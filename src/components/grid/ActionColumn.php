<?php

/**
 * ActionColumn
 *
 * Custom buttons for gridview
 *
 * @author Germano Ricardi and Almir Bolduan
 *
 * @version 1.0
 *
 */

namespace almirb\yii2common\components\grid\btactioncolumn;

use yii;
use yii\helpers\Html;
use kartik\grid\ActionColumn as KartikActionColumn;

class ActionColumn extends KartikActionColumn
{
    public $headerOptions	= ['class' => 'actions-buttons text-center'];
    public $contentOptions	= ['class' => 'text-center'];
    public $width = '130px';

    public $viewButtonVisible   = true;
    public $updateButtonVisible = true;
    public $deleteButtonVisible = true;

    function init()
    {
        parent::init();
        if (!$this->template) {
            $this->template = "<span class='btn btn-group btn-group-sm'>{view} {update} {delete}</span>";
        } else {
            $this->template = "<span class='btn btn-group btn-group-sm'>" . $this->template . "</span>";
        }
        //Html::addCssStyle($this->headerOptions, "min-width:160px;");  TODO: Impedir que a ActionColumn quebre.

        $this->initDefaultButtons();
    }

    public function run()
    {
        return Html::decode($this->contentOptions);
    }

    // protected
    protected function initDefaultButtons(){

        // view
        if (($this->viewButtonVisible) && (!isset($this->buttons['view']))) {
            $this->buttons['view'] = function ($url, $model, $key) {
                $options = array_merge([
                    'title' => Yii::t('app','View'),
                    'aria-label' => Yii::t('app','View'),
                    'data-pjax' => '0',
                    'class' => 'btn btn-sm btn-default',
                ], $this->buttonOptions);
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
            };
        }

        // update
        if (($this->updateButtonVisible) && (!isset($this->buttons['update']))) {
            $this->buttons['update'] = function ($url, $model, $key) {
                $options = array_merge([
                    'title' => Yii::t('app','Edit'),
                    'aria-label' => Yii::t('app','Edit'),
                    'data-pjax' => '0',
                    'class' => 'btn btn-sm btn-primary',
                ], $this->buttonOptions);
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
            };
        }

        // delete
        if (($this->deleteButtonVisible) && (!isset($this->buttons['delete']))) {
            $this->buttons['delete'] = function ($url, $model, $key) {

                $options = array_merge([
                    'title' => Yii::t('app','Delete'),
                    'aria-label' => Yii::t('app','Delete'),
                    'data-confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'data-method' => 'post',
                    'data-pjax' => '0',
                    'class' => 'btn btn-sm btn-danger',
                ], $this->buttonOptions);
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, $options);
            };
        }
    }
}
