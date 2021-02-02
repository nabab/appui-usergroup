<?php
/*
 * Removes old sessions
 *
 **/
/** @var int $delay */
$delay = 7*3600*24;
/** @var $ctrl \bbn\Mvc\Controller */
echo (int)$ctrl->db->delete('bbn_users_sessions', [
  ['last_activity', '<', Date('Y-m-d H:i:s', Time() - $delay)]
])." Sessions rows deleted";