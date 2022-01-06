
const login = new LOGIN;
const ui = new UI;
const studentOp = new STUDENT;

// admin login function
const adminLogin = async () => {

  const email = document.querySelector('#email').value;
  const password = document.querySelector('#password').value;

  let message = '';

  if(email == '' || password == ''){

    if(email == '' && password == ''){
      message = 'input your email address and password';
    }else {
      if(email == '' ){
        message = 'input your email address';
      }
      if(password == '' ){
        message += 'input your password';
      }
    }
    ui.showAlert(message);

  }else {

    const res = await login.adminLogin(email, password);
    if(!res.error){

      if(res.profile != {}) {

        //saves the user data to localstorage
        localStorage.setItem('adminProfile', JSON.stringify({
          username: res.profile.email,
          status: 'loggedIn'
        }
        ));

        document.querySelector('#email').value = '';
        document.querySelector('#password').value = '';
        window.location.href = '../../admin';
      }

    }else{
      ui.showAlert(res.error);
    }
    
  }
}

// Student login function
const studentLogin = async () => {

  const matricNo = document.querySelector('#matric-no').value;
  const pin = document.querySelector('#pin').value;

  let message = '';

  if(matricNo == '' || pin == ''){

    if(matricNo == '' && pin == ''){
      message = 'input your matric number and pin';
    }else {
      if(matricNo == '' ){
        message = 'input your matric number';
      }
      if(pin == '' ){
        message += 'input your pin';
      }
    }
    ui.showAlert(message);
    
  }else {

    const res = await login.studentLogin(matricNo, pin);
    if(!res.error){

      if(res.profile != {}) {

        //saves the user data to localstorage
        localStorage.setItem('studentProfile', JSON.stringify({
          matricNo: res.profile.matricNo,
          status: 'loggedIn'
        }
        ));

        document.querySelector('#pin').value = '';
        document.querySelector('#matric-no').value = '';
        window.location.href = '../../student';
      }

    }else{
      ui.showAlert(res.error);
    }

  }

}

//creates a new student
const createStudent = async () => {

  const student = ui.getStudent();
  let invalid = studentOp.isInvalid(student);
  
  if(!invalid) {
    const res = await studentOp.createStudent(student);

    if(!res.error) {
      ui.showPopup('student created');
      ui.clearFields();

      let replace = setTimeout(() => {
        window.location.href = '../../admin';
        window.clearTimeout(replace);
      }, 1500);

    }else {
      ui.showAlert(res.error);
    }
  }else {
    ui.showAlert('Input all the fields');
  }

}

const deleteStudent = async () => {

  const matricNo = ui.getMatricNo();

  // const stdObj = await studentOp.getStudent(matricNo);
  // if(!stdObj.error) {
  //   ui.displayStudent(stdObj.student);
  // }

  const res = await studentOp.deleteStudent(matricNo);
  if(!res.error){
    ui.clearFields();
    ui.clearSearchField();
    ui.showPopup('deleted');
  }else {
    ui.showAlert(res.error);
  }
}

//displays the logged in student's data after a sucessful login
const displayStudent = async (user) => {

  if(user == 'student'){

    //Checking if a user is logged in
    if(login.studentIsLoggedIn()) {
  
      //checking if student data is saved in local storage
      const savedData = JSON.parse(localStorage.getItem('student'));
      
      //if there is no saved data fetch from the api
      if(!savedData){
        
        //get the matric no of logged in student
        const profile = JSON.parse(localStorage.getItem('studentProfile'));
        const data = await studentOp.getStudent(profile.matricNo);
  
        if(!data.error){
          //save the fetched data 
          window.localStorage.setItem('student', JSON.stringify(data.student));
          ui.displayStudent(data.student, user);
        }else {
          ui.showAlert(data.error);
        }
  
      }else {
        //if saved data display it
        ui.displayStudent(savedData, user);
      }
      
    }
  }else if(user == 'admin') {

    //Checking if a user is logged in
    if(login.adminIsLoggedIn()) {
      
      //get the matric no of logged in student
      const matricNo = ui.getMatricNo();
 
      if(matricNo){
        
        const data = await studentOp.getStudent(matricNo);
        if(!data.error){

          const editBtn = document.querySelector('#edit');
          //add event listener to the edit button when the search button is clicked
          editBtn.addEventListener('click', () => {
            
            //if edit button is clicked
            ui.enableFields();

            //hide the edit button
            editBtn.classList.remove('flex');
            editBtn.classList.add('hidden');

            const saveBtn = document.querySelector('#save');

            //show the save button
            saveBtn.classList.remove('hidden');
            saveBtn.classList.add('flex');

            saveBtn.addEventListener('click', async () => {
              //update student record if the save button is clicked
              const status = await updateStudent('admin');
              
              if(status) {
                //if save button is clicked and update is successful
                ui.disableFields();

                //hide the save button
                saveBtn.classList.remove('flex');
                saveBtn.classList.add('hidden');
  
                //show the edit button
                editBtn.classList.remove('hidden');
                editBtn.classList.add('flex');
              }
            })
      
          })

          const deleteBtn = document.querySelector('#delete');
          deleteBtn.addEventListener('click', () => {
            const confirmed = confirm('Are you Sure you want to delete this student \n It CANNOT BE UNDONE !');
            if(confirmed) {
              deleteStudent();
            }
          })
          if(data.student) {
            ui.displayStudent(data.student, user);
          }

        }else {
          ui.showAlert(data.error);
        }
  
      }else {
        //if no input matric number
        ui.showAlert('input a matric number');
      }
      
    }
  }
  
}

//displays the number of students in each level
const displayStats = async () => {

  const statObj = await studentOp.getStats();

  if(!statObj.error) {
    ui.displayStats(statObj.stats);
  }else {
    ui.showAlert('error fetching stats');
  }

}

//displaying all students in a lvel on the admin panel
const displayAllStudents = async () => {

  if(login.adminIsLoggedIn()) {

    displayStats();

    const level = document.querySelector('#level').value;
    const res = await studentOp.getStudents(level);
  
    if(!res.error) {
  
      if(res.students) {
        ui.displayAllStudents(res.students);
      }
      
    }else {
  
      ui.showAlert('something went wrong');
  
    }
  }


}

//this removes a saved user from local storage
const expire = (user) => {

  if(user == 'student') {
    localStorage.removeItem('studentProfile');
    localStorage.removeItem('student');
  }else if(user ='admin') {
    localStorage.removeItem('adminProfile');
  }
}

// checking if  user is logged in , if not redirect to login page
const check = async (url, user) => {
  
  let loginStat;
  if(user == 'student') {
    loginStat = login.studentIsLoggedIn();

    if(!loginStat) {
      ui.showAlert('You must login first !');
    
      setTimeout(() => {
        ui.showAlert('redirecting to login page');
        window.clearTimeout();
      }, 2000)
    
      let replace = setTimeout(() => {
        window.location.href = url;
        window.clearTimeout(replace);
      }, 4500);
    }
  }else if(user == 'admin') {
    loginStat = login.adminIsLoggedIn();

    if(!loginStat) {
      ui.showAlert('You must login first !');
    
      setTimeout(() => {
        ui.showAlert('redirecting to login page');
        window.clearTimeout();
      }, 2000)
    
      let replace = setTimeout(() => {
        window.location.href = url;
        window.clearTimeout(replace);
      }, 4500);
    }
  }

}

//This saves a student data after edit
const updateStudent = async (user) => {

  const student = ui.getStudent();
  if(studentOp.isInvalid(student)) {
    ui.showAlert('Fill all the fields');
    return false;
  }
  let savedData;

  if(user == 'student') {
    //if student is logged in, get his data from localstorage
    savedData = JSON.parse(localStorage.getItem('student'));
  }else if(user == 'admin') {
    // if admin is logged in, get matric no from the search bar
    const matricNo = ui.getMatricNo();

    //fetch the student with the matric no
    const resObj = await studentOp.getStudent(matricNo);
    if(resObj.error) {
      //if error show the error and end function
      ui.showAlert(resObj.error);
      //send a status to the admin if the update failed
      if(user == 'admin') return false;
    }else {
      if(resObj.student) {
        savedData = resObj.student;
      }
    }
  }

  let match = studentOp.compare(student, savedData);

  if(match){
    await ui.showAlert('No changes have been made');
    //send a status to the admin if the update failed
    if(user == 'admin') return false;
  }else {
    const res = await studentOp.updateStudent(student, savedData.matricNo);
    if(!res.error){

      // localStorage.setItem('studentProfile', JSON.stringify({
        //     matricNo: res.student.matricNo,
        //     status: 'loggedIn'
        //   })
        // );

      ui.showPopup('saved');
        
      if(user == 'student') {
        localStorage.setItem('student', JSON.stringify(res.student));
  
        let replace = setTimeout(() => {
          window.location.href = '../../student';
          window.clearTimeout(replace);
        }, 1300);
      }else if(user == 'admin') {
        // let replace = setTimeout(() => {
        //   window.location.href = '../../admin';
        //   window.clearTimeout(replace);
        // }, 1300);

        //send a status to the admin if the update was successful
        return true;
      }
        
    }else {
      ui.showAlert('an error occured');
      if(user == 'admin') {
        //send a status to the admin if the update failed
        return false;
      }
    }
  }

}

//Adding an event listener for clicks to the whole document
document.addEventListener('click', async (e) => {

  //if the admin login button is clicked
  if(e.target.id == 'admin-login') {
    await adminLogin();
  }

  //if the student login button is clicked
  if(e.target.id == 'student-login') {
    await studentLogin();
  }

  //saves student when save button is clicked
  if(e.target.id == 'save-std') {
    await updateStudent('student');
  }

  if(e.target.id == 'edit' || e.target.id == 'delete') {
    let student = ui.getStudent();
    if(studentOp.isInvalid(student)) {
      ui.showAlert('Search a matric number first');
    }
  }

  //creates a new student whhen the save button is clicked
  if(e.target.id == 'create-student') {
    await createStudent();
  }

  //clears the search field when it is clicked
  if(e.target.id == 'search') {
    ui.clearSearchField();
  }
  
})

//Adding event listeners for keypress
document.addEventListener('keypress', (e) => {
  
  //if enter key is pressed display the student with the inputted matric no
  if(e.key == 'Enter' && e.target.id == 'search') {
    displayStudent('admin');
  }

  // console.log(e);
})

//Adding event listeners for input
document.addEventListener('input', (e) => {
  
  //if enter key is pressed display the student with the inputted matric no
  if(e.target.id == 'search') {
    ui.clearFields();
  }

  // console.log(e);
})
