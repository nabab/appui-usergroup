<?php
/** @var \bbn\mvc\model $model */
/** @var array $d Reference to the model's data */
$d =& $model->data;
/** @var array $r The result*/
$r = [
  'success' => false
];

if ( isset($d['id_option']) ){

  /** @var bbn\user\manager $mgr */
  $mgr = $model->inc->user->get_manager();

  if ( !empty($d['id_user']) ){
    $r['success'] = $mgr->user_insert_option($d['id_user'], $d['id_option']);
  }

  else if ( !empty($d['id_group']) ){
    $r['success'] = $mgr->group_insert_option($d['id_group'], $d['id_option']);
  }
}

return $r;