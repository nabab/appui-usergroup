<?php
/**
 * What is my purpose?
 *
 **/

use bbn\X;
use bbn\Str;
use bbn\Appui\Grid;
/** @var $model \bbn\Mvc\Model*/
if ($model->hasData('limit')) {
  $grid = new grid($model->db, $model->data, [
    'table' => 'bbn_mvc_logs',
    'fields' => [],
    'order' => [['field' => 'time', 'dir' => 'DESC']]
  ]);
  return $grid->getDatatable();
}
