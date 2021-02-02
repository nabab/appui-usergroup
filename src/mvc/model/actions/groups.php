<?php
$r = ['success' => false];
if (
  !empty($model->data['action']) &&
  ($cfg = $model->inc->user->getClassCfg())
){
  $fid = $cfg['arch']['groups']['id'];
  $fgroup = $cfg['arch']['groups']['group'];
  $fcfg = $cfg['arch']['groups']['cfg'];
  $mgr = $model->inc->user->getManager();

  switch ( $model->data['action'] ){
    case 'insert':
      if (
        !empty($model->data[$fgroup]) &&
        (!$model->inc->user->isDev() || $model->inc->user->isAdmin())
      ){
        if (!empty($model->data['source_id'])) {
          if ($id = $mgr->copy('group', $model->data['source_id'], [$fgroup => $model->data[$fgroup]])) {
            $r['success'] = true;
            $r['data'] = $mgr->getGroup($id);
          }
        }
        else if ($id = $mgr->groupInsert([$fgroup => $model->data[$fgroup]])) {
          $r['success'] = true;
          $r['data'] = [
            $fid => $id,
            $fgroup => $model->data[$fgroup],
            $fcfg => '{}',
            'num' => 0
          ];
        }
      }
      break;
    
    case 'update':
      if ( 
        !empty($model->data[$fid]) &&
        !empty($model->data[$fgroup]) &&
        (!$model->inc->user->isDev() || $model->inc->user->isAdmin())
      ){
        $r['success'] = $mgr->groupRename($model->data[$fid], $model->data[$fgroup]);
        $r['data'][$fid] = $model->data[$fid];
      }
      break;
    
    case 'delete':
      if ( 
        !empty($model->data[$fid]) &&
        (!$model->inc->user->isDev() || $model->inc->user->isAdmin())
      ){
        if ( $r['success'] = $mgr->groupDelete($model->data[$fid]) ){
          $r['data'][$fid] = $model->data[$fid];
        }
      }
      break;
  }
}
return $r;