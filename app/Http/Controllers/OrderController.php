<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Http\Requests\Checkout;

use App\Models\MoySklad;
use App\Models\Telegram;

use App\Models\Order;
use App\Models\OrderCustomer;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function Order($uuid = '')
    {
        if ($uuid) {
            $order = MoySklad::newOrderView($uuid);
            return view('order', compact('order'));
        }
        return view('order');
    }

    //old version
    /*public function Checkout(Request $request)
    {
        $isUserRegistered = !($request->has('checkout'));

        if (!$isUserRegistered) {
            $request->validate(Checkout::rules());

            $newAgent = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address == '' ? '...' : $request->address,
            ];

            $orderItems = json_decode($request->checkout, true)['positions'];

            $tgMessageType = 'neworderDB';
        } else {
            $data = json_decode($request->name, true);

            $newAgent = ['name' => $data['agent']['meta']['href']];

            $orderItems = $data['positions'];

            $tgMessageType = 'neworderDBreg';
        }

        $customer = OrderCustomer::create($newAgent);

        $order = Order::create([
            // Добавляем поля заказа, например, дату, статус и т.д.
            'customer_id' => $customer->id,
            'creation_date' => now()->addHours(3)->toDateTimeString(),
            // или любая другая дата, если требуется
            // Другие поля заказа, если есть
        ]);

        //название склада
        //$stockId = $request->input('stockId');

        $totalSum = 0;

        foreach ($orderItems as $item) {

            $totalSum += $item['price'];

            OrderItem::create([
                'order_id' => $order->id,
                'name' => $item['name'],
                'article' => $item['article'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'stock_category_id' => $item['category_id']
            ]);
        }

        $order->total_sum = $totalSum;
        // $order->stock_id = $stockId;
        $order->save();


//        Mail::to($request->email)->send(new VerifyEmail($result));
        Telegram::getMessageTelegram(0, $orderItems, $newAgent, $tgMessageType);

        if (!$isUserRegistered) {
            return redirect()->route('userorder')->with(
                [
                    'data' => $newAgent,
                    'order' => 0,
                    'id' => 0
                ]
            );
        } else {
            $message = 'Ваш заказ получен.';
            return redirect()->route('card')->with(['status' => $message]);
        }
        //return response()->json($result['id']);
        return redirect()->route('userorder')->with(['error' => 'Не удалось отправить заказ']);
    }*/    
    
    //ХОРОШАЯ ВЕРСИЯ ПОКА ЕЁ НЕ ДРОПАТЬ
    /*public function Checkout(Request $request)
    {
        // Определяем, зарегистрирован ли пользователь (если не зарегистрирован, выполняется стандартный процесс оформления заказа)
        $isUserRegistered = !($request->has('checkout'));
    
        if (!$isUserRegistered) {
            // Валидация данных при новом заказе от незарегистрированного пользователя
            $request->validate(Checkout::rules());
    
            // Данные нового пользователя (покупателя)
            $newAgent = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address == '' ? '...' : $request->address,
            ];
    
            // Получаем товары из запроса
            $orderItems = json_decode($request->checkout, true)['positions'];
    
            $tgMessageType = 'neworderDB';
        } else {
            // Если пользователь зарегистрирован, декодируем данные из запроса
            $data = json_decode($request->name, true);
    
            // Устанавливаем данные для зарегистрированного пользователя
            $newAgent = ['name' => $data['agent']['meta']['href']];
    
            // Получаем товары для зарегистрированного пользователя
            $orderItems = $data['positions'];
    
            $tgMessageType = 'neworderDBreg';
        }
    
        // Создаем запись в таблице `order_customers` для нового или существующего покупателя
        $customer = OrderCustomer::create($newAgent);
    
        // Создаем заказ, привязанный к покупателю
        $order = Order::create([
            'customer_id' => $customer->id,
            'creation_date' => now()->addHours(3)->toDateTimeString(),
            // Если нужно добавить другие поля заказа, добавьте их здесь
        ]);
    
        // Рассчитываем общую сумму заказа
        $totalSum = 0;
    
        // Создаем записи для каждого товара в заказе
        foreach ($orderItems as $item) {
            $totalSum += $item['price'];
    
            OrderItem::create([
                'order_id' => $order->id,
                'name' => $item['name'],
                'article' => $item['article'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'stock_category_id' => $item['category_id'] // Поле для категории склада
            ]);
        }
    
        // Обновляем общую сумму заказа
        $order->total_sum = $totalSum;
        $order->save();
    
        // Отправляем уведомление в Telegram о новом заказе
        Telegram::getMessageTelegram(0, $orderItems, $newAgent, $tgMessageType);
    
        // Если пользователь не зарегистрирован, перенаправляем его на страницу подтверждения заказа
        if (!$isUserRegistered) {
            return redirect()->route('userorder')->with([
                'data' => $newAgent,
                'order' => 0,
                'id' => 0
            ]);
        } else {
            // Если пользователь зарегистрирован, выводим сообщение о получении заказа
            $message = 'Ваш заказ получен.';
            return redirect()->route('card')->with(['status' => $message]);
        }
    
        // На случай ошибки перенаправляем на страницу заказа с сообщением об ошибке
        return redirect()->route('userorder')->with(['error' => 'Не удалось отправить заказ']);
    } */
    
    //+- ОК ВЕРСИИ ЩАС БУДУ ПЕРЕДЕЛЫВАТЬ
    /*public function Checkout(Request $request)
    {
        // Предполагаем, что пользователь зарегистрирован
        $currentUser = Auth::user();
        $customer = OrderCustomer::where('email', $currentUser->email)->first();
    
        if (!$customer) {
            // Создаем нового покупателя, если его не нашли
            $customer = OrderCustomer::create([
                'name' => $currentUser->name,
                'email' => $currentUser->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        }
    
        // Проверяем, что данные о заказе в формате JSON или массиве
        $orderData = $request->input('name');
    
        // Проверяем, если $orderData — это строка, то декодируем её
        if (is_string($orderData)) {
            $orderData = json_decode($orderData, true); // Декодируем JSON в массив
        }
    
        // Извлекаем товары из массива данных
        $orderItems = $orderData['positions'] ?? []; // Убедитесь, что 'positions' есть в массиве
    
        if (!empty($orderItems)) {
            // Создаем новый заказ
            $order = Order::create([
                'customer_id' => $customer->id,
                'creation_date' => now()->addHours(3)->toDateTimeString(),
            ]);
    
            $totalSum = 0;
    
            // Проходим по каждому товару и сохраняем его в базе данных
            foreach ($orderItems as $item) {
                $totalSum += $item['price'] * $item['quantity'];
    
                // Создаем запись для каждого товара в заказе
                OrderItem::create([
                    'order_id' => $order->id,
                    'article' => $item['article'],
                    'name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'stock_category_id' => $item['category_id'],
                ]);
            }
    
            // Обновляем общую сумму заказа
            $order->update(['total_sum' => $totalSum]);
    
            // Отправляем данные о заказе и товарах в Telegram
            $tgMessageType = 'neworderDB'; // Тип сообщения для Telegram
            Telegram::getMessageTelegram(0, $orderItems, $customer, $tgMessageType);
        } else {
            // Если товары не были переданы
            return redirect()->back()->with('error', 'Товары для заказа не найдены.');
        }
    
        // Возвращаем пользователя на страницу с подтверждением заказа
        return redirect()->route('card')->with('status', 'Заказ оформлен');
    }*/
    
    
    //best version without stockid
    /*public function Checkout(Request $request)
    {
        // Предполагаем, что пользователь зарегистрирован
        $currentUser = Auth::user();
    
        // Получаем данные о компании из запроса
        // Здесь предполагается, что данные о компании приходят через поле 'organization' в запросе (например, через JSON)
        $companyData = $request->input('name.agent.meta.href'); // Извлекаем данные о компании из запроса
        $companyName = "ООО АТРИ"; // По умолчанию, если компания не передана, можно задать статичное значение
    
        if (!empty($companyData)) {
            // Если компания передана, используем динамическое значение
            $companyName = $request->input('name.agent.name'); // Получаем название компании из запроса
        }
    
        // Проверяем, есть ли такой заказчик в базе по email
        $customer = OrderCustomer::where('email', $currentUser->email)->first();
    
        if (!$customer) {
            // Если заказчика нет, создаем нового заказчика, используя имя компании
            $customer = OrderCustomer::create([
                'name' => $companyName, // Используем название компании вместо имени пользователя
                'email' => $currentUser->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        }
    
        // Проверяем, что данные о заказе в формате JSON или массиве
        $orderData = $request->input('name');
    
        // Проверяем, если $orderData — это строка, то декодируем её
        if (is_string($orderData)) {
            $orderData = json_decode($orderData, true); // Декодируем JSON в массив
        }
    
        // Извлекаем товары из массива данных
        $orderItems = $orderData['positions'] ?? []; // Убедитесь, что 'positions' есть в массиве
    
        if (!empty($orderItems)) {
            // Создаем новый заказ
            $order = Order::create([
                'customer_id' => $customer->id,
                'creation_date' => now()->addHours(3)->toDateTimeString(),
            ]);
    
            $totalSum = 0;
    
            // Проходим по каждому товару и сохраняем его в базе данных
            foreach ($orderItems as $item) {
                // Предположим, что цена передается в копейках, поэтому делим на 100 для конвертации в рубли
                
                $realPrice = $item['price'] / 100; // Конвертация копеек в рубли
    
                $totalSum += $realPrice * $item['quantity'];
    
                // Создаем запись для каждого товара в заказе
                OrderItem::create([
                    'order_id' => $order->id,
                    'article' => $item['article'],
                    'name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $realPrice, // Записываем цену в рублях
                    'stock_category_id' => $item['category_id'],
                ]);
            }
    
            // Обновляем общую сумму заказа
            $order->update(['total_sum' => $totalSum]);
    
            // Отправляем данные о заказе и товарах в Telegram
            $tgMessageType = 'neworderDB'; // Тип сообщения для Telegram
            Telegram::getMessageTelegram(0, $orderItems, $customer, $tgMessageType);
        } else {
            // Если товары не были переданы
            return redirect()->back()->with('error', 'Товары для заказа не найдены.');
        }
    
        // Возвращаем пользователя на страницу с подтверждением заказа
        return redirect()->route('card')->with('status', 'Заказ оформлен');
    }*/
    
    
    
    /*public function Checkout(Request $request)
    {
        // Предполагаем, что пользователь зарегистрирован
        $currentUser = Auth::user();
    
        // Получаем данные о компании из запроса
        $companyData = $request->input('name.agent.meta.href');
        $companyName = "ООО АТРИ"; // По умолчанию
    
        if (!empty($companyData)) {
            $companyName = $request->input('name.agent.name');
        }
    
        // Проверяем, есть ли такой заказчик в базе по email
        $customer = OrderCustomer::where('email', $currentUser->email)->first();
    
        if (!$customer) {
            $customer = OrderCustomer::create([
                'name' => $companyName,
                'email' => $currentUser->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        }
    
        // Получаем данные заказа и товары
        $orderData = $request->input('name');
        if (is_string($orderData)) {
            $orderData = json_decode($orderData, true);
        }
    
        $orderItems = $orderData['positions'] ?? [];
    
        if (!empty($orderItems)) {
            // Создаем новый заказ
            $order = Order::create([
                'customer_id' => $customer->id,
                'creation_date' => now()->addHours(3)->toDateTimeString(),
            ]);
    
            // Получаем id склада, если передан
            $stockId = $request->input('stockId'); // Поле для ID склада
    
            $totalSum = 0;
    
            foreach ($orderItems as $item) {
                // Конвертируем цену в рубли
                $realPrice = $item['price'] / 100;
    
                $totalSum += $realPrice * $item['quantity'];
    
                // Сохраняем товар с информацией о складе
                OrderItem::create([
                    'order_id' => $order->id,
                    'article' => $item['article'],
                    'name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $realPrice, // Цена в рублях
                    'stock_category_id' => $stockId ?? $item['category_id'], // Используем stockId
                ]);
            }
    
            // Обновляем общую сумму заказа
            $order->update(['total_sum' => $totalSum]);
    
            // Отправляем данные в Telegram
            $tgMessageType = 'neworderDB';
            Telegram::getMessageTelegram(0, $orderItems, $customer, $tgMessageType);
        } else {
            return redirect()->back()->with('error', 'Товары для заказа не найдены.');
        }
    
        return redirect()->route('card')->with('status', 'Заказ оформлен');
    } */

public function Checkout(Request $request)
{
    if (Auth::check()) {
        // Пользователь авторизован
        $currentUser = Auth::user();

        // Получаем данные о компании из запроса
        $companyData = $request->input('name.agent.meta.href');
        $companyName = "ООО АТРИ"; // По умолчанию

        if (!empty($companyData)) {
            $companyName = $request->input('name.agent.name');
        }

        // Проверяем, есть ли такой заказчик в базе по email
        $customer = OrderCustomer::where('email', $currentUser->email)->first();

        if (!$customer) {
            $customer = OrderCustomer::create([
                'name' => $companyName,
                'email' => $currentUser->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        }

        $tgMessageType = 'neworderDBreg';

        // Получаем данные заказа и товары
        $orderData = $request->input('name');
        if (is_string($orderData)) {
            $orderData = json_decode($orderData, true);
        }

        $orderItems = $orderData['positions'] ?? [];
    } else {
        // Пользователь не авторизован
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            // Добавьте другие необходимые правила валидации
        ]);

        $customerData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address == '' ? '...' : $request->address,
        ];

        $customer = OrderCustomer::create($customerData);

        $companyName = $request->name; // Для согласованности
        $tgMessageType = 'neworderDB';

        // Получаем данные заказа и товары
        $orderData = $request->input('checkout');
        if (is_string($orderData)) {
            $orderData = json_decode($orderData, true);
        }

        $orderItems = $orderData['positions'] ?? [];
    }

    if (!empty($orderItems)) {
        // Создаем новый заказ
        $order = Order::create([
            'customer_id' => $customer->id,
            'creation_date' => now()->addHours(3)->toDateTimeString(),
        ]);

        // Получаем id склада, если передан
        $stockId = $request->input('stockId'); // Поле для ID склада

        $totalSum = 0;

        foreach ($orderItems as $item) {
            // Конвертируем цену в рубли
            $realPrice = $item['price'] / 100;

            $totalSum += $realPrice * $item['quantity'];

            // Сохраняем товар с информацией о складе
            OrderItem::create([
                'order_id' => $order->id,
                'article' => $item['article'],
                'name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $realPrice, // Цена в рублях
                'stock_category_id' => $stockId ?? $item['category_id'], // Используем stockId
            ]);
        }

        // Обновляем общую сумму заказа
        $order->update(['total_sum' => $totalSum]);

        // Отправляем данные в Telegram
        Telegram::getMessageTelegram(0, $orderItems, $customer, $tgMessageType);

        if (!Auth::check()) {
            return redirect()->route('userorder')->with([
                'data' => $customerData,
                'order' => 0,
                'id' => 0,
            ]);
        } else {
            $message = 'Ваш заказ получен.';
            return redirect()->route('card')->with(['status' => $message]);
        }
    } else {
        return redirect()->back()->with('error', 'Товары для заказа не найдены.');
    }
}


    //функционал быстрой покупки в клик
    /*public function quickOrder(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        $newAgent = [
            'name' => 'Клиент (заказ в один клик)',
            'email' => 'no-email@example.com',
            'phone' => $request->input('phone'),
            'address' => 'Не указан',
        ];

        $orderItems = [
            [
                'name' => 'Продукт', // Замените на реальное название продукта, если есть
                'article' => 'Артикул', // Замените на реальный артикул продукта, если есть
                'quantity' => $request->input('quantity'),
                'price' => 1000, // Замените на реальную цену продукта
                'category_id' => 1, // Замените на реальный ID категории продукта
                'summa' => 1000 * $request->input('quantity')
            ]
        ];

        $customer = OrderCustomer::create($newAgent);

        $order = Order::create([
            'customer_id' => $customer->id,
            'creation_date' => now()->addHours(3)->toDateTimeString(),
        ]);

        $totalSum = 0;

        foreach ($orderItems as $item) {
            $totalSum += $item['price'] * $item['quantity'];

            OrderItem::create([
                'order_id' => $order->id,
                'name' => $item['name'],
                'article' => $item['article'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'stock_category_id' => $item['category_id']
            ]);
        }

        $order->total_sum = $totalSum;
        $order->save();

        Telegram::getMessageTelegram(0, $orderItems, $newAgent, 'quickorder');

        return response()->json(['success' => true, 'message' => 'Заказ успешно отправлен!']);
    } */


    public function changeStatus(Request $request)
    {
        $orderId = $request->orderId;
        $status = $request->status;

        $order = Order::findOrFail($orderId);
        $currentStatus = $order->status;

        if ($currentStatus === $status) {
            return response()->json([
                'status' => 'Status already set',
            ]);
        }

        // Списание товара со склада
        // if выглядит стремно, надо ченить придумать
        if (!(($currentStatus === 'Отменён'&& $status === 'В работе') || ($currentStatus === 'В работе' && $status === 'Отменён'))) {
            $orderItems = $order->items;
            foreach ($orderItems as $item) {
                if ($item->stock_category_id === 'moysklad' || $item->stock_category_id === 'colyman') {
                    continue;
                }
                $stockItem = Stock::where(['article' => $item->article, 'stock_category_id' => $item->stock_category_id])->first();
                if ($stockItem) {
                    if ($currentStatus === 'Завершён') {
                        $stockItem->quantity += $item->quantity;
                    } elseif ($status == 'Завершён') {
                        $stockItem->quantity -= $item->quantity;
                    }
                    $stockItem->save();
                }
            }
        }

        $order->status = $status;
        $order->save();

        return response()->json([
            'status' => 'success',
        ]);
    }
    
    public function show($id)
    {
        // Найти заказ по его ID
        $order = OrderItem::with('customer')->findOrFail($id);
        // Вернуть представление для отображения деталей заказа
        return view('dashboard.payment.order_show', compact('order'));
    }

}
