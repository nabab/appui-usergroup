<?php
/*
 * Removes old sessions
 *
 **/
use bbn\X;
 /** @var int $delay */
$delay = 12*3600*24;

/** @var $ctrl \bbn\Mvc\Controller */
echo (int)$ctrl->db->delete('bbn_users_sessions', [
  'id_user' => null,
  [['last_activity', '<', date('Y-m-d H:i:s', time() - $delay)]]
])." anonymous sessions rows deleted.".PHP_EOL;

$users = $ctrl->db->rselectAll([
  'tables' => ['bbn_users_sessions'],
  'fields' => ['id_user', 'num' => 'COUNT(id)', 'max' => 'MAX(last_activity)'],
  'where' => [['last_activity', '<', date('Y-m-d H:i:s', time() - $delay)]],
  'having' => [['num', '>', 1]],
  'group_by' => ['id_user']
]);

foreach ($users as $u) {
  echo (int)$ctrl->db->delete('bbn_users_sessions', [
    'id_user' => $u['id_user'],
    ['last_activity', '<', $u['max']]
  ])._("Sessions rows deleted for user").' '.$u['id_user'].PHP_EOL;
}
