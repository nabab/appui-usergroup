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
  $prefCfg = $model->inc->pref->getClassCfg();

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
        if (!empty($id)) {
          if (!empty($model->data['default_dashboard'])
            && ($dashDefId = $model->inc->options->fromCode('default', 'dashboard', 'appui'))
          ) {
            $model->db->insert($prefCfg['table'], [
              $prefCfg['arch']['user_options']['id_option'] => $dashDefId,
              $prefCfg['arch']['user_options']['id_group'] => $id,
              $prefCfg['arch']['user_options']['id_alias'] => $model->data['default_dashboard']
            ]);
          }
          if (!empty($model->data['default_menu'])
            && ($menuDefId = $model->inc->options->fromCode('default', 'menu', 'appui'))
          ) {
            $model->db->insert($prefCfg['table'], [
              $prefCfg['arch']['user_options']['id_option'] => $menuDefId,
              $prefCfg['arch']['user_options']['id_group'] => $id,
              $prefCfg['arch']['user_options']['id_alias'] => $model->data['default_menu']
            ]);
          }
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
        if (!empty($model->data['default_dashboard'])
          && ($dashDefId = $model->inc->options->fromCode('default', 'dashboard', 'appui'))
        ) {
          if ($dashDef = $model->db->selectOne($prefCfg['table'], $prefCfg['arch']['user_options']['id'], [
            $prefCfg['arch']['user_options']['id_group'] => $model->data[$fid],
            $prefCfg['arch']['user_options']['id_option'] => $dashDefId
          ])) {
            if ($model->db->update($prefCfg['table'], [
              $prefCfg['arch']['user_options']['id_alias'] => $model->data['default_dashboard']
            ], [
              $prefCfg['arch']['user_options']['id'] => $dashDef
            ])) {
              $r['success'] = true;
            }
          }
          else if ($model->db->insert($prefCfg['table'], [
            $prefCfg['arch']['user_options']['id_option'] => $dashDefId,
            $prefCfg['arch']['user_options']['id_group'] => $model->data[$fid],
            $prefCfg['arch']['user_options']['id_alias'] => $model->data['default_dashboard']
          ])) {
            $r['success'] = true;
          }
        }
        if (!empty($model->data['default_menu'])
          && ($menuDefId = $model->inc->options->fromCode('default', 'menu', 'appui'))
        ) {
          if ($menuDef = $model->db->selectOne($prefCfg['table'], $prefCfg['arch']['user_options']['id'], [
            $prefCfg['arch']['user_options']['id_group'] => $model->data[$fid],
            $prefCfg['arch']['user_options']['id_option'] => $menuDefId
          ])) {
            if ($model->db->update($prefCfg['table'], [
              $prefCfg['arch']['user_options']['id_alias'] => $model->data['default_menu']
            ], [
              $prefCfg['arch']['user_options']['id'] => $menuDef
            ])) {
              $r['success'] = true;
            }
          }
          else if ($model->db->insert($prefCfg['table'], [
            $prefCfg['arch']['user_options']['id_option'] => $menuDefId,
            $prefCfg['arch']['user_options']['id_group'] => $model->data[$fid],
            $prefCfg['arch']['user_options']['id_alias'] => $model->data['default_menu']
          ])){
            $r['success'] = true;
          }
        }
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