

//  {
//   "surname": "",
//   "firstname": "",
//   "middlename": "",
//   "dob": "",
//   "nationality": "",
//   "state": "",
//   "lga": "",
//   "matricNo": "",
//   "level": ""
// }

// {
//   "id": 1,
//   "surname": "Iyoriobhe",
//   "firstname": "Wisdom",
//   "middlename": "Ose",
//   "dob": "03/12/2001",
//   "nationality": "Nigerian",
//   "state": "Edo",
//   "lga": "Benin",
//   "matricNo": "17/184145015",
//   "level": "300"
// }


// METHODS
// compare(student1, student2)
// getStats()
// getStudents(level)
// getStudent(matricNo, level)
// createStudent(student)
// getID(matricNo)
// updateStudent(student)
// deleteStudent(matricNo)


class STUDENT {


  //COMPARES TWO STUDENT OBJECTS
  compare(student1, student2) {

    if(student1.surname == student2.surname && 
      student1.firstname == student2.firstname &&
      student1.middlename == student2.middlename &&
      student1.dob == student2.dob &&
      student1.nationality == student2.nationality &&
      student1.state == student2.state &&
      student1.lga == student2.lga &&
      student1.matricNo == student2.matricNo &&
      student1.level == student2.level ){

        //if id exists in both objects
        if(student1.id && student2.id){
          if(student1.id == student2.id){
            return true;
          }else {
            return false;
          }
        }else {
          return true;
        }
    }else {
      return false;
    }
  }

  //checks if all the student keys have value
  isInvalid(student) {

    if(student.surname == '' || student.firstname == '' ||
      student.middlename == '' || student.dob == '' ||
      student.nationality == '' || student.state == '' ||
      student.lga == '' ||  student.matricNo == '' ||
      student.level == ''  ){

        return true;
    }else {
      return false;
    }


  }

  //GET ALL THE NUMBER OF STUDENTS OIN EACH LEVEL
  async getStats() {

    let error;
    let stats = {};
    try{

      for (let i = 100; i <= 400; i += 100) {
        const res = await fetch(`http://localhost:3000/students?level=${i}`);
        const students = await res.json();

        if(i==100){
          stats.yr1 = students.length;
        }
        if(i==200){
          stats.yr2 = students.length;
        }
        if(i==300){
          stats.yr3 = students.length;
        }
        if(i==400){
          stats.yr4 = students.length;
        }
      }
      
      return {
        stats,
        error
      };

    }catch(err) {

      error = err.message;
      return {
        error
      };

    }

  }

// GET ALL STUDENT FUNCTION
  async getStudents(level) {

    let error;
    try{

      const res = await fetch(`http://localhost:3000/students?level=${level}`);
      const students = await res.json();
      return {
        students,
        error
      }

    }catch(err){

      error = err.message;
      return {
        error
      };

    }
 
  }

// GET SINGLE STUDENT FUNCTION
  async getStudent(matricNo) {

    let error;
    try{

      const res = await fetch(`http://localhost:3000/students?matricNo=${matricNo}`);
      const student = await res.json();

      if(student.length == 1) {
        // if a single student is returned
        return {
          student: student[0],
          error
        };
      }else if(student.length == 0){
        //if no student is returned
        return {
          error: 'invalid matric number'
        }
      }else {
        //if more than one student is returned
        return {
          error: 'a fatal error occured, duplicate matric numbers found'
        }
      }

    }catch(err){

      return {
        error: 'an error occured: ' + err.message
      };

    } 

  }

// CREATE STUDENT FUNCTION
  async createStudent(student) {

    let error;
    //CHECKING IF STUDENT ALREADY EXISTS
    let std = await this.getStudent(student.matricNo);

    if(std.error != 'invalid matric number'){
      console.log(std.error)
      return {
        error: 'an error occured'
      };
    }else if(std.student) {
      return {
        error: 'matric number already exists'
      };
    }else {

      try{
  
        const res = await fetch(`http://localhost:3000/students/`, {
          method : "POST",
          headers : {
            "Content-type" : "application/json"
          } ,
          body : JSON.stringify(student)
        });
        const students = await res.json();
        return {
          students,
          error
        };
  
      }catch(err){
  
        error = err.message;
        return {
          error: 'error creating student'
        };
  
      }

    }

  }

// GET STUDENT ID FUNCTION
  async getID(matricNo) {

    let error;
    try{

      const res = await fetch(`http://localhost:3000/students?matricNo=${matricNo}`);
      const student = await res.json();

      if(student.length > 0){
        const ID = student[0].id;
        return {
          ID,
          error
        };
      }else{
        return{
          error: 'invalid matric no'
        }
      }
      
    }catch(err){
      
      return {
        error: 'error fetching data'
      };
      
    }

    

  }

//  UPDATE STUDENT FUNCTION 
  async updateStudent(studentData, matricNo) {

    let error;
    //GETTING THE STUDENT ID FIRST
    let resObj = await this.getID(matricNo);
    if(resObj.error){
      return {
        error: resObj.error
      };
    }

    let id = resObj.ID;

    try{

      const res = await fetch(`http://localhost:3000/students/${id}`, {
        method : "PUT",
        headers : {
          "Content-type" : "application/json"
        } ,
        body : JSON.stringify(studentData)
      });
      //returns a single student object not an array
      const student = await res.json();
      return {
        student,
        error
      };

    }catch(err){

      error = err.message;
      return {
        error
      }

    }

  }

// DELETE STUDENT FUNCTION
  async deleteStudent(matricNo) {

    let error;
    //GETTING THE STUDENT ID FIRST
    let resObj = await this.getID(matricNo);
    if(resObj.error){
      return {
        error: resObj.error
      };
    }
    let id = resObj.ID;

    try{
      const res = await fetch(`http://localhost:3000/students/${id}`, {
        method : "DELETE",
        headers : {
          "Content-type" : "application/json"
        }
      });
      const student = await res.json();
      return {
        student,
        error
      };

    }catch(err){

      error= err.message;
      return {
        error
      };

    }
    
  }


}