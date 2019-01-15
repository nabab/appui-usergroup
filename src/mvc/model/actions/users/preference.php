<?php
/**
 * @var \bbn\mvc\model $model
 * @var \bbn\user\preferences $pref
 * @var \bbn\user\permissions $perm
 * @var \bbn\user $user
 */
$pref = $model->inc->pref;
$perm = $model->inc->perm;
$user = $model->inc->user;

$r = ['success' => false];
if ( isset($model->data['url']) && ($id_option = $perm->is($model->data['url'])) ){
  $pref->set($id_option, json_decode($model->data['elements'], true), $user->get_id());
  $r['success'] = true;
}
return $r;