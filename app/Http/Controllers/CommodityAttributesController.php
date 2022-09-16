<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commodity;
use App\Models\CommodityCategory;
use App\Models\CommodityType;
use App\Models\CommodityPrice;
use App\Models\CommodityQuantity;
use App\Models\CommodityUnit;
use App\Models\CommodityAquisitionDate;

class CommodityAttributesController extends Controller
{

   /**
    * Assign Commodity Attributes
     */
   public  function assignCommodityAttributes($id)
   {
        $commodity = Commodity::find($id);

        return view('commodities.add_commodity_attributes', compact(
            'commodity',
        ));
   }

   /**
    * Store Commodity Attributes
    */
   public function storeCommodityAttributes(Request $request)
   {
        $commodity_id = $request->commodity_id;
        // $commodity_category = $request->commodity_category;
        $commodity_type = $request->commodity_type;
        $cost_price = $request->cost_price;
        $commodity_quantity = $request->commodity_quantity;
        $commodity_unit = $request->commodity_unit;
        $acquisition_date = $request->acquisition_date;

        // $commodityCategory = CommodityCategory::create([

        // ]);

        $commodityType = CommodityType::create([
            'commodity_id' => $commodity_id,
            'type_name' => $commodity_type,
        ]);

        $commodityPrice = CommodityPrice::create([
            'commodity_id' => $commodity_id,
            'price' => $cost_price,
        ]);

        $commodityQuantity = CommodityQuantity::create([
            'commodity_id' => $commodity_id,
            'quantity' => $commodity_quantity,
        ]);

        $commodityUnit = CommodityUnit::create([
            'commodity_id' => $commodity_id,
            'unit' => $commodity_unit,
        ]);

        $commodityAquisitionDate = CommodityAquisitionDate::create([
            'commodity_id' => $commodity_id,
            'aquisition_date' => $acquisition_date,
        ]);

        return redirect("/home");

   }
}
