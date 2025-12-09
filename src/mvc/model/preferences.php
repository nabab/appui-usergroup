<?php


/** @var bbn\Mvc\Model $model */
if ( isset($model->data['limit']) ){
  $grid = new \bbn\Appui\Grid($model->db, $model->data, [
/*    'count' => <<< MYSQL
SELECT COUNT(bbn_users_options.id)
FROM bbn_users_options
  JOIN bbn_options AS options
    ON options.id = bbn_users_options.id_option
  LEFT JOIN bbn_options AS links
    ON links.id = bbn_users_options.id_link
  LEFT JOIN bbn_options AS aliases
    ON aliases.id = bbn_users_options.id_alias
MYSQL
    ,*/
    'table' => 'bbn_users_options',
    'fields' => [
      'bbn_users_options.id', 'bbn_users_options.id_option', 
      'bbn_users_options.id_alias', 'bbn_users_options.public',
      'id_parent' => 'options.id_parent',
      'id_link' => 'IFNULL(aliases.id_link, bbn_users_options.id_link)',
      'text' => 'IFNULL(aliases.text, bbn_users_options.text)',
      'id_user' => 'IFNULL(aliases.id_user, bbn_users_options.id_user)',
      'option' => "CONCAT(options.text, ' (', IFNULL(options.code, '-'), ')')",
      'link' => "CONCAT(links.text, ' (', IFNULL(links.code, '-'), ')')",
    ],
    'join' => [
      [
        'table' => 'bbn_options',
        'alias' => 'options',
        'on' => [
          'conditions' => [
            [
              'field' => 'options.id',
              'operator' => '=',
              'exp' => 'bbn_users_options.id_option'
            ]
          ]
        ]
      ], [
        'table' => 'bbn_users_options',
        'alias' => 'aliases',
        'type' => 'left',
        'on' => [
          'conditions' => [
            [
              'field' => 'aliases.id',
              'operator' => '=',
              'exp' => 'bbn_users_options.id_alias'
            ]
          ]
        ]
      ], [
        'table' => 'bbn_options',
        'alias' => 'links',
        'type' => 'left',
        'on' => [
          'conditions' => [
            [
              'field' => 'links.id',
              'operator' => '=',
              'exp' => 'bbn_users_options.id_link'
            ]
          ]
        ]
      ]
    ],
    'where' => [
      'logic' => 'OR',
      'conditions' => [[
        'field' => 'bbn_users_options.id_user',
        'operator' => 'eq',
        'value' => $model->inc->user->getId()
      ], [
        'field' => 'bbn_users_options.id_group',
        'operator' => 'eq',
        'value' => $model->inc->user->getIdGroup()
      ], [
        'field' => 'bbn_users_options.public',
        'operator' => 'eq',
        'value' => 1
      ]]
    ]
  ]);
  if ( $grid->check() ){
    $data = $grid->getDatatable(true);
    $id_perm = $model->inc->options->fromCode('permission', 'appui');
    foreach ( $data['data'] as $i => $d ){
      $data['data'][$i]['permission'] = $model->inc->options->isParent($d['id_option'], $id_perm);
    }
    $data['id_perm'] = $id_perm;
    return $data;
  }
}
return [];