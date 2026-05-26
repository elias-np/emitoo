<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customers\StoreCustomerRequest;
use App\Http\Requests\Customers\UpdateCustomerRequest;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::forCompany()->latest()->paginate(15);

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

        $data['company_id'] = auth()->user()->company_id;

        Customer::create($data);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Cliente cadastrado com sucesso.');
    }

    public function edit(Customer $customer)
    {
        $this->authorize('belong-to-company', $customer);

        return view('customers.edit', compact('customer'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $this->authorize('belong-to-company', $customer);

        $data = $request->validated();

        if (empty($data['pais'])) {
            $data['pais'] = 'BR';
        }

        $customer->update($data);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Cliente atualizado com sucesso.');
    }
}
