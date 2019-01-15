<?php
/** @var \bbn\mvc\controller %ctrl */
$ctrl->obj->success = false;
$mgr = $ctrl->inc->user->get_manager();
if ( isset($ctrl->post['action'], $ctrl->post['id_option']) ){
  switch ( $ctrl->post['action'] ){
    case 'insert':
      if ( !empty($ctrl->post['id_user']) ){
        $ctrl->obj->success = $mgr->user_insert_option($ctrl->post['id_user'], $ctrl->post['id_option']);
      }
      else if ( !empty($ctrl->post['id_group']) ){
        $ctrl->obj->success = $mgr->group_insert_option($ctrl->post['id_group'], $ctrl->post['id_option']);
      }
      break;
    case 'delete':
      if ( !empty($ctrl->post['id_user']) ){
        $ctrl->obj->success = $mgr->user_delete_option($ctrl->post['id_user'], $ctrl->post['id_option']);
      }
      else if ( !empty($ctrl->post['id_group']) ){
        $ctrl->obj->success = $mgr->group_delete_option($ctrl->post['id_group'], $ctrl->post['id_option']);
      }
      break;
  }
}
