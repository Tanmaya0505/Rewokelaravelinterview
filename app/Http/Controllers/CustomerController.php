<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = Customer::orderBy('id', 'DESC')->get();
        return view('customer.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = \App\User::orderBy('id', 'DESC')->pluck('name', 'id')->prepend('Select User...', '');
        return view('customer.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
        'user_id' => 'required|numeric',
        'name' => 'required|string|max:255',
        'email' => 'required|string|max:255|email|unique:customers',
        'comment' => 'required|string',
        ]);

      $insert = Customer::create($request->all());
      if($insert){
          $request->session()->flash('success', 'Customer added successfully.');
          return redirect()->route('customer.create');
      }else{
          $request->session()->flash('error', 'Data not inserted.');
          return redirect()->route('customer.create');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $data = \App\User::orderBy('id', 'DESC')->pluck('name', 'id')->prepend('Select User...', '');
        return view('customer.edit',compact('customer','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $this->validate($request,[
        'user_id' => 'required|numeric',
        'name' => 'required|string|max:255',
        'email' => 'required|string|max:255|email|unique:customers,email,'.$customer->id,
        'comment' => 'required|string',
        ]);

        $customer->update($request->all());
        $request->session()->flash('success', 'Customer updated successfully.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        Customer::destroy($customer->id);
        Session()->flash('success', 'Customer deleted successfully.');
        return redirect()->route('customer.index');
    }
}
