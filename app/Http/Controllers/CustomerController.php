<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * display customers
     */
    public function view_customers()
    {
        return view('customers.view_customers');
    }

    /**
     * display a form for adding a customer
     */
    public function add_customer()
    {
        return view('customers.add_customer');
    }

    /**
     * save or store a customerin database
     */
    public function store_customer(Request $request)
    {
        $user = auth()->user();


        // see if user has customers at all
        if ($user->customers()->count()) {

            foreach($user->customers as $customer) {

                if ($request->email == $customer->email && $request->email !== null) {
                    $message = "the email already exists, customer's email is unique";
                    return back()->with('status', $message);
                }

            }
        }

        // check if customer dp is empty or not
        if ($request->customer_dp == null)
        {
            $customer_dp = 'user-light.ico';
        }
        else if ($request->customer_dp != null)
        {
            $customer_dp = $request->name . '-' . time() . '.' . $request->customer_dp->extension();
            $request->customer_dp->move(public_path('customer_images'), $customer_dp);
        }

        $customer = $request->user()->customers()->create([
            'name' => $request->name,
            'email' => $request->email,
            'image_path' => $customer_dp,
        ]);

        $message = "You have successfully added ".$customer->name." in your customer's list";

        return redirect()->route('view_customers')->with('status', $message);

    }

    /**
     * display a form for editing customer details
     */
    public function edit_customer(Customer $customer)
    {
        //failed to implement this. mostly because keeps telling strange errors.
        // when i send a customer model this controller, it keeps saying Costomer model not found
        // when i send an id instead, and return the edit view, it says parameter not found
        // if you have a solution be my guest

        // dd($customer);

        $cus = Customer::find($customer->id);

        return view('customers.edit_customer', [
            'customer' => $cus
        ]);
    }

    /**
     * delete a customer
     */
    public function delete_customer(Customer $customer)
    {

        $customer->delete();

        $message = "$customer->name has been deleted from your customer's list";

        return redirect()->route('view_customers')->with('session', $message);
    }
}
