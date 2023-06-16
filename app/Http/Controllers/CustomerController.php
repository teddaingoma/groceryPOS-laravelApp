<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

            $email = $request->email;

            $customer = $request->user()->customers()->create([
                'name' => $request->name,
                'email' => $email,
                'image_path' => $customer_dp,
            ]);

            $message = "You have successfully added ".$customer->name." in your customer's list";

            return redirect()->route('view_customers')->with('status', $message);
        }

        dd("you ain't got no customers blud");
    }
}
