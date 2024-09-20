<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\ProductControl;

class Telegram 
{

    public static function layout($num, $product, $link, $type = '')
    {
        switch ($type) {
            case 'ticket':
                return self::ticket($num, $product, $link);
                break;
            case 'neworder':
                return self::neworder($num, $product, $link);
                break;
            case 'spares':
                return self::spares($num, $product, $link);
                break;
            case 'checkout':
                return self::checkout($num, $product, $link);
                break;
            case 'precheckout':
                return self::precheckout($num, $product, $link);
                break;
            case 'manager':
                return self::manager($num, $product, $link);
                break;
            case 'counterparty':
                return self::counterparty($num, $product, $link);
                break;
            case 'neworderDB':
                return self::neworderDB($num, $product, $link);
                break;
            case 'neworderDBreg':
                return self::neworderDBreg($num, $product, $link);
                break;
             case 'quickorder':
                return self::quickOrder($num, $product, $link);
                break;
            default:
                return self::product($num, $product, $link);
        }
    }

    public static function neworder($num, $product, $link)
    {
        $msd = '<b>Новый заказ №'.$product.'</b>'.PHP_EOL.
        '------'.PHP_EOL.
        'Покупатель: '.$link['name'].PHP_EOL.
        'E-mail: '.$link['email'].PHP_EOL.
        'Телефон: '.$link['phone'].PHP_EOL.
        '------'.PHP_EOL.
        '<a href="https://prospekt-parts.com/dashboard/payment/reports/'.$num.'">[Подробнее]</a>';
        //'<a href="https://api.moysklad.ru/app/#Company/edit?id='.$num.'">[Подробнее]</a>';
        return $msd;
    }

    public static function counterparty($num, $product, $link)
    {
        $msd = '<b>Зарегистрировалась новая компания</b>'.PHP_EOL.
        '<i>'.$product.'</i>'.PHP_EOL.
        'E-mail адрес: '.$link.PHP_EOL.
        '------'.PHP_EOL.
        '<a href="https://api.moysklad.ru/app/#Company/edit?id='.$num.'">[Подробнее]</a>';
        return $msd;
    }

    public static function manager($num, $product, $link)
    {
        $msd = '<b>Вопрос менеджеру #'.time().
        ' <a href="https://api.moysklad.ru/app/#customerorder/edit?id='.$num.'">по заказу</a></b>'.PHP_EOL.
        '------'.PHP_EOL.
        PHP_EOL.$product.PHP_EOL.
        '<a href="https://api.moysklad.ru/app/#Company/edit?id='.$link.'">[Подробнее]</a>';
        return $msd;
    }

    public static function precheckout($num, $product, $link)
    {
        $msd = '<b>Предаказ #'.$product.'</b>'.PHP_EOL.
        '------'.PHP_EOL.
        'Дата: '.date('d.m.Y | H:i').PHP_EOL.
        '==========.'.PHP_EOL.
        '<a href="https://api.moysklad.ru/app/#internalorder/edit?id='.$num.'">[Подробнее]</a>';
        return $msd;
    }

    public static function checkout($num, $product, $link)
    {   
        $msd = '<b>Заказ #'.$product.'</b>'.PHP_EOL.
        '------'.PHP_EOL.
        'Дата: '.date('d.m.Y | H:i').PHP_EOL.
        'На вашем сервисе '.config('app.name').' был оформлен заказ товаров.'.PHP_EOL.
        '<a href="https://api.moysklad.ru/app/#customerorder/edit?id='.$num.'">[Подробнее]</a>';
        return $msd;
    }
    
    public static function spares($num, $product, $link)
    {
        $msd = '<b>Заказ #'.time().'</b>'.PHP_EOL.
        '------'.PHP_EOL.
        '<b>VIN номер:</b> '.$link.PHP_EOL.PHP_EOL.
        '<b>Сообщение:</b>'.PHP_EOL.$product.PHP_EOL.
        '<a href="https://api.moysklad.ru/app/#Company/edit?id='.$num.'">[Подробнее]</a>';
        return $msd;
    }

    public static function ticket($num, $product, $link)
    {
        $msd = '<b>Тикет #'.$num.'</b>'.PHP_EOL.
        '<b>Сообщение:</b>'.PHP_EOL.$product.PHP_EOL.
        '<a href="https://prospekt-parts.com/dashboard/product/details/'.$link.'">[Подробнее]</a>';
        return $msd;
    }

    public static function product($num, $product, $link)
    {
        $msd = '<b>Запрос #'.$num.'</b>'.PHP_EOL.
        '<b>Информация:</b>'.PHP_EOL.$product.PHP_EOL.
        '<a href="https://api.moysklad.ru/app/#Contract/edit?id='.$link.'">[Подробнее]</a>';
        return $msd;
    }

    /*public static function neworderDB($num, $product, $link)
    {
        $positions = self::getOrderPosition($product);

        $msd = '<b>Новый заказ</b>'.PHP_EOL.
            '------'.PHP_EOL.
            'Покупатель: '.$link['name'].PHP_EOL.
            'E-mail: '.$link['email'].PHP_EOL.
            'Телефон: '.$link['phone'].PHP_EOL.
            'Адрес: '.$link['address'].PHP_EOL.
            '------'.PHP_EOL.
            'Позиции: '.PHP_EOL.
            '------'.PHP_EOL.
            $positions['items'].
            'Сумма заказа: '.($positions['total'] / 100).'₽'.PHP_EOL;
            //'<a href="https://prospekt-parts.com/dashboard/payment/reports/'.$num.'">[Подробнее]</a>';
        //'<a href="https://api.moysklad.ru/app/#Company/edit?id='.$num.'">[Подробнее]</a>';
        return $msd;
    }*/
    
    public static function neworderDB($num, $product, $link)
    {
        $positions = self::getOrderPosition($product);
    
        $msd = '🆕 <b>Новый заказ</b>'.PHP_EOL.
            '------'.PHP_EOL.
            '👤 <b>Покупатель:</b> '.htmlspecialchars($link['name']).PHP_EOL.
            '✉️ <b>E-mail:</b> '.htmlspecialchars($link['email']).PHP_EOL.
            '📞 <b>Телефон:</b> '.htmlspecialchars($link['phone']).PHP_EOL.
            '📍 <b>Адрес:</b> '.htmlspecialchars($link['address']).PHP_EOL.
            '------'.PHP_EOL.
            '🛍️ <b>Позиции:</b>'.PHP_EOL.
            '------'.PHP_EOL.
            $positions['items'].
            '💰 <b>Сумма заказа:</b> '.number_format($positions['total'] / 100, 2, '.', '').'₽'.PHP_EOL;
        return $msd;
    }

    
    
    public static function quickOrder($num, $product, $link)
    {
        $positions = self::getOrderPosition($product);

        $msd = '<b>Новый заказ в один клик</b>'.PHP_EOL.
            '------'.PHP_EOL.
            'Покупатель: '.$link['name'].PHP_EOL.
            'Телефон: '.$link['phone'].PHP_EOL.
            '------'.PHP_EOL.
            'Позиции: '.PHP_EOL.
            '------'.PHP_EOL.
            $positions['items'].
            'Сумма заказа: '.($positions['total'] / 100).'₽'.PHP_EOL;

        return $msd;
    }
    

    public static function neworderDBreg($num, $product, $link)
    {
        $counterAgent = MoySklad::getContrAgentLink($link['name']);
        
        $categoriesResult = Database::getCategotiesArray();
        
        $positions = self::getOrderPosition($product);

        $msd = '<b>Новый заказ зарегестрированного пользователя</b>'.PHP_EOL.
            '------'.PHP_EOL.
            '<a href="' . $counterAgent . '"><u>Ссылка на покупателя</u></a>' .PHP_EOL.
            '------'.PHP_EOL.
            'Позиции: '.PHP_EOL.
            '------'.PHP_EOL.
            //test
            'Склад: '.$categoriesResult[$item['category_id']].PHP_EOL.
            '------'.PHP_EOL.
            
            $positions['items'].
            'Сумма заказа: '.($positions['total'] / 100).'₽'.PHP_EOL;
        //'<a href="https://prospekt-parts.com/dashboard/payment/reports/'.$num.'">[Подробнее]</a>';
        //'<a href="https://api.moysklad.ru/app/#Company/edit?id='.$num.'">[Подробнее]</a>';
        return $msd;
    }

      /*public static function getOrderPosition($product)
        {
            $categoriesResult = Database::getCategotiesArray();
        
            $items = '';
            $total = 0;
            foreach ($product as $item){
                $items .= 'Наименование: ' . $item['name'] . ' ' . $item['article'] . PHP_EOL .
                          'Цена: ' . ($item['price'] / 100) . PHP_EOL .
                          'Кол-во: ' . $item['quantity'] . PHP_EOL .
                          '------' . PHP_EOL; // Разделитель между товарами (если требуется)
                $total += ($item['price']) * $item['quantity']; // Расчет суммы по позиции
            }
            return ['items' => $items, 'total' => $total];
        }*/ 

        public static function getOrderPosition($product)
        {
            $items = '';
            $total = 0;
            foreach ($product as $item){
                $price = $item['price'];
                $quantity = $item['quantity'];
                $sum = $price * $quantity;
                $items .= '📦 <b>Наименование:</b> '.htmlspecialchars($item['name'].' '.$item['article']).PHP_EOL.
                          '💲 <b>Цена:</b> '.number_format($price / 100, 2, '.', '').'₽'.PHP_EOL.
                          '🔢 <b>Количество:</b> '.$quantity.PHP_EOL.
                          '🧮 <b>Сумма:</b> '.number_format($sum / 100, 2, '.', '').'₽'.PHP_EOL.
                          '------'.PHP_EOL;
                $total += $sum;
            }
            return ['items' => $items, 'total' => $total];
        }


    public static function getMessageTelegram($num, $product, $link, $type = '')
    {
        $msd = self::layout($num, $product, $link, $type);
        $url = config('app.tg_url').config('app.tg_apikey').'/sendMessage';
        $response = Http::asForm()->post($url, [
            'text' => htmlspecialchars_decode($msd),
            'chat_id' => -1002004240593,    
            'parse_mode' => 'HTML'
            
        ]);
        //return $response;
        // Записать ответ для отладки
    \Log::info('Ответ от Telegram API: ' . $response);
    return $response;
    }

}