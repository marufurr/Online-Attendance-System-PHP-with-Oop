<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/Database.php');
include_once ('./lib/Student.php');
?>


<?php
/**
 * Created by PhpStorm.
 * User: DIU
 * Date: 3/10/2019
 * Time: 4:32 PM
 */

class Student
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    public function getStudent()
    {
        $query = "select *from tbl_student";
        $result = $this->db->select($query);
        return $result;
    }


    public function insertStudent($name, $roll)
    {
        $name = mysqli_real_escape_string($this->db->link, $name);
        $roll = mysqli_real_escape_string($this->db->link, $roll);
        if (empty($name) || empty($roll)) {
            $msg = "<div class='alert alert-danger'><strong><b>Error! Field Must Not Be Empty!</b></strong> </div>";
            return $msg;
        } else {
            $stu_query = "INSERT INTO tbl_student(name,roll) VALUES ('$name','$roll')";
            $stu_insert = $this->db->insert($stu_query);

            $att_query = "INSERT INTO tbl_attendance(roll) VALUES ('$roll')";
            $stu_insert = $this->db->insert($att_query);

            if ($stu_insert) {
                $msg = "<div class='alert alert-success'><strong>Success! Student Data Inserted Successfully!!!</strong> </div>";
                return $msg;
            } else {
                $msg = "<div class='alert alert-danger'><strong>Success! Student Data Not Inserted!</strong> </div>";
                return $msg;
            }
        }
    }

    public function insertAttendance($cur_date, $attend = array())
    {
        $query = "SELECT DISTINCT att_time FROM tbl_attendance";
        $getData = $this->db->select($query);
        while ($result = $getData->fetch_assoc()) {
            $db_date = $result['att_time'];
            if ($cur_date == $db_date) {
                $msg = "<div class='alert alert-danger'><strong><b>Alert!</b> Today Student Attendance Already Taken!</strong> </div>";
                return $msg;
            }
        }
        foreach ($attend as $atn_key => $atn_value) {
            if ($atn_value == "present") {
                $stu_query = "INSERT INTO tbl_attendance(roll,attend,att_time)VALUES('$atn_key','present',now())";
                $data_insert = $this->db->insert($stu_query);
            } elseif ($atn_value == "absent") {
                $stu_query = "INSERT INTO tbl_attendance(roll,attend,att_time)VALUES('$atn_key','absent',now())";
                $data_insert = $this->db->insert($stu_query);

            }


            if ($data_insert) {
                $msg = "<div class='alert alert-success'><strong>Success! Attendance Data Inserted Successfully!!!</strong> </div>";
                return $msg;
            } else {
                $msg = "<div class='alert alert-danger'><strong>Error! Attendance Data Not Inserted!</strong> </div>";
                return $msg;
            }
        }
    }

    public function getDateList()
    {
        $query = "SELECT DISTINCT att_time FROM tbl_attendance";
        $result = $this->db->select($query);
        return $result;
    }

    public function getAllData($dt)
    {
        $query = "SELECT tbl_student.name,tbl_attendance.*
        FROM tbl_student
        INNER JOIN tbl_attendance
        ON tbl_student.roll = tbl_attendance.roll
        WHERE att_time = '$dt'";
        $result = $this->db->select($query);
        return $result;
    }
    public function updateAttendance($dt,$attend){
        foreach ($attend as $atn_key => $atn_value) {
            if ($atn_value == "present") {
                $query = "UPDATE tbl_attendance
              SET attend='present'
              WHERE roll = '".$atn_key."' AND att_time = '".$dt."'";
                $data_update = $this->db->insert($query);
            } elseif ($atn_value == "absent") {
                $query = "UPDATE tbl_attendance
              SET attend='absent'
              WHERE roll = '".$atn_key."' AND att_time = '".$dt."'";
                $data_update = $this->db->insert($query);

            }


            if ($data_update) {
                $msg = "<div class='alert alert-success'><strong>Success! Attendance Data Updated Successfully.</strong> </div>";
                return $msg;
            } else {
                $msg = "<div class='alert alert-danger'><strong>Error! Attendance Data Not Updated!</strong> </div>";
                return $msg;
            }
        }
    }
}