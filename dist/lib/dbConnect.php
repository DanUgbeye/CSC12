<?php

  class dbConnect {

    const HOST = 'localhost';

    const USERNAME = 'deedee';

    const PASSWORD = '123456';

    const DATABASENAME = 'csc12';

    public $conn;

    function __construct(){

      $this->conn = $this->getConnection();

    }

    //creates a connection to the database
    function getConnection() {

      $conn = new mysqli(self::HOST, self::USERNAME, self::PASSWORD, self::DATABASENAME);
      // Check for connection error
      if ($conn->connect_error) {
        echo("Problem with connecting to database.". $conn->connect_error);
      }
      $conn->set_charset("utf8");
      return $conn;
    }

  }

  class dbOperations extends dbConnect {

    //this searches the database for a student account and returns it if any is found
    function studentLogin($matric_no, $pin) {

      $data = array();
      $query = "SELECT id, matric_no, surname, first_name, middle_name, nationality,
       state, lga, level FROM students WHERE matric_no = '".$matric_no. "' AND pin = '".$pin."'";
      $res = $this->conn->query($query);

      if($res->num_rows > 0) {
        $resp = $res->fetch_array();
        $data['status'] = true;
        $data['result'] = $resp;
        return $data;
      }else {
        $data['status'] = false;
        $data['error'] = 'Invalid matric number or pin'; 
        return $data;
      }
    }

    //compares 2 student details if they are equal and returns a boolean
    function compare($student1, $student2) {

      if($student1['surname'] == $student2['surname'] && 
      $student1['first_name'] == $student2['first_name'] &&
      $student1['middle_name'] == $student2['middle_name'] &&
      $student1['dob'] == $student2['dob'] &&
      $student1['nationality'] == $student2['nationality'] &&
      $student1['state'] == $student2['state'] &&
      $student1['lga'] == $student2['lga'] &&
      $student1['matric_no'] == $student2['matric_no'] &&
      $student1['level'] == $student2['level'] ){

        if(!empty($student1['id']) && !empty($student2['id'])) {
          if($student1['id'] == $student2['id']) {
            return true;
          }else {
            return false;
          }
        }
        return true;

      }else {

        return false;

      }

    }

    //updates student details
    function updateStudent($student = array(), $id) {
      
      $data = array();
      //checking if any change was made in the student details before updating
      $res = $this->getStudentById($id);
      if($res['status']) {
        $match = $this->compare($res['result'], $student);
        if($match) {
          $data['status'] = false;
          $data['error'] = 'no changes have been made';
          return $data;
        }
      }else {
        $data['status'] = false;
        $data['error'] = 'invalid ID';
        return $data;
      }

      $query = "UPDATE `students` SET `matric_no`='".$student['matric_no']."',`surname`='".$student['surname']."',
      `first_name`='".$student['first_name']."',`middle_name`='".$student['middle_name']."',`dob`='".$student['dob']."',
      `nationality`='".$student['nationality']."',`state`='".$student['state']."',`lga`='".$student['lga']."',
      `level`='".$student['level']."'
      WHERE id ='".$id."'";

      $res = $this->conn->query($query);
      if($res->affected_rows > 0 ) {
        $resp = $res->fetch_array();
        $res = $this->getStudentById($id);
        $data['status'] = true;
        $data['result'] = $resp['result'];
        return $data;        
        
      }else {
        $data['status'] = false;
        $data['error'] = 'update details failed';
        return $data;
      }

    }

    //get student details using id only, this function is used by an admin only
    function getStudentById($id) {

      $data = array();
      $query = "SELECT id, matric_no, surname, first_name, middle_name, nationality,
      state, lga, level FROM students WHERE id = '".$id."'";
      $res = $this->conn->query($query);

      if($res->num_rows > 0) {
        $resp = $res->fetch_array();
        $data['status'] = true;
        $data['result'] = $resp;
        return $data;
      }else {
        $data['status'] = false;
        $data['error'] = 'Invalid id'; 
        return $data;
      }

    }


  }

  class adminDb extends dbOperations {

    
    //this searches the database for an admin account and returns it if any is found
    function adminLogin($email, $password) {

      $data = array();
      $query = "SELECT username, email FROM admin WHERE email = '".$email. "' AND password = '".$password."'";
      $res = $this->conn->query($query);

      if($res->num_rows > 0) {
        $resp = $res->fetch_array();
        $data['status'] = true;
        $data['result'] = $resp;
        return $data;
      }else {
        $data['status'] = false;
        $data['error'] = 'Invalid email or password';
        return $data;
      }

    }

    //creates a new student on the database
    function createStudent($student = array()) {

      $data = array();
      if(!empty($student)) {

        //checking if another student exists with the matric number
        $res = $this->getStudentByMatricNo($student['matric_no']);
        if($res['status'] = true) {
          $data['status'] = false;
          $data['error'] = 'matric number already exists';
          return $data;
        }

        $query = "INSERT INTO `students`( `matric_no`, `surname`, `first_name`, `middle_name`, `dob`,
          `nationality`, `state`, `lga`, `level`, `pin`)
          VALUES ('".$student['matric_no']."','".$student['surname']."','".$student['first_name']."','".$student['middle_name']."
          ','".$student['dob']."','".$student['nationality']."','".$student['state']."','".$student['lga']."
          ','".$student['level']."','".$student['pin']."')";

          $res = $this->conn->query($query);

          //if there is a response from the db
          if($res) {

          //check if that student exist on the db after insertion
            $resp = $this->getStudentByMatricNo($student['matric_no']);
            if($resp['status']) {

            //after getting the student on the db, compare if details match
            $match = $this->compare($student, $resp['result']);
              if($match) {
                //if match, return true meaning student is created successfully
                $data['status'] = true;
                $data['result'] = $resp['result'];
                return $data;
              }
            }else {
              //if student does not exist on db after insertion
              $data['status'] = false;
              $data['error'] = 'failed to create: student not found after inserting!'; 
              return $data;
            }
          }else {
            //if there is no response from db
            $data['status'] = false;
            $data['error'] = 'failed to create'; 
          }

      }

    }

    //this deletes a student data using either matric number or id
    function deleteStudent($param, $paramName) {

      $data = array();

      $query = "DELETE FROM `students` WHERE ";
      if($paramName == 'id') {
        $query += "id = '".$param."'";
      }elseif($paramName == 'matric_no') {
        $query += "matric_no = '".$param."'";
      }

      $res = $this->conn->query($query);
      if($res && $res->affected_rows > 0) {
        $data['status'] = true;
        return $data;
      }else {
        $data['status'] = false;
        $data['error'] = 'delete operation failed';
      }

    }

    //gets all the students in a partiular level
    function getAllStudents($level) {

      $data = array();
      $query = "SELECT id, matric_no, surname, first_name, middle_name, nationality,
       state, lga, dob, level FROM students WHERE level = '".$level."'";
      $res = $this->conn->query($query);

      if($res->num_rows > 0) {
        $no = 0;
        while($row = $res->fetch_assoc()) {
          $resp[$no] = $row;
          // echo $resp[$no]['matric_no'];
          $no++;
        }
        
        $data['status'] = true;
        $data['result'] = $resp;
        return $data;
      }else {
        $data['status'] = false;
        $data['error'] = 'no students in this level'; 
        return $data;
      }
    }

    //gets the total number of students in a level
    function getNoOfStudents($level) {

      $data = array();
      $query = "SELECT id FROM students WHERE level = '".$level."'";
      $res = $this->conn->query($query);

      $no = $res->num_rows;
      $data['result'] = $no;    
      $data['status'] = true;
      return $data;
      
    }

    //get student details using matric number only, this function is used by an admin only
    function getStudentByMatricNo($matric_no) {

      $data = array();
      $query = "SELECT id, matric_no, surname, first_name, middle_name, nationality,
       state, lga, level FROM students WHERE matric_no = '".$matric_no."'";
      $res = $this->conn->query($query);

      if($res->num_rows > 0) {
        $resp = $res->fetch_array();
        $data['status'] = true;
        $data['result'] = $resp;
        return $data;
      }else {
        $data['status'] = false;
        $data['error'] = 'Invalid matric number'; 
        return $data;
      }

    }

   
  }

?>