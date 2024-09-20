<?php

namespace App\Http\Controllers;

use App\Mail\DealerApplicationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DealerApplicationController extends Controller
{
    public function submit(Request $request)
    {
        // Получение данных из запроса
        $email = $request->input('email');
        // Отправка письма
        Mail::to('info@prospekt-parts.com')->send(new DealerApplicationMail($email));
        return response()->json(['message' => 'Заявка успешно отправлена!'] , 200);
    }
    
    public function getContent(Request $request)
            {
                $language = $request->input('language', 'ru');
            
                switch ($language) {
                    case 'en':
                        $content = $this->getEnglishContent();
                        break;
                    case 'zh':
                        $content = $this->getChineseContent();
                        break;
                    case 'tr':
                        $content = $this->getTurkishContent();
                        break;
                    default:
                        $content = $this->getRussianContent();
                }
                    return response()->json($content);
            }


            private function getEnglishContent()
            {
                return [
                    'header' => 'Hello, world!',
                    'body' => 'This text is in English.',
                ];
            }
            
            private function getChineseContent()
            {
                return [
                    'header' => '你好，世界！',
                    'body' => '这段文字是用中文写的。',
                ];
            }
            
            private function getTurkishContent()
            {
                return [
                    'header' => 'Merhaba, dünya!',
                    'body' => 'Bu metin Türkçe olarak yazılmıştır.',
                ];
            }
    
    
    
}
