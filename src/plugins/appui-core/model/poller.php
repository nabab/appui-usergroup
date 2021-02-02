<?php
return [[
  'id' => 'appui-usergroup-0',
  'frequency' => 10,
  'function' => function(array $data) use($model){
    $model->inc->user->updateActivity();
    return ['success' => true];
  }
]];
