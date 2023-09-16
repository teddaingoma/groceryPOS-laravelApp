<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commodity;
use App\Models\Category;
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
        $commodities = Commodity::all()->where('user_id', auth()->user()->id);
        //dd($commodities);

        return view('commodities.view_commodities', compact(
            'commodities',
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
}
