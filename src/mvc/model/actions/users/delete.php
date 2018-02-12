<?php
/** @var \bbn\mvc\model $model */
/** @var \bbn\user\manager $mgr */
$r = ['success' => false];
$cfg = $model->inc->user->get_class_cfg();
$id_field = $cfg['arch']['users']['id'];
if ( !empty($model->data[$id_field]) &&
  ($mgr = $model->inc->user->get_manager()) &&
  ($user = $mgr->get_user($model->data[$id_field])) &&
  empty($user['admin'])
){
  $r['success'] = $mgr->deactivate($model->data[$id_field]);
  $r['data'][$id_field] = $model->data[$id_field];
}
return $r;