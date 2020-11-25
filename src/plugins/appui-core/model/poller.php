<?php
return [[
  'id' => 'appui-usergroup-0',
  'frequency' => 10,
  'function' => function(array $data) use($model){
    $model->inc->user->update_activity();
    return ['success' => true];
  }
]];
