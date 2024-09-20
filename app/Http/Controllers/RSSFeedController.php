<?php

namespace App\Http\Controllers;

use App\Models\MoySklad;
use App\Models\DongFeng;
use App\Models\Stock;

    
use Illuminate\Http\Request;
use App\Models\Data\Replacement;

class RSSFeedController extends Controller
{
    // feedRSS
    public function feedRSS()
    {
        // $yml = [
          //   [
            //    'id' => '7fc90f27-3213-11ee-0a80-0083002708e8',
              //  'article' => 'A5410302801',
              //  'alt_article' => 'DF-5410300601',
        //        'name' => 'Вал Коленчатый',
         //       'description' => 'Вал коленчатый, деталь сложной формы, имеющая шейки для крепления шатунов, от которых воспринимает усилия и преобразует их в крутящий момент.',
          //      'price' => 420000
             //],
        //     [
        //         'id' => '810e4183-5064-11ed-0a80-05bf003d33a9',
        //         'article' => 'A4710902755',
        //         'alt_article' => 'A4710902455',
        //         'name' => 'Комплект топливных фильтров',
        //         'description' => 'Фильтр топливный ДВС. Фильтр очистки топлива дизелей, сменный элемент.',
        //         'price' => 10283
        //     ],
        //     [
        //         'id' => '88a54430-48ad-11ed-0a80-0c87007f419c',
        //         'article' => 'A4731800809',
        //         'alt_article' => '',
        //         'name' => 'Фильтр масляный',
        //         'description' => 'Фильтр масляный ДВС. Фильтр для очистки масла, сменный элемент.',
        //         'price' => 3785
        //     ],
        //     [
        //         'id' => '54ddbc1a-90e3-11ed-0a80-0f4a0011b022',
        //         'article' => 'A4700908352',
        //         'alt_article' => '',
        //         'name' => 'Фильтр топливный',
        //         'description' => 'Фильтр очистки топлива дизелей, сменный элемент.',
        //         'price' => 6633
        //     ],
        //     [
        //         'id' => '887f3a9f-48ad-11ed-0a80-0c87007f4188',
        //         'article' => 'A4710700887',
        //         'alt_article' => '',
        //         'name' => 'Форсунка топливная',
        //         'description' => 'Форсунка для подачи топлива в камеру сгорания ДВС автомобиля.',
        //         'price' => 61545
        //     ],
        //     [
        //         'id' => '85516e33-5064-11ed-0a80-05bf003d3521',
        //         'article' => 'A5410900151',
        //         'alt_article' => '',
        //         'name' => 'Фильтр топливный',
        //         'description' => '',
        //         'price' => 1990
        //     ],
        //     [
        //         'id' => '56305339-90e3-11ed-0a80-0f4a0011b086',
        //         'article' => 'A0060179721',
        //         'alt_article' => 'A0030100651',
        //         'name' => 'Форсунка топливная',
        //         'description' => 'Фильтр топливный ДВС, сменный элемент. Используется для фильтрации топливной системы двигателя от грязи и вредных примесей.',
        //         'price' => 8000
        //     ],
        //     [
        //         'id' => 'c0bac601-b76b-11ed-0a80-025b00160b85',
        //         'article' => 'A0290742502',
        //         'alt_article' => 'A0280745902',
        //         'name' => 'Насос-форсунка топливная',
        //         'description' => 'Топливная насос-форсунка является топливным насосом высокого давления для каждого цилиндра двигателя. Определяет количество топлива необходимое для впрыска в камеру сгорания, которое передает через трубку форсунке двигателя. Управление электронное, посредством коммуникации с блоком управления и датчиками автомобиля.',
        //         'price' => 29000
        //     ],
        //     [
        //         'id' => '569d6ead-90e3-11ed-0a80-0f4a0011b0bf',
        //         'article' => 'A0262509201',
        //         'alt_article' => 'A0222503801',
        //         'name' => 'Комплект сухого сцепления',
        //         'description' => '',
        //         'price' => 59000
        //     ],
        //     [
        //         'id' => '88e982f5-48ad-11ed-0a80-0c87007f41c4',
        //         'article' => 'A9604200120',
        //         'alt_article' => 'A0064205220',
        //         'name' => 'Колодки',
        //         'description' => 'Тормозные колодки автомобиля.',
        //         'price' => 14800
       //      ]
      //     ];
        //A5410302801 DF-5410300601
        //$replace = Replacement::getResultReplacement('DF-5410300601')[0]->analog;

       $yml = [];
        $product = MoySklad::getAllProduct(500, 0);
        $product2 = Stock::getStock(0, 300, 1);
        $product3 = Stock::getStock(0, 300, 2);
        
        $selectedArticles = [
        'A0292507301', 'A0290742502', 'A0032605963', 'A4700908352', 'A4710902755', 'A5410304837', 
        'A0024463464', 'A9616902244', 'A9408903819', 'A3758900419', 'A0002540447', 'A4570302537', 
        'A9602419713', 'A0032600963', 'A0262509201', 'A0060179721', 'A4719935796', 'A5412002701', 
        'A5410300820', 'A5410501801', 'A4600160720', 'A0292509301', 'A9615000900', 'A0034606380', 
        'A9360903755', 'A0004292797', 'A0032605863', 'A9453900308', 'A0001806965', 'A5410305037', 
        'A0040949204', 'A5410900151', 'A9604200420', 'A5410300624', 'A4710303305', 'A0018207245', 
        'A4731800809', 'A4570511710', 'A4731800309', 'A0071516201', 'A5421800801', 'A9608300818', 
        'A0050940204', 'A0034602280', 'A4572002901', 'A4710109113', 'A5410161620', 'A9064200320'
    ];

                
        foreach ($product['rows'] as $item) {
            if (in_array($item['article'], $selectedArticles)) {
                $yml[] = [
                    'id' => $item['id'],
                    'article' => $item['article'],
                    'name' => mb_convert_case($item['name'], MB_CASE_TITLE, "UTF-8"),
                    'price' => floor($item['salePrices'][0]['value'] / 100),
                ];
            }
        }
//        foreach ($product2 as $item) {
//            $yml[] = [
//                'id' => $item['id'],
//                'article' => $item['article'],
//                'name' => mb_convert_case($item['name'], MB_CASE_TITLE, "UTF-8"),
//                'price' => floor($item['price'] / 100)
//            ];
//        }
//        foreach ($product3 as $item) {
//            $yml[] = [
//                'id' => $item['id'],
//                'article' => $item['article'],
//                'name' => mb_convert_case($item['name'], MB_CASE_TITLE, "UTF-8"),
//                'price' => floor($item['price'] / 100)
//            ];
//        }
        // Теперь у вас есть один массив $products содержащий все данные из трех запросов
        return response()->view('feed', ['yml' => $yml])->header('Content-Type', 'text/xml');
        }

    public function isReplacement($text)
        {
            $replacements = Replacement::findAnalogs($text);
            // Проверьте, существуют ли замены и есть ли у первой замены аналог
            if (!empty($replacements) && isset($replacements[0]->analog)) {
                return $replacements[0]->analog;
            }
            // Если нет замен или свойства аналога, верните пустую строку
            return '';
        }


}
