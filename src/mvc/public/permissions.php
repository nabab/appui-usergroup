<?php
$dbc = new \bbn\Appui\Database($ctrl->db);
\bbn\Appui\History::disable();
$vals = $ctrl->db->selectAllByKeys('bbn_emailings', ['id', 'id_note']);
//var_dump($dbc->tableId('bbn_emails'), $vals);
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
\bbn\X::hdump(
  APST_FTP,
  $all,
  ($files = \bbn\File\Dir::getDirs($dir)),
  \bbn\File\Dir::getFiles($dir),
  is_dir($dir),
  $dir,
  $sftp
);
var_dump($dir, is_dir($dir), );
*/
/*
$ftp = new \bbn\File\Ftp([
  'host' => APST_FTP_HOST,
  'login' => APST_FTP_USER,
  'pass' => APST_FTP_PASS,
  'timeout' => 10
]);

\bbn\X::hdump($ftp->listFiles('_appui'), $ftp->error);
//$ctrl->combo('$title', true);
*/