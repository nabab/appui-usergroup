<?php
/*
 * Removes old sessions
 *
 **/
/** @var $ctrl \bbn\mvc\controller */

$num = 0;
if ($sessions = $ctrl->db->select_all_by_keys('bbn_users_sessions', ['id', 'sess_id'], ['opened' => 1])) {
  $dir = session_save_path().'/';
  foreach ($sessions as $id => $sess_id) {
    if (!is_file($dir.'sess_'.$sess_id)) {
      $num += (int)$ctrl->db->update('bbn_users_sessions', ['opened' => 0], ['id' => $id]);
    }
  }
}
echo $num.' '._('session(s) closed').PHP_EOL;
