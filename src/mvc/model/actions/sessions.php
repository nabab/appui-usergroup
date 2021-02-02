<?php
$success = false;
if ( !empty($model->data['id']) && !empty($model->data['minutes']) && 
  (($model->data['minutes'] === 2) || ($model->data['minutes'] < 2))
){
  $mgr = $model->inc->user->getManager();
  $success = $mgr->destroySessions($model->data['id'], $model->data['minutes']);  
}
return [
  'success' => $success
];