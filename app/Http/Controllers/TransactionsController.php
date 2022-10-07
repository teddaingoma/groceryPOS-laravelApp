<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Commodity;
use App\Models\SoldCommodityItem;
use App\Models\CommodityQuantity;

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

        $commodityQuantity = DB::table('commodity_quantities')
                                ->where('commodity_id', $commodity_id)
                                ->first()
        ;

        $current_quantity = $commodityQuantity->quantity - $sell_quantity;

        $soldCommodityItem = SoldCommodityItem::create([
            'commodity_id' => $commodity_id,
            'sold_quantity' => $sell_quantity,
            'selling_price' => $selling_price,
        ]);

        $updateCommodityQuantity = CommodityQuantity::where('commodity_id', $commodity_id)->update([
            'quantity' => $current_quantity,
        ]);

        $message = "Successfully Sold";

        return redirect()->route('home.index')->with('status', $message);
    }
}
