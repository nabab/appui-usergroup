<?php
/** @var \bbn\mvc\model $model */

$user_cfg = $model->inc->user->get_class_cfg();
return [
  'opened' => $model->db->rselect_all([
    'table' => $user_cfg['tables']['sessions'],
    'fields' => [
      $user_cfg['arch']['sessions']['creation'],
      $user_cfg['arch']['sessions']['last_activity']
    ],
    'join' => [[
      'table' => $user_cfg['table'],
      'on' => [
        'conditions' => [[
          'field' => $user_cfg['table'].'.'.$user_cfg['arch']['users']['id'],
          'exp' => $user_cfg['tables']['sessions'].'.'.$user_cfg['arch']['sessions']['id_user']
        ]]
      ]
    ]],
    'order' => [[
      'field' => $user_cfg['arch']['sessions']['last_activity'],
      'dir' => 'DESC'
    ]],
    'where' => [[
      'field' => $user_cfg['arch']['sessions']['id_user'],
      'value' => $model->inc->user->get_id()
    ], [
      'field' => $user_cfg['arch']['sessions']['opened'],
      'value' => 1
    ]],
    'limit' => 5
  ]),
  'closed' => $model->db->rselect_all([
    'table' => $user_cfg['tables']['sessions'],
    'fields' => [
      $user_cfg['arch']['sessions']['creation'],
      $user_cfg['arch']['sessions']['last_activity']
    ],
    'join' => [[
      'table' => $user_cfg['table'],
      'on' => [
        'conditions' => [[
          'field' => $user_cfg['table'].'.'.$user_cfg['arch']['users']['id'],
          'exp' => $user_cfg['tables']['sessions'].'.'.$user_cfg['arch']['sessions']['id_user']
        ]]
      ]
    ]],
    'order' => [[
      'field' => $user_cfg['arch']['sessions']['last_activity'],
      'dir' => 'DESC'
    ]],
    'where' => [[
      'field' => $user_cfg['arch']['sessions']['id_user'],
      'value' => $model->inc->user->get_id()
    ], [
      'field' => $user_cfg['arch']['sessions']['opened'],
      'value' => 0
    ]],
    'limit' => 5
  ])
];