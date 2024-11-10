<?php
/*
 * Removes old sessions
 *
 **/
/** @var bbn\Mvc\Controller $ctrl */

$cfg = $ctrl->inc->user->getClassCfg();
$t   = &$cfg['tables']['sessions'];
$c   = &$cfg['arch']['sessions'];
$num = $ctrl->db->update(
  $t,
  [$c['opened'] => 0],
  [
    $c['opened'] => 1,
    [$c['last_activity'], '<', date('Y-m-d H:i:s', time() - (defined('BBN_SESS_LIFETIME') ? constant('BBN_SESS_LIFETIME') : 7200))]
  ]
);
echo $ctrl->db->last();
if ($num) {
  echo $num.' '._('session(s) closed').PHP_EOL;
}
