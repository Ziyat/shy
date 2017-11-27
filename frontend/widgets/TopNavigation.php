<?php

namespace frontend\widgets;

use backend\models\Pages;
use common\models\Lang;
use Yii;
use yii\bootstrap\Widget;

class TopNavigation extends Widget
{

    public function init()
    {
        
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        $menu = $this->get_menu_array();
        $menu_tree = $this->map_tree($menu);
        return $this->render('top-navigation', [
                    'menu' => $menu_tree,
        ]);
    }

    /**
     * Получение массива для создания дерева для меню
     * */
    private function get_menu_array()
    {
        $lang_id = Lang::getLangIdByUrl(Yii::$app->language);
        $res = Yii::$app->db->createCommand('SELECT id, parent_id, show_on_menu, alias, type, action, link, title FROM pages WHERE `lang_id` = \'' . $lang_id . '\' ORDER BY position')->queryAll();
        $arr = [];
        foreach ($res as $r) {
            $arr[$r['id']] = $r;
        }
        return $arr;
    }

    /**
     * Построение дерева
     * */
    private function map_tree($dataset)
    {

        $tree = array();

        foreach ($dataset as $id => &$node) {
//            $breadcrumbs = "";
//            $breadcrumbs_array = $this->breadcrumbs($dataset, $id);
//            foreach ($breadcrumbs_array as $alias) {
//                $breadcrumbs .= "/" . $alias;
//            }
// $node['link'] = trim($breadcrumbs, '/');
            if ($node['type'] == Pages::TYPE_ACTION) {
                $node['link'] = '/' . Yii::$app->language . '/' . ($node['action'] == '/' ? '' : $node['action']);
            } elseif ($node['type'] == Pages::TYPE_CROSSING) {
                $node['link'] = '/' . Yii::$app->language . '/' . mb_strtolower($node['alias']); ####NOT READY
            } elseif ($node['type'] == Pages::TYPE_LINK) {
                $node['link'] = mb_strtolower($node['link']);
            } elseif (in_Array($node['type'], [2, 5, 6, 7, 8, 9])) {
                $node['link'] = '/' . Yii::$app->language . '/' . mb_strtolower($node['alias']) . ($node['type'] == 8 ? '/gallery' : ($node['type'] == 7 ? '/article' : ''));
            } else {
                $node['link'] = '/' . Yii::$app->language . '/#'; //throw new HttpException('Internal error occured.');
            }

            if ($node['is_in_top_menu'] == 1) {
                if (!$node['parent'] or ( /* $node['top'] and */!$dataset[$node['parent']]['show_on_menu'])) {
                    $tree[$id] = &$node;
                } else {
                    $dataset[$node['parent']]['childs'][$id] = &$node;
                }
            }
        }
//        echo '<pre>'.print_r($tree,true);exit;
        return $tree;
    }


    /**
     * Хлебные крошки
     * */
//    private function breadcrumbs($array, $id = 1) {
//        if (!$id) {
//            return false;
//        }
//
//        $count = count($array);
//        $breadcrumbs_array = array();
//        for ($i = 0; $i < $count; $i++) {
//            if (isset($array[$id])) {
//                $breadcrumbs_array[$array[$id]['alias']] = $array[$id]['title'];
//                $id = $array[$id]['parent'];
//            } else {
//                break;
//            }
//        }
//        return array_reverse($breadcrumbs_array, true);
//    }
}
