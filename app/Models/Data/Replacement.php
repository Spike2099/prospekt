<?php
namespace App\Models\Data;

use App\Models\Colyman;
use App\Models\MoySklad;
use App\Models\Replacement as Parts;
use App\Models\Stock;


class Replacement
{

    public static function findAnalogs($text)
    {
        $result = Parts::where('article', $text)->get()->toArray();
        $analogs = Parts::where('analog', $text)->get()->toArray();
        foreach ($analogs as $item)
            $result[] = [
                'article' => $item['analog'],
                'analog' => $item['article']
            ];
        return $result;
    }

    public static function getResultReplacement(string $text) : array
    {
        $analog = [];

        $checkAnalog = self::findAnalogs($text);

        if (count($checkAnalog) > 0) {
            foreach ($checkAnalog as $item) {

                $analogMore = MoySklad::searchAssortmentByArticle($item['analog']);

                if (!empty($analogMore['rows'])) {
                    foreach ($analogMore['rows'] as $row) {
                        $code = $row['article'];
                        // Если в аналогах нет самого артикула запроса (такое оказывается бывает)

                        if ($code !== $text) {
                            $analog['rows'][] = $row;
                        }
                    }
                }

                $dbAnalogs = array_merge(
                    Stock::getManyByArticle($item['analog'],1),
                    Stock::getManyByArticle($item['analog'],2),
                    Colyman::getManyByArticleColyman($item['analog']),
                    Stock::getManyByArticle($item['analog'],3)
                );

                if (!empty($dbAnalogs)) {
                    foreach ($dbAnalogs as $row) {
                        $analog['db'][] = $row;
                    }
                } else {
                    $analog['notFound'][] = $item['analog'];
                }
            }
        }
        return $analog;
    }
}