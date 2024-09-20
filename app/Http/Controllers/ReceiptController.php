<?php

namespace App\Http\Controllers;
use App\Models\Stock;
use App\Models\DongFeng;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Database;
use App\Models\Receipt;
use App\Models\ReceiptItem;
use Illuminate\Validation\Validator;

class ReceiptController extends Controller
{
    public function search(Request $request)
    {
        $article = $request->input('article');
        $category= $request->input('category');
        $search = Stock::getManyByArticle($article, $category);
        return response()->json($search);
    }

    public function index()
    {
        $receipts = Receipt::paginate(50);
        //$receipts = Receipt::with('category')->paginate(50);
        
        return view('dashboard.admin.receipts.index', [
            'receipts' => $receipts
        ]);
    }

    public function create()
    {
        return view('dashboard.admin.receipts.create', [
            'categories' => Database::getTablesList()
        ]);
    }


    public function loss_page()
    {
         return view('dashboard.admin.receipts.losspage', [
            'categories' => Database::getTablesList()
        ]);
    }
    
    
    public function store(Request $request)
        {
            try {
                $item = $request->validate([
                    //'stock_category_id' => 'required|in:1,2,3',
                    'receipt_id' => 'required|exists:receipts,id', 
                    'price' => 'required',
                    'quantity' => 'required',
                    'article' => 'required',
                    'name' => 'required',
                ]);
            } catch (Throwable $th) {
                return redirect()->back()->with('error', $th->getMessage());
            }
    
            ReceiptItem::create($item);
    
            return redirect()->back()->with('success', 'Товар успешно добавлен.');
        }

    //возможно $id вместо $receipt 
   /* public function show($id)
    {
        $receipt = Receipt::with('items.stock')->findOrFail($id);
        return view('dashboard.admin.receipts.show', [
            'receipt' => $receipt
        ]);
    }

    public function store(Request $request)
    {
            try {
            $item = $request->validate([
                'stock_category_id' => 'required|in:1,2,3',
                'creation_date' => 'required',
                
                'price' => 'required',
                'quantity' => 'required',
                'article' => 'required',
                'name' => 'required',
                'isIncoming' => 'required' 
            ]);

            $receipt = Receipt::create([
                'stock_category_id' => $item['stock_category_id'],
                'creation_date' => $item['creation_date'],
                'isIncoming' => $item['isIncoming']
                ///'type' => 'приход' // или другой тип
            ]);

            $item['receipt_id'] = $receipt->id;
            ReceiptItem::create($item);

        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

        return redirect()->back()->with('success', 'Товар успешно добавлен.');
    } */ 

    
   /* public function store(Request $request)
    {
           try {
            $item = $request->validate([
                'stock_category_id' => 'required|in:1,2,3',
                'creation_date' => 'required',
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
    } */

/*public function store(Request $request)
 {
     $validatedData = $request->validate([
         'category' => 'required|string',
         'type' => 'required|integer|in:1,0',
         'date' => 'required|date',
         'products' => 'required|array',
         'products.*.id' => 'required|integer',
         'products.*.quantity' => 'required|integer|min=1',
     ]);

     DB::beginTransaction();

     try {
         $receipt = Receipt::create([
             'category' => $validatedData['category'],
             'isIncoming' => $validatedData['type'],
             'date' => $validatedData['date']
         ]);

         foreach ($validatedData['products'] as $productData) {
             $product = Stock::where('id', $productData['id'])->first();
             if ($product) {
                 if ($validatedData['type'] === '1') {
                     $product->quantity += $productData['quantity'];
                 } else if ($validatedData['type'] === '0') {
                     $product->quantity -= $productData['quantity'];
                 }
                 $product->save();
             } else {
//                     //создание пока под вопрсом
//                     if ($validatedData['type'] === 'приход') {
//                         $product = Product::create([
//                             'name' => $productData['name'],
//                             'stock' => $productData['quantity'],
//                             'price' => $productData['price']
//                         ]);
//                     } else {
                     throw new \Exception("Товар с {$productData['name']} not found");
                 }
//                 }

             $receipt->items()->attach($product->id, [
                 'quantity' => $productData['quantity'],
                 'price' => $productData['price'],
                 'article' => $productData['article'],
                 'name' => $productData['name'],
             ]);
         }

         DB::commit();

         return response()->json(['message' => 'Операция выполнена успешно'], 200);


     } catch (\Exception $e) {
         DB::rollBack();
         return response()->json(['message' => 'Операция не удалась', 'error' => $e->getMessage()], 500);
     }
} */
    
    
    /*public function show(Receipt $receipt)
    {
        //
    }*/

    public function edit(Receipt $receipt)
    {
        //
    }

    public function update(UpdateReceiptRequest $request, Receipt $receipt)
    {
        //
    }

    public function destroy(Receipt $receipt)
    {
        //
    }
   
    /*public function index_loss()
    {
         return view('dashboard.admin.receipts.indexloss');
    }*/
}
