<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $customers = Customer::searchCustomers($request->search)->select('id', 'name', 'kana', 'tel')->paginate(10);

        return Inertia::render('Customers/Index', [
            'customers' => $customers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Customers/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        Customer::create([
            'name'     => $request->name,
            'kana'     => $request->kana,
            'tel'      => $request->tel,
            'email'    => $request->email,
            'postcode' => $request->postcode,
            'address'  => $request->address,
            'birthday' => $request->birthday,
            'gender'   => $request->gender,
            'memo'     => $request->memo
        ]);

        return redirect(route('customers.index'))->with([
            'status' => 'success',
            'message' => '顧客の登録を行いました。'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return Inertia::render('Customers/Show', [
            'customer' => $customer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect(route('customers.index'))->with([
            'status' => 'delete',
            'message' => '顧客を削除しました。'
        ]);
    }
}
