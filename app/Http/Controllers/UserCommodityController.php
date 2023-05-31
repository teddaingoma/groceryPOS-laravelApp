<?php

namespace App\Http\Controllers;

use App\Models\Commodity;
use Illuminate\Http\Request;

class UserCommodityController extends Controller
{
    // i've just realized i don't need this controller, but i'll just keep it, and the route too
    /**
     * Show the commodities belonging to the currently authenticated user
     */

     public function showUserCommodity(Commodity $commodity)
     {
        // only show a commodity that is owned by the currently authenticated user. a way of avoiding method spoofing
        if ($commodity->user_id == auth()->user()->id) {
            return view('commodities.show_commodity', compact(
                'commodity',
            ));
        }
        else {
            return redirect()->route("home.index");
        }
     }
}
