<?php declare (strict_types = 1);

require 'connection.php';

class Lecturer extends Database
{
    public function getUser($id = 0)
    {
        //this block of code handles the name display

        $sql = $this->db->query("SELECT * FROM `user` WHERE `Id`='$id' ");
        $numRows = $sql->num_rows;
        $data = [];
        if ($numRows > 0) {
            while ($row = $sql->fetch_assoc()) {
                array_push($data, $row);
            }

            return $this->out($data);
        }
    }

    public function enroll()
    {
        // this block of codes executes the enrollment program
        exec('c:/Fingerprint/enroll.jar');
    }

    public function attend()
    {
        exec('c:/Fingerprint/attendance.jar');
    }

    public function getCourse(int $levelId, int $deptId)
    {

        $res = $this->db->query("SELECT course.*,course.Id AS cid, level.*,department.* FROM course JOIN level ON level.Id = course.level_Id JOIN department ON department.Id = course.dept_id WHERE course.level_Id = '$levelId' AND course.dept_id = '$deptId' ");

        $numRows = $res->num_rows;

        if ($numRows > 0) {
            $data = [];

            while ($row = $res->fetch_assoc()) {
                $id = $row['cid'];
                $course = $row['course'];
                $course_code = $row['course_code'];
                $data[] = array("cid" => $id, "course" => $course, 'courseCode' => $course_code);
            }
            return $this->out($data);
        }

    }

    public function addStudent(string $name, int $regnum, int $lvlId, int $deptId, array $course)
    {

        //check if students and regNum already exists

        $checkIfStudentExists = $this->db->query("SELECT * FROM `students` WHERE `name`='$name' AND `regNum` = '$regnum' ");
        $numRows = $checkIfStudentExists->num_rows;

        if ($numRows > 0) {
            return $this->message('exists');
        } else {
            $res = $db->query("INSERT INTO `students`( `name`, `regNum`, `dept_Id`, `level_Id`, `date_created`)
             VALUES ('$name','$regnum','$deptId','$lvlId',NOW())");

            if ($res) {
                $lastId = $db->insert_id;

                foreach ($course as $key => $value) {
                    $res1 = $db->query("INSERT INTO `student_course`( `student_Id`, `courseId`, `date_created`) VALUES ($lastId,$value,NOW())");
                    if ($res1) {
                        return $this->message('successful');

                    }
                }
            }
        }
    }

    public function getStudents()
    {
        $res = $this->db->query("SELECT department.*,department.Id AS dip,students.*, students.Id AS stid, level.*,level.Id AS lid FROM students JOIN department ON dept_Id = department.Id JOIN level ON level_Id = level.Id ");
        $numRows = $res->num_rows;

        if ($numRows > 0) {
            while ($row = $res->fetch_assoc()) {
                $Id = $row['stid'];
                $name = $row['name'];
                $regNum = $row['regNum'];
                $level = $row['level'];
                $dept = $row['dept'];

                $data[] = array('id' => $Id, 'name' => $name, 'regNum' => $regNum, 'level' => $level, 'dept' => $dept);
            }

            return $this->out($data);
        }

    }
}
