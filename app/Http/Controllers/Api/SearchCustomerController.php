<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Resources\CustomerResource;

class SearchCustomerController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $customers = Customer::searchCustomers($request->search)->select('id', 'name', 'kana', 'tel')->paginate(50);

        return CustomerResource::collection($customers);
    }
}
