<?php

namespace App\Http\Controllers;

use App\Models\Data\Replacement;
//use App\Models\Data\StockPos;
use App\Models\DongFeng;
use App\Models\Colyman;
use App\Models\Oil;
use App\Models\Hudurusta;
use App\Models\Goods;
use App\Models\NonOriginal;
use App\Models\Stock;
use App\Models\Steames;
use App\Models\Customer;
use App\Models\MoySklad;
use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\SearchProductController;

class MainController extends Controller
{
    public function Catalog2($limit = 64, $offset = 0)
    {
        $product = MoySklad::getAllProduct($limit, $offset);
        // $pro = [];
        // foreach($product['rows'] as $item) {
        //     $pro[] = $item['article']; //  ?? '/img/placeholder.png'
        // }
        // $arr_images = Goods::whereIn('article', $pro)->select('article', 'image')->get()->toArray();
        //return response()->json($res);, 'arr_images' => $arr_images
        return view('catalog1', ['product' => $product, 'limit' => $limit, 'offset' => $offset]);
    }
   
   /* public function testCatalog(Request $request)
    {
        $rules = [
            'type' => 'nullable',
            'text' => 'required|min:3',
        ];

        $messages = [
            'text.required' => 'Пожалуйста, введите артикул',
            'text.min' => 'Минимальная длина артикула 3 символа',
        ];

        //временный поиск возможно надо будет переработать
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->passes()) {
            //убран поиск MoySklad
            $url = Steames::getListResult($request->input('text'));

            $search = MoySklad::searchOfResult($url);

            if ($search) {
                $search['rows'] = array_filter($search['rows'], function ($item) {
                    // исключаем склад из поиска костыль
                    return $item['productFolder']['id'] !== '416a3aff-0f66-11ee-0a80-0d9c00124798';
                });

                $search['meta']['size'] = count($search['rows']);
            }


            //Mercedes-Benz 1-5 day
            $stockPositions = Stock::getManyByArticle($request->input('text'), 1);
            //NonOriginal Mercedes-Benz
            $stockPositionsNonOriginal = Stock::getManyByArticle($request->input('text'), 3);
            //DongFeng Chinese
            $dongFeng = Stock::getManyByArticle($request->input('text'), 2);
            //Colyman TurkishParts
            $colyman = Colyman::getManyByArticleColyman($request->input('text'));
            //file_put_contents('/var/www/prospekt-parts.com/public_html/logger.txt', var_export($dongFeng, true));
            $oil = Oil::getManyByArticleOil($request->input('text'));
            //hudurusta TrSale
            //поиск аналогов
            $analog = Replacement::getResultReplacement($request->input('text'));

            //file_put_contents('/var/www/prospekt-parts.com/public_html/logger.txt', var_export($analog, true));
            return redirect()->route('testsearch2')->with([
                'search' => $search,
                'text' => $request->input('text'),
                'analog' => $analog,
                'stockPositions' => $stockPositions,  // Add stock positions to the data being sent
                'stockPositionsNonOriginal' => $stockPositionsNonOriginal,
                'dongFeng' => $dongFeng,
                'colyman' => $colyman,
                'oil' => $oil
            ]);
            //file_put_contents('/var/www/prospekt-parts.com/public_html/logger.txt', var_export($search, true));
        } else {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
    } */
   
    public function Test()
    {
        $modal = MoySklad::getAllGoods(); //  getListURL
        $data = [];
        foreach ($modal as $item) {
            $data[] = [
                'link' => $item['link'],
                'image' => $item['image'],
                'article' => $item['article'],
                'name' => $item['name'],
                'description' => $item['description'],
                'price' => $item['price'],
                'quantity' => $item['quantity']
            ];
        }
        Goods::upsert($data, ['article'], ['quantity']); // insert // updateOrCreate // create
        return view('test', ['modal' => $data]);
        // return redirect()->route('search')->with(['search' => $search, 'text' => $text]);
    }


    public function Promotion()
    {
        return view('promotion');
    }


    public function PromoCatalog($id, $limit = 10, $offset = 0)
    {
        $model = Catalog::where('stock', $id)->first();
        $product = MoySklad::getProductFromStock($id, $limit, $offset);
        // return response()->json($product);
        return view('dashboard.promo.catalog',
            [
                'stock' => $id,
                'model' => $model,
                'product' => $product,
                'limit' => $limit,
                'offset' => $offset
            ]
        );
    }


    public function PromoView($uuid)
    {
        $model = Catalog::where('brand', $uuid)->first();
        //Catalog::where('brand', $uuid)->toArray()->get();
        //return response()->json($model);
        return view('dashboard.promo', compact('uuid', 'model'));
    }


    public function NoProduct()
    {
        return redirect()->route('search');
    }


    public function About()
    {
        return view('about');
    }


    public function Dealer()
    {
        return view('dealer');
    }

    public function Production()
    {
        return view('production');
    }


    public function Сontact()
    {
        return view('contact');
    }

    public function Customers()
    {
        return view('customers');
    }


    public function Documentation()
    {
        return view('doc');
    }


    public function License()
    {
        return view('doc.license');
    }


    public function ReturnPolicy()
    {
        return view('doc.return-policy');
    }


    public function Guaranty()
    {
        return view('doc.guaranty');
    }


    public function Responsibility()
    {
        return view('doc.responsibility');
    }


    public function Private()
    {
        return view('doc.privatepolice');
    }

    public function DetailProduct($id)
    {
        $product = MoySklad::getOneProduct($id);
        $data = Goods::where('link', $id)->get();
        //return response()->json($product);
        if ($product['name'] === 'Товар не найден') {
            return view('errors.404');
        }
        $count = 1;
        return view('product', compact('id', 'product', 'data' , 'count'));
    }


    public function stockFolder($id, $limit = 64, $offset = 0)
    {
        $product = MoySklad::getProductFromStock($id, $limit, $offset);
        //return response()->json($product);
        //$product = MoySklad::getProductFromStockGms($id, $limit, $offset);
        return view('stock', compact('product', 'limit', 'offset', 'id'));
    }
    
    public function Catalog($limit = 64, $offset = 0)
    {
        $product = MoySklad::getAllProduct($limit, $offset);
        // $pro = [];
        // foreach($product['rows'] as $item) {
        //     $pro[] = $item['article']; //  ?? '/img/placeholder.png'
        // }
        // $arr_images = Goods::whereIn('article', $pro)->select('article', 'image')->get()->toArray();
        //return response()->json($res);, 'arr_images' => $arr_images
        return view('catalog', ['product' => $product, 'limit' => $limit, 'offset' => $offset]);
    }

    public function FilesDelete(Request $request)
    {
        $uuid = $request->input('uuid');
        $filename = $request->input('name');

        $path = './img/goods/';
        unlink($path . $filename . '.jpg');
        Goods::updateOrCreate(['link' => $uuid], ['image' => '']);
        return [
            'header' => 'Успешно',
            'text' => 'Фото удалено'
        ];
    }

    //дописать потмо условие на все склады ещё один if на stock, чтобы подгружать и сохранять картинки
    public function Files(Request $request)
    {
        $request->validate([
            'uuid' => 'required',
            'file' => 'required',
            'name' => 'required'
        ]);
        $filename = $request->input('name');
        $name = $_FILES['file']['name'];
        $error = $_FILES['file']['error'];
        $ext = explode('.', $name);
        $uuid = $request->input('uuid');

        $uploaddir = './img/goods/';
        $uploadfile = $uploaddir . $filename . '.' . $ext[1];
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
            Goods::updateOrCreate(['link' => $uuid], ['image' => $uploadfile]);
            return [
                'header' => 'Успешно',
                'text' => 'Фото товара загружено',
                'type' => 'success'
            ];
        } else {
            return [
                'header' => 'Ошибка!',
                'text' => $error,
                'type' => 'error'
            ];
        }
    }


    //version3
/*public function Product(Request $request)
{
    $rules = [
        'type' => 'nullable',
        'text' => 'required|min:3',
    ];

    $messages = [
        'text.required' => 'Пожалуйста, введите артикул',
        'text.min' => 'Минимальная длина артикула 3 символа',
    ];
    
    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->passes()) {
        $article = trim($request->input('text'));
        $normalizedArticle = strtoupper(preg_replace('/\s+/', '', $article));

        // Первый запрос к API с полным артикулом
        $url = Steames::getListResult($normalizedArticle);
        $search = MoySklad::searchOfResult($url);

        // Если поиск не дал результатов, удаляем буквенный префикс и повторяем запрос
        if (!$search || count($search['rows']) === 0) {
            $numericArticle = preg_replace('/^\D+/', '', $normalizedArticle);
            if ($numericArticle !== $normalizedArticle) {
                $url = Steames::getListResult($numericArticle);
                $search = MoySklad::searchOfResult($url);
            }
        }

        if ($search) {
            $search['rows'] = array_filter($search['rows'], function ($item) {
                return $item['productFolder']['id'] !== '416a3aff-0f66-11ee-0a80-0d9c00124798';
            });

            $search['meta']['size'] = count($search['rows']);
        }

        // Выполняем локальный поиск на складе
        $stockPositions = Stock::getManyByArticle($normalizedArticle, 1);
        $stockPositionsNonOriginal = Stock::getManyByArticle($normalizedArticle, 3);
        $dongFeng = Stock::getManyByArticle($normalizedArticle, 2);
        $colyman = Colyman::getManyByArticleColyman($normalizedArticle);
        $oil = Oil::getManyByArticleOil($normalizedArticle);
        $hudurusta = Hudurusta::getManyByArticleHudurusta($normalizedArticle);
        $analog = Replacement::getResultReplacement($normalizedArticle);

        return redirect()->route('search')->with([
            'search' => $search,
            'text' => $article,
            'analog' => $analog,
            'stockPositions' => $stockPositions,
            'stockPositionsNonOriginal' => $stockPositionsNonOriginal,
            'dongFeng' => $dongFeng,
            'colyman' => $colyman,
            'oil' => $oil,
            'hudurusta' => $hudurusta
        ]);
    } else {
        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
    }
} */


    //version2
   /* public function Product(Request $request)
    {
    $rules = [
        'type' => 'nullable',
        'text' => 'required|min:3',
    ];

    $messages = [
        'text.required' => 'Пожалуйста, введите артикул',
        'text.min' => 'Минимальная длина артикула 3 символа',
    ];
    
    $validator = Validator::make($request->all(), $rules, $messages);

    if($validator->passes()) {
        $article = $request->input('text');
        
        // Первый запрос к API с полным артикулом
        $url = Steames::getListResult($article);
        $search = MoySklad::searchOfResult($url);

        // Если поиск не дал результатов, удаляем буквенный префикс и повторяем запрос
        if (!$search || count($search['rows']) === 0) {
            $numericArticle = preg_replace('/^\D+/', '', $article);
            if ($numericArticle !== $article) {
                $url = Steames::getListResult($numericArticle);
                $search = MoySklad::searchOfResult($url);
            }
        }

        if ($search) {
            $search['rows'] = array_filter($search['rows'], function ($item) {
                return $item['productFolder']['id'] !== '416a3aff-0f66-11ee-0a80-0d9c00124798';
            });

            $search['meta']['size'] = count($search['rows']);
        }
        // dd($search['rows']);
        // Выполняем локальный поиск на складе
        $stockPositions = Stock::getManyByArticle($article, 1);
        $stockPositionsNonOriginal = Stock::getManyByArticle($article, 3);
        $dongFeng = Stock::getManyByArticle($article, 2);
        $colyman = Colyman::getManyByArticleColyman($article);
        $oil = Oil::getManyByArticleOil($article);
        $hudurusta = Hudurusta::getManyByArticleHudurusta($article);
        $analog = Replacement::getResultReplacement($article);

$v = [
            'search' => $search,
            'text' => $article,
            'analog' => $analog,
            'stockPositions' => $stockPositions,
            'stockPositionsNonOriginal' => $stockPositionsNonOriginal,
            'dongFeng' => $dongFeng,
            'colyman' => $colyman,
            'oil' => $oil,
            'hudurusta' => $hudurusta
        ];
        $v = print_r($v, true);

       // file_put_contents('/var/www/prospekt-parts.com/public_html/logger.txt', "[MainController] " . $v . "\n", FILE_APPEND);

        return redirect()->route('search')->with([
            'search' => $search,
            'text' => $article,
            'analog' => $analog,
            'stockPositions' => $stockPositions,
            'stockPositionsNonOriginal' => $stockPositionsNonOriginal,
            'dongFeng' => $dongFeng,
            'colyman' => $colyman,
            'oil' => $oil,
            'hudurusta' => $hudurusta
        ]);
    } else {
        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
    }
    
}*/ 

    //version1
    public function Product(Request $request)
    {
        $rules = [
            'type' => 'nullable',
            'text' => 'required|min:3',
        ];

        $messages = [
            'text.required' => 'Пожалуйста, введите артикул',
            'text.min' => 'Минимальная длина артикула 3 символа',
        ];
        
        //временный поиск возможно надо будет переработать
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->passes()) {
            //убран поиск MoySklad
            $url = Steames::getListResult($request->input('text'));

            $search = MoySklad::searchOfResult($url);

            if ($search) {
                $search['rows'] = array_filter($search['rows'], function ($item) {
                    // исключаем склад из поиска костыль
                    return $item['productFolder']['id'] !== '416a3aff-0f66-11ee-0a80-0d9c00124798';
                });

                $search['meta']['size'] = count($search['rows']);
            }
            
            
            //Mercedes-Benz 1-5 day
            $stockPositions = Stock::getManyByArticle($request->input('text'), 1);
            //ArmTek
            $stockPositionsArmTek = Stock::getManyByArticle($request->input('text'), 4);
            //NonOriginal Mercedes-Benz
            $stockPositionsNonOriginal = Stock::getManyByArticle($request->input('text'), 3);
            //DongFeng Chinese 
            $dongFeng = Stock::getManyByArticle($request->input('text'), 2);
            //Colyman TurkishParts
            $colyman = Colyman::getManyByArticleColyman($request->input('text'));
            //file_put_contents('/var/www/prospekt-parts.com/public_html/logger.txt', var_export($dongFeng, true));
            $oil = Oil::getManyByArticleOil($request->input('text'));
            // Hudurusta -TrSale
            $hudurusta = Hudurusta::getManyByArticleHudurusta($request->input('text'));
            //поиск аналогов
            $analog = Replacement::getResultReplacement($request->input('text'));
            
            //file_put_contents('/var/www/prospekt-parts.com/public_html/logger.txt', var_export($analog, true));
            return redirect()->route('search')->with([
                'search' => $search,
                'text' => $request->input('text'),
                'analog' => $analog,
                'stockPositions' => $stockPositions,  // Add stock positions to the data being sent
                'stockPositionsArmTek' => $stockPositionsArmTek,
                'stockPositionsNonOriginal' => $stockPositionsNonOriginal,
                'dongFeng' => $dongFeng,
                'colyman' => $colyman,
                'oil' => $oil,
                'hudurusta' => $hudurusta
                ]);
            //file_put_contents('/var/www/prospekt-parts.com/public_html/logger.txt', var_export($search, true));
        } else {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
    } 

    public function Partner()
    {
        return view('partner');
    }

    public function Shipper()
    {
        return view('shipper');
    }

    public function Developers()
    {
        return view('developers');
    }

    public function Card()
    {
        $uuid = auth()->user();
        if ($uuid) {
            $data = Customer::where('customer.uuid', $uuid->verified)
                ->join('contract', 'customer.uuid', '=', 'contract.uuid')
                ->get();
            //return response()->json($data);
            return view('card', ['data' => $data]);
        }
        return view('card');
    }

}
