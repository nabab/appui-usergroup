<?php
/** @var \bbn\mvc\model $model */
/** @var \bbn\user\manager $mgr */
$r = ['success' => false];
$cfg = $model->inc->user->get_class_cfg();
$fid = $cfg['arch']['groups']['id'];
$fgroup = $cfg['arch']['groups']['group'];
$fcfg = $cfg['arch']['groups']['cfg'];
if ( !empty($model->data[$fgroup]) ){
  $mgr = $model->inc->user->get_manager();
  if ( $id = $mgr->group_insert([$fgroup => $model->data[$fgroup]]) ){
    $r['success'] = 1;
    $r['data'] = [
      $fid => $id,
      $fgroup => $model->data[$fgroup],
      $fcfg => '{}',
      'num' => 0
    ];
    $src = $model->data['source_id'] ?: false;
    if ( $src ){
      $options = $model->db->rselect_all('bbn_users_options', [], ['id_group' => $src]);
      foreach ( $options as $o ){
        $model->inc->pref->set(
          $o['id_option'],
          $o['cfg'] ? json_decode($o['cfg'], 1) : [],
          null,
          $id);
      }
    }
  }
}
return $r;