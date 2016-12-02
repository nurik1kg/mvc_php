<?php
return array(
    'test'=> 'default/index',
    'news/([0-9]+)' => 'news/view/$1', // actionList � NewsController
    'news' => 'news/index', // actionIndex � NewsController
    'student/add' => 'student/add', // actionAdd � StudentController
    'student' => 'student/search', // actionSearch � StudentController
    '' => 'default/index', // home
);