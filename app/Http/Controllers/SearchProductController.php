<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SearchProductController extends Controller
{
    public static function searchByArticle(Request $request)
    {
        {
            $request->validate(
            [
                'article' => 'required|min:3',
            ],
            [
                'article.required' => 'Пожалуйста, введите артикул',
                'article.min' => 'Минимальная длина артикула 3 символа',
            ]);

            // Первичный поиск по полному артикулу
            $stockItem = Stock::getByArticle($article, 1);
            
            if (!$stockItem) {
                // Если товар не найден, удаляем буквенный префикс и выполняем повторный поиск
                $numericArticle = preg_replace('/^\D+/', '', $article);
                if ($numericArticle !== $article) {
                    $stockItem = Stock::getByArticle($numericArticle, 1);
                }
            }
            
            if ($stockItem) {
                // Найден товар в запасах, выполните необходимые действия
                return Redirect::route('product.show', array('product' => $stockItem));
            }
            
            return redirect()
                ->back()
                ->withErrors(['search' => 'Товар с данным ариткулом не был найден'])
                ->withInput();

            //file_put_contents('/var/www/prospekt-parts.com/public_html/logger.txt', var_export($search, true));

        }
    }
}

/*class SearchProductController extends Controller
{
    public static function searchByArticle(Request $request)
    {
        $request->validate(
        [
            'article' => 'required|min:3',
        ],
        [
            'article.required' => 'Пожалуйста, введите артикул',
            'article.min' => 'Минимальная длина артикула 3 символа',
        ]);

        // Получаем и нормализуем артикул
        $article = trim($request->input('article'));
        $normalizedArticle = strtoupper(preg_replace('/\s+/', '', $article));

        // Первичный поиск по полному артикулу
        $stockItems = Stock::getManyByArticle($normalizedArticle, 1);

        // Если товар не найден, удаляем буквенный префикс и выполняем повторный поиск
        if (!$stockItems || count($stockItems) === 0) {
            $numericArticle = preg_replace('/^\D+/', '', $normalizedArticle);
            if ($numericArticle !== $normalizedArticle) {
                $stockItems = Stock::getManyByArticle($numericArticle, 1);
            }
        }

        // Выполнить более широкий поиск, чтобы захватить похожие артикулы
        if ($stockItems && count($stockItems) > 0) {
            $partialMatchItems = Stock::getManyByPartialArticle($normalizedArticle, 1);
            $stockItems = array_merge($stockItems, $partialMatchItems);
        } else {
            $stockItems = Stock::getManyByPartialArticle($normalizedArticle, 1);
        }

        // Удаляем дубликаты, оставляя уникальные записи
        $stockItems = array_unique($stockItems, SORT_REGULAR);

        file_put_contents('/var/www/prospekt-parts.com/public_html/logger.txt', "[searchProductController] " . $v);

        if ($stockItems && count($stockItems) > 0) {
            // Найдены товары в запасах, выполните необходимые действия
            return view('product.search_results', ['stockItems' => $stockItems]);
        }

        return redirect()
            ->back()
            ->withErrors(['search' => 'Товар с данным артикулом не был найден'])
            ->withInput();
    }
} */
