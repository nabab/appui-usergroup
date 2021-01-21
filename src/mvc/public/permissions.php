<?php
$dbc = new \bbn\appui\database($ctrl->db);
\bbn\appui\history::disable();
$vals = $ctrl->db->select_all_by_keys('bbn_emailings', ['id', 'id_note']);
//var_dump($dbc->table_id('bbn_emails'), $vals);
$num = 0;
foreach ( $vals as $id => $id_note ){
  $num += (int)$ctrl->db->update('bbn_history_uids', ['bbn_uid' => $id], ['bbn_uid' => $id_note]);
  $num += (int)$ctrl->db->update('bbn_emails', ['id_mailing' => $id], ['id_mailing' => $id_note]);
}
var_dump($num);

/*
$adh = new \apst\adherent($ctrl->db, 60562);
$all = [];
$dir = $adh->get_common_path();
$handle = opendir($dir);
while ( false !== ($file = readdir($handle)) ){
  $all[] = $file;
}
closedir($handle);
\bbn\x::hdump(
  APST_FTP,
  $all,
  ($files = \bbn\file\dir::get_dirs($dir)),
  \bbn\file\dir::get_files($dir),
  is_dir($dir),
  $dir,
  $sftp
);
var_dump($dir, is_dir($dir), );
*/
/*
$ftp = new \bbn\file\ftp([
  'host' => APST_FTP_HOST,
  'login' => APST_FTP_USER,
  'pass' => APST_FTP_PASS,
  'timeout' => 10
]);

\bbn\x::hdump($ftp->listFiles('_appui'), $ftp->error);
//$ctrl->combo('$title', true);
*/