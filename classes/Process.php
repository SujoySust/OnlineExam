<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Session.php');
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');

class Process
{
    private $database;
    private $format;
    public function __construct(){
        $this->database = new Database();
        $this->format = new Format();
    }
    public function processData($data){

        $ans = $data['ans'];
        $selectedans =$this->format->validation($data['ans']);
        $number = $this->format->validation($data['number']);
        $selectedans = mysqli_real_escape_string($this->database->link,$selectedans);
        $number = mysqli_real_escape_string($this->database->link,$number);
        $next = $number+1;
        if(!isset($_SESSION['score'])){
            $_SESSION['score'] = '0';
        }
        $total = $this->getTotal();
        $right = $this->rightAns($number);
        if($right == $selectedans){
            $_SESSION['score']++;
        }
        if($number == $total)
        {
            header("Location: final.php");
        }else{
            header("Location: test.php?q=".$next);
        }

    }
    private function getTotal(){
        $query = "select * from tbl_ques";
        $getResult = $this->database->select($query);
        $total = $getResult->num_rows;
        return $total;
    }
    private function rightAns($number){
        $query = "select * from tbl_ans where quesNo = '$number' and rightans = '1'";
        $getdata = $this->database->select($query)->fetch_assoc();
        $result = $getdata['id'];
        return $result;
    }

}
?>