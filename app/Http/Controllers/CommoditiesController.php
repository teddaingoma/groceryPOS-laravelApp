<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commodity;
use App\Models\Category;
use App\Models\CommoditySellInvoice;
use App\Models\TypeSellInvoive;
use App\Models\CommodityAquisitionDate;
use App\Models\TypeAquisitionDate;

use Carbon\Carbon;
class CommoditiesController extends Controller
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
        // display commodities only of the currently authenticated user
        $user_commodities = Commodity::all()->where('user_id', auth()->user()->id);
        // auth()->user()->commodities;

        // initialize arrays
        $months = [];
        $monthCount = [];
        $commodities = [];
        $commdityQty = [];
        $actualSales = [];
        $customers = [];
        $suppliers = [];
        $cusSellCount = [];
        $supPurchCount = [];
        $acqDates = [];
        $datesCount = [];
        $saleMonths = [];
        $saleCount = [];
        $soldItems = [];
        $soldItemCount = [];

        ////
        $commodity_data = auth()->user()->commodities;
        $customer_data = auth()->user()->customers;
        $supplier_data = auth()->user()->suppliers;

        // get data and update in their corresponding arrays

        $month_data = Commodity::select('id', 'created_at')->where('user_id', auth()->user()->id)->get()->groupBy(function($month_data){
            return Carbon::parse($month_data->created_at)->format('M');
        });


        $acq_dates_data = CommodityAquisitionDate::select('id', 'aquisition_date')->get()->groupBy(function($acq_dates_data){
            return Carbon::parse($acq_dates_data->aquisition_date)->format('M');
        });

        $acq_dates_data1 = TypeAquisitionDate::select('id', 'type_aquisition_date')->get()->groupBy(function($acq_dates_data1){
            return Carbon::parse($acq_dates_data1->type_aquisition_date)->format('M');
        });

        $saleMonth_data = CommoditySellInvoice::select('id', 'created_at')->where('user_id', auth()->user()->id)->get()->groupBy(function($saleMonth_data){
            return Carbon::parse($saleMonth_data->created_at)->format('M');
        });

        $typeMonth_data = TypeSellInvoive::select('id', 'created_at')->where('user_id', auth()->user()->id)->get()->groupBy(function($typeMonth_data){
            return Carbon::parse($typeMonth_data->created_at)->format('M');
        });

        $commSale_data = CommoditySellInvoice::select('id', 'commodity_id')->where('user_id', auth()->user()->id)->get()->groupBy('commodity_id');
        $typeSale_data = TypeSellInvoive::select('id', 'commodity_type_id')->where('user_id', auth()->user()->id)->get()->groupBy('commodity_type_id');

        // dd($commSale_data);

        // dd($acq_dates_data->commodity_id);

        foreach($month_data as $month => $values)
        {
            $months[] = $month;
            $monthCount[] = count($values);
        }

        foreach($commodity_data as $commodity)
        {
            $commodities[] = $commodity->name;
            $commodityQty[] = $commodity->Quantity->quantity;
            $actualSales[] = ($commodity->SoldCommodityItem->sold_quantity * $commodity->Price->price);

            if ($commodity->Types->count())
            {
                foreach ($commodity->Types as $type)
                {
                    $commodities[] = $type->type_name;
                    $commodityQty[] = $type->TypeQuantity->type_quantity;
                    $actualSales[] = ($type->SoldTypeItem->sold_quantity * $type->TypePrice->type_price);
                }
            }
        }

        foreach($customer_data as $customer)
        {
            $customers[] = $customer->name;
            $cusSellCount[] = $customer->commoditySellInvoices()->count() + $customer->typeSellInvoices()->count();
        }

        foreach($supplier_data as $supplier)
        {
            $suppliers[] = $supplier->name;
            $supPurchCount[] = $supplier->commodityPurchaseInvoices()->count() + $supplier->typePurchaseInvoices()->count();
        }

        foreach($acq_dates_data as $acq_date => $values)
        {
            $acqDates[] = $acq_date;
            $datesCount[] = count($values);
        }

        foreach($acq_dates_data1 as $acq_date1 => $values1)
        {
            $acqDates[] = $acq_date1;
            $datesCount[] = count($values1);
        }

        /*
            when including type data in the array, firstyl, open the array and the types array
            then search, if the month already exixst the array, get the index then updae the count
            else, include the month,
            unfortunately, it's trippin, so will just append weather or not it's already there

            foreach($acq_dates_data1 as $acq_date1 => $values1)
            {
            // before appending types, search if that month has alraedy been included
            // if so, update the count of month
                // else, append

                foreach($acqDates as $acqDate)
                {
                    if(strtolower($acq_date1) === strtolower($acqDate))
                    {
                        $datesCount[array_search($acqDate, $acqDates)] = $datesCount[array_search($acqDate, $acqDates)] + count($values1);
                        // print $acq_date1." already there. at position ".array_search($acqDate, $acqDates)." and count ".count($values)." ";
                    }
                    // else if(strtolower($acq_date1) !== strtolower($acqDate))
                    // {
                    //     print " mbola: ";
                    // }
                    // break;

                    // print ($acqDate.": ".array_search($acqDate, $acqDates)." ");
                }
                // $acqDates[] = $acq_date1;
                // $datesCount[] =  count($values1);
            }

            foreach($acq_dates_data1 as $acq_date1 => $values1)
            {
                $type_month = strtolower($acq_date1);
                foreach($acqDates as $acqDate)
                {
                    $comm_month = strtolower($acqDate);
                    if($type_month !== $comm_month)
                    {
                        $acqDates[] = $acq_date1;
                        $datesCount[] =  count($values1);
                    }
                }
            }

        */

        foreach($saleMonth_data as $sale_month => $values)
        {
            $saleMonths[] = $sale_month;
            $saleCount[] = count($values);
        }

        foreach($typeMonth_data as $sale_month => $values)
        {
            $saleMonths[] = $sale_month;
            $saleCount[] = count($values);
        }

        foreach($commSale_data as $comm_sale => $values)
        {

            foreach(auth()->user()->commodities as $commodity)
            {
                if($comm_sale == $commodity->id)
                {
                    $soldItems[] = $commodity->name;
                }
            }

            $soldItemCount[] = count($values);
        }

        foreach($typeSale_data as $type_sale => $values)
        {
            foreach(auth()->user()->commodities as $commodity)
            {
                foreach($commodity->Types as $type)
                {
                    if($type_sale == $type->id)
                    {
                        $soldItems[] = $type->type_name;
                    }
                }
            }

            $soldItemCount[] = count($values);
        }

        // dd($acqDates, $datesCount);

        return view('commodities.view_commodities', compact(
            'user_commodities',
            'months',
            'monthCount',
            'commodities',
            'commodityQty',
            'actualSales',
            'customers',
            'suppliers',
            'cusSellCount',
            'supPurchCount',
            'acqDates',
            'datesCount',
            'saleMonths',
            'saleCount',
            'soldItems',
            'soldItemCount',
        ));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();

        //user should have at least a category before creating a commodity

        if (auth()->user()->businesses == null)
            return redirect()->route('select_business');

        if (!$user->categories->count()) {
            $message = "$user->name, you ain't got no category, create one, please";
            return redirect()->route('category.create')->with('status', $message);
        }

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

        // create a commodity through a user. a user has many commodities

        $commodity = $request->user()->commodities()->create([
            'name' => $request->input('commodity_name'),
            'description' => $request->input('commodity_description'),
            'image_path' => $Commodity_image,
            'business_id' => $request->user()->businesses->id,
        ]);

        if ($commodity == true)
        {
            $message = "Added $commodity->name successfully.";

            $commodity_id = $commodity->id;

            // save default sales values for the commodity. used for analytics
            // a user records sale counts of a commodity
            $request->user()->soldCommodityItem()->create([
                'commodity_id' => $commodity_id,
                'sold_quantity' => '0'
            ]);

            return redirect()->route('assign_commodity_attributes', [$commodity])->with('status', $message);
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
        if  ($commodity->user_id !== auth()->user()->id) {
            return redirect()->route('home.index');
        }
        if (auth()->user()->businesses == null)
            return redirect()->route('home.index');

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

        if  ($commodity->user_id !== auth()->user()->id) {
            return redirect()->route('home.index');
        }

        if (auth()->user()->businesses == null)
            return redirect()->route('home.index');

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

        if  ($commodity->user_id !== auth()->user()->id) {
            return redirect()->route('home.index');
        }

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

        Commodity::where('id', $id)->update([
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
    public function destroy(Request $request, $id)
    {
        $commodity = Commodity::find($id);
        // find out if the owner has types for this commodity before deleting
        // if this commodity has types, prompt for comfirmation first
        if ($commodity->Types()->count()) {
            $message = $commodity->name." has ".$commodity->Types()->count()." type(s). Kindly delete individually";
            return redirect()->route('home.show', $id)->with('status', $message);
        }

        $request->user()->commodities()->where('id', $id)->delete();

        $message = "Successfully deleted ".$commodity->name." from your inventory";

        return redirect()->route('home.index')->with('status', $message);

        // return back();
    }

    /**
     * for the owner to manage their inventories on a more detailed level
     */
    public function manage_inventory()
    {
        // display commodities only of the currently authenticated user
        $user_commodities = Commodity::all()->where('user_id', auth()->user()->id);
        // auth()->user()->commodities;

        return view('commodities.manage_inventory', compact(
            'user_commodities'
        ));
    }
}
