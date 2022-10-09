<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Commodity;
use App\Models\SoldCommodityItem;
use App\Models\CommodityQuantity;
use App\Models\CommoditySellInvoice;

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
}