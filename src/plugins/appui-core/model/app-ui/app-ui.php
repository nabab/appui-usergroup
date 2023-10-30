<?php

use bbn\Mvc;
/** @var bbn\Mvc\Model $model The current model */

$user = $model->inc->user;
return [
  'headright' => [
    'content' => Mvc::getInstance()->subpluginView('app-ui/user', 'html', [], 'appui-usergroup', 'appui-core'),
    'script' => Mvc::getInstance()->subpluginView('app-ui/user', 'js', [], 'appui-usergroup', 'appui-core'),
    'data' => [
      'id' => $model->inc->user->getId(),
      'isAdmin' => $model->inc->user->isAdmin(),
      'isDev' => $model->inc->user->isDev(),
      'name' => $model->inc->user->getName(),
    ]
  ]
];


