<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Commodity;
use App\Models\CommodityType;
use App\Models\TypeAquisitionDate;
use App\Models\TypeCostPrice;
use App\Models\TypePrice;
use App\Models\TypeQuantity;
use App\Models\TypePurchase;
use App\Models\TypeBudgetedSale;
use App\Models\SoldTypeItem;

class CommodityTypesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $commodity and $type
     * @return \Illuminate\Http\Response
     */
    public function editCommodityType($commodity, $type)
    {
        $Commodity = Commodity::find($commodity);
        $commodity_type_id = $type;

        return view('commodities.types.edit_commodity_type', compact(
            'Commodity',
            'commodity_type_id',
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $commodity, $type
     * @return \Illuminate\Http\Response
     */
    public function updateCommodityType(Request $request, $commodity, $type)
    {
        $commodity = Commodity::find($commodity);
        $commodity_type = CommodityType::find($type);

        $Type_price = DB::table('type_prices')
                        ->where('commodity_type_id', $type)
                        ->first();
        $Type_aquisition_date = DB::table('type_aquisition_dates')
                                    ->where('commodity_type_id', $type)
                                    ->first();

        if ($request->commodity_type == NULL)
        {
            $type_name = $commodity_type->type_name;
        }

        if ($request->commodity_type !== NULL)
        {
            $type_name = $request->commodity_type;
        }

        if ($request->commodity_type_description == NULL)
        {
            $type_description = $commodity_type->description;
        }

        if ($request->commodity_type_description !== NULL)
        {
            $type_description = $request->commodity_type_description;
        }

        if ($request->commodity_type_image == NULL)
        {
            $Commodity_type_image = $commodity_type->image_path;
        }

        if ($request->commodity_type_image !== NULL)
        {
            $Commodity_type_image = $type_name . '-' . time() . '.' . $request->commodity_type_image->extension();
            $request->commodity_type_image->move(public_path('commodity_images'), $Commodity_type_image);
        }

        if ($request->type_cost_price == NULL)
        {
            $type_cost_price = $commodity_type->TypeCostPrice->type_cost_price;
        }
        if ($request->type_cost_price !== NULL)
        {
            $type_cost_price = $request->type_cost_price;
        }

        if ($request->type_selling_price == NULL)
        {
            $type_selling_price = $commodity_type->TypePrice->type_price;
        }
        if ($request->type_selling_price !== NULL)
        {
            $type_selling_price = $request->type_selling_price;
        }

        if ($request->type_acquisition_date == NULL)
        {
            $type_aquisition_date = $Type_aquisition_date->type_aquisition_date;
        }
        if ($request->type_acquisition_date !== NULL)
        {
            $type_aquisition_date = $request->type_acquisition_date;
        }

        $update_commodity_type = CommodityType::where('id', $type)->update([
            'type_name' => $type_name,
            'description' => $type_description,
            'image_path' => $Commodity_type_image
        ]);

        $update_type_cost_price = TypeCostPrice::where('commodity_type_id', $type)->update([
            'type_cost_price' => $type_cost_price,
        ]);

        $update_type_selling_price = TypePrice::where('commodity_type_id', $type)->update([
            'type_price' => $type_selling_price,
        ]);

        $update_type_aquisition_date = TypeAquisitionDate::where('commodity_type_id', $type)->update([
            'type_aquisition_date' => $type_aquisition_date
        ]);

        $message = "Successfully Updated $type_name";
        return redirect()->route(
            'show_commodity_type', [
                'commodity' => $commodity,
                'type' => $type
            ]
        )->with('status', $message);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(                $id)
    {
        $type = CommodityType::find($id);

        $type->delete();

        return redirect()->route("home.index");
    }

    /**
     * Show a Commodity's Type.
     * Will get the commodity and type's id
     *
     * @param  int  $commodity, $type
     * @return \Illuminate\Http\Response
     */
    public function showCommodityType($commodity, $type)
    {
        $commodity = Commodity::find($commodity);
        $commodity_type_id = $type;

        return view('commodities.types.show_commodity_type', compact(
            'commodity',
            'commodity_type_id',
        ));

    }

    /**
     * Show the form for creating a commodity's type's attributes.
     * Will get the commodity and type's id
     *
     * @param  int  $commodity, $type
     * @return \Illuminate\Http\Response
     */
    public function addTypeAttributes($commodity, $type)
    {
        $Commodity = Commodity::find($commodity);
        $commodity_type_id = $type;

        return view('commodities.types.add_type_attributes', compact(
            'Commodity',
            'commodity_type_id',
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTypeAttributes(Request $request, $commodity)
    {
        $commodity_id = $commodity;
        $commodity_type_id = $request->commodity_type_id;

        $commodityType = CommodityType::find($commodity_type_id);
        $commodity_type_name = $commodityType->type_name;

        $type_aquisition_date = $request->type_acquisition_date;
        $type_quantity = $request->type_quantity;
        $type_cost_price = $request->type_cost_price;
        $type_selling_price = $request->type_selling_price;

        $TypeAquisitionDate = TypeAquisitionDate::create([
            'type_aquisition_date' => $type_aquisition_date,
            'commodity_type_id' => $commodity_type_id
        ]);

        $TypeCostPrice = TypeCostPrice::create([
            'type_cost_price' => $type_cost_price,
            'commodity_type_id' => $commodity_type_id
        ]);

        $TypePrice = TypePrice::create([
            'type_price' => $type_selling_price,
            'commodity_type_id' => $commodity_type_id
        ]);

        $TypeQuantity = TypeQuantity::create([
            'type_quantity' => $type_quantity,
            'commodity_type_id' => $commodity_type_id
        ]);

        $TypePurchase = TypePurchase::create([
            'commodity_id' => $commodity_id,
            'commodity_type_id' => $commodity_type_id,
            'quantity' => $type_quantity,
            'cost_price' => $type_cost_price,
        ]);

        $TypeBudgetedSale = TypeBudgetedSale::create([
            'commodity_id' => $commodity_id,
            'commodity_type_id' => $commodity_type_id,
            'quantity' => $type_quantity,
            'selling_price' => $type_selling_price,
        ]);

        if ($commodityType->SoldTypeItem()->count()) {
            $soldTypeItem = SoldTypeItem::where('commodity_type_id', $commodity_type_id)->update([
                'selling_price' => $type_selling_price,
            ]);
        }
        elseif (!$commodityType->SoldTypeItem()->count()) {
             $soldTypeItem = SoldTypeItem::create([
                'commodity_id' => $commodity_id,
                'commodity_type_id' => $commodity_type_id,
                'sold_quantity' => '0',
                'selling_price' => $type_selling_price,
            ]);
        }


        if (
            $TypeAquisitionDate == true &&
            $TypeCostPrice == true &&
            $TypePrice == true &&
            $TypeQuantity == true &&
            $TypePurchase == true &&
            $TypeBudgetedSale == true &&
            $soldTypeItem == true
        )
        {
            $message = "Successfully Added Attributes of $commodity_type_name";
            return redirect()->route(
                'show_commodity_type', [
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
     * Return a form for adding a commodity type supplier quantity reorder
     * @param int $commodity, $type
     */
    public function addTypeSupply($commodity, $type)
    {
        $Commodity = Commodity::find($commodity);
        $commodity_type_id = $type;

        return view('commodities.types.type_supplier_purchase', compact(
            'Commodity',
            'commodity_type_id',
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request, int $commodity, $type
     * @return \Illuminate\Http\Response
     */
    public function storeTypeSupply(Request $request, $commodity, $type)
    {
        $commodity_id = $commodity;
        $type_id = $type;
        $supplier_quantity = $request->supplier_type_quantity;
        $type_cost_price = $request->type_cost_price;
        $type_selling_price = $request->type_selling_price;

        $commodityType = CommodityType::find($type_id);

        if ($commodityType->TypeQuantity == null)
        {
            $TypeQuantity = TypeQuantity::create([
                'type_quantity' => $supplier_quantity,
                'commodity_type_id' => $type,
            ]);

            $TypeBudgetedSale = TypeBudgetedSale::create([
                'commodity_id' => $commodity_id,
                'commodity_type_id' => $type,
                'quantity' => $supplier_quantity,
                'selling_price' => $type_selling_price,
            ]);

            $TypePurchase = TypePurchase::create([
                'commodity_id' => $commodity_id,
                'commodity_type_id' => $type,
                'quantity' => $supplier_quantity,
                'cost_price' => $type_cost_price,
            ]);
        }

        if($commodityType->TypePrice == null){
            $TypePrice = TypePrice::create([
                'type_price' => $type_selling_price,
                'commodity_type_id' => $type,
            ]);

            if ($commodityType->TypeQuantity == null)
            {

                $TypeBudgetedSale = TypeBudgetedSale::create([
                    'commodity_id' => $commodity_id,
                    'commodity_type_id' => $type,
                    'quantity' => $supplier_quantity,
                    'selling_price' => $type_selling_price,
                ]);
            }
        }

        if ($commodityType->TypeCostPrice == null)
        {
            $TypeCostPrice = TypeCostPrice::create([
                'type_cost_price' => $type_cost_price,
                'commodity_type_id' => $type,
            ]);

            if ($commodityType->TypeQuantity == null)
            {
                $TypePurchase = TypePurchase::create([
                    'commodity_id' => $commodity_id,
                    'commodity_type_id' => $type,
                    'quantity' => $supplier_quantity,
                    'cost_price' => $type_cost_price,
                ]);
            }
        }


        if (
            $commodityType->TypeQuantity !== null &&
            $commodityType->TypeCostPrice !== null &&
            $commodityType->TypePrice !== null
        )
        {
            // dd($commodityType->TypeBudgetedSale->quantity);
            $current_quantity = $commodityType->TypeQuantity->type_quantity + $supplier_quantity;
            $current_purchases = $commodityType->TypePurchase->quantity + $supplier_quantity;
            $current_budgeted_sales = $commodityType->TypeBudgetedSale->quantity + $supplier_quantity;

            $typeQuantity = TypeQuantity::where('commodity_type_id', $type_id)->update([
                'type_quantity' => $current_quantity,
            ]);
            $typePurchase = TypePurchase::where('commodity_type_id', $type_id)->update([
                'quantity' => $current_purchases,
                'cost_price' => $type_cost_price,
            ]);

            $typeBudgetedSale = TypeBudgetedSale::where('commodity_type_id', $type_id)->update([
                'quantity' => $current_budgeted_sales,
                'selling_price' => $type_selling_price,
            ]);
        }

        $message = "Successfully Added $supplier_quantity of $commodityType->type_name (s) in Inventory";
        return redirect()->route('home.show', ['home' => $commodity_id])->with('status', $message);

    }
}
