<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commodity;
use App\Models\CommodityPrice;
use App\Models\CommodityQuantity;
use App\Models\CommodityUnit;
use App\Models\CommodityAquisitionDate;
use App\Models\Category;
use App\Models\CommodityBudgetedSale;
use App\Models\CommodityPurchase;
use App\Models\SoldCommodityItem;

use NunoMaduro\Collision\Adapters\Phpunit\Printer;

class CommoditiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commodities = Commodity::all();
        $commodityBudgetedSales = CommodityBudgetedSale::all();
        $commodityPurchases = CommodityPurchase::all();
        $soldCommodityItem = SoldCommodityItem::all();

        $totalGrossProfit = 0.0;
        $totalActualSales = 0.0;

        foreach ($commodityBudgetedSales as $Sales)
        {
            foreach ($commodityPurchases as $Purchases)
            {
                if ($Sales->commodity_id == $Purchases->commodity_id)
                {
                    /*
                        print("------Budgeted Sales-----");
                        print($Sales->CommodityBudgetedSale->name);
                        print("-");
                        Print($Sales->quantity);
                        print("-");
                        print($Sales->selling_price);
                        print("-");
                        print($Sales->quantity * $Sales->selling_price);
                        print("-Budgeted");
                        print("------Purchases-----");
                        print("-");
                        print($Purchases->CommodityPurchase->name);
                        print("-");
                        print($Purchases->quantity);
                        print("-");
                        print($Purchases->cost_price);
                        print("-Cost of sales");
                        print($Purchases->quantity * $Purchases->cost_price);
                        print("****************");
                    */
                    $itemBudgetedSales = $Sales->quantity * $Sales->selling_price;
                    $itemPurchases = $Purchases->quantity * $Purchases->cost_price;
                    $itemGrossProfit = $itemBudgetedSales - $itemPurchases;
                    $totalGrossProfit = $totalGrossProfit + $itemGrossProfit;
                }
            }

        }

        foreach ($soldCommodityItem as $soldCommodity)
        {
            $itemSales = $soldCommodity->sold_quantity * $soldCommodity->selling_price;
            $totalActualSales = $totalActualSales + $itemSales;
        }

        return view('commodities.view_commodities', compact(
            'commodities',
            'commodityBudgetedSales',
            'commodityPurchases',
            'soldCommodityItem',
            'totalGrossProfit',
            'totalActualSales',
        ));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("commodities.add_commodity");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->commodity_image == NULL)
        {
            $Commodity_image = 'item-light.ico';
        }
        else if ($request->commodity_image != NULL)
        {
            $Commodity_image = $request->commodity_name . '-' . time() . '.' . $request->commodity_image->extension();
            $request->commodity_image->move(public_path('commodity_images'), $Commodity_image);
        }

        $commodity = Commodity::create([
            'name' => $request->input('commodity_name'),
            'description' => $request->input('commodity_description'),
            'image_path' => $Commodity_image,
        ]);

        if ($commodity == true)
        {
            $message = "Added $request->commodity_name successfully.";

            $commodity_id = $commodity -> id;

            $SoldCommodityItem = SoldCommodityItem::create([
                'commodity_id' => $commodity_id,
                'sold_quantity' => '0',
                'selling_price' => '00.00',
            ]);

            return redirect()->route('assign_commodity_attributes', ['id' => $commodity_id])->with('status', $message);
        }
        else
        {
            return redirect()->route('home.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $commodity = Commodity::find($id);
        return view('commodities.show_commodity', compact(
            'commodity'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $commodity = Commodity::find($id);
        $categories = Category::all();

       return view('commodities.edit_commodity',compact(
        'commodity',
        'categories'
       ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $commodity = Commodity::find($id);

        if ($request->commodity_name !== NULL)
        {
            $name = $request->commodity_name;

            if ($request->commodity_image !== NULL)
            {
                $Commodity_image = $name . '-' . time() . '.' . $request->commodity_image->extension();
                $request->commodity_image->move(public_path('commodity_images'), $Commodity_image);
            }
        }

        if ($request->commodity_name == NULL)
        {
            $name = $commodity->name;

            if ($request->commodity_image !== NULL)
            {
                $Commodity_image = $commodity->name . '-' . time() . '.' . $request->commodity_image->extension();
                $request->commodity_image->move(public_path('commodity_images'), $Commodity_image);
            }
        }

        if ($request->commodity_description !== NULL)
        {
            $description = $request->commodity_description;
        }

        if ($request->commodity_description == NULL)
        {
            $description = $commodity->description;
        }

        if ($request->commodity_image == NULL)
        {
            $Commodity_image = $commodity->image_path;
        }

        $update_commodity = Commodity::where('id', $id)->update([
            'name' => $name,
            'description' => $description,
            'image_path' => $Commodity_image,
        ]);

        return redirect()->route('home.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
