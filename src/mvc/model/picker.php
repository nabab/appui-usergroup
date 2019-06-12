<?php
/*
 * Describe what it does or you're a pussy
 *
 **/

/** @var \bbn\mvc\model $model */
/** @var bbn\user\manager $manager */
$manager = $model->inc->user->get_manager();
$groups = $manager->groups();
$cfg = $model->inc->user->get_class_cfg()['arch']['groups'];
$res = [];
$i = 0;
foreach ( $groups as $g ){
  if ( $g['num'] ){
    array_push($res, [
      'id' => $g[$cfg['id']],
      'text' => $g[$cfg['group']],
      'is_parent' => true,
      'expanded' => true,
      'items' => []
    ]);
    $users = $manager->get_list($g[$cfg['id']]);
    foreach ( $users as $u ){
      array_push($res[$i]['items'], [
        'id' => $u['id'],
        'text' => $manager->get_name($u)
      ]);
    }
    $i++;
  }
}
return $res;