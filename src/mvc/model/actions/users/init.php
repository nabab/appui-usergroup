<?php
/** @var \bbn\mvc\model $model */
/** @var \bbn\user\manager $mgr */
$r = [
  'success' => false
];
/** @var array $cfg */
$cfg = $model->inc->user->get_class_cfg();
/** @var string $id_group */
$id_field = $cfg['arch']['users']['id'];
if ( isset($model->data[$id_field]) ){
  $mgr = $model->inc->user->get_manager();
  $r['success'] = $mgr->make_hotlink($model->data[$id_field], 'password');
  $r[$id_field] = $model->data[$id_field];
}
return $r;