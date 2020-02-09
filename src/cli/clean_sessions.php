<?php
/*
 * Removes old sessions
 *
 **/
/** @var int $delay */
$delay = 7*3600*24;
/** @var $ctrl \bbn\mvc\controller */
echo (int)$ctrl->db->delete('bbn_users_sessions', [
  ['last_activity', '<', date('Y-m-d H:i:s', time() - $delay)]
])." Sessions rows deleted";