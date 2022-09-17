<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commodity;
use App\Models\Category;
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
        $categories = Category::all();

        return view('commodities.add_commodity_attributes', compact(
            'commodity',
            'categories'
        ));
   }

   /**
    * Store Commodity Attributes
    */
   public function storeCommodityAttributes(Request $request)
   {
        $commodity_id = $request->commodity_id;
        $category_id = $request->category_id;
        $commodity_type = $request->commodity_type;
        $cost_price = $request->cost_price;
        $commodity_quantity = $request->commodity_quantity;
        $commodity_unit = $request->commodity_unit;
        $acquisition_date = $request->acquisition_date;

        $commodityCategory = CommodityCategory::create([
            'commodity_id' => $commodity_id,
            'category_id' => $category_id,
        ]);

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

        return redirect()->route('home.index');

   }

   /**
    * Add Commodity Type
    */
    public function addCommodityType($id)
    {
        $commodity = Commodity::find($id);
        $commodityPrice = CommodityPrice::all();
        $commodityQuantity = CommodityQuantity::all();
        $commodityUnit = CommodityUnit::all();
        $aquisitionDates = CommodityAquisitionDate::all();

        return view('commodities.add_commodity_type', compact(
            'commodity',
            'commodityPrice',
            'commodityQuantity',
            'commodityUnit',
            'aquisitionDates',
        ));

    }

    /**
     * Store commodity Type
     */
    public function storeCommodityType(Request $request)
    {
        $commodity_id = $request->commodity_id;
        $commodity_type = $request->commodity_type;

        $commodityType = CommodityType::create([
            'commodity_id' => $commodity_id,
            'type_name' => $commodity_type,
        ]);

        if ($commodityType == true)
        {
            return redirect()->route('home.index');
        }
    }
}
