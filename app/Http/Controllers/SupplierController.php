<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     *  view suppliers
     */
    public function view_suppliers()
    {
        return view('suppliers.view_suppliers');
    }

    /**
     * display a form for adding a supplier
     */
    public function add_supplier()
    {
        return view('suppliers.add_supplier');
    }

    /**
     * store a supplier in the database
     */
    public function store_supplier(Request $request)
    {
        $user = auth()->user();


        // see if user has customers at all
        if ($user->suppliers()->count()) {

            foreach($user->suppliers as $supplier) {

                if ($request->email == $supplier->email && $request->email !== null) {
                    $message = "the email already exists, supplier's email is unique";
                    return back()->with('status', $message);
                }

            }
        }

        // check if supplier dp is empty or not
        if ($request->supplier_dp == null)
        {
            $supplier_dp = 'user-light.ico';
        }
        else if ($request->supplier_dp != null)
        {
            $supplier_dp = $request->name . '-' . time() . '.' . $request->supplier_dp->extension();
            $request->supplier_dp->move(public_path('supplier_images'), $supplier_dp);
        }

        $supplier = $request->user()->suppliers()->create([
            'name' => $request->name,
            'email' => $request->email,
            'image_path' => $supplier_dp,
        ]);

        $message = "You have successfully added ".$supplier->name." in your supplier's list";

        return redirect()->route('view_suppliers')->with('status', $message);
    }

    /**
     * display a form for editing a supplier
     */
    public function edit_supplier(Supplier $supplier)
    {
        //failed to implement this
        return view('supplier.edit_supplier');
    }

    /**
     *  delete supplier
     */
    public function delete_supplier(SUpplier $supplier)
    {
        $supplier->delete();

        $message = "$supplier->name has been deleted from your supplier's list";

        return redirect()->route('view_suppliers')->with('status', $message);
    }

}
