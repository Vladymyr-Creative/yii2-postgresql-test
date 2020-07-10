<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Command;
use yii\db\Exception;
use \yii\db\Query;

class Page extends ActiveRecord
{
    const API_URL = "https://www.foetex.dk/dsgsearchservice/rest/apps/foetexdk/searchers/products";
    const PRODUCT_TABLE = 'product';
    const PAGE_TABLE = 'page';
    const INSERT_TEMPLATES = [
        self::PAGE_TABLE => ['link'],
        self::PRODUCT_TABLE => ['link', 'title', 'gtin', 'sku', 'price'],
    ];
    const Map = [
        self::PRODUCT_TABLE => [
            'path' => ['documents', 'documents'],
            'map' => [
                'link' => 'url_da_string',
                'title' => 'name_text_da',
                'gtin' => 'code_string',
                'sku' => 'code_string',
                'price' => 'currentPrice',
            ]
        ],
        self::PAGE_TABLE => [
            'path' => ['documents', 'pagination', 'pages'],
            'map' => [
                'link' => 'query'
            ],
        ]
    ];

    public static function handleData($data)
    {
        if (empty($data)) {
            return false;
        }

        self::saveData(self::getDataFor($data, self::PRODUCT_TABLE), ['key' => 'gtin', 'table' => self::PRODUCT_TABLE]);
        self::saveData(self::getDataFor($data, self::PAGE_TABLE), ['key' => 'link', 'table' => self::PAGE_TABLE]);
    }

    public static function getDataFor($data, $table)
    {
        $elements = self::getElemByPath($data, $table);
        $resultData = [];
        foreach ($elements as $element) {
            $itemData = [];
            foreach (self::INSERT_TEMPLATES[$table] as $item) {
                switch ($table) {
                    case self::PRODUCT_TABLE:
                        $itemData[$item] = isset($element[self::Map[$table]['map'][$item]]) ? $element[self::Map[$table]['map'][$item]] : null;
                        break;
                    case self::PAGE_TABLE:
                        $itemData[$item] = isset($element[self::Map[$table]['map'][$item]]) ? self::API_URL . '?' . $element[self::Map[$table]['map'][$item]] : null;
                        break;
                }
            }
            $resultData[] = $itemData;
        }

        return $resultData;
    }

    private static function saveData(array $productsData, $params)
    {
        $table = $params['table'];
        $productsData = self::filterExistingData($productsData, $params);
        $productsData = self::prepareDataFor($productsData, $table);

        try {
            Yii::$app->db->createCommand()->batchInsert($table, self::INSERT_TEMPLATES[$table], $productsData)->execute();
        } catch (Exception $e) {
            exit($e);
        }
    }

    private static function filterExistingData(array $data, $params)
    {
        $key = $params['key'];
        $table = $params['table'];
        $variants = self::getFilterVariants($data, $params);

        $existingData = (new Query())
            ->select([$key])
            ->from($table)
            ->where(['in', $key, $variants])
            ->all();

        foreach ($data as $index => $product) {
            foreach ($existingData as $item) {
                if ($product[$key] == $item[$key]) {
                    unset($data[$index]);
                }
            }
        }

        return $data;
    }

    private static function prepareDataFor(array $productsData, $table)
    {
        $result = [];

        foreach ($productsData as $product) {
            $preparedProduct = [];
            foreach (self::INSERT_TEMPLATES[$table] as $item) {
                $preparedProduct[$item] = isset($product[$item]) ? $product[$item] : null;
            }
            $result[] = $preparedProduct;
        }
        return $result;
    }

    private static function getElemByPath($data, $table)
    {
        $path = self::Map[$table]['path'];
        $destination = $data;

        try {
            foreach ($path as $item) {
                if (!isset($destination[$item])) {
                    return [];
                }
                $destination = $destination[$item];
            }
            return $destination;
        } catch (Exception $e) {
            exit($e);
        }
    }

    private static function getFilterVariants($data, $params)
    {
        $key = $params['key'];
        $variants = [];
        foreach ($data as $product) {
            $variants[] = empty($product[$key]) ? "" : $product[$key];
        }
        return $variants;
    }
}