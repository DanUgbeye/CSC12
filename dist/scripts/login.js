class LOGIN {
  constructor() {

  }

  adminLogin = async (email, password) => {

    let error;
    try{

      const res = await fetch(`http://localhost:3000/admins?email=${email}&password=${password}`);
      const resObj = await res.json();

      if(resObj.length > 0) {
        const profile = resObj[0];
        if(profile.email === email && profile.password === password) {
          return {
            profile,
            error
          };
        }
      }else {
        return {
          error: 'invalid email or password'
        }
      }

    }catch(err){
      
      return {
        error: 'an error occured'
      };
    }
    
  }

  studentLogin = async (matricNo, pin) => {

    let error;
    try{
      const res = await fetch(`http://localhost:3000/users?matricNo=${matricNo}&pin=${pin}`);
      const resObj = await res.json();
      
      if(resObj.length > 0){
        const profile = resObj[0];
        if(profile.matricNo === matricNo && profile.pin === pin) {
          return {
            profile,
            error
          };
        }
      }else {
        return {
          error: 'invalid matric no or password'
        }
      }
      
    }catch(err){
      return {
        error: 'an error occured'
      };
    }

  }

  adminIsLoggedIn =  () => {

    const data =  JSON.parse(localStorage.getItem('adminProfile'));
    if(data){
      if(data.username && data.status == 'loggedIn'){
        return true;
      }else {
        return false;
      }
    }else {
      return false;
    }

  }

  studentIsLoggedIn = () => {

    const data =  JSON.parse(localStorage.getItem('studentProfile'));
    if(data){
      if(data.matricNo && data.status == 'loggedIn'){
        return true;
      }else {
        return false;
      }
    }else {
      return false;
    }

  }

}