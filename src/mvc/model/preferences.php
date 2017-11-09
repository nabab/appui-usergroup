<?php
/*
 * Describe what it does or you're a pussy
 *
 **/

/** @var $this \bbn\mvc\model*/
if ( isset($model->data['limit']) ){
  $grid = new \bbn\appui\grid($model->db, $model->data, [
    'count' => <<< MYSQL
SELECT COUNT(bbn_user_options.id)
FROM bbn_user_options
  JOIN bbn_options AS options
    ON options.id = bbn_user_options.id_option
  LEFT JOIN bbn_options AS links
    ON links.id = bbn_user_options.id_link
  LEFT JOIN bbn_options AS aliases
    ON aliases.id = bbn_user_options.id_alias
MYSQL
    ,
    'query' => <<< MYSQL
SELECT bbn_user_options.id, bbn_user_options.id_option,
bbn_user_options.id_alias, bbn_user_options.public,
IFNULL(aliases.id_link, bbn_user_options.id_link) AS id_link,
IFNULL(aliases.text, bbn_user_options.text) AS text,
IFNULL(aliases.id_user, bbn_user_options.id_user) AS id_user,
bbn_user_options.id_user, bbn_user_options.id_group,
CONCAT(options.text, ' (', IFNULL(options.code, '-'), ')') AS `option`,
CONCAT(links.text, ' (', IFNULL(links.code, '-'), ')') AS link,
options.id_parent
FROM bbn_user_options
  JOIN bbn_options AS options
    ON options.id = bbn_user_options.id_option
  LEFT JOIN bbn_user_options AS aliases
    ON aliases.id = bbn_user_options.id_alias
  LEFT JOIN bbn_options AS links
    ON links.id = bbn_user_options.id_link
MYSQL
    ,
    'filters' => [
      'logic' => 'OR',
      'conditions' => [[
        'field' => 'bbn_user_options.id_user',
        'operator' => 'eq',
        'value' => $model->inc->user->get_id()
      ], [
        'field' => 'bbn_user_options.id_group',
        'operator' => 'eq',
        'value' => $model->inc->user->get_group()
      ], [
        'field' => 'bbn_user_options.public',
        'operator' => 'eq',
        'value' => 1
      ]]
    ]
  ]);
  if ( $grid->check() ){
    return $grid->get_datatable();
  }
}
return [];