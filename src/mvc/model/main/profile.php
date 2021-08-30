<?php
/**
 * What is my purpose?
 *
 **/

/** @var $model \bbn\Mvc\Model*/

$data = [
  'data' => $model->inc->user->getSession(),
  'root' => APPUI_USERGROUP_ROOT,
  'schema' => $model->inc->user->getClassCfg()['arch']['users']
];
if (defined('BBN_PROJECT')) {
  $proj = new bbn\Appui\Project($model->db, BBN_PROJECT);
  $data['languages'] = array_map(function($a) use (&$model) {
    return $model->inc->options->option($a);
  }, $proj->getLangsIds());
}
if ($model->hasData('locale')) {
  if (!isset($data['schema']['language'])) {
    $data['schema']['language'] = 'lang';
  }

  $data['data'][$data['schema']['language']] = $model->data['locale'];
}

return $data;

