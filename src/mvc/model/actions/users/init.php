<?php
/** @var bbn\Mvc\Model $model */
/** @var \bbn\User\Manager $mgr */
$r = [
  'success' => false
];
/** @var array $cfg */
$cfg = $model->inc->user->getClassCfg();
/** @var string $id_group */
$id_field = $cfg['arch']['users']['id'];
if ( !empty($model->data[$id_field]) ){
  $mgr = $model->inc->user->getManager();
  $r['success'] = $mgr->makeHotlink($model->data[$id_field], 'password');
  $r[$id_field] = $model->data[$id_field];
}
return $r;