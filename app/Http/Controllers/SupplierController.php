<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
{
    $search = $request->search;

    $suppliers = Supplier::when($search, function ($q) use ($search) {
        $q->where(function ($query) use ($search) {
            $query->where('NamaSupplier','like',"%$search%")
                  ->orWhere('Email','like',"%$search%")
                  ->orWhere('NoTelp','like',"%$search%");
        });
    })->get();

    return view('suppliers.index', compact('suppliers'));
}

    


    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'NamaSupplier' => 'required',
            'NoTelp' => 'nullable|max:20',
            'Email' => 'nullable|email'
        ]);

        Supplier::create($request->all());

        return redirect()->route('suppliers.index')->with('success','Supplier berhasil ditambah');
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $request->validate([
            'NamaSupplier' => 'required',
            'NoTelp' => 'nullable|max:20',
            'Email' => 'nullable|email'
        ]);

        $supplier->update($request->all());

        return redirect()->route('suppliers.index')->with('success','Supplier berhasil diupdate');
    }

    public function destroy($id)
    {
        Supplier::destroy($id);
        return back()->with('success','Supplier dihapus');
    }
}
