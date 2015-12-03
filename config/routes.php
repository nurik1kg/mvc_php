<?php
return array(
    
    'news/([0-9]+)' => 'news/view/$1', // actionList â NewsController
    'news' => 'news/index', // actionIndex â NewsController
    'student/add' => 'student/add', // actionAdd â StudentController
    'student' => 'student/search', // actionSearch â StudentController
    '' => 'default/index', // home
);