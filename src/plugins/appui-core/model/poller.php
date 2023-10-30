<?php
/** @var bbn\Mvc\Model $model The model */
$user =& $model->inc->user;
return [[
  'id' => 'appui-usergroup-0',
  'frequency' => 10,
  'function' => function(array $data) use($user){
    $user->updateActivity();
    return ['success' => true];
  }
]];
