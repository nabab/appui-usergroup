<?php
/** @var \bbn\mvc\model $model */
/** @var \bbn\user\manager $mgr */
$r = ['success' => false];
$cfg = $model->inc->user->get_class_cfg();
$id_field = $cfg['arch']['groups']['id'];
if ( !empty($model->data[$id_field]) &&
  (!$model->inc->user->is_dev() || $model->inc->user->is_admin())
){
  $mgr = $model->inc->user->get_manager();
  if ( $r['success'] = $mgr->group_delete($model->data[$id_field]) ){
    $r['data'][$id_field] = $model->data[$id_field];
  }
}
return $r;