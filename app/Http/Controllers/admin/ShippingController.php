<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $countries = Country::get();

        $query = Shipping::Select('shipping_charges.*', 'countries.name as countryName')
            ->latest('id')
            ->leftJoin('countries', 'countries.id', 'shipping_charges.country_id');


        if ($request->get('keyword')) {
            $query->where('countries.name', 'like', '%' . $request->get('keyword') . '%');
        }

        $shippings = $query->paginate(10);

        $data = [
            'countries' => $countries,
            'shippings' => $shippings,
        ];

        return view('admin.shipping.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::orderBy('name', 'asc')->get();

        $data = [
            'countries' => $countries,
        ];
        return view('admin.shipping.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country' => 'required',
            'amount' => 'required|numeric',
        ]);

        if ($validator->passes()) {

            $count = Shipping::where('country_id', $request->country)->count();

            if ($count > 0) {
                session()->flash('error', 'Shipping Already Added');

                return response()->json([
                    'status' => true,
                ]);
            }

            $shipping = new Shipping;

            $shipping->country_id = $request->country;
            $shipping->amount = $request->amount;
            $shipping->save();

            session()->flash('success', 'Shipping Amount Added Successfully');

            return response()->json([
                'status' => true,
                'message' => 'Shipping Amount Added Successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $countries = Country::orderBy('id', 'asc')->get();
        $shipping = Shipping::find($id);

        $data = [
            'countries' => $countries,
            'shipping' => $shipping,
        ];
        return view('admin.shipping.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'country' => 'required',
            'amount' => 'required|numeric',
        ]);

        if ($validator->passes()) {


            $shipping = Shipping::find($id);

            $shipping->country_id = $request->country;
            $shipping->amount = $request->amount;
            $shipping->save();

            session()->flash('success', 'Shipping Amount Updated Successfully');

            return response()->json([
                'status' => true,
                'message' => 'Shipping Amount Updated Successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shipping = Shipping::find($id);

        if (empty($shipping)) {
            return redirect()->back()->with('error', 'Shipping Not Found');
        }

        $shipping->delete();

        return redirect()->back()->with('success', 'Shipping Deleted Successfully');
    }
}
