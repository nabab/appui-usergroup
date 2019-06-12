<?php
/**
 * Created by BBN Solutions.
 * User: Mirko Argentino
 * Date: 12/02/2018
 * Time: 14:52
 */

if ( !empty($model->data['id']) && (!empty($model->data['id_user']) || !empty($model->data['id_group'])) ){
  $res = [
    'group' => [],
    'public' => []
  ];
  if ( !empty($model->data['id_user']) ){
    $res['user'] = [];
  }
  $id_group = !empty($model->data['id_user']) ?
    $model->db->select_one('bbn_users', 'id_group', ['id' => $model->data['id_user']]) :
    !empty($model->data['id_group']);
  foreach ( $model->inc->options->options($model->data['id']) as $id_opt => $opt ){
    if ( !empty($model->data['id_user']) ){
      if ( !empty($model->inc->pref->user_has($id_opt, $model->data['id_user'])) ){
        $res['user'][] = $id_opt;
      }
    }
    if ( !empty($model->inc->pref->group_has($id_opt, $id_group)) ){
      $res['group'][] = $id_opt;
    }
    if ( !empty($model->inc->options->option($id_opt)['public']) ){
      $res['public'][] = $id_opt;
    }
  }
  return [
    'data' => $res
  ];
}