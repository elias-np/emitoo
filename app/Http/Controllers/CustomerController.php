<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customers\StoreCustomerRequest;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->paginate(15);

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(StoreCustomerRequest $request)
    {
        $data = $request->validated();

        if (empty($data['pais'])) {
            $data['pais'] = 'BR';
        }

        Customer::create($data);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Cliente cadastrado com sucesso.');
    }
}
