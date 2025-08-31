<?php
/** @var bbn\Mvc\Controller %ctrl */
$ctrl->obj->success = false;
$mgr = $ctrl->inc->user->getManager();
if ( isset($ctrl->post['action'], $ctrl->post['id_option']) ){
  switch ( $ctrl->post['action'] ){
    case 'insert':
      if ( !empty($ctrl->post['id_user']) ){
        $ctrl->obj->success = $mgr->userInsertOption($ctrl->post['id_user'], $ctrl->post['id_option']);
      }
      else if ( !empty($ctrl->post['id_group']) ){
        $ctrl->obj->success = $mgr->groupInsertOption($ctrl->post['id_group'], $ctrl->post['id_option']);
      }
      break;
    case 'delete':
      if ( !empty($ctrl->post['id_user']) ){
        $ctrl->obj->success = $mgr->userDeleteOption($ctrl->post['id_user'], $ctrl->post['id_option']);
      }
      else if ( !empty($ctrl->post['id_group']) ){
        $ctrl->obj->success = $mgr->groupDeleteOption($ctrl->post['id_group'], $ctrl->post['id_option']);
      }
      break;
  }
}
