<?php

namespace App\Models;

use App\Models\Steames;
use Illuminate\Support\Facades\Http;


class MoySklad
{

    public static function msUrl()
    {
        return 'https://api.moysklad.ru/api/remap/1.2/entity/';
        //https://api.moysklad.ru/api/remap/1.2/entity/product
    }

    public static function get($url)
    {
        return Http::withBasicAuth(
            config('app.ms_login'), 
            config('app.ms_password')
        )->withHeaders(['Accept-Encoding' => 'gzip'])->get($url);
    }


    public function showStock()
    {
          $stock = Stock::all(); // Используйте Eloquent для получения коллекции объектов
            return view('catalog', compact('stock'));
    }


    public static function put($url, $req)
    {
        return Http::withBasicAuth(
            config('app.ms_login'), 
            config('app.ms_password')
        )->withHeaders(['Accept-Encoding' => 'gzip'])->withBody($req, 'application/json')->put($url);
    }

    public static function post($url, $req)
    {
        return Http::withBasicAuth(
            config('app.ms_login'), 
            config('app.ms_password')
        )->withHeaders(['Accept-Encoding' => 'gzip'])->withBody($req, 'application/json')->post($url);
    }


    public static function newOrderView($id)
    {
        $url = self::msUrl().'customerorder/'.$id.'?expand=state,agent,positions,positions.assortment';
        $response = self::get($url);
        return $response->json();
    }


    public static function getListStock()
    {
        $url = self::msUrl().'productfolder';
        $response = self::get($url);
        return $response->json();
    }


    public static function viewOnePreOrder($id)
    {
        $url = self::msUrl().'internalorder/'.$id.'?expand=state,positions,positions.assortment';
        $response = self::get($url);
        return $response->json();
    }


    public static function viewPrintDocument()
    {
        $url = self::msUrl().'demand/metadata/embeddedtemplate';
        $response = self::get($url);
        return $response->json();
    }


    public static function editSetting($data)
    {
        $uuid = auth()->user()->verified;
        $url = self::msUrl().'counterparty/'.$uuid;
        $arr = [
            'description' => $data->person,
            'email' => $data->email,
            'phone' => $data->phone,
            'actualAddress' => $data->actualAddress,
            'legalAddress' => $data->legalAddress,
            'actualAddressFull' => [
                'comment' => $data->delivery
            ]
        ];
        $response = self::put($url, json_encode($arr));
        return $response->json();
    }

    public static function getCheckout($req)
    {
        $url = self::msUrl().'customerorder';
        $response = self::post($url, $req);
        //dd( json_decode($req));
        return $response->json();
    }


    public static function getPreCheckout($req)
    {
        $url = self::msUrl().'internalorder';
        $response = self::post($url, $req);
        return $response->json();
    }
    
    public static function newUserAlien($req)
    {
        $url = self::msUrl().'counterparty';
        $response = self::post($url, json_encode($req));
        return $response->json();
    }

    public static function getNewOrderFromGuest($user, $checkout)
    {
        $req = [
            'organization' => [
                'meta' => [
                    'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/organization/218c26ab-33fe-11ed-0a80-0285001db7b3',
                    'type' => 'organization',
                    'mediaType' => 'application/json'
                ]
            ],
            'agent' => [
                'meta' => [
                    'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/counterparty/'.$user,
                    'type' => 'counterparty',
                    'mediaType' => 'application/json'
                ]
            ],
            'store' => [
                'meta' => [
                    'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/store/218d258b-33fe-11ed-0a80-0285001db7b5',
                    'metadataHref' => 'https://api.moysklad.ru/api/remap/1.2/entity/store/metadata',
                    'type' => 'store',
                    'mediaType' => 'application/json'                    
                ]             
            ],
            'positions' => json_decode($checkout, true)['positions']
        ];
        $url = self::msUrl().'customerorder';
        $response = self::post($url, json_encode($req));
        return $response->json();
    }

    
    public static function getContrAgent($req)
    {
        $url = self::msUrl().'counterparty';
        $response = self::post($url, $req);
        return $response->json();
    }
    //https://online.moysklad.ru/app/#company/edit?id=4f7576b2-9819-11ee-0a80-157a009a00d7

    public static function getContrAgentLink($apiUrl)
    {
        $url = $apiUrl;
        $response = self::get($url);
        return $response->json()['meta']['uuidHref'];
    }

    public static function getAgreementID()
    {
        $uuid = auth()->user()->verified;
        $url = self::msUrl().'contract?filter=agent=https://api.moysklad.ru/api/remap/1.2/entity/counterparty/'.$uuid;
        $response = self::get($url);
        $item = $response->json()['rows'];
        if($item === []) {
            return null;
        }
        return $item[0]['id'];
    }


    public static function viewAllPreOrders()
    {
        $uuid = auth()->user()->verified;
        $url = self::msUrl().'internalorder?order=name,desc;created&filter=description='.$uuid;
        $response = self::get($url);
        $items = $response->json();
        $array = [];
        foreach($items['rows'] as $item) {
            $array[] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'created' => $item['created'],
                'sum' => $item['sum'],
                'vatSum' => $item['vatSum'],
                'size' => $item['positions']['meta']['size'],
                'state' => self::getInvoiceoutMetadataStates(isset($item['state']['meta']['href']) ? $item['state']['meta']['href'] : ''),
            ];
        }
        return [
            'count' => $items['meta']['size'],
            'rows' => $array
        ];
    }


    public static function createListGoods($data)
    {
        $url = self::msUrl().'product';
        $response = self::post($url, json_encode($data));
        $result = $response->json();
        if(isset($result[0]['meta']['href'])) {
            self::createListGoods($data);
        }
        return $result;
    } 


    public static function enter($data, $sum)
    {
        $url = self::msUrl().'enter';
        $result = [
            [
                'name' => 'new'.date('Ydm'),
                'moment' => date('Y-m-d H:i:s'),
                'applicable' => true,
                'sum' => $sum,
                'organization' => [
                    'meta' => [
                        'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/organization/218c26ab-33fe-11ed-0a80-0285001db7b3',
                        'metadataHref' => 'https://api.moysklad.ru/api/remap/1.2/entity/organization/metadata',
                        'type' => 'organization',
                        'mediaType' => 'application/json'                    
                    ]                    
                ],
                'store' => [
                    'meta' => [
                        'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/store/218d258b-33fe-11ed-0a80-0285001db7b5',
                        'metadataHref' => 'https://api.moysklad.ru/api/remap/1.2/entity/store/metadata',
                        'type' => 'store',
                        'mediaType' => 'application/json'                        
                    ]
                ],
                'positions' => $data,
                'overhead' => [
                    'sum' => $sum,
                    'distribution' => 'price'                   
                ]
            ]
        ];
        $response = self::post($url, json_encode($result));
        return $response->json();
    }

    public static function createContract()
    {
        $uuid = auth()->user()->verified;
        $url = self::msUrl().'contract';
        $arr = [
            [
                'ownAgent' => [
                    'meta' => [
                        'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/organization/218c26ab-33fe-11ed-0a80-0285001db7b3',
                        'metadataHref' => 'https://api.moysklad.ru/api/remap/1.2/entity/organization/metadata',
                        'type' => 'organization',
                        'mediaType' => 'application/json'                        
                    ]                   
                ],
                'agent' => [
                    'meta' => [
                        'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/counterparty/'.$uuid,
                        'metadataHref' => 'https://api.moysklad.ru/api/remap/1.2/entity/counterparty/metadata',
                        'type' => 'counterparty',
                        'mediaType' => 'application/json'
                    ]                   
                ]                
            ]
        ];
        $response = self::post($url, json_encode($arr));
        return $response->json();
    }

    
    public static function getStock($id)
    {
        $url = self::msUrl().'enter/'.$id.'?expand=positions,positions.assortment';
        $response = self::get($url);
        return $response->json();
    }


    public static function getContract()
    {
        $id = self::getAgreementID();
        $url = self::msUrl().'contract/'.$id.'?expand=agent,state,accounts,ownAgent,ownAgent.accounts,agentAccount';
        $response = self::get($url);
        if($id === null) {
            return null;
        }
        return $response->json();
    }


    public static function getContractId($id)
    {
        $url = self::msUrl().'contract/'.$id.'?expand=agent,agent.state,agent.accounts,ownAgent,ownAgent.accounts,agentAccount';
        $response = self::get($url);
        return $response->json();
    }

    
    public static function searchByProduct($type, $text)
    {
       
        $params = is_numeric($text) ? '&filter=article~'.$text : '&search='.urlencode($text);
        $url = self::msUrl().'product?expand=positions'.$params;
        $response = self::get($url);
        return $response->json(); 
        /*
        $params = is_numeric($text) ? '&filter=article~'.$text : '&search='.urlencode($text);
        // Если $excludeStock установлен в true, исключаем товары из Stock.
        if ($excludeStock) {
            $params .= '&filter=stockMode=all&quantityMode=all';
        }
        $url = self::msUrl().'product?expand=positions'.$params;
        $response = self::get($url);
        return $response->json();*/
        //$searchResults = getAllProduct::searchByProduct('type', 'text', true);
            //найти функцию в которой идёт поиск по артикулам из Stock.   
    }


    
    public static function getCountry()
    {
        $url = self::msUrl().'country?order=name';
        $response = self::get($url);
        return $response->json();
    }

    
    public static function searchAssortmentByArticle($text)
    {
        $url = self::msUrl().'assortment?expand=productFolder&limit=100&filter=quantityMode=all&filter=article~'.$text;
        $response = self::get($url);
        return $response->json();
    }


    public static function getAllContract($limit = 100)
    {
        $url = self::msUrl().'contract?expand=state,agent&limit='.$limit;
        $response = self::get($url);
        return $response->json();
    } 


    public static function searchOfResult($url)
    {
        $response = self::get($url);
        return $response->json();
    }


    public static function getOneCounterparty($id)
    {
        $url = self::msUrl().'counterparty/'.$id.'?expand=accounts';
        $response = self::get($url);
        return $response->json();
    }


    //getOrderCustomerOne
    public static function getInvoiceOne($id)
    {
        $url = self::msUrl().'invoiceout/'.$id.'?expand=state,contract,agent,positions.assortment,positions.assortment.images,customerOrder,organization,organization.accounts';
        $response = self::get($url);
        return $response->json();
    }
    

    public static function getInvoices()
    {
        $uuid = auth()->user()->verified;
        $url = self::msUrl().'invoiceout?order=created,desc;&filter=agent=https://api.moysklad.ru/api/remap/1.2/entity/counterparty/'.$uuid;
        $response = self::get($url);
        $items = $response->json();
        $array = [];
        foreach($items['rows'] as $item) {
            $array[] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'sum' => $item['sum'],
                'agent' => self::getCounterParty($item['agent']['meta']['href']),
                'state' => self::getInvoiceoutMetadataStates(isset($item['state']['meta']['href']) ? $item['state']['meta']['href'] : ''),
                'created' => $item['created'],
                'payedSum' => $item['payedSum'],
                'moment' => $item['moment'],
                'paymentPlannedMoment' => isset($item['paymentPlannedMoment']) ? $item['paymentPlannedMoment'] : 'Нет данных',
            ];
        }
        return [
            'list' => $array,
            'count' => $items['meta']['size']
        ];
    }


    public static function getAllInvoices($limit = 15, $offset = 0)
    {
        $url = self::msUrl().'invoiceout?expand=agent,state,customerOrder&order=name,desc;moment&limit='.$limit.'&offset='.$offset;
        $response = self::get($url);
        return $response->json();
    }


    public static function getReports()
    {
        $uuid = auth()->user()->verified; // customerorder
        $url = self::msUrl().'customerorder?filter=agent=https://api.moysklad.ru/api/remap/1.2/entity/counterparty/'.$uuid;
        $response = self::get($url);
        $items = $response->json();
        $array = [];
        foreach($items['rows'] as $item) {
            $array[] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'sum' => $item['sum'],
                'agent' => self::getCounterParty($item['agent']['meta']['href']),
                'state' => self::getInvoiceoutMetadataStates(isset($item['state']['meta']['href']) ? $item['state']['meta']['href'] : ''),
                'created' => $item['created'],
                'payedSum' => $item['payedSum'],
                'moment' => $item['moment'],
                'paymentPlannedMoment' => isset($item['paymentPlannedMoment']) ? $item['paymentPlannedMoment'] : 'Нет данных',
            ];
        }
        $return = [
            'list' => $array,
            'count' => $items['meta']['size']
        ];
        return $return;
    }

    public static function getAllReports()
    {
        $url = self::msUrl().'customerorder?expand=agent,state&order=name,desc;moment&limit=100';
        $response = self::get($url);
        return $response->json();
    }


    public static function getStatusTrackingType($value)
    {
        return strtr($value, 
            [
                'ELECTRONICS' => 'Фотокамеры и лампы-вспышки',
                'LP_CLOTHES'  => 'Тип маркировки "Одежда"',
                'LP_LINENS'   => 'Тип маркировки "Постельное белье"',
                'MILK'        => 'Молочная продукция',
                'NCP'         => 'Никотиносодержащая продукция',
                'NOT_TRACKED' => 'Без маркировки',
                'OTP'         => 'Альтернативная табачная продукция',
                'PERFUMERY'   => 'Духи и туалетная вода',
                'SHOES'       => 'Тип маркировки "Обувь"',
                'TIRES'       => 'Шины и покрышки',
                'TOBACCO'     => 'Тип маркировки "Табак"',
                'WATER'       => 'Упакованная вода'
            ]
        );
    }

    public static function getPaymentItemType($value)
    {
        return strtr($value, 
            [
                'GOOD' => 'Товар',
                'EXCISABLE_GOOD' => 'Подакцизный товар',
                'COMPOUND_PAYMENT_ITEM' => 'Составной предмет расчета',
                'ANOTHER_PAYMENT_ITEM' => 'Иной предмет расчета'
            ]
        );
    }


    public static function getAllProduct($limit = 10, $offset = 0)
    {
        
        $stock = 'https://api.moysklad.ru/api/remap/1.2/entity/productfolder/8854033a-48ad-11ed-0a80-0c87007f4175';
        $url = self::msUrl().'assortment?expand=images,positions,productFolder&limit='.$limit.'&offset='.$offset.'&filter=quantityMode=positiveOnly&filter=productFolder='.$stock;
        $response = self::get($url);
        return $response->json();
    }

    public static function getProductFromStock($folder, $limit = 10, $offset = 0)
    {
        $stock = 'https://api.moysklad.ru/api/remap/1.2/entity/productfolder/'.$folder;
        //$stock = 'https://api.moysklad.ru/api/remap/1.1/report/stock/bystore' .$folder;
        $url = self::msUrl().'assortment?expand=productFolder&limit='.$limit.'&offset='.$offset.
        '&filter=quantityMode=all&filter=stockMode=all;productFolder='.$stock;
        $response = self::get($url);
        return $response->json();
        //resources/views/stock.blade.php:3
    }


    public static function getAllGoods()
    {
        $url = self::msUrl().'assortment?expand=positions&limit=1000&offset=3000';
        $response = self::get($url);
        $items = $response->json();
        $array = [];
        foreach($items['rows'] as $item) {
            $array[] = [
                'link' => $item['id'], 
                'image' => '', 
                'article' => isset($item['article']) ? $item['article'] : '???',// ? $item['article'] :  
                'name' => $item['name'], 
                'description' => '', 
                'price' => $item['salePrices'][0]['value'], 
                'quantity' => $item['quantity']
            ];
        }
        return $array;
    }


    public static function getMenuCatalog()
    {
        $url = self::msUrl().'productfolder';
        $response = self::get($url);
        if(count($response->json()) === 0) {
            return $array = [
                'name' => 'Запасные части MERCEDES-BENZ',
                'href' => 'catalog/category/8854033a-48ad-11ed-0a80-0c87007f4175/10/0',
            ];
        } else {
            $array = [];
            foreach($response->json()['rows'] as $menu) {
                $array[] = [
                    'name' => $menu['name'],
                    'href' => 'catalog/category/'.$menu['id'].'/10/0',
                ];
            }
            return $array;            
        }
    }


    public static function getCategory($id)
    {
        $url = self::msUrl().'productfolder/'.$id;
        $response = self::get($url);
        return $response->json();
    }


    public static function getCompany($id)
    {
        $url = self::msUrl().'counterparty/'.$id;
        $response = self::get($url);
        return $response->json();
    }

    public static function getInvoice($id) 
    {
        $url = self::msUrl().'invoiceout/'.$id.'?expand=state';
        $response = self::get($url);
        return $response->json();
    }

    public static function getInvoiceOut($url) 
    {
        //$url = self::msUrl().'invoiceout/metadata/states/'.$id;
        $response = self::get($url);
        $items = $response->json();
        return [
            'id' => $items['id'],
            'accountId' => $items['accountId'],
            'name' => $items['name']
        ];
    }

    public static function getInvoiceoutMetadataStates($url)
    {
        if($url === '') {
            return [
                'name' => 'Нет данных',
                'color' => 7172984
            ];
        }
        $response = self::get($url);
        $items = $response->json();
        return [
            'id' => $items['id'],
            'name' => $items['name'],
            'color' => $items['color']
        ];
    }

    public static function getInvoicePositions($id) 
    {
        $url = self::msUrl().'invoiceout/'.$id.'/positions';
        $response = self::get($url);
        return $response->json();
    }

    public static function getCustomerOrderPositions($url) 
    {
        $response = self::get($url);
        $items = $response->json();
        $array = [];
        foreach($items['rows'] as $item) {
            $array[] = [
                'id' => $item['id'],
                'product' => self::getProduct($item['assortment']['meta']['href']),
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'discount' => $item['discount'],
                'vat' => $item['vat'],
            ];
        }
        return [
            'product' => $array,
            'size' => $items['meta']['size']
        ];
    }

    public static function getProductImages($url)
    {
        $response = self::get($url);
        //$item = $response->json(); // $item['rows'] ? $item['rows'][0]['miniature']['href'] : 
        $images = '/img/placeholder.png';
        return [
            'images' => $images
        ];
    }

    public static function getProductFolderID($url)
    {
        $parts = parse_url($url);
        $arr = explode('?id=', $parts["fragment"]);
        return $arr[1];
    }    

    public static function getOneProduct($id)
    {
        $url = self::msUrl().'assortment?expand=productFolder&limit=100&filter=id='.$id;
        $response = self::get($url);
        $item = $response->json()['rows']; 
        if($item === []) {
            return [
                'id' => $id,
                'name' => 'Товар не найден'
            ];
        }
        $item = $item[0];
        return [
            'id' => $item['id'],
            'updated' => $item['updated'],
            'name' => $item['name'],
            'description' => isset($item['description']) ? $item['description'] : '',
            'externalCode' => $item['externalCode'],
            'archived' => $item['archived'] === true ? 'да' : 'нет',
            'catalog' => [
                'id' => $item['productFolder']['id'],
                'name' => $item['productFolder']['name']
            ],
            
            //'vat' => $item['vat'],
            'vat' => isset($item['vat']) ? $item['vat'] : '',
             
            'minPrice' => $item['minPrice']['value'],
            'salePrices' => $item['salePrices'][0]['value'],
            'paymentItemType' => self::getPaymentItemType($item['paymentItemType']),
            'article' => $item['article'],
            'weight' => $item['weight'],
            'volume' => $item['volume'],
            'trackingType' => self::getStatusTrackingType($item['trackingType']),
            'barcodes' => isset($item['barcodes']) ? $item['barcodes'][0]['ean13'] : 'Нет данных',
            'quantity' => $item['quantity']
        ];
    } 

    public static function getProduct($url) 
    {
        $response = self::get($url);
        $item = $response->json();
        return [ 
            'article' => $item['article'],
            'name' => $item['name']
        ];
    }

    public static function getCounterParty($url)
    {
        $response = self::get($url);
        $item = $response->json();
        return [
            'name' => $item['name'],
            'type' => $item['companyType'],
            'updated' => $item['updated'],
            'created' => $item['created'],
            'address' => isset($item['legalAddress']) ? $item['legalAddress'] : 'Адрес не указан',
            'inn' => isset($item['inn']) ? $item['inn'] : '',
            'kpp' => isset($item['kpp']) ? $item['kpp'] : '',
            'ogrn' => isset($item['ogrn']) ? $item['ogrn'] : '',
            'okpo' => isset($item['okpo']) ? $item['okpo'] : '',
            'email' => isset($item['email']) ? $item['email'] : 'E-mail не указан',
            'phone' => isset($item['phone']) ? $item['phone'] : 'Телефон не указан',
            'actualAddress' => isset($item['actualAddress']) ? $item['actualAddress'] : 'Фактический адрес отсутствует'
        ];
    }

    public static function getInvoiceProduct($id)
    {
        $array = [];
        foreach(self::getInvoicePositions($id)['rows'] as $invoice) {
            $array[] = [
                'product_id' => $invoice['id'],
                'product' => self::getProduct($invoice['assortment']['meta']['href']),
                'quantity' => $invoice['quantity'],
                'price' => $invoice['price'],
                'discount' => $invoice['discount'],
                'vat' => $invoice['vat'],
            ];
        }
        $invoice = self::getInvoice($id);
        return [
            'invoice' => $array,
            'order' => $invoice,
            'company' => self::getCounterParty($invoice['agent']['meta']['href'])
        ];
    }

    public static function getCustomerOrder($url)
    {
        $response = self::get($url);
        $positions = $response->json();
        return [
            'size' => $positions['size']
        ];
    }

    public static function getPaymentReports($order)
    {
        $array = [];
        $params = '?expand=state,agent,positions,positions.assortment,positions.assortment.images,invoicesOut';
        $url = self::msUrl().'customerorder/'.$order.$params;
        $response = self::get($url);
        return $response->json();
    }

    public static function getDemand()
    {
        $uuid = auth()->user()->verified;
        $url = self::msUrl().'demand?order=name,desc;created&filter=agent=https://api.moysklad.ru/api/remap/1.2/entity/counterparty/'.$uuid;
        $response = self::get($url);
        $items = $response->json();
        $array = [];
        foreach($items['rows'] as $item) {
            $array[] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'positions' => $item['positions']['meta']['size'],
                'sum' => $item['sum'],
                'state' => self::getInvoiceoutMetadataStates(isset($item['state']['meta']['href']) ? $item['state']['meta']['href'] : ''),
                'created' => $item['created'],
                'payedSum' => $item['payedSum'],
                'moment' => $item['moment']
            ];
        }
        $return = [
            'rows' => $array,
            'count' => $items['meta']['size']
        ];
        return $return;
    }

    public static function getOneDemand($id)
    {
        $url = self::msUrl().'demand/'.$id.'?expand=state,agent,organization,organizationAccount,positions,positions.assortment,payments,invoicesOut';
        $response = self::get($url);
        return $response->json();
    }

    public static function changeStatusCustomerorder($id)#статус
    {
        $req = [
            'state' => [
                'meta' => [
                    'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/customerorder/metadata/states/dbf6a5f2-8ffc-11ed-0a80-07fe011434dd',
                    'metadataHref' => 'https://api.moysklad.ru/api/remap/1.2/entity/customerorder/metadata',
                    'type' => 'state',
                    'mediaType' => 'application/json'                    
                ],
                'id' => 'dbf6a5f2-8ffc-11ed-0a80-07fe011434dd',
                'accountId' => '213fbb41-33fe-11ed-0a80-08210000b632',
                'name' => 'Выставлен счет',
                'color' =>  10066329,
                'stateType' => 'Regular',
                'entityType' => 'customerorder'                
            ]          
        ];
        $url = self::msUrl().'customerorder/'.$id;
        $response = self::put($url, json_encode($req));
        return $response->json();
    }


    public static function createAccoutFromAgent($id, $data = [])
    {
        $req = [
            'meta' => [
                'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/counterparty/'.$id,
                'metadataHref' => 'https://api.moysklad.ru/api/remap/1.2/entity/counterparty/metadata',
                'type' => 'counterparty',
                'mediaType' => 'application/json'
            ],
            'description' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'accounts' => [
                [
                    'isDefault' => true,
                    'accountNumber' => '12512568161257981',
                    'bankName' => $data['bank'],
                    'correspondentAccount' => $data['ks'],
                    'bic' => $data['bik']
                ]
            ]            
        ];
        $url = self::msUrl().'counterparty/'.$id;
        $response = self::put($url, json_encode($req));
        return $response->json();
    }


    public static function createInvoiceout($id) // Создаёт заказ
    {
        $get = self::getPaymentReports($id);
        $items = response()->json($get);
        $array = [];
        foreach($items->original['positions']['rows'] as $item) {
            $array[] = [
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'discount' => $item['discount'],
                'vat' => $item['vat'],
                'assortment' => [
                    'meta' => [
                        'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/product/'.$item['assortment']['id'],
                        'type' => 'product',
                        'mediaType' => 'application/json'                        
                    ]
                ]
            ];
        }
        $arr = [
            'organization' => [
                'meta' => [
                    'href' => $items->original['organization']['meta']['href'],
                    'metadataHref' => $items->original['organization']['meta']['metadataHref'],
                    'type' => $items->original['organization']['meta']['type'],
                    'mediaType' => $items->original['organization']['meta']['mediaType']
                ]
            ],
            'agent' => [
                'meta' => [
                    'href' => $items->original['agent']['meta']['href'],
                    'metadataHref' => $items->original['agent']['meta']['metadataHref'],
                    'type' => $items->original['agent']['meta']['type'],
                    'mediaType' => $items->original['agent']['meta']['mediaType']  
                ]
            ],
            'state' => [
                'meta' => [
                    'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/invoiceout/metadata/states/7a7494b7-6ff6-11ed-0a80-0e4b0048295b',
                    'metadataHref' => 'https://api.moysklad.ru/api/remap/1.2/entity/invoiceout/metadata',
                    'type' => 'state',
                    'mediaType' => 'application/json'                  
                ],
                'id' => '7a7494b7-6ff6-11ed-0a80-0e4b0048295b',
                'accountId' => '213fbb41-33fe-11ed-0a80-08210000b632',
                'name' => 'Не оплачено',
                'color' => 15280409,
                'stateType' => 'Regular',
                'entityType' => 'invoiceout'    
            ],
            'customerOrder' => [
                'meta' => [
                    'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/customerorder/'.$items->original['id'],
                    'metadataHref' => 'https://api.moysklad.ru/api/remap/1.2/entity/customerorder/metadata',
                    'type' => 'customerorder',
                    'mediaType' => 'application/json'                   
                ]
            ],
            'store' => [
                'meta' => [
                    'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/store/218d258b-33fe-11ed-0a80-0285001db7b5',
                    'metadataHref' => 'https://api.moysklad.ru/api/remap/1.2/entity/store/metadata',
                    'type' => 'store',
                    'mediaType' => 'application/json'                    
                ]             
            ],
            'contract' => [
                'meta' => [
                    'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/contract/'.self::getContract()['id'],
                    'metadataHref' => 'https://api.moysklad.ru/api/remap/1.2/entity/contract/metadata',
                    'type' => 'contract',
                    'mediaType' => 'application/json'                    
                ]
            ],
            'positions' => $array,
            'paymentPlannedMoment' => date('Y-m-d H:i:s', strtotime($items->original['created'].'+3 days')) 
        ];
        self::changeStatusCustomerorder($id);
        $url = self::msUrl().'invoiceout';
        $response = self::post($url, json_encode($arr));
        return $response->json();
    }

    public static function getImage()
    {
        $url = 'https://api.moysklad.ru/api/remap/1.2/download/062010a6-a3ed-46be-bcef-fb0fa028d6b4?miniature=true';
        $response = self::get($url);
        return $response->json();
    }

    public static function getUPDfileExport($id)
    {
        $arr = [
            'template' => [
                'meta' => [
                    'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/demand/metadata/embeddedtemplate/4fdd996f-d2fd-4500-baf2-fea33b6db077',
                    'type' => 'embeddedtemplate',
                    'mediaType' => 'application/json'                   
                ]               
            ],
            'extension' => 'pdf'
        ];
        $url = self::msUrl().'demand/'.$id.'/export';
        $response = self::post($url, json_encode($arr));
        $parse = $response->transferStats->getRequest()->getUri();
        $res = [
            'scheme' => $parse->getScheme().'://',
            'host' => $parse->getHost(),
            'path' => $parse->getPath()
        ];
        return implode('', $res);
        // response()->streamDownload(function () {
        //     echo $response->transferStats->getHandlerStats()['url'];
        // }, time().'-readme.pdf');
    }

    
    public static function getStreamData()
    {
        $url = self::msUrl().'product?expand=images,positions';
        $response = self::get($url);
        return $response->json();
    }


    public static function getAllAgent()
    {
        $url = self::msUrl().'counterparty?expand=state&order=name,asc;created&limit=100';
        $response = self::get($url);
        return $response->json();
    }


    public static function deleteOrderPosition($uuid)
    {
        $req = [
            'meta' => [
                'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/customerorder/'.$uuid,
                'metadataHref' => 'https://api.moysklad.ru/api/remap/1.2/entity/customerorder/metadata',
                'type' => 'customerorder',
                'mediaType' => 'application/json'
            ]
        ];
        $url = self::msUrl().'customerorder/delete';
        $response = self::post($url, json_encode($req));
        return $response->json();
    }

    public static function deleteAgent($uuid)
    {
        $req = [
            'meta' => [
                'href' => 'https://api.moysklad.ru/api/remap/1.2/entity/counterparty/'.$uuid,
                'metadataHref' => 'https://api.moysklad.ru/api/remap/1.2/entity/counterparty/metadata',
                'type' => 'counterparty',
                'mediaType' => 'application/json'
            ]
        ];
        $url = self::msUrl().'counterparty/delete';
        $response = self::post($url, json_encode($req));
        return $response->json();
    }

    public static function getAllProductFolders()
    {
        $url = self::msUrl().'productfolder';
        $response = self::get($url);
        return $response->json();
    }

}