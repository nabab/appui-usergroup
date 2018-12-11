<?php
$r = ['success' => false];
if ( 
  !empty($model->data['action']) &&
  ($cfg = $model->inc->user->get_class_cfg())
){
  $fid = $cfg['arch']['groups']['id'];
  $fgroup = $cfg['arch']['groups']['group'];
  $fcfg = $cfg['arch']['groups']['cfg'];
  $mgr = $model->inc->user->get_manager();
  
  switch ( $model->data['action'] ){
    case 'insert':
      if ( 
        !empty($model->data[$fgroup]) && 
        (!$model->inc->user->is_dev() || $model->inc->user->is_admin()) &&
        ($id = $mgr->group_insert([$fgroup => $model->data[$fgroup]]))
      ){
        $r['success'] = true;
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
              $id
            );
          }
        }
      }
      break;
    
    case 'update':
      if ( 
        !empty($model->data[$fid]) &&
        !empty($model->data[$fgroup]) &&
        (!$model->inc->user->is_dev() || $model->inc->user->is_admin())
      ){
        $r['success'] = $mgr->group_rename($model->data[$fid], $model->data[$fgroup]);
        $r['data'][$fid] = $model->data[$fid];
      }
      break;
    
    case 'delete':
      if ( 
        !empty($model->data[$fid]) &&
        (!$model->inc->user->is_dev() || $model->inc->user->is_admin())
      ){
        if ( $r['success'] = $mgr->group_delete($model->data[$fid]) ){
          $r['data'][$fid] = $model->data[$fid];
        }
      }
      break;
  }
}
return $r;