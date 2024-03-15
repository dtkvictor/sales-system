<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sale\StoreSaleRequest;
use App\Http\Requests\Sale\UpdateSaleRequest;
use App\Models\Sale;
use App\Models\ItemSale;
use App\Models\Product;
use App\Http\Filters\SaleFilter;
use App\Helpers\StringUtils;
use Illuminate\Database\QueryBuilder;
use Illuminate\Support\Facades\Validator;
use App\Rules\ClientValidate;
use App\Rules\ProductsCartValidate;
use App\Rules\PaymentMethodValidate;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $sales = new SaleFilter(new Sale());
        $sales = $sales->apply(request()->query())                       
                       ->with('user')
                       ->withSum('items as total_amount', DB::raw('unit_price * amount'))
                       ->paginate(10);

        $sales->each(function($sale) {
            $sale->total_amount = $sale->total_amount ?? 0; 
            $sale->payment_method = StringUtils::slugToText($sale->payment_method);
        });

        return view('components.pages.sale.index', [
            'sales' => $sales
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('shopping.cart');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'client' => [new ClientValidate],
            'products' => ['required', 'json', new ProductsCartValidate],
            'payment_method' => ['required', 'string', new PaymentMethodValidate]
        ]);

        if($validator->fails()) {
            $request->session()->put('fails', $validator->errors()->first());
            return back();
        }

        try {
            $payment_method = explode('.', $request->payment_method);
            $sale = new Sale();
            $sale->user_id = auth()->user()->id;
            $sale->client_id = $request->client;
            $sale->payment_method = $payment_method[0];
            $sale->parcels = $payment_method[1];
            $sale->save();

            $products = json_decode($request->products);
            foreach($products as $product) {
                $itemSale = new ItemSale();
                $itemSale->sale_id = $sale->id;
                $itemSale->product_id = $product->id;
                $itemSale->amount = $product->amount;
                $itemSale->unit_price = Product::select('price')
                                            ->find($product->id)
                                            ->value('price');
                $itemSale->save();
            }

            $request->session()->put('success', 'Successful sale.');
            return redirect()->route('sale.index');

        }catch(QueryException $e) {
            $request->session()->put('fails', "Error performing the operation on the database. Code: {$e->getCode()}");
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {        
        $sale->load('items.product');
        $sale->load('client');

        return view('components.pages.sale.show', [
            'sale' => $sale,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        try {
            $sale->delete();
            request()->session()->put('success', "Sale $sale->id deleted successfully.");
        }catch(QueryBuilder $e) {
            request()->session()->put('fails', "Error performing the operation on the database. Code: {$e->getCode()}");
        }
        return redirect()->route('sale.index');
    }
}