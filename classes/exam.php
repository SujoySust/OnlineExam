<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Session.php');
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');

class exam
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function addQuestion($data)
    {
        $quesNo = mysqli_real_escape_string($this->db->link, $data['quesNo']);
        $ques = mysqli_real_escape_string($this->db->link, $data['ques']);
        $ans = array();
        $ans[1]=mysqli_real_escape_string($this->db->link, $data['ans1']);
        $ans[2]=mysqli_real_escape_string($this->db->link, $data['ans2']);
        $ans[3]=mysqli_real_escape_string($this->db->link, $data['ans3']);
        $ans[4]=mysqli_real_escape_string($this->db->link, $data['ans4']);
        $rightAns =mysqli_real_escape_string($this->db->link,$data['rightans']);

        $query = "insert into tbl_ques(quesNo, ques) values ('$quesNo','$ques')";
        $insert_row = $this->db->insert($query);
        if($insert_row)
        {
            foreach ($ans as $key=>$ans)
            {
                if($ans != ''){
                    if($rightAns == $key)
                    {
                        $rquery = "insert into tbl_ans (quesNo, rightAns, ans) values('$quesNo','1','$ans')";
                    }else{
                        $rquery = "insert into tbl_ans (quesNo, rightAns, ans) values('$quesNo','0','$ans')";
                    }
                    $insertrow = $this->db->insert($rquery);
                    if($insertrow){
                        continue;
                    }else{
                        die('Insert Error..');
                    }

                }
            }
            $msg = "<span class='success'>Question Added Succeessfully</span>";
        }
        return $msg;

    }

    public function getAllQusetion(){

        $query = "select * from tbl_ques order by quesNo ";
        $result = $this->db->select($query);
        return $result;
    }

      /*  public function EnableUser($userid)
        {
            $query = "update tbl_ques
                        set
                        status = '0'
                        where userId = '$userid'";
            $updated_row = $this->db->update($query);
            if($updated_row)
            {
                $msg = "<span class='success'>User Enabled! </span>";
                return $msg;
            }
            else{
                $msg = "<span class='error'>User Not Enabled! </span>";
                return $msg;
            }

        }*/

    public function DeleteQues($quesid){

        $tables = array("tbl_ques","tbl_ans");
        foreach ($tables as $table)
        {
            $delquery = "delete from $table where quesNo='$quesid'";
            $deldata = $this->db->delete($delquery);
        }
        if($deldata)
        {
            $msg = "<span class='success'>Question Deleted Succeessfully! </span>";
            return $msg;
        }
        else{
            $msg = "<span class='error'>Question Not Deleted! </span>";
            return $msg;
        }

    }

    public function getTotalRows(){
        $query = "select * from tbl_ques";
        $getResult = $this->db->select($query);
        $total = $getResult->num_rows;
        return $total;
    }
    public function getQuestion(){
        $query = "select * from tbl_ques";
        $getdata = $this->db->select($query);
        $result = $getdata->fetch_assoc();
        return $result;
    }
    public function getQuesByNumber($number){
        $query = "select * from tbl_ques where quesNo = '$number' ";
        $getdata = $this->db->select($query);
        $result = $getdata->fetch_assoc();
        return $result;
    }
    public function getAnswer($number){
        $query = "select * from tbl_ans where quesNo = '$number' ";
        $getdata = $this->db->select($query);
        return $getdata;
    }
}


?>