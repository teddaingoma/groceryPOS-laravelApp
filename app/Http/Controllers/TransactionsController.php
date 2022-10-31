<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Commodity;
use App\Models\SoldCommodityItem;
use App\Models\CommodityQuantity;
use App\Models\CommoditySellInvoice;
use App\Models\CommodityType;
use App\Models\SoldTypeItem;
use App\Models\TypeQuantity;
use App\Models\TypeSellInvoive;

class TransactionsController extends Controller
{
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
            $message = "$Commodity->name has no inventory level. Might consider purchasing some stock.";
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
                        $message = "Sorry, the amount Paid, MWK$payment, is less then the total cost of the item (s), MWK$TotalCost. May you top up atleast MWK$top_up";
                        return redirect()->back()->with('status', $message);
                    }

                    if ($payment >= $TotalCost)
                    {

                        if ($Commodity->SoldCommodityItem !== null)
                        {
                            $current_sells = $Commodity->SoldCommodityItem->sold_quantity + $sell_quantity;

                            $soldCommodityItem = SoldCommodityItem::where('commodity_id', $commodity_id)->update([
                                'sold_quantity' => $current_sells,
                                'selling_price' => $selling_price,
                            ]);
                        }

                        if ($Commodity->SoldCommodityItem == null)
                        {
                            $soldCommodityItem = SoldCommodityItem::create([
                                'commodity_id' => $commodity_id,
                                'sold_quantity' => $sell_quantity,
                                'selling_price' => $selling_price,
                            ]);
                        }

                        $current_quantity = $Commodity->Quantity->quantity - $sell_quantity;
                        $updateCommodityQuantity = CommodityQuantity::where('commodity_id', $commodity_id)->update([
                            'quantity' => $current_quantity,
                        ]);

                        $change = $payment - $TotalCost;

                        $commoditySellInvoice = CommoditySellInvoice::create([
                            'commodity_id' => $commodity_id,
                            'sell_quantity' => $sell_quantity,
                            'selling_price' => $selling_price,
                            'total_cost' => $TotalCost,
                            'payment' => $payment,
                            'change' => $change,
                            'owner_id' => 0,
                            'customer_id' => 0,
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

                        $TypeSellInvoive = TypeSellInvoive::create([
                            'commodity_id' => $commodity_id,
                            'commodity_type_id' => $type,
                            'sell_quantity' => $sell_quantity,
                            'selling_price' => $selling_price,
                            'total_cost' => $TotalCost,
                            'payment' => $payment,
                            'change' => $change,
                            'owner_id' => 0,
                            'customer_id' => 0,
                        ]);

                        $message = "Successfully sold $sell_quantity item (s) of $commodityType->type_name!";
                        return redirect()->route('home.show', ['home' => $commodity_id])->with('status', $message);
                    }
                }
            }
        }
    }
}
