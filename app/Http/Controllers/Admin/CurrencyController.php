<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{
    public function index(){
        $currencies = Currency::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.currencies.index', compact('currencies'));
    }

    public function create(){
        return view('admin.currencies.create');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|unique:currencies,name',
            'code' => 'required|unique:currencies,code',
            'rate' => 'required',
            'decimals' => 'required',
            'symbol_placement' => 'required',
            'is_active' => 'required',
        ]);

        $currency = new Currency;
        $currency->name = $validatedData['name'];
        $currency->symbol = $request->symbol;
        $currency->code = $request->code;
        $currency->rate = $validatedData['rate'];
        $currency->decimals = $validatedData['decimals'];
        $currency->primary_order = $request->primary_order;
        $currency->symbol_placement = $validatedData['symbol_placement'];
        $currency->is_active = $validatedData['is_active'];
        $currency->save();

        return redirect()->route('admin.currencies')
            ->with('status','Currency Created Successfully.');
    }

    public function edit($id){
        $currency = Currency::find($id);
        return view('admin.currencies.edit', compact('currency'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:currencies,name,' . $id,
            'code' => 'required|unique:currencies,code,' . $id,
            'rate' => 'required',
            'decimals' => 'required',
            'symbol_placement' => 'required',
            'is_active' => 'required',
        ]);

        $currency = Currency::find($id);
        $currency->name = $validatedData['name'];
        $currency->symbol = $request->symbol;
        $currency->code = $request->code;
        $currency->rate = $validatedData['rate'];
        $currency->decimals = $validatedData['decimals'];
        $currency->primary_order = $request->primary_order;
        $currency->symbol_placement = $validatedData['symbol_placement'];
        $currency->is_active = $validatedData['is_active'];
        $currency->update();

        return redirect()->route('admin.currencies')
            ->with('status', 'Currency Record Updated Successfully.');
    }

    public function delete(string $id)
    {
        $currency = Currency::find($id);
        $currency->delete();

        return redirect()->route('admin.currencies')
            ->with('statusDanger','Currency Data Deleted Successfully.');
    }

    public function updateCurrencyRates()
    {
        $response = Http::get('https://api.currencyapi.com/v3/latest', [
            'apikey' => 'cur_live_XJ6W5KthZYyYfcGMZkU7SA9ZWfLL0rUWc9Z4lbm7',
            'base_currency' => 'PKR',
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['data'])) {
                $apiCurrencies = $data['data'];
                $currencies = Currency::all();

                foreach ($currencies as $currency) {
                    $name = strtoupper($currency->name);

                    if (isset($apiCurrencies[$name])) {
                        $currency->rate = round($apiCurrencies[$name]['value'], 2);
                        $currency->save();
                    }
                }

                return redirect('/admin/currencies')
                    ->with('status', 'Currency rates updated successfully.');
            }

            return redirect('/admin/currencies')
                ->with('statusDanger', 'Invalid API response structure.');
        }

        return redirect('/admin/currencies')
            ->with('statusDanger', 'Failed to fetch currency data from API.');
    }
}
