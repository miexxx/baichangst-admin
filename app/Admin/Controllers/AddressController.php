<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Address;

class AddressController extends Controller
{
    public function getaddress($id){
        if($id) {
            $addresss = Address::where('address_id', 'like', $id . '__')->get(['address_id','address_name']);
        }
        else{
            $addresss = null;
        }
        return response()->json($addresss);
    }

    public function provinces(){
        $provinces = Address::where('address_id','like','__')->get(['address_id','address_name']);
        return response()->json($provinces);
    }
}