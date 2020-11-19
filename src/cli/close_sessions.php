<?php
/*
 * Removes old sessions
 *
 **/
/** @var $ctrl \bbn\mvc\controller */

$cfg = $ctrl->inc->user->get_class_cfg();
$t   = &$cfg['tables']['sessions'];
$c   = &$cfg['arch']['sessions'];
$num = $ctrl->db->update(
  $t,
  [$c['opened'] => 0],
  [
    $c['opened'] => 1,
    [$c['last_activity'], '<', null, 'NOW() - INTERVAL 60 MINUTE']
  ]
);
if ($num) {
  echo $num.' '._('session(s) closed').PHP_EOL;
}
