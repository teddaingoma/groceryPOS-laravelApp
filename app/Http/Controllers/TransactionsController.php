<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Commodity;
use App\Models\CommoditySellInvoice;
use App\Models\CommodityType;
use App\Models\SoldTypeItem;
use App\Models\TypeQuantity;
use App\Models\TypeSellInvoive;

use Carbon\Carbon;

class TransactionsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the form for adding or creating a commodity sell invoice.
     *
     * @param  int  $commodity
     *
     * @return \Illuminate\Http\Response
     */
    public function sellCommodity($commodity)
    {
        $Commodity = Commodity::find($commodity);

         if  ($Commodity->user_id !== auth()->user()->id) {
            return redirect()->route('home.index');
        }

        return view('sales.commodities.sell_commodity', compact(
            'Commodity'
        ));
    }

    /**
     * Store a newly created commodity sell invoice in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function recordSellCommodity(Request $request)
    {
        $commodity_id = $request->commodity_id;
        $sell_quantity = $request->sell_quantity;
        $selling_price = $request->selling_price;
        $payment = $request->paid_amount;

        $TotalCost = $selling_price * $sell_quantity;

        $Commodity = Commodity::find($commodity_id);

        if ($Commodity->Quantity == null)
        {
            $message = "$Commodity->name is empty. Might consider purchasing some stock.";
            return redirect()->route('home.show', ['home' => $commodity_id])->with('status', $message);
        }

        if ($Commodity->Quantity !== null)
        {
            if ($Commodity->Quantity->quantity < 1)
            {
                $message = "Sorry, it appears $Commodity->name is out of stock. Consider re-ordering";
                return redirect()->route('home.show', ['home' => $commodity_id])->with('status', $message);
            }

            if ($Commodity->Quantity->quantity > 0)
            {
                if ($Commodity->Quantity->quantity < $sell_quantity)
                {
                    $message = "Sorry, it appears you have less inventory, almost ".$Commodity->Quantity->quantity." left!";
                    return redirect()->route('home.show', ['home' => $commodity_id])->with('status', $message);
                }

                if ($Commodity->Quantity->quantity >= $sell_quantity)
                {
                    if ($payment < $TotalCost)
                    {
                        $top_up = $TotalCost - $payment;
                        $message = "Sorry, the amount Paid, MWK$payment, is less than the total cost of the item (s), MWK$TotalCost. May you top up atleast MWK$top_up";
                        return redirect()->back()->with('status', $message);
                    }

                    if ($payment >= $TotalCost)
                    {
                        if ($request->user()->soldCommodityItem()->where('commodity_id', $Commodity->id) !== null)
                        {
                            $current_sells = $Commodity->SoldCommodityItem->sold_quantity + $sell_quantity;

                            $request->user()->soldCommodityItem()->where('commodity_id', $Commodity->id)->update([
                                'sold_quantity' => $current_sells
                            ]);
                        }

                        if ($Commodity->SoldCommodityItem == null)
                        {
                            $request->user()->soldCommodityItem()->create([
                                'commodity_id' => $commodity_id,
                                'sold_quantity' => $sell_quantity
                            ]);
                        }

                        $current_quantity = $Commodity->Quantity->quantity - $sell_quantity;

                        $Commodity->Quantity()->where('commodity_id', $commodity_id)->update([
                            'quantity' => $current_quantity,
                        ]);

                        $change = $payment - $TotalCost;

                        if ($request->customer_id == null)
                            $customer_id = 0;
                        else if ($request->customer_id !== null)
                            $customer_id = $request->customer_id;

                        $user_id = $request->user()->id;

                        CommoditySellInvoice::create([
                            'commodity_id' => $commodity_id,
                            'sell_quantity' => $sell_quantity,
                            'selling_price' => $selling_price,
                            'total_cost' => $TotalCost,
                            'payment' => $payment,
                            'change' => $change,
                            'user_id' => $user_id,
                            'customer_id' => $customer_id,
                        ]);

                        $message = "Successfully sold $sell_quantity item (s) of $Commodity->name!";
                        return redirect()->route('home.index')->with('status', $message);

                    }
                }
            }
        }

    }

    /**
     * Show the form for adding or creating a type sell invoice.
     *
     * @param  int  $commodity, $type
     *
     * @return \Illuminate\Http\Response
     */
    public function sellType($commodity, $type)
    {
        $Commodity = Commodity::find($commodity);

        if  ($Commodity->user_id !== auth()->user()->id) {
            return redirect()->route('home.index');
        }
        $commodity_type_id = $type;

        return view('sales.types.sell_type', compact(
            'Commodity',
            'commodity_type_id',
        ));
    }

    /**
     * Store a newly created commodity sell invoice in storage.
     *
     * @param  \Illuminate\Http\Request  $request, int $commodity, $type
     * @return \Illuminate\Http\Response
     */
    public function recordSellType(Request $request, $commodity, $type)
    {
        $commodity_id = $commodity;
        $sell_quantity = $request->sell_quantity;
        $payment = $request->paid_amount;

        $commodityType = CommodityType::find($type);
        $selling_price = $commodityType->TypePrice->type_price;

        $TotalCost = $selling_price * $sell_quantity;

        if ($commodityType->TypeQuantity == NULL)
        {
            $message = "$commodityType->type_name has no inventory level. Might consider purchasing some stock.";
            return redirect()->route('home.show', ['home' => $commodity_id])->with('status', $message);
        }
        if ($commodityType->TypeQuantity !== NULL)
        {
            if ($commodityType->TypeQuantity->type_quantity < 1)
            {
                $message = "Sorry, it appears $commodityType->type_name is out of stock. Consider re-ordering";
                return redirect()->route('home.show', ['home' => $commodity_id])->with('status', $message);
            }

            if ($commodityType->TypeQuantity->type_quantity > 0)
            {
                if ($commodityType->TypeQuantity->type_quantity < $sell_quantity)
                {
                    $message = "Sorry, it appears you have less inventory, almost ".$commodityType->TypeQuantity->type_quantity." left!";
                    return redirect()->route('home.show', ['home' => $commodity_id])->with('status', $message);
                }

                if ($commodityType->TypeQuantity->type_quantity >= $sell_quantity)
                {
                    if ($payment < $TotalCost)
                    {
                        $top_up = $TotalCost - $payment;
                        $message = "Sorry, the amount Paid, MWK$payment, is less than the total cost of the item (s), MWK$TotalCost. May you top up atleast MWK$top_up";
                        return redirect()->back()->with('status', $message);
                    }
                    if ($payment >= $TotalCost)
                    {
                        if ($commodityType->soldTypeItem == NULL)
                        {
                            $soldTypeItem = SoldTypeItem::create([
                                'commodity_id' => $commodity_id,
                                'commodity_type_id' => $type,
                                'sold_quantity' => $sell_quantity,
                                'selling_price' => $selling_price,
                            ]);
                        }
                        if ($commodityType->soldTypeItem !== NULL)
                        {
                            $current_sells = $commodityType->SoldTypeItem->sold_quantity + $sell_quantity;

                            $soldTypeItem = SoldTypeItem::where('commodity_type_id', $type)->update([
                                'sold_quantity' => $current_sells,
                                'selling_price' => $selling_price,
                            ]);
                        }

                        $current_quantity = $commodityType->TypeQuantity->type_quantity - $sell_quantity;
                        $updateTypeQuantity = TypeQuantity::where('commodity_type_id', $type)->update([
                            'type_quantity' => $current_quantity,
                        ]);

                        $change = $payment - $TotalCost;

                        if ($request->customer_id == null)
                            $customer_id = 0;
                        else if ($request->customer_id !== null)
                            $customer_id = $request->customer_id;

                        $user_id = $request->user()->id;

                        $TypeSellInvoive = TypeSellInvoive::create([
                            'commodity_id' => $commodity_id,
                            'commodity_type_id' => $type,
                            'sell_quantity' => $sell_quantity,
                            'selling_price' => $selling_price,
                            'total_cost' => $TotalCost,
                            'payment' => $payment,
                            'change' => $change,
                            'user_id' => $user_id,
                            'customer_id' => $customer_id,
                        ]);

                        // {{ Str::plural('like', $post->likes->count()) }}
                        $message = "Successfully sold $sell_quantity item (s) of $commodityType->type_name!";
                        return redirect()->route('home.show', ['home' => $commodity_id])->with('status', $message);
                    }
                }
            }
        }
    }

    /**
     * Show the the list of available commodities to sell
     *
     * @return \Illuminate\Http\Response
     */
    public function AvailableCommodities()
    {
        if (auth()->user()->businesses == null)
            return redirect()->route('home.index');

        $data = Commodity::select('id', 'created_at')->get()->groupBy(function($data){
            return Carbon::parse($data->created_at)->format('M');
        });

        $months = [];
        $monthCount = [];

        foreach($data as $month => $values)
        {
            $months[] = $month;
            $monthCount[] = count($values);
        }

        $commodities = Commodity::all();
        return view('sales.available_commodities', compact(
            'commodities',
            'data',
            'months',
            'monthCount'
        ));
    }

    public function bar_chart()
    {
        $months = [];
        $monthCount = [];
        $commodities = [];
        $commdityQty = [];
        $actualSales = [];
        $customers = [];
        $suppliers = [];
        $cusSellCount = [];
        $supPurchCount = [];

        ////
        $commodity_data = auth()->user()->commodities;
        $customer_data = auth()->user()->customers;
        $supplier_data = auth()->user()->suppliers;

        $month_data = Commodity::select('id', 'created_at')->where('user_id', auth()->user()->id)->get()->groupBy(function($month_data){
            return Carbon::parse($month_data->created_at)->format('M');
        });

        foreach($month_data as $month => $values)
        {
            $months[] = $month;
            $monthCount[] = count($values);
        }

        foreach($commodity_data as $commodity)
        {
            $commodities[] = $commodity->name;
            $commodityQty[] = $commodity->Quantity->quantity;
            $actualSales[] = ($commodity->SoldCommodityItem->sold_quantity *$commodity->Price->price);

            if ($commodity->Types->count())
            {
                foreach ($commodity->Types as $type)
                {
                    $commodities[] = $type->type_name;
                    $commodityQty[] = $type->TypeQuantity->type_quantity;
                    $actualSales[] = ($type->SoldTypeItem->sold_quantity * $type->TypePrice->type_price);
                }
            }
        }

        foreach($customer_data as $customer)
        {
            $customers[] = $customer->name;
            $cusSellCount[] = $customer->commoditySellInvoices()->count() + $customer->typeSellInvoices()->count();
        }

        foreach($supplier_data as $supplier)
        {
            $suppliers[] = $supplier->name;
            $supPurchCount[] = $supplier->commodityPurchaseInvoices()->count() + $supplier->typePurchaseInvoices()->count();
        }

        return view('charts.bar_chart', compact(
            'months',
            'monthCount',
            'commodities',
            'commodityQty',
            'actualSales',
            'customers',
            'suppliers',
            'cusSellCount',
            'supPurchCount'
        ));
    }

    /**
     * Display a listing of the sales reports.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewSalesReport()
    {
        foreach(auth()->user()->commoditySellInvoices as $commoditySellInvoice)
        {
            ($commoditySellInvoice->Customer);
        }
        if (auth()->user()->businesses == null)
            return redirect()->route('home.index');

        $totalGrossProfit = 0.0;
        $totalActualSales = 0.0;
        $totalPurchaseCosts = 0.0;
        $commodity_gross_profit = 0;
        $itemSales = 0;


        // commodity budgeted sales
        foreach (auth()->user()->commodityBudgetedSales as $budgetedSales)
        {
            /**
             * Item Gross Profit = Budgeted sales - costs of purchasing that item
             * $itemGrossProfit = $itemBudgetedSales - $itemCosts
             *
             * $itemBudgetedSales = $Sales->$quantity * $item_selling_price
             * $itemCosts = $Purchases->quantity * $item_cost_price
             */
            $commodity_gross_profit = ( $budgetedSales->quantity * $budgetedSales->CommodityBudgetedSale->Price->price ) -
            ( $budgetedSales->quantity * $budgetedSales->CommodityBudgetedSale->CostPrice->cost_price );

            $totalGrossProfit = $totalGrossProfit + $commodity_gross_profit;
        }

        // type budgeted sales
        foreach (auth()->user()->typeBudgetedSales as $typeSale)
        {
            /**
             * Item Gross Profit = Budgeted sales - costs of purchasing that item
             * $itemGrossProfit = $itemBudgetedSales - $itemCosts
             *
             * $itemBudgetedSales = $Sales->$quantity * $item_selling_price
             * $itemCosts = $Purchases->quantity * $item_cost_price
             */
            $type_gross_profit = ( $typeSale->CommodityType->TypePrice->type_price * $typeSale->quantity ) -
            ( $typeSale->CommodityType->TypeCostPrice->type_cost_price * $typeSale->CommodityType->TypeQuantity->type_quantity );

            $totalGrossProfit = $totalGrossProfit + $type_gross_profit;

        }

        // actual commodity sales
        foreach (auth()->user()->soldCommodityItem as $soldCommodity )
        {
            /**
             * item sales = total sold amount * item's selling price
             */
            $itemSales = $soldCommodity->sold_quantity * $soldCommodity->SoldCommodity->Price->price;
            $totalActualSales = $totalActualSales + $itemSales;
        }

        // actual type sales
        foreach (auth()->user()->soldTypeItem as $soldType )
        {
            /**
             * item sales = total sold amount * item's selling price
             */
            $itemSales = $soldType->sold_quantity * $soldType->SoldType->TypePrice->type_price;
            $totalActualSales = $totalActualSales + $itemSales;
        }

        return view('sales.sales_report', compact(
            'totalGrossProfit',
            'totalActualSales',
        ));
    }

    /**
     * Display a listing of the financial reports.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewFinancialStatements()
    {
        if (auth()->user()->businesses == null)
            return redirect()->route('home.index');

        $totalGrossProfit = 0.0;
        $totalActualSales = 0.0;
        $totalPurchaseCosts = 0.0;

        /**
         * Eloquence
         */

        // actual commodity sales
        foreach (auth()->user()->soldCommodityItem as $soldCommodity )
        {
            /**
             * item sales = total sold amount * item's selling price
             */
            $itemSales = $soldCommodity->sold_quantity * $soldCommodity->SoldCommodity->Price->price;
            $totalActualSales = $totalActualSales + $itemSales;
        }

        // actual type sales
        foreach (auth()->user()->soldTypeItem as $soldType )
        {
            /**
             * item sales = total sold amount * item's selling price
             */
            $itemSales = $soldType->sold_quantity * $soldType->SoldType->TypePrice->type_price;
            $totalActualSales = $totalActualSales + $itemSales;
        }

        // commodity cost of sales / purchase costs
        foreach(auth()->user()->commodityPurchases as $Purchases)
        {
            // total cost of purchasing inventory items
            $itemPurchases = $Purchases->quantity * $Purchases->CommodityPurchase->CostPrice->cost_price;
            $totalPurchaseCosts = $totalPurchaseCosts + $itemPurchases;
        }

        // commodity cost of sales / purchase costs
        foreach (auth()->user()->typePurchases as $typePurchase)
        {
            $itemPurchases = $typePurchase->quantity *  $typePurchase->CommodityType->TypeCostPrice->type_cost_price;
            $totalPurchaseCosts = $totalPurchaseCosts + $itemPurchases;
        }

        /** */

        return view('sales.financial_statements', compact(
            'totalActualSales',
            'totalPurchaseCosts',
        ));
    }

    /**
     * Display a listing of the financial reports.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewPurchaseReport()
    {
        if (auth()->user()->businesses == null)
            return redirect()->route('home.index');

        $totalPurchaseCosts = 0.0;

        foreach(auth()->user()->commodityPurchases as $Purchases)
        {
            // total cost of purchasing inventory items
            $itemPurchases = $Purchases->quantity * $Purchases->CommodityPurchase->CostPrice->cost_price;
            $totalPurchaseCosts = $totalPurchaseCosts + $itemPurchases;
        }

        foreach (auth()->user()->typePurchases as $typePurchase)
        {
            $itemPurchases = $typePurchase->quantity *  $typePurchase->CommodityType->TypeCostPrice->type_cost_price;
            $totalPurchaseCosts = $totalPurchaseCosts + $itemPurchases;
        }

        return view('sales.purchases_report', compact(
            'totalPurchaseCosts'
        ));
    }
}
