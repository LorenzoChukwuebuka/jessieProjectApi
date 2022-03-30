<?php declare (strict_types = 1);
namespace App;

use App\Database;
use App\util;

class AdminController extends Database
{
    public function login($user, $pass): string
    {
        $res = $this->db->query("SELECT * FROM `user` WHERE `username`='$user' AND `password`='$pass' ");
        $numRows = $res->num_rows;

        if ($numRows > 0) {
            $rw = $res->fetch_assoc();
            $data = [];

            array_push($data, $rw);

            return $this->out($data);

        } else {
            return $this->message('Invalid details');
        }
    }

    public function addSchool($school): string
    {

        $res1 = $this->db->query("SELECT * FROM `school` WHERE `school`='$school'");
        $numRows = $res1->num_rows;

        if (!empty($school)) {
            if ($numRows === 0) {
                $res = $this->db->query("INSERT INTO `school`(`school`) VALUES ('$school')");

                if ($res) {
                    return $this->message('succesful');
                } else {
                    return $this->message($this->db->error);
                }
            } else {
                return $this->message('user exists');
            }

        } else {
            return $this->message('Invalid inputs');
        }

    }

    public function fetchSchool()
    {

        $res = $this->db->query("SELECT * FROM `school`");
        $numRows = $res->num_rows;

        if ($numRows > 0) {
            $data = [];
            while ($row = $res->fetch_assoc()) {
                array_push($data, $row);

            }

            echo $this->out($data);
        }
    }

    public function deleteSchool(int $id = 0)
    {
        $res = $this->db->query(" DELETE FROM `school` WHERE `Id` = '$id' ");
        if ($res) {
            return $this->message('successful');
        } else {
            return $this->message($this->db->error);
        }
    }

    public function updateSchool(int $id, string $school)
    {
        $res = $this->db->query("UPDATE `school` SET `school` = '$school' WHERE `Id` = '$id' ");

        if ($res) {
            return $this->message('successful');
        } else {
            echo $this->message($this->db->error);
        }
    }

    public function addDepartment(string $dept, int $schId)
    {
        $res1 = $this->db->query("SELECT * FROM `department` WHERE `dept` = '$dept'");
        $numRows = $res1->num_rows;

        if ($numRows === 0) {
            $res = $this->db->query("INSERT INTO `department`(`dept`, `school_Id`) VALUES ('$dept','$schId')");
            if ($res) {
                return $this->message('successful');
            } else {
                return $this->message($this->db->error);
            }

        } else {
            return $this->message('exists');
        }
    }

    public function fetchDept(int $id = 0)
    {

        if ($id != 0) {
            //fetches corresponding  dept in schools
            $res = $this->db->query("SELECT department.*, school.* FROM department JOIN school ON department.school_Id = school.Id WHERE department.school_Id = '$id'");
            $numRows = $res->num_rows;

            if ($numRows > 0) {
                $data = [];

                while ($row = $res->fetch_assoc()) {
                    array_push($data, $row);
                }
                return $this->out($data);
            }
        } else {
            //fetches all department
            $res = $this->db->query("SELECT school.*,department.* FROM department JOIN school ON department.school_Id = school.Id ");
            $numRows = $res->num_rows;

            if ($numRows > 0) {

                $data = [];

                while ($rw = $res->fetch_assoc()) {
                    array_push($data, $rw);
                }
                return $this->out($data);
            }
        }

    }

    public function updateDepartment(string $dept, int $schId, int $id = 0)
    {
        $res = $this->db->query("UPDATE `department` SET `dept`='$dept',`school_Id`='$schId' WHERE `Id` = '$id'");
        if ($res) {
            return $this->message('updated');
        } else {
            return $this->message($this->db->error);
        }
    }

    public function deleteDept(int $id)
    {
        $res = $this->db->query("DELETE FROM `department` WHERE `Id` = '$id'");
        if ($res) {
            return $this->message('successful');
        } else {
            return $this->message($this->db->error);
        }
    }

    public function addCourse(string $course, string $course_code, int $level, int $dept)
    {
        $res1 = $this->db->query("SELECT * FROM `course` WHERE `course_code` = '$course_code' AND `course` = '$course'");
        $numRows = $res1->num_rows;

        if ($numRows === 0) {
            $res = $this->db->query("INSERT INTO `course`( `course`, `course_code`, `level_Id`, `dept_id`) VALUES ('$course','$course_code','$level','$dept')");
            if ($res) {
                return $this->message('successful');
            } else {
                return $this->message($this->db->error);
            }
        } else {
            return $this->message('exists');
        }
    }

    public function fetchCourses(int $id = 0)
    {

        $res = $this->db->query("SELECT department.*,level.*,course.* FROM course JOIN level ON course.level_Id = level.Id JOIN department ON course.dept_id = department.Id  ");
        $numRows = $res->num_rows;

        if ($numRows > 0) {
            $data = [];
            while ($rw = $res->fetch_assoc()) {
                array_push($data, $rw);
            }
            return $this->out($data);
        }
    }

    public function get_Course($levelId, $deptId)
    {

        $res = $this->db->query("SELECT * FROM `course` WHERE `level_Id`= $levelId AND `dept_id`=$deptId");

        $numRows = $res->num_rows;
        if ($numRows > 0) {
            $data = [];

            while ($rw = $res->fetch_assoc()) {
                array_push($data, $rw);
            }

            return $this->out($data);
        }

    }

    public function updateCourses(string $course, string $course_code, int $lvl, int $dept, $id = 0)
    {
        $res = $this->db->query("UPDATE `course` SET `course`='$course',`course_code`='$course_code',`level_Id` = '$lvl',`dept_id`='$dept' WHERE `Id` = '$id'");
        if ($res) {
            return $this->message('updated');
        } else {
            return $this->message($this->db->error);
        }
    }

    public function deleteCourse(int $id = 0)
    {
        $res = $this->db->query("DELETE FROM `course` WHERE `Id` = '$id'");
        if ($res) {
            return $this->message('successful');
        } else {
            return $this->message($this->db->error);
        }
    }

    public function getlevel()
    {
        $stmt = $this->db->prepare("SELECT * FROM `level`");
        $stmt->execute();
        $res = $stmt->get_result();
        $numRows = $res->num_rows;

        if ($numRows > 0) {
            $data = [];
            while ($rw = $res->fetch_assoc()) {
                array_push($data, $rw);
            }
            return $this->out($data);
        }
    }

    public function addLecturers(string $name, array $course)
    {

        if ($name === "" && $course === "") {
            return $this->message('Invalid inputs');
        } else {
            $checkifUserExists = $this->db->query("SELECT * FROM `user` WHERE `username` = '$name'");
            $numRow = $checkifUserExists->num_rows;

            if ($numRow === 0) {
                $pass = util::generateRand(8);
                $res = $this->db->query("INSERT INTO `user`( `username`, `password`, `type`) VALUES ('$name','$pass','1')");

                if ($res) {
                    $lecturerId = $this->db->insert_id;

                    foreach ($course as $key => $value) {
                        $res1 = $this->db->query("INSERT INTO `lecturer_course`(`lecturerId`, `courseId_1`, `time_created`) VALUES ('$lecturerId','$value',NOW())");

                    }

                    return $this->message($pass);

                }

            } else {
                return $this->message('exists');
            }
        }

    }

    public function updateLectures(int $userId, string $name, string $course, int $id = 0)
    {

        $res = $db->query("UPDATE `user` SET `username` = '$name' WHERE `Id` = '$userId' ");
        if ($res) {
            // return $this->message('success');
            $res1 = $this->db->query("UPDATE `lecturer_course` SET `course` = '$course' WHERE `Id` = '$id'");

            if ($res1) {
                return $this->message('success');
            }
        }
    }

    public function deletelectures(int $id = 0)
    {
        $res = $this->db->query("DELETE FROM `lecturer_course` WHERE `Id` = '$id'");
        $res2 = $this->db->query("DELETE FROM `user` WHERE `Id`=$id");
        if ($res && $res2) {
            return $this->message('successful');
        }
    }

    public function fetchlecturers()
    {
        $res = $this->db->query("SELECT course.*, user.*, user.Id as UID, lecturer_course.*,lecturer_course.Id AS lid FROM lecturer_course JOIN user ON lecturerId = user.Id JOIN course ON courseId_1 = course.Id");
        $numRow = $res->num_rows;

        if ($numRow > 0) {
            // $data = [];

            while ($row = $res->fetch_assoc()) {
                $Id = $row['lid'];
                $name = $row['username'];
                $course = $row['course'];
                $course_code = $row['course_code'];
                $uid = $row['UID'];

                $data[] = array("lid" => $Id, "course" => $course, 'courseCode' => $course_code, "name" => $name, "lecturerId" => $uid);

            }

            return $this->out($data);

        }
    }

    public function addStudents(string $name, int $regnum, int $dept_Id, int $levelId, array $course)
    {
        $checkifStudentExists = $this->db->query("SELECT * FROM `students` WHERE `name`= '$name' ");
        $numRow = $checkifStudentExists->num_rows;

        if ($numRow === 0) {
            $unique = util::generateRand(16);

            $sql = "INSERT INTO `students`(`name`, `regNum`, `dept_Id`, `level_Id`, `date_created`,`uniqueCode`) VALUES ('$name','$regnum','$dept_Id','$levelId',NOW(),'$unique')";

            $res = $this->db->query($sql);
            if ($res) {
                $studentId = $this->db->insert_id;

                foreach ($course as $key => $value) {
                    $res1 = $this->db->query("INSERT INTO `student_course`(`student_Id`,`courseId`,`date_created`) VALUES ('$studentId','$value',NOW())");

                    if ($res1) {
                        return $this->message($unique);
                    }
                }
            }

        } else {
            return $this->message('Student exist');
        }
    }

    public function fetchStudents()
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

    public function edit_student(string $name, int $regNum, int $levelId, int $deptId)
    {

    }
    public function delete_student(int $id = 0)
    {
        $res = $this->db->query("DELETE FROM `students` WHERE `Id` = $id");
        $res1 = $this->db->query("DELETE FROM `student_course` WHERE `student_Id` = $id");
        if ($res && $res1) {
            return $this->message('Deleted');
        } else {
            return $this->db->error();
        }

    }

    public function enroll()
    {
        return exec('c:/Fingerprint/enroll.jar');
    }

    public function get_total_course()
    {
        $sql = $this->db->query("Select ifnull(((select COUNT(`Id`) from `course` )),0) AS total_course");
        $rw = $sql->fetch_assoc();
        return $this->out($rw);
    }

    public function get_total_departments()
    {
        $sql = $this->db->query("Select ifnull(((select COUNT(`Id`) from `department` )),0) AS total_depts");
        $rw = $sql->fetch_assoc();
        return $this->out($rw);
    }

    public function get_total_students()
    {
        $sql = $this->db->query("Select ifnull(((select COUNT(`Id`) from `students` )),0) AS total_students");
        $rw = $sql->fetch_assoc();
        return $this->out($rw);
    }

    public function get_total_lecturers()
    {
        $sql = $this->db->query("Select ifnull(((select COUNT(`Id`) from `user`where username != 'admin' )),0) AS total_lecturers");
        $rw = $sql->fetch_assoc();
        return $this->out($rw);
    }

}
