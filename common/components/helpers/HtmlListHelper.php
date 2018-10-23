<?php

namespace common\components\helpers;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class HtmlListHelper
{
    // Based on this
    // 'content' => function ($model, $key, $index, $column) {
    //     $result = '';
    //     $result .= '<ul>';
    //     $links = '';
    //     foreach ($model->tasks as $task) {
    //         $title = $task->title;
    //         $title = \explode(' ', $title)[0] . '...';
    //         $links .='<li>';
    //         $links .= '<a href="/admin/tasks/view?id=' . $task->id . '">';
    //         $links .= $title;
    //         $links .= '</a>';
    //         $links .= '</li>';
    //     }
    //     $result .= $links;
    //     $result .= '</ul>';
    //     return $result;
    // }
    public static function list($model, $field = '', $attribute = '', $key = null, $index = null, $column = null)
    {
        $fieldsObjectsArray = ArrayHelper::getValue($model, $field);
        $itemsArray = [];

        foreach ($fieldsObjectsArray as $object) {
            $itemsArray[] = ArrayHelper::toArray(
                $object,
                [
                   get_class($object) => [
                    'id',
                    $attribute
                   ]
                ]
            );
        }

        if ($itemsArray) {
            $idAttributeArray = ArrayHelper::map($itemsArray, 'id', $attribute);
            $result = '';
            $result .= '<ul>';
            $links = '';

            foreach ($idAttributeArray as $id => $item) {
                $item = \explode(' ', $item)[0] . '...';
                $links .='<li>';
                $links .= Html::a($item, [$field . '/view', 'id' => $id]);
                $links .= '</li>';
            }

            $result .= $links;
            $result .= '</ul>';

            return $result;
        }
        return null;
    }
}
