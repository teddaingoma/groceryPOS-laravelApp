<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;

class BusinessController extends Controller
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view_business(Business $business)
    {
        if (auth()->user()->businesses == null)
            return redirect()->route('home.index');

        return view('business.view_business', compact(
            'business'
        ));
    }

    /**
     * if a grocery owmner doesn't have a registered business, prompt for options
     */
    public function select_business()
    {
        return view('business.select_business');
    }

    public function select_registered_business()
    {
        /**
         * for now, this view is not required because a user will only have one business only
         * in a later implementation, which is the original design, a user can register more than one business
         */
        return view('business.select_registered_business');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register_business()
    {
        if (auth()->user()->businesses !== null)
            return redirect()->route('home.index');

        return view('business.register_business');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_business(Request $request)
    {

        // you can firstly validate or whatever

        /** check if the name already exists */
        if ($request->user()->businesses()->count())
        {
            foreach($request->user()->businesses as $business)
            {
                if(strtolower($business->name) === strtolower($request->name))
                {
                    $message = "You already have a grocery business by the name ".$request->name;
                    return redirect()->back()->with('status', $message);
                }
            }
        }

        $request->user()->businesses()->create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $message = "Successfully added a Grocery Business!";

        return redirect()->route('home.index')->with('status', $message);
    }
}
