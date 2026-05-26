<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\Companies\StoreCompanyRequest;

class CompanyController extends Controller
{
    public function create()
    {
        return view('companies.create');
    }

    public function store(StoreCompanyRequest $request)
    {
        Company::create($request->validated());

        return redirect()
            ->route('companies.create')
            ->with('success', 'Empresa cadastrada com sucesso.');
    }
}