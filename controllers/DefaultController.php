<?php

class DefaultController
{
    public function actionIndex()
    {
        require_once(ROOT.'/views/default.php');
        
        return true;
    }
}