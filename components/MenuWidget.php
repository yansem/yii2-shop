<?php

namespace app\components;

use app\models\Category;
use yii\base\Widget;

class MenuWidget extends Widget
{
    public $tpl;
    public $ul_class;
    public $data;
    public $tree;
    public $menuHtml;

    public function init()
    {
        parent::init();
        if($this->ul_class === null){
            $this->ul_class = 'menu';
        }
        if($this->tpl === null){
            $this->tpl = 'menu';
        }
        $this->tpl .= '.php';
    }

    public function run()
    {
        $this->data = Category::find()->indexBy('id')->select('id, parent_id, title')->asArray()->all();
        $this->tree = $this->getTree();
        debug($this->tree, 1);
        return $this->tpl;
    }

    protected function getTree()
    {
        $tree= [];
        $data = $this->data;
        foreach ($data as $id=>&$node){
            if(!$node['parent_id']){
                $tree[$id] = &$node;
            }else{
                $data[$node['parent_id']]['childs'][$id] = &$node;
            }
        }
        return $tree;
    }
}