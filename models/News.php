<?php
require_once(ROOT. '/component/Db.php');

class News
{
    // этот метод возврашаеть одну новестей по $id
    public static function getNewsItem ($post_id)
    {
        // Запрос к БД 
        $conn = Db::getConnection();
        
        $newsItem = array();
        
        $sql='SELECT  title, date, content '
            .'FROM news '
            .'WHERE id = ? ';
        $stmt = $conn->prepare($sql); //dayardayt
        $stmt->bind_param('i', $id);
        $id = $post_id;
        /* execute prepared statement */
        $stmt->execute(); //zapros
        $stmt->store_result(); // zapros
		
    	if ($stmt->num_rows>0)
    	{
    	$stmt->bind_result($newsItem['title'], $newsItem['date'], $newsItem['content']); // kelgen maanini yigarat
        // output data of each row
        $row = $stmt->fetch();
        return $newsItem;
    	}
    }
    
    // Бардык жанылыктарды чыгарат (кайтарат)
    public static function getNewsList()
    {
        // Запрос к БД
        
        $conn = Db::getConnection();    
  
        $newsList = array();
        
        $sql='SELECT id, title, date, short_content '
            .'FROM news '
            .'ORDER BY date DESC ';
        
        $stmt = $conn->prepare($sql); //dayardayt
        /* execute prepared statement */
        $stmt->execute(); //zapros
        $stmt->store_result(); // zapros
		
    	if ($stmt->num_rows>0)
    	{
    	$stmt->bind_result($id, $title, $date, $sh_content); // kelgen maanini yigarat
        // output data of each row
        $i=0;
        while($row = $stmt->fetch())
            {
                $newsList[$i]['id'] = $id;
                $newsList[$i]['title'] = $title;
                $newsList[$i]['date'] = $date;
                $newsList[$i]['sh_content'] = $sh_content;
                $i++;
            }
        }
        
        return $newsList;
    	}
    }
