<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Command;
use yii\db\Exception;

class Page extends ActiveRecord
{
    const API_URL = "https://www.foetex.dk/dsgsearchservice/rest/apps/foetexdk/searchers/products";

    public static function handleData($data)
    {
        if (empty($data)) {
            return false;
        }

        self::saveProductsData(self::getProductsData($data));
        self::savePageLinks(self::getPagesLinks($data));
    }

    public static function getProductsData($data)
    {
        $path = "documents";
        $products = $data->$path->$path;
        $productsData = [];
        foreach ($products as $product) {
            $itemData = [];
            $itemData[] = $product->url_da_string;
            $itemData[] = $product->name_text_da;
            $itemData[] = $product->code_string;
            $itemData[] = $product->code_string;
            $itemData[] = $product->currentPrice;
            $productsData[] = $itemData;
        }
        return $productsData;
    }

    public static function getPagesLinks($data)
    {
        $pages = $data->pagination->pages;
        $pageLinks = [];
        foreach ($pages as $page) {
            $pageLinks[] = self::API_URL . "?" . $page->query;
        }
        return $pageLinks;
    }

    private static function saveProductsData(array $productsData)
    {
        $productsData = self::filterExistingProducts($productsData);
        try {
            Yii::$app->db->createCommand()->batchInsert('product', ['link', 'title', 'gtin', 'sku', 'price'], $productsData)->execute();
        } catch (Exception $e) {
            die($e);
        }
    }

    private static function savePageLinks(array $pageLinks)
    {
        $pageLinks = self::filterExistingPages($pageLinks);
        try {
            Yii::$app->db->createCommand()->batchInsert('page', ['link'], $pageLinks)->execute();
        } catch (Exception $e) {
            die($e);
        }
    }

    private static function filterExistingProducts(array $productsData)
    {
        $gtins = [];
        foreach ($productsData as $product) {
            $gtins[] = $product->gtin;
        }
        $existingGtins = Yii::$app->db->createCommand('SELECT gtin FROM product')->where(['gtin' => $gtins])->all();
        foreach ($productsData as $product) {
            if (in_array($product->gtin, $existingGtins)){
                unset($product);
            }
        }
        return $productsData;
    }

    private static function filterExistingPages(array $pageLinks)
    {
    }
}