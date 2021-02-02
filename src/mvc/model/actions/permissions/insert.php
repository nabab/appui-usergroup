<?php
/** @var \bbn\Mvc\Model $model */
/** @var array $d Reference to the model's data */
$d =& $model->data;
/** @var array $r The result*/
$r = [
  'success' => false
];

if ( isset($d['id_option']) ){

  /** @var bbn\User\Manager $mgr */
  $mgr = $model->inc->user->getManager();

  if ( !empty($d['id_user']) ){
    $r['success'] = $mgr->userInsertOption($d['id_user'], $d['id_option']);
  }

  else if ( !empty($d['id_group']) ){
    $r['success'] = $mgr->groupInsertOption($d['id_group'], $d['id_option']);
  }
}

return $r;