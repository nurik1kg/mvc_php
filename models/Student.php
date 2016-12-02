<?php
require_once(ROOT. '/component/Db.php');

class Student {
    
    public static function saveStudent ($name, $age, $bolum) 
    {
        $conn = Db::getConnection();
        
        $sql="INSERT INTO students (name , age ,dep_id) VALUES (?,?,?)";
        $stmt = $conn->prepare($sql); //dayardayt
        $stmt->bind_param('sii', $name,$age,$bolum);
        /* execute prepared statement */
        $stmt->execute(); //zapros
        $stmt->store_result(); // zapros 
        
  		if ($stmt->affected_rows>0)
    	{
    	//$stmt->bind_result($name); // kelgen maanini yigarat
        // output data of each row
        echo("Koshuldu");
        }
        
        return true;
        
    }
    public static function updateStudent ($name, $age, $bolum,$id) 
    {
        $conn = Db::getConnection();
        
        $sql="UPDATE students SET name = ? , age = ?, dep_id = ?
                WHERE id = ? ";
        $stmt = $conn->prepare($sql); //dayardayt
        $stmt->bind_param('siii', $name,$age,$bolum,$id);
        /* execute prepared statement */
        $stmt->execute(); //zapros
        $stmt->store_result(); // zapros
        
  		if ($stmt->affected_rows>0)
    	{
    	//$stmt->bind_result($name); // kelgen maanini yigarat
        // output data of each row
        echo("Updated");
        }
        
        return true;
        
    }
    public static function deleteStudent ($id) 
    {
        $conn = Db::getConnection();
        
        $sql="DELETE FROM students
            WHERE id = ?";
        $stmt = $conn->prepare($sql); //dayardayt
        $stmt->bind_param('i',$id);
        /* execute prepared statement */
        $stmt->execute(); //zapros
        $stmt->store_result(); // zapros
        
  		if ($stmt->affected_rows>0)
    	{
    	//$stmt->bind_result($name); // kelgen maanini yigarat
        // output data of each row
        echo("Ochuruldu");
        }
        
        return true;
        
    }
    public static function getFacultet () 
    {
        // Запрос к БД 
        $conn = Db::getConnection();
        
        $f_name = array();
        
        $sql='SELECT  DISTINCT facultet '
            .'FROM bolum ';
        $stmt = $conn->prepare($sql); //dayardayt
        /* execute prepared statement */
        $stmt->execute(); //zapros
        $stmt->store_result(); // zapros
        
  		if ($stmt->num_rows>0)
    	{
    	$stmt->bind_result($name); // kelgen maanini yigarat
        // output data of each row
        $i=0;
        while($stmt->fetch())
            {
                $f_name[$i]['name'] = $name;
                $i++;
            }
        }
        
        return $f_name;
   	}
        
    public static function getBolum(){
        // Запрос к БД 
        $conn = Db::getConnection();
        
        $b_name = array();
        
        $sql='SELECT id_b, bolum, facultet '
            .'FROM bolum ';
        $stmt = $conn->prepare($sql); //dayardayt
        /* execute prepared statement */
        $stmt->execute(); //zapros
        $stmt->store_result(); // zapros
        
  		if ($stmt->num_rows>0)
    	{
    	$stmt->bind_result($id,$bname,$fname); // kelgen maanini yigarat
        
        // output data of each row
        $i=0;
        while($stmt->fetch())
            {
                $b_name[$i]['id'] = $id;
                $b_name[$i]['bname'] = $bname;
                $b_name[$i]['fname'] = $fname;
                $i++;
            }
        }
        
        return $b_name;
    }
    public static function searchBolum($id){
        // Запрос к БД 
        $conn = Db::getConnection();
        
        $tab = array();
        
        $sql="SELECT a.id, a.name, a.age, b.facultet, b.bolum "
            ."FROM bolum b, students a WHERE a.dep_id = '$id' and b.id_b = '$id' ";
        $stmt = $conn->prepare($sql); //dayardayt
        /* execute prepared statement */
        $stmt->execute(); //zapros
        $stmt->store_result(); // zapros
        
  		if ($stmt->num_rows>0)
    	{
    	$stmt->bind_result($id,$name,$age,$fa,$bo); // kelgen maanini yigarat
        // output data of each row
        $i=0;
        while($stmt->fetch())
            {
                $tab[$i]['id'] = $id;
                $tab[$i]['name'] = $name;
                $tab[$i]['age'] = $age;
                $tab[$i]['fa'] = $fa;
                $tab[$i]['bo'] = $bo;
                $i++;
            }
        }
        
        return $tab;
    }
}