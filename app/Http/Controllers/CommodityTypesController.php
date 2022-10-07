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

class CommodityTypesController extends Controller
{
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

        if ($request->type_price == NULL)
        {
            $type_price = $Type_price->type_price;
        }
        if ($request->type_price !== NULL)
        {
            $type_price = $request->type_price;
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

        $update_type_price = TypePrice::where('commodity_type_id', $type)->update([
            'type_price' => $type_price
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
    public function destroy($id)
    {
        //
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
        $Commodity = Commodity::find($commodity);
        $commodity_type_id = $type;

        return view('commodities.types.show_commodity_type', compact(
            'Commodity',
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
    public function storeTypeAttributes(Request $request, $commodity, $type_name)
    {
        $commodity_id = $commodity;
        $commodity_type_name = $type_name;

        $commodity_type_id = $request->commodity_type_id;
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

        if (
            $TypeAquisitionDate == true &&
            $TypeCostPrice == true &&
            $TypePrice == true &&
            $TypeQuantity == true
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
}
