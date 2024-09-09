<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\ShippingCharges;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function create(){
        $countries = Country::get();
        $shippingCharges = ShippingCharges::select('Shipping_charges.*','countries.name')
                            ->leftjoin('countries','countries.id','Shipping_charges.country_id')->get();
                
        return view('admin.shipping.create' ,compact('countries' , 'shippingCharges'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'country' => 'required',
            'amount' => 'required|numeric',
        ]);
    
        if ($validator->passes()) {
            // check if shipping already added for this country
            $count = ShippingCharges::where('country_id',$request->country)->count();
            if ($count > 0 ){
                session()->flash('error', 'Shipping Already added');
                return response()->json([
                    'status' => true,
                ]);
            }

            $shipping = new ShippingCharges();
            $shipping->country_id = $request->country;
            $shipping->amount = $request->amount;
            $shipping->save();
    
            session()->flash('success', 'Shipping added successfully');
            return response()->json([
                'status' => true,
            ]);
    
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    
    public function edit($id){
        $shippingCharge = ShippingCharges::find($id);
        $countries = Country::get();
        return view('admin.shipping.edit' ,compact('shippingCharge','countries'));
    }

    public function update($id ,Request $request) {
        $shipping = ShippingCharges::find($id);

        $validator = Validator::make($request->all(), [
            'country' => 'required',
            'amount' => 'required|numeric',
        ]);
    
        if ($validator->passes()) {

            if ($shipping == null ){
                session()->flash('error', 'Shipping Not Found');
                return response()->json([
                    'status' => true,
                ]);
            }

            $shipping = ShippingCharges::find($id);
            $shipping->country_id = $request->country;
            $shipping->amount = $request->amount;
            $shipping->save();
    
            session()->flash('success', 'Shipping updated successfully');
            return response()->json([
                'status' => true,
            ]);
    
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($id) {
        $shippingCharge = ShippingCharges::find($id);
        $shippingCharge->delete();

        if ($shippingCharge == null ){
            session()->flash('error', 'Shipping Not Found');
            return response()->json([
                'status' => true,
            ]);
        }
        
        session()->flash('success', 'Shipping deleded successfully');
        return response()->json([
            'status' => true,
        ]);
    }
}

