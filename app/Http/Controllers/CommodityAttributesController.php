<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commodity;
use App\Models\Category;
use App\Models\CommodityCategory;
use App\Models\CommodityType;
use App\Models\CommodityCostPrice;
use App\Models\CommodityPrice;
use App\Models\CommodityQuantity;
use App\Models\CommodityUnit;
use App\Models\CommodityAquisitionDate;
use App\Models\CommodityPurchase;
use App\Models\CommodityBudgetedSale;

class CommodityAttributesController extends Controller
{

   /**
    * Assign Commodity Attributes
     */
   public  function assignCommodityAttributes($id)
   {
        $commodity = Commodity::find($id);
        $categories = Category::all();

        return view("commodities.add_commodity_attributes", compact(
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
        $cost_price = $request->cost_price;
        $selling_price = $request->selling_price;
        $commodity_quantity = $request->commodity_quantity;
        $commodity_unit = $request->commodity_unit;
        $acquisition_date = $request->acquisition_date;

        $commodityCategory = CommodityCategory::create([
            'commodity_id' => $commodity_id,
            'category_id' => $category_id,
        ]);

        $commodityCostPrice = CommodityCostPrice::create([
            'commodity_id' => $commodity_id,
            'cost_price' => $cost_price
        ]);

        $commodityPrice = CommodityPrice::create([
            'commodity_id' => $commodity_id,
            'price' => $selling_price,
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

        $commodityPurchase = CommodityPurchase::create([
            'commodity_id' => $commodity_id,
            'quantity' => $commodity_quantity,
            'cost_price' => $cost_price
        ]);

        $commodityBudgetedSale = CommodityBudgetedSale::create([
            'commodity_id' => $commodity_id,
            'quantity' => $commodity_quantity,
            'selling_price' => $selling_price
        ]);

        if (
            $commodityCategory == true &&
            $commodityCostPrice == true &&
            $commodityPrice == true &&
            $commodityQuantity == true &&
            $commodityUnit == true &&
            $commodityAquisitionDate == true &&
            $commodityPurchase == true &&
            $commodityBudgetedSale == true
        )
        {
            $message = "Successfully Added";
            return redirect()->route('home.show', ['home' => $commodity_id])->with('status', $message);
        }
        else
        {
            return redirect()->route('home.index');
        }

   }

   /**
    * Add Commodity Type
    */
    public function addCommodityType($id)
    {
        $commodity = Commodity::find($id);


        return view('commodities.add_commodity_type', compact(
            'commodity',
        ));

    }

    /**
     * Store commodity Type
     */
    public function storeCommodityType(Request $request)
    {
        $commodity_id = $request->commodity_id;
        $commodity = Commodity::find($commodity_id);
        $commodity_type = $request->commodity_type;


        if ($request->commodity_type_image !== NULL)
        {
            $Commodity_type_image = $commodity_type . '-' . time() . '.' . $request->commodity_type_image->extension();
            $request->commodity_type_image->move(public_path('commodity_images'), $Commodity_type_image);
        }

        if ($request->commodity_type_image == NULL)
        {
            $Commodity_type_image = $commodity->image_path;
        }

        if ($request->commodity_type_description !== NULL)
        {
            $type_description = $request->commodity_type_description;
        }

        if ($request->commodity_type_description == NULL)
        {
            $type_description = $commodity->description;
        }

        $commodityType = CommodityType::create([
            'commodity_id' => $commodity_id,
            'type_name' => $commodity_type,
            'description' => $type_description,
            'image_path' => $Commodity_type_image,
        ]);

        if ($commodityType == true)
        {
            $commodity_type_id = $commodityType->id;
            $message = "Successfully added type $commodity_type";

            return redirect()->route(
                'assign_type_attributes', [
                    'commodity' => $commodity_id,
                    'type' => $commodity_type_id
                ]
            )->with('status', $message);

        }
        else
        {
            return redirect()->route('home.index');
        }
    }

    /**
     * Add Commodity Category
     */
    public function addCommodityCategory($id)
    {
        $commodity = Commodity::find($id);
        $categories = Category::all();
        $commodityPrice = CommodityPrice::all();
        $commodityQuantity = CommodityQuantity::all();
        $commodityUnit = CommodityUnit::all();
        $aquisitionDates = CommodityAquisitionDate::all();

        return view('commodities.add_commodity_category', compact(
            'commodity',
            'categories',
            'commodityPrice',
            'commodityQuantity',
            'commodityUnit',
            'aquisitionDates',
        ));
    }

    /**
     * Store Commodity Category
     */
    public function storeCommodityCategory(Request $request)
    {
        $commodity_id = $request->commodity_id;
        $category_id = $request->category_id;

        $commodityCategory = CommodityCategory::create([
            'commodity_id' => $commodity_id,
            'category_id' => $category_id,
        ]);

        if ($commodityCategory == true)
        {
            $message = "Category Added Successfully";
            return redirect()->route('home.show', ['home' => $commodity_id])->with('status', $message);
        }
        else
        {
            return redirect()->route('home.index');
        }
    }

    /**
     * Add Commodity Price
     */
    public function addCommodityPrice($id)
    {
        $commodity = Commodity::find($id);
        $categories = Category::all();
        $commodityPrice = CommodityPrice::all();
        $commodityQuantity = CommodityQuantity::all();
        $commodityUnit = CommodityUnit::all();
        $aquisitionDates = CommodityAquisitionDate::all();

        return view('commodities.add_commodity_price', compact(
            'commodity',
            'categories',
            'commodityPrice',
            'commodityQuantity',
            'commodityUnit',
            'aquisitionDates',
        ));
    }

    /**
     * Store commodity Price
     */
    public function storeCommodityPrice(Request $request)
    {
        $commodity_id = $request->commodity_id;
        $cost_price = $request->cost_price;

        $commodityPrice = CommodityPrice::create([
            'commodity_id' => $commodity_id,
            'price' => $cost_price,
        ]);

        if ($commodityPrice == true)
        {
            return redirect("/home/$commodity_id");
        }
        else
        {
            return redirect()->route('home.index');
        }
    }

    /**
     * Assign a Commodity's Unit of Measurement
     */
    public function addCommodityUnit($id)
    {
        $commodity = Commodity::find($id);

        return view('commodities.add_commodity_unit', compact(
            'commodity'
        ));
    }

    /**
     * Store a commodity's Unit of measurement
     */
    public function storeCommodityUnit(Request $request)
    {
        $commodity_id = $request->commodity_id;
        $commodity_unit = $request->commodity_unit;

        $commodityUnit = CommodityUnit::create([
            'commodity_id' => $commodity_id,
            'unit' => $commodity_unit,
        ]);

        if ($commodityUnit == true)
        {
            return redirect("/home/$commodity_id");
        }
        else
        {
            return redirect()->route('home.index');
        }
    }

    /**
     * Add a commodity's Acquisition Date
     */
    public function addCommodityAquisitionDate($id)
    {
        $commodity = Commodity::find($id);
        return view('commodities.add_commodity_acq-date', compact(
            'commodity'
        ));
    }

    /**
     * Store a commodity's Acquisition Date
     */
    public function storeCommodityAquisitionDate(Request $request)
    {
        $commodity_id = $request->commodity_id;
        $acquisition_date = $request->acquisition_date;

        $commodityAquisitionDate = CommodityAquisitionDate::create([
            'commodity_id' => $commodity_id,
            'aquisition_date' => $acquisition_date,
        ]);

        if ($commodityAquisitionDate == true)
        {
            return redirect("/home/$commodity_id");
        }
        else
        {
            return redirect()->route('home.index');
        }
    }

    /**
     * Add a commodity's available quantity
     */
    public function addCommodityQuantity($id)
    {
        $commodity = Commodity::find($id);
        return view('commodities.add_commodity_quantity', compact(
            'commodity'
        ));
    }

    /**
     * Store a commodity's available quantity
     */
    public function storeCommodityQuantity(Request $request)
    {
        $commodity_id = $request->commodity_id;
        $commodity_quantity = $request->commodity_quantity;

        $commodityQuantity = CommodityQuantity::create([
            'commodity_id' => $commodity_id,
            'quantity' => $commodity_quantity,
        ]);

        if ($commodityQuantity == true)
        {
            return redirect("/home/$commodity_id");
        }
        else
        {
            return redirect()->route('home.index');
        }
    }
}
