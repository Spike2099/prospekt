<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Checkout;
use App\Models\Colyman;
use App\Models\Data\Replacement;
use App\Models\Database;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\MakeContract;
use App\Http\Requests\SettingEdit;
use App\Http\Requests\CounterAgent;
use App\Models\Card;
use App\Models\Contract;
use App\Models\Telegram;

//методы для хранения данных по заказу со стоков
use App\Models\Order;
use App\Models\OrderCustomer;
use App\Models\OrderItem;

use App\Models\MoySklad;
use App\Models\DaData;
use App\Models\Goods;
use App\Models\Stock;
use App\Models\User;
use App\Models\Steames;

use Illuminate\Support\Facades\Validator;


class DachboardController extends Controller
{

    public function Dashboard()
    {
        $uuid = auth()->user()->verified;
        if (isset($uuid)) {
            Card::giveAccess($uuid);
        }
        return view('dashboard');
    }


    public function arrayPack($request) // Request 
    {
        return setcookie("Pack", $request, time() + 3600);
    }


    public function preOrderViewOne($id)
    {
        $pre = MoySklad::viewOnePreOrder($id);
        return view('dashboard.payment.preorder-detail', ['id' => $id, 'pre' => $pre]);
    }


    public function preOrders()
    {
        $order = MoySklad::viewAllPreOrders();
        // return response()->json($order);
        return view('dashboard.payment.preorders', ['order' => $order]);
    }


    public function createInvoice(Request $request)
    {
        MoySklad::createInvoiceout($request->id);
        $message = 'Счёт выставлен';
        return redirect()->route('orders')->with(['message' => $message]);
    }


    public function noSearch()
    {
        return redirect()->route('dashboard');
    }

    public function RecordDetail($id)
    {
        $demand = MoySklad::getOneDemand($id);
        return view('dashboard.payment.demand', ['id' => $id, 'demand' => $demand]);
    }


    public function EditSettings(SettingEdit $request)
    {
        $request->validate(SettingEdit::rules());
        $message = 'Настройки обновлены.';
        MoySklad::editSetting($request);
        return redirect()->route('settings')->with(['message' => $message]);
    }


//    public function resultSearch(Request $request)
//    {
//        $request->validate(['text' => 'required']); // поиск по артиклу
//        $search = MoySklad::searchAssortmentByArticle($request->text);
//        //временно, пока скопы не напишу
//        $searchStock = array_merge(
//            Stock::getManyByArticle($request->input('text'), 1),
//            Stock::getManyByArticle($request->input('text'), 2),
//            Colyman::getManyByArticleColyman($request->input('text')),
//            Stock::getManyByArticle($request->input('text'), 3)
//        );
//        //new
//        if (!empty($searchStock)) {
//            foreach ($searchStock as &$item) {
//                $item['volume'] = $item['quantity'];
//                $item['productFolder']['id'] = $item['link'] === 'turkishProduct' ? 'turkishStock' : 'stockMercedesBenz';
//                $item['salePrices'][0]['value'] = $item['price'] * 100;
//            }
//            $search['rows'] = array_merge($search['rows'], $searchStock);
//            $search['meta']['size'] += count($searchStock);
//        }
//
//        $analog = Replacement::getResultReplacement($request->input('text'));
//
//        if (!empty($analog['db'])) {
//            foreach ($analog['db'] as &$item) {
//                $item['volume'] = $item['quantity'];
//                $item['productFolder']['id'] = $item['link'];
//                $item['salePrices'][0]['value'] = $item['price'] * 100;
//            }
//        }
//
//        $error = 'Слишком короткий запрос, укажите более точные данные';
//        if (strlen($request->text) > 2) {
//            return view('dashboard.result.search', ['search' => $search, 'analog' => $analog, 'text' => $request->text]);
//        }
//        return view('dashboard.result.search', ['text' => $request->text, 'error' => $error]);
//    }

    public function resultSearch(Request $request)
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
            //важно
            $search = MoySklad::searchAssortmentByArticle($request->text);

            if ($search) {
                $search['rows'] = array_filter($search['rows'], function ($item) {
                    // исключаем склад из поиска костыль
                    return $item['productFolder']['id'] !== '416a3aff-0f66-11ee-0a80-0d9c00124798';
                });

                $search['meta']['size'] = count($search['rows']);
            }

            $stockPositions = Stock::getManyByArticle($request->input('text'), 1);
            $stockPositionsNonOriginal = Stock::getManyByArticle($request->input('text'), 3);
            $dongFeng = Stock::getManyByArticle($request->input('text'), 2);
            
            $stockPositionsArmTek = Stock::getManyByArticle($request->input('text'), 4);
            $colyman = Colyman::getManyByArticleColyman($request->input('text'));
            $analog = Replacement::getResultReplacement($request->input('text'));

            return view('dashboard.result.search', [
                'search' => $search,
                'text' => $request->input('text'),
                'analog' => $analog,
                'stockPositions' => $stockPositions,  // Add stock positions to the data being sent
                'stockPositionsArmTek' => $stockPositionsArmTek, 
                'stockPositionsNonOriginal' => $stockPositionsNonOriginal,
                'dongFeng' => $dongFeng,
                'colyman' => $colyman,
            ]);
        } else {
            $error = 'Слишком короткий запрос, укажите более точные данные';
            return view('dashboard.result.search', ['text' => $request->text, 'error' => $error]);
        }
//        $request->validate(['text' => 'required']); // поиск по артиклу
//        $search = MoySklad::searchAssortmentByArticle($request->text);
//        //временно, пока скопы не напишу
//        $stockPositions = Stock::getManyByArticle($request->input('text'), 1);
//        $stockPositionsNonOriginal = Stock::getManyByArticle($request->input('text'), 3);
//        $dongFeng = Stock::getManyByArticle($request->input('text'), 2);
//        $colyman = Colyman::getManyByArticleColyman($request->input('text'));
//        $searchStock = array_merge(
//            Stock::getManyByArticle($request->input('text'), 1),
//            Stock::getManyByArticle($request->input('text'), 2),
//            Colyman::getManyByArticleColyman($request->input('text')),
//            Stock::getManyByArticle($request->input('text'), 3)
//        );
        //new
//        if (!empty($searchStock)) {
////            foreach ($searchStock as &$item) {
////                $item['volume'] = $item['quantity'];
////                $item['productFolder']['id'] = $item['link'] === 'turkishProduct' ? 'turkishStock' : 'stockMercedesBenz';
////                $item['salePrices'][0]['value'] = $item['price'] * 100;
////            }
//            $search['rows'] = array_merge($search['rows'], $searchStock);
//            $search['meta']['size'] += count($searchStock);
//        }

//        $analog = Replacement::getResultReplacement($request->input('text'));

//        if (!empty($analog['db'])) {
//            foreach ($analog['db'] as &$item) {
//                $item['volume'] = $item['quantity'];
//                $item['productFolder']['id'] = $item['link'];
//                $item['salePrices'][0]['value'] = $item['price'] * 100;
//            }
//        }

//        $error = 'Слишком короткий запрос, укажите более точные данные';
//        if (strlen($request->text) > 2) {
//            return view('dashboard.result.search', ['search' => $search, 'analog' => $analog, 'text' => $request->text]);
//        }
//        return view('dashboard.result.search', ['text' => $request->text, 'error' => $error]);
    }


    public function searchDashboard(Request $request)
    {
        $request->validate([
            'type' => 'nullable',
            'text' => 'required',
        ]);
        $url = Steames::getListResult($request->text);
        $search = MoySklad::searchOfResult($url);
        $text = $request->input('text');
        //return response()->json($search);
        return redirect()->route('dashboard')->with(['search' => $search, 'text' => $text]);
    }


    public function Settings()
    {
        $uuid = auth()->user()->verified;
        $profile = MoySklad::getCompany($uuid);
        //return response()->json($profile);
        return view('dashboard.profile.settings', ['profile' => $profile]);
    }



    public function DashboardClientExcel()
    {
        return view('dashboard.dashboardExcel');
    }
    
    public function dashboardProduct()
    {
        return view('dashboard.dashboardProduction');
    }
    

    public function Events()
    {
        return view('dashboard.events');
    }


    public function Schedule()
    {
        return view('dashboard.work.schedule');
    }


    public function Help()
    {
        return view('dashboard.help');
    }


    public function Notifications()
    {
        return view('dashboard.notifications');
    }


    public function Invoice($invoice)
    {
        $order = MoySklad::getInvoiceOne($invoice);
        //return response()->json($order);
        return view('dashboard.payment.order', [
            'order' => $order,
            'id' => $invoice
        ]);
    }


    public function Account()
    {
        return view('dashboard.account');
    }

    public function updateAgreement(MakeContract $request)
    {
        $uuid = auth()->user()->verified;
        $message = 'Данные договора обновлены. Пожалуйста, сверьте данные и подтвердите.';
        $doc = Contract::updateOrCreate(['uuid' => $uuid], $request->all());
        $contract = MoySklad::createAccoutFromAgent($uuid, $request->all());
        return redirect()->route('contract')->with(['status' => $message]);
    }


    public function sendAgreement(MakeContract $request)
    {
        $message = 'Ваш запрос на заключение договора получен. Пожалуйста, сверьте данные и подтвердите.';
        $request->validate(MakeContract::rules());
        $contract = MoySklad::getContract();
        if (isset($contract['id'])) {
            Telegram::getMessageTelegram(time(), 'Запрос на заключение договора.', $contract['id']);
            Contract::create($request->all());
            return back()->with(['status' => $message]);
            //$message = 'Не удалось создать договор. Свяжитесь с менеджером.';
            //return back()->with(['error' => $message]);
        }
        MoySklad::createContract();
        return back();
    }


    public function Checkout(Request $request)
    {
        $message = 'Ваш заказ получен.';

        $account = MoySklad::getCheckout($request->name);
        //dd($account);
        if (isset($account['id'])) {
            //Telegram::getMessageTelegram($account['id'], $account['name'], '', 'checkout');
            return redirect()->route('card')->with(['status' => $message, 'id' => $account['id']]);
        } else {
            return redirect()->back()->withErrors(['error' => 'Не удалось создать заказ.']);
        }
    }


    public function sendDeal(Request $request)
    {
        $uuid = auth()->user()->verified;
        $message = 'Договор составлен, теперь его можно сохранить или распечатать.';
        $deal = new Card;
        $deal->user_id = $uuid;
        $deal->save();
        // MoySklad::enterIntoAcontract($request->deal, $request->accountId);
        return redirect()->route('contract')->with(['status' => $message]);
    }


    public function EditAgreement()
    {
        $uuid = auth()->user()->verified;
        $contract = Contract::find($uuid);
        return view('document.edit-agreement', ['contract' => $contract]);
    }


    public function Agreement()
    {
        $contract = MoySklad::getContract();
        //return response()->json($contract);
        return view('document.agreement', ['contract' => $contract]);
    }


    public function Record()
    {
        $demand = MoySklad::getDemand();
        return view('dashboard.payment.record', ['demand' => $demand]);
    }


    public function DetailProduct($id, Request $request)
    {
        if ($request->has(['name', 'phone'])) {
            Telegram::getMessageTelegram($request->num, $request->message, $request->id);
            return back()->with(['status' => 'Ваш тикет отправлен и получен. Ожидайте ответа от менеджера']);
        }
        //временное условие
        if (!is_numeric($id)) {
            $image = Goods::where('link', $id)->get();

            $product = MoySklad::getOneProduct($id);
            $product['stock_category_id'] = 'moysklad';
            //dd($image);

            $goods = Goods::where('article', $product['article'])->first();

            if ($goods) {
                $goods->name = $product['name'];
                $goods->link = $product['id'];
                $goods->article = $product['article'];
                $goods->price = $product['salePrices'];
                $goods->quantity = $product['quantity'];
                $goods->save();
            }
        } else {
            $product = Stock::where('id', $id)->first();
            $product['catalog'] = ['id' => 'stockMercedesBenz', 'name' => 'Запасной Мерс Склад'];
            $product['salePrices'] = $product['price'] * 100;
            $product['volume'] = $product['quantity'];
            $product['barcodes'] = 'Нет данных';
            $image = $product;
        }
        return view('dashboard.product.details', compact('id', 'product', 'image'));
    }

    public function DetailProductColyman($id)
    {
        $product = Colyman::where('id', $id)->first();
        $product['catalog'] = ['id' => 'turkishStock', 'name' => 'Mercedes-Benz Turkish Stock'];
        $product['salePrices'] = $product['price'] * 100;
        $product['volume'] = $product['quantity'];
        $product['barcodes'] = 'Нет данных';
        $product['stock_category_id'] = 'colyman';
        $image = $product;

        return view('dashboard.product.details', compact('id', 'product', 'image'));
    }


    public function CatalogDetail($name, $limit = 10, $offset = 0)
    {
        if ($name === 'stockMercedesBenz') {
            return redirect()->route('product.index');
        }
        elseif ($name === 'turkishStock') {
            return redirect()->route('colyman.index');
        }
        //$product = MoySklad::getAllProduct($limit, $offset);
        $product = MoySklad::getProductFromStock($name, $limit, $offset);
        //dd($product);
        //return response()->json($product);
        return view('dashboard.catalog-detail', [
            'name' => $name,
            'product' => $product,
            'limit' => $limit,
            'offset' => $offset
        ]);
    }


    public function ReportsDetail($order)
    {
        //$response = MoySklad::getPaymentReports($order);
        $id = $order;
        $response = Order::with('customer', 'items')->where('id', $id)->first()->toArray();
        //return response()->json($response);
        return view('dashboard.payment.reports-detail', [
            'data' => $response,
            'order' => $order,
            'categories' => Database::getCategotiesArray()
        ]);
    }


    public function Card()
    {
        return view('dashboard.card');
    }


    /*public function Reports()
    {
        // Получаем email текущего авторизованного пользователя
            // Получаем email текущего авторизованного пользователя
        $currentEmail = Auth::user()->email; // Или используйте customer_id, если так удобнее
    
        // Находим покупателя по email
        $customer = OrderCustomer::where('email', $currentEmail)->first();
    
        // Проверка, если покупатель найден
        if ($customer) {
            // Получаем заказы, связанные с этим покупателем
            $orders = Order::with('items')
                ->where('customer_id', $customer->id)
                ->get();
        } else {
            $orders = collect(); // Пустая коллекция, если заказов нет
        }
    
        return view('dashboard.payment.reports', compact('orders', 'customer'));
        
    } */
    
    
    //Хорошая версия хуёвый вывод названия компании
    /*public function Reports()
    {
        $currentEmail = Auth::user()->email;
        $customer = OrderCustomer::where('email', $currentEmail)->first();
    
        if ($customer) {
            $orders = Order::with('items')
                ->where('customer_id', $customer->id)
                ->get();
        } else {
            $orders = collect(); // Пустая коллекция, если пользователь не найден
        }
    
        return view('dashboard.payment.reports', compact('orders', 'customer'));
    }*/

    public function Reports()
    {
        // Получаем email текущего авторизованного пользователя
        $currentEmail = Auth::user()->email;
    
        // Находим покупателя по email
        $customer = OrderCustomer::where('email', $currentEmail)->first();
    
        if ($customer) {
            // Загружаем заказы с привязкой к покупателю и товарам
            $orders = Order::with(['customer', 'items']) // Загружаем связанные модели customer и items
                ->where('customer_id', $customer->id)
                ->get();
        } else {
            $orders = collect(); // Пустая коллекция, если покупатель не найден
        }
    
        return view('dashboard.payment.reports', compact('orders'));
    }

    
    

    public function SendSpares(Request $request)
    {
        $uuid = auth()->user()->verified;
        Telegram::getMessageTelegram($uuid, $request->spares, $request->vin, 'spares');
    }


    public function preCheckout(Request $request)
    {
        $message = 'Ваш предзаказ оформлен.';
        $account = MoySklad::getPreCheckout($request->name);
        if (isset($account['id'])) {
            Telegram::getMessageTelegram($account['id'], $account['name'], '', 'precheckout');
            return redirect()->route('account')->with(['status' => $message, 'id' => $account['id']]);
        } else {
            return redirect()->back()->withErrors(['error' => 'Не удалось создать предзаказ.']);
        }
    }

    // getUPDfileExport($id)
    public function getUPD(Request $request)
    {
        $pdf = MoySklad::getUPDfileExport($request->name);
        if ($pdf) {
            return redirect()->route('record')->with(['pdf' => $pdf]);
        } else {
            return redirect()->back()->withErrors(['error' => 'Не удалось получить УПД']);
        }
    }


    public function addedCounterAgent(CounterAgent $request)
    {
        $request->validate(CounterAgent::rules());
        $account = MoySklad::getContrAgent($request->company);
        $message = 'На ваш email: "' . $request->email . '" была отправлена важная информация. Пожалуйста, ознакомьтесь.';
        $error = 'Не удалось зарегистрировать.';
        sleep(2);
        if (isset($account['id'])) {
            Telegram::getMessageTelegram($account['id'], $account['name'], $request->email, 'counterparty');
            return redirect()->route('signin')->with(['signup' => $message, 'id' => $account['id']]);
        }
        return redirect()->route('signin')->with(['error' => $error]);
    }


    public function Orders()
    {
        $orders = MoySklad::getInvoices();
        return view('dashboard.payment.orders', ['orders' => $orders]);
    }


    public function Manager(Request $request)
    {
        $message = 'Ваш запрос получен.';
        $uuid = auth()->user()->verified;
        Telegram::getMessageTelegram($request->reports, $request->message, $uuid, 'manager');
        return redirect()->route('order')->with(['status' => $message]);
    }


    public function Description(Request $request)
    {
        $request->validate([
            'uuid' => 'required',
            'description' => 'required'
        ]);
        $uuid = $request->input('uuid');
        Goods::updateOrCreate(['link' => $uuid], ['description' => $request->description]);
        return redirect('/dashboard/product/details/' . $uuid)->with(['text' => 'Описание обновлено']);
    }


    public function Users()
    {
        $model = User::all();
        return view('dashboard.users', ['model' => $model]);
    }


    public function Accounts($limit = 15, $offset = 0)
    {
        $model = MoySklad::getAllInvoices($limit, $offset);
        //return response()->json($model);
        return view('dashboard.accounts', ['model' => $model, 'limit' => $limit, 'offset' => $offset]);
    }

    //по аналогу будет со стоком 
    public function OrdersList()
    {
//        $model = MoySklad::getAllReports();
//        dd($model);
        $model = Order::with('customer', 'items')->get()->toArray();
        //return response()->json($model);
        return view('dashboard.orders', ['model' => $model]);
    }


    public function OrdersListDelete($uuid)
    {
        $message = 'Заказ удалён';
        MoySklad::deleteOrderPosition($uuid);
        return redirect()->route('allorders')->with(['status' => $message]);
    }


    public function AgentDelete($uuid)
    {
        $message = 'Заказ удалён';
        MoySklad::deleteAgent($uuid);
        return redirect()->route('adminusers')->with(['status' => $message]);
    }


}