<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commodity;
use App\Models\CommodityType;
use App\Models\TypeAquisitionDate;
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
        $commodity_type = $request->commodity_type;

        if ($request->commodity_type_image !== NULL)
        {
            $Commodity_type_image = $commodity_type . '-' . time() . '.' . $request->commodity_type_image->extension();
            dd($Commodity_type_image);
            $request->commodity_type_image->move(public_path('commodity_images'), $Commodity_type_image);
        }

        if ($request->commodity_type_image == NULL)
        {
            dd("Path is empty");
            $Commodity_type_image = $commodity->image_path;
        }
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
        $type_price = $request->type_price;

        $TypeAquisitionDate = TypeAquisitionDate::create([
            'type_aquisition_date' => $type_aquisition_date,
            'commodity_type_id' => $commodity_type_id
        ]);

        $TypePrice = TypePrice::create([
            'type_price' => $type_price,
            'commodity_type_id' => $commodity_type_id
        ]);

        $TypeQuantity = TypeQuantity::create([
            'type_quantity' => $type_quantity,
            'commodity_type_id' => $commodity_type_id
        ]);

        if (
            $TypeAquisitionDate == true &&
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
