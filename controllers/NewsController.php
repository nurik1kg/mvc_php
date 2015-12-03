<?php

include_once ROOT.'/models/News.php'; // modeldi koshuu

class NewsController
{
    public function actionIndex()
    {
        $newsList = array();
        $newsList = News::getNewsList();
        
        
        require_once(ROOT.'/views/news/index.php');
        
        return true;
    }
    
    public function actionView($id)
    {
        $newsItem = array();
        $newsItem = News::getNewsItem($id);
            
        require_once(ROOT.'/views/news/list_index.php');
        
        return true;
    }
}