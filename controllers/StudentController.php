<?php
include_once ROOT.'/models/Student.php'; // modeldi koshuu

class StudentController
{
    public function actionAdd()
    {
         if (isset($_POST['save']))
         {
            Student :: saveStudent($_POST['name'],$_POST['age'],$_POST['bolum']);
            return true;
         }
         if (isset($_POST['update']))
         {
            Student :: updateStudent($_POST['name'],$_POST['age'],$_POST['bolum'], $_POST['d_id']);
            return true;
         }
         if (isset($_POST['delete']))
         {
            Student :: deleteStudent($_POST['d_id']);
            return true;
         }
        //$f_name = array();
        $b_name = array();
       // $studentAdd= News::getNewsItem($id);
        //$f_name = Student ::getFacultet();
        $b_name = Student :: getBolum();
        require_once(ROOT.'/views/student/add_student.php');
        
        return true;
    }
    
    public function actionSearch()
    {
        
         if (isset($_POST['search']))
         { 
            $tab = array();
            $tab = Student :: searchBolum($_POST['bolum']);
         }
         else
         {
             $tab = array();
             //$tab[]='';
         }
        //$f_name = array();
        $b_name = array();
        //$f_name = Student ::getFacultet();
        $b_name = Student :: getBolum();
        require_once(ROOT.'/views/student/search_student.php');
        
        return true;
    }
}