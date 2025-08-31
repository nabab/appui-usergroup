<?php
/**
 * @var bbn\Mvc\Model $model
 * @var \bbn\User\Preferences $pref
 * @var \bbn\User\Permissions $perm
 * @var \bbn\User $user
 */
$pref = $model->inc->pref;
$perm = $model->inc->perm;
$user = $model->inc->user;

$r = ['success' => false];
if ( isset($model->data['url']) && ($id_option = $perm->is($model->data['url'])) ){
  $pref->set($id_option, Json_decode($model->data['elements'], true), $user->getId());
  $r['success'] = true;
}
return $r;