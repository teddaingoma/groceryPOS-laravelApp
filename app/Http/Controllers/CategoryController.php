<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
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
        if (auth()->user()->businesses == null)
            return redirect()->route('home.index');

        return view('categories.create_category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // see if the owner has categories, if not go ahead and create one.
        if ($request->user()->categories()->count())
        {
            foreach ($request->user()->categories as $category)
            {
                // if they have, go through them and see if the category being created already exixsts.
                // no redanduncy
                if (strtolower($category->name) === strtolower($request->category_name)) {
                    $message = "a category with name $request->category_name already exists";
                    return redirect()->back()->with('status', $message);
                }
            }
        }

        $request->user()->categories()->create([
            'name' => $request->category_name
        ]);

        $message = "added category $request->category_name successfully. you can now assign commodities to this category";

        return redirect()->route('home.index')->with('status', $message);
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


}
