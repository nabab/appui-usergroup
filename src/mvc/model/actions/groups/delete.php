<?php
/** @var \bbn\mvc\model $model */
/** @var \bbn\user\manager $mgr */
$r = ['success' => false];
$cfg = $model->inc->user->get_class_cfg();
$id_field = $cfg['arch']['groups']['id'];
if ( isset($model->data[$id_field]) ){
  $mgr = $model->inc->user->get_manager();
  if ( $r['success'] = $mgr->group_delete($model->data[$id_field]) ){
    $r[$id_field] = $model->data[$id_field];
  }
}
return $r;