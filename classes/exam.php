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
}


?>