<?php

namespace frontend\components\CarouselWidget;

use yii\base\Widget;

class CarouselWidget extends Widget
{
    public $carouselId = 'carouselWidget_0';
    public $models = [];
    public $options = [];

    private $carouselItemsContent;

    public function init(){
        $this->carouselItemsContent = [];
        foreach($this->models as $model){
            $caption = sprintf('<h1>Room #%d</h1>',$model->id);
            $content = sprintf('This is room #%d at floor %d with %0.2fEUR price per day',$model->id,$model->floor,$model->price_per_day);
            $itemContent = ['content' => $content, 'caption' => $caption];
            $this->carouselItemsContent[] = $itemContent;
        }
    }

    public function run(){
        return $this->render('carousel',['carouselItemsContent' => $this->carouselItemsContent]);
    }
}