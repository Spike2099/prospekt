<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use Illuminate\Http\Request;
use Throwable;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Stock::paginate(100);
        return view('dashboard.admin.products.index', [
            'products' => $products
        ]);
    }

    public function store(Request $request)
    {
        try {
            $item = $request->validate([
                'stock_category_id' => 'required|in:1,2,3',
                'price' => 'required',
                'quantity' => 'required',
                'article' => 'required',
                'name' => 'required',
            ]);
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

        Stock::create($item);

        return redirect()->back()->with('success', 'Товар успешно добавлен.');
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request)
    {
        dd($request->input('product_ids'));
        $productIds = $request->input('product_ids');
        if (!empty($productIds)) {
            Stock::whereIn('id', $productIds)->delete();
            return redirect()->back()->with('success', 'Выбранные товары успешно удалены.');
        }
        return redirect()->back()->with('error', 'Пожалуйста, выберите товары для удаления.');
        }
}
