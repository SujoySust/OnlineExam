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

        $query = "insert into tbl_ques(quesNo, ques, status) values ('$quesNo','$ques','0')";
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

    public function addWrittenQuestion($data){
        $quesNo = $this->fm->validation($data['quesNo']);
        $ques = $this->fm->validation($data['ques']);
        $mark = $this->fm->validation($data['marks']);

        $quesNo = mysqli_real_escape_string($this->db->link,$quesNo);
        $ques = mysqli_real_escape_string($this->db->link,$ques);
        $mark =mysqli_real_escape_string($this->db->link,$mark);
        $query = "insert into tbl_writtenques(quesNo, question, marks) values ('$quesNo','$ques','$mark')";
        $insert_row = $this->db->insert($query);
        if ($insert_row)
        {
            $msg = "<span class='success'>Question Added Succeessfully</span>";
        }
        return $msg;

    }

    public function getAllQusetion(){

        $query = "select * from tbl_ques order by quesNo ";
        $result = $this->db->select($query);
        return $result;
    }

    public function getWrittenQuesList(){
        $query = "select * from tbl_writtenques";
        $result = $this->db->select($query);
        return $result;
    }

    public function getWrittenQues(){
        $query = "select * from tbl_writtenques where status = '1'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getAllMcqQues(){
        $query = "select * from tbl_ques where status = '1'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getWrittenAns($userId){

        $query = "select * from tbl_writtenans where userId = '$userId'";
        $result = $this->db->select($query);
        return $result;

    }

    public function getQuestionData($quesNo){
        $query = "select * from tbl_writtenques where quesNo = '$quesNo'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getMcqQuestion($quesNo){
        $query = "select * from tbl_ques where quesNo = '$quesNo'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getMcqQuestionAns($quesNo){
        $query = "select * from tbl_ans where quesNo = '$quesNo'";
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

    public function DeleteWrittenQues($delid){
        $delquery = "delete from tbl_writtenques where quesNo='$delid'";
        $deldata = $this->db->delete($delquery);
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

    public function DeleteAllQues(){

        $tables = array("tbl_ques","tbl_ans");
        foreach ($tables as $table)
        {
            $delquery = "delete from $table";
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
    public function DeleteAllWrittenQues(){
        $delquery = "delete from tbl_writtenques";
        $deldata = $this->db->delete($delquery);
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
        if($getResult == null)
        {
            $total = 0;
            return $total;
        }else{
            $total = $getResult->num_rows;
            return $total;
        }

    }

    public function getTotalWrittenRows(){
        $query = "select * from tbl_writtenques";
        $getResult = $this->db->select($query);
        if($getResult == null)
        {
            $total = 0;
            return $total;
        }else{
            $total = $getResult->num_rows;
            return $total;
        }

    }

    public function getQuestion(){
        $query = "select * from tbl_ques where status = '1'";
        $getdata = $this->db->select($query);
        if($getdata!=null){
            if(isset($getdata)) {
                $result = $getdata->fetch_assoc();
                return $result;
            }
        }else{
            header("Location:index.php");
        }


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
    public function updateQuestion(){

        $query = "update tbl_ques set status = '1'";
        $updated_row = $this->db->update($query);
        if(isset($updated_row)){
            $msg = "MCQ Examination Started...";
        }
        else{
            $msg = "MCQ Examination Not Started!!!";
        }
        return $msg;
    }

    public function updateAllWrittenQuestion(){
        $query = "update tbl_writtenques set status = '1'";
        $updated_row = $this->db->update($query);
        if(isset($updated_row)){
            $msg = "Written Examination Started...";
        }
        else{
            $msg = "Written Examination Not Started!!!";
        }
        return $msg;
    }


    public function updateWrittenQuestion ($quesNo,$data){
        $question = $data['question'];
        $marks = $data['marks'];
        $question = $this->fm->validation($question);
        $marks = $this->fm->validation($marks);
        $question  = mysqli_real_escape_string($this->db->link,$question);
        $marks =mysqli_real_escape_string($this->db->link,$marks);


        $query = "update tbl_writtenques
                    set
                    question = '$question',
                    marks = '$marks'
                    where quesNo = '$quesNo'";
        $updated_row = $this->db->update($query);
        if($updated_row)
        {
            $msg = "<span>Question Succeessfully Updated </span>";
            return $msg;
        }
        else{
            $msg = "<span>Question Not Updated</span>";
            return $msg;
        }

    }

    public function updateMcqQuestion ($quesNo,$data){
        $rightAns = (int)$data['taskOption'];
        $quesNo = mysqli_real_escape_string($this->db->link, $quesNo);
        $ques = mysqli_real_escape_string($this->db->link, $data['question']);
        $answer = array();
        $id = array();

        $id[1]=mysqli_real_escape_string($this->db->link, $data['id1']);
        $id[2]=mysqli_real_escape_string($this->db->link, $data['id2']);
        $id[3]=mysqli_real_escape_string($this->db->link, $data['id3']);
        $id[4]=mysqli_real_escape_string($this->db->link, $data['id4']);

        $answer[1]=mysqli_real_escape_string($this->db->link, $data['ans1']);
        $answer[2]=mysqli_real_escape_string($this->db->link, $data['ans2']);
        $answer[3]=mysqli_real_escape_string($this->db->link, $data['ans3']);
        $answer[4]=mysqli_real_escape_string($this->db->link, $data['ans4']);
        $rightAns =mysqli_real_escape_string($this->db->link,$rightAns);

        $query = "update tbl_ques 
                   set ques = '$ques'
                   where quesNo = '$quesNo'";
        $updated_row = $this->db->update($query);
        if($updated_row)
        {
            $i = 1;
            foreach ($answer as $key=>$answer)
            {

                if($answer != ''){

                    if($rightAns == (int)$key)
                    {
                        $myquery = "update tbl_ans 
                   set ans = '$answer',
                   rightans = '1'
                   where id = '$id[$i]'";
                        $updatedrow = $this->db->update($myquery);
                    }else{
                        $myquery = "update tbl_ans 
                   set ans = '$answer',
                   rightans = '0'
                   where id = '$id[$i]'";
                        $updatedrow = $this->db->update($myquery);
                    }

                }
                $i++;
            }
            $msg = "<span>Question Updated Succeessfully</span>";
        }
        return $msg;

    }


    public function finishExam(){
        $query = "update tbl_ques set status = '0'";
        $updated_row = $this->db->update($query);
        if(isset($updated_row)){
            $msg = "Examination Finished...";
        }
        else{
            $msg = "Examination Not Finished!!!";
        }
        return $msg;
    }

    public function finishWrittenExam(){
        $query = "update tbl_writtenques set status = '0'";
        $updated_row = $this->db->update($query);
        if(isset($updated_row)){
            $msg = "Examination Finished...";
        }
        else{
            $msg = "Examination Not Finished!!!";
        }
        return $msg;
    }
}


?>