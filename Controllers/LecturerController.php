<?php declare (strict_types = 1);

namespace App;

use App\Database;

class LecturerController extends Database
{
    public function getUser(int $id = 0)
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

    public function lecturer_course(int $id)
    {
        //get the lecturers course and see students who are offering the courses

        $sql = $this->db->query("SELECT lecturer_course.Id, user.username AS names,course.Id AS cid, course.course,course.course_code FROM lecturer_course JOIN user ON user.Id = lecturer_course.lecturerId JOIN course ON course.Id = lecturer_course.courseId_1 WHERE lecturer_course.lecturerId =$id");
        $numRows = $sql->num_rows;
        $data = [];
        if ($numRows > 0) {
            while ($rows = $sql->fetch_assoc()) {
                array_push($data, $rows);
            }

            return $this->out($data);
        }
    }

    public function get_students_per_course(int $id)
    {
        //get the students offering a particular course unnder a particular lecturer

        $sql = $this->db->query(" SELECT student_course.Id, students.name,students.regNum,course.course,course.course_code FROM student_course JOIN students ON students.Id = student_course.student_Id JOIN course ON course.Id = student_course.courseId WHERE student_course.courseId = $id ");
        $numRows = $sql->num_rows;
        if ($numRows > 0) {

            while ($row = $sql->fetch_assoc()) {
                $data[] = $row;
            }

            return $this->out($data);
        }
    }

}
