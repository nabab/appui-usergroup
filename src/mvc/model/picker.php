<?php
/*
 * Describe what it does or you're a pussy
 *
 **/

/** @var $this \bbn\mvc\model*/
$manager = new \apst\manager($this->inc->user);
$groups = $manager->groups();
$res = [];
$i = 0;
foreach ( $groups as $g ){
  if ( $g['num'] ){
    array_push($res, [
      'id' => $g['id'],
      'text' => $g['group'],
      'is_parent' => true,
      'expanded' => true,
      'items' => []
    ]);
    $users = $manager->get_list($g['id']);
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