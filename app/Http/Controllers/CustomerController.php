<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::latest()->paginate(10);
        return view('customers.index', compact('customers'));
    }

    /**
     * Impersonate the given customer.
     */
    public function impersonate(Customer $customer)
    {
        Auth::guard('customer')->login($customer);
        return redirect()->route('home');
    }
}
