<?php
/** @var \bbn\mvc\model $model */
/** @var int $id_perm The option root's ID of the permissions */

$id_user = false;
$id_group = false;

if ( !empty($model->data['id_user']) ){
  $id_user = $model->data['id_user'];
}
else if ( !empty($model->data['id_group']) ){
  $id_group = $model->data['id_group'];
}
if ( $id_user || $id_group ){
  $id_perm = $model->inc->options->from_code('bbn_permissions');
  $pref = \bbn\user\preferences::get_preferences();
  $manager = $model->inc->user->get_manager();
  $cfg = $model->inc->user->get_class_cfg();
  if ( $id_user ){
    $item = $manager->get_user($id_user);
    $id_group = $item[$cfg['arch']['users']['id_group']];
    $name = $cfg['arch']['users']['username'] ?? ( $cfg['arch']['users']['login'] ?? $cfg['arch']['users']['email'] );
  }
  else{
    $item = $manager->get_group($id_group);
    $name = $cfg['arch']['groups']['group'];
  }
  $db =& $model->db;
  return [
    'title' => _("Permissions de l'utilisateur ".$item[$name]),
    'id_user' => $id_user,
    'id_group' => $id_group,
    'tree' => $model->inc->options->map(function($r)use($pref, $manager, $id_group, $id_user){
      if ( !empty($r['public']) && empty($r['num_children']) ){
        return false;
      }
      if ( empty($r['icon']) ){
        if ( substr($r['code'], -1) === '/' ){
          $r['icon'] = 'folder';
        }
        else {
          $r['icon'] = 'file';
        }
      }
      if ( !$id_user || $pref->has_permission($r['id']) ){
        $o = [
          'id' => $r['id'],
          'text' => $r['text'],
          'code' => $r['code'],
          'icon' => $r['icon'],
          'is_parent' => empty($r['num_children']) ? false : true
        ];
        if ( !empty($r['public']) ){
          $o['checked'] = 1;
          $o['disabled'] = 1;
        }
        else if ( $manager->group_has_option($id_group, $r['id']) ){
          $o['checked'] = 1;
          if ( $id_user ){
            $o['disabled'] = 1;
          }
        }
        else if ( $id_user && $manager->user_has_option($id_user, $r['id']) ){
          $o['checked'] = 1;
        }
        if ( $o['is_parent'] ){
          $o['items'] = $r['items'];
        }
          return $o;
      }
    }, $id_perm, true)
  ];
}
