<?php
/*
 * Describe what it does!
 *
 **/

/** @var $this \bbn\Mvc\Model*/
$res = ['success' => false];
if ( isset($model->data['id']) ){
  $res['success'] = $model->inc->pref->delete($model->data['id']);
}
return $res;