<?php

namespace App\Http\Controllers;

use App\Models\CustomerType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CustomerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['customer_types'] = CustomerType::all();
        return view('admin.customers.customer_types.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customers.customer_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customertype_name' => 'required',
        ]);

        try {
            $customerType = new CustomerType();
            $customerType->customertype_name = $request->input('customertype_name');
            $customerType->save();

            return Redirect::route('admin.customertype.index')->with('success', 'Customer Type created successfully');
        } catch (\Exception $e) {
            return Redirect::back()->withInput()->with('error', 'Error creating customer type: ' . $e->getMessage());
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
    public function edit($id)
    {
        try {
            $data['customerType'] = CustomerType::findOrFail($id);
            return view('admin.customers.customer_types.edit', $data);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Redirect::route('admin.customertype.index')->with('error', 'Customer Type not found');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $customerType = CustomerType::findOrFail($id);
        $customerType->update($request->all());
        return Redirect::route('admin.customertype.index')->with('success', 'Customer Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $customerType = CustomerType::findOrFail($id);
            $customerType->delete();

            return Redirect::route('admin.customertype.index')->with('success', 'Customer Type deleted successfully');

        } catch(\Exception $e) {
            return Redirect::back()->withInput()->with('error', 'Error deleting customer type: ' . $e->getMessage());
        }
    }
}
