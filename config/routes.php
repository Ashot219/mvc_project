<?php

return array(
    'user/logout' => 'user/logout',
    'user/login' => 'user/login',
    'login/(.*)' => 'user/login',
    'task/edit/(.*)' => 'task/edit/$1',
    'tasks/save_task' => 'task/save',
    'tasks/update_task' => 'task/update',
    'tasks/create' => 'task/create',
    'tasks' => 'task/index',
    '/(.*)' => 'task/index',
    '/' => 'task/index',
);
 