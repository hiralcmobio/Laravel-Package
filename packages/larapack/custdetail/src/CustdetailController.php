<?php

namespace Larapack\Custdetail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class CustdetailController extends Controller
{


    public function postCustomer(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobileno' => 'required|numeric|digits:10',
            'address' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('message', $validator->messages()->first());
            Session::flash('alert-class', 'alert-danger');
            return redirect('/home');
        }
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->mobileno = $request->mobileno;
        $customer->address = $request->address;
        $customer->save();

        Session::flash('message', 'Customer added successfully.');
        Session::flash('alert-class', 'alert-success');
        return redirect('home');
    }

}
