<?php
/** @var \bbn\mvc\model $model */
/** @var \bbn\user\manager $mgr */
$r = ['success' => false];
$cfg = $model->inc->user->get_class_cfg();
$id = $cfg['arch']['groups']['id'];
$group = $cfg['arch']['groups']['group'];
if ( isset($model->data[$id]) && !empty($model->data[$group]) ){
  $mgr = $model->inc->user->get_manager();
  $r['success'] = $mgr->group_rename($model->data[$id], $model->data[$group]);
  $r[$id] = $model->data[$id];
}
return $r;