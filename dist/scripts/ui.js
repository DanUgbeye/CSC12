class UI {
  constructor() {
     
  }
  
  showAlert = async (message) => {

    let alert = document.querySelector('#alert');
    alert.innerHTML = message;
    alert.classList.remove('hidden');

    setTimeout(() => {
      alert.textContent = '';
      alert.classList.add('hidden');
    }, 2000)
  }

  getMatricNo() {
    const matricNo = document.querySelector('#search').value;
    return matricNo;
  }

  showPopup(message) {
    let popup = document.querySelector('#popup');
    popup.innerHTML = 
      `
        ${message}
        <span>
          <img src="../../res/images/done.svg" />
        </span>
      `;
    popup.classList.remove('hidden');
    popup.classList.add('flex');

    setTimeout(() => {
      popup.textContent = '';
      popup.classList.add('hidden');
      popup.classList.remove('flex');
    }, 1500)
  }

  displayStudent(student, user) {
    document.querySelector('#surname').value = student.surname;
    document.querySelector('#firstname').value = student.firstname;
    document.querySelector('#middlename').value = student.middlename;
    document.querySelector('#d-o-b').value = student.dob;    
    document.querySelector('#nationality').value = student.nationality;
    document.querySelector('#state').value = student.state;
    document.querySelector('#lga').value = student.lga;
    document.querySelector('#matric-no').value = student.matricNo;
    document.querySelector('#level').value = student.level;

    if(user == 'student'){
      document.querySelector('#dis-mat-no').textContent = student.matricNo;
    }
  }

  clearFields() {

    document.querySelector('#surname').value = '';
    document.querySelector('#firstname').value = '';
    document.querySelector('#middlename').value = '';
    document.querySelector('#d-o-b').disabled = false;
    document.querySelector('#d-o-b').value = 'yyyy-mm-dd';
    document.querySelector('#d-o-b').disabled = true;
    document.querySelector('#nationality').value = '';
    document.querySelector('#state').value = '';
    document.querySelector('#lga').value = '';
    document.querySelector('#matric-no').value = '';
    document.querySelector('#level').value = '100';

  }

  disableFields() {

    document.querySelector('#surname').disabled = true;
    document.querySelector('#firstname').disabled = true;
    document.querySelector('#middlename').disabled = true;

    document.querySelector('#d-o-b').classList.remove('bg-[white]');
    document.querySelector('#d-o-b').classList.add('bg-[transparent]');
    document.querySelector('#d-o-b').disabled = true;

    document.querySelector('#nationality').disabled = true;
    document.querySelector('#state').disabled = true;
    document.querySelector('#lga').disabled = true;
    document.querySelector('#matric-no').disabled = true;

    document.querySelector('#level').classList.remove('bg-[white]');
    document.querySelector('#level').classList.add('bg-[transparent]');
    document.querySelector('#level').disabled = true;

  }

  enableFields() {

    document.querySelector('#surname').disabled = false;
    document.querySelector('#firstname').disabled = false;
    document.querySelector('#middlename').disabled = false;

    document.querySelector('#d-o-b').classList.remove('bg-[transparent]');
    document.querySelector('#d-o-b').classList.add('bg-[white]');
    document.querySelector('#d-o-b').disabled = false;

    document.querySelector('#nationality').disabled = false;
    document.querySelector('#state').disabled = false;
    document.querySelector('#lga').disabled = false;
    document.querySelector('#matric-no').disabled = false;

    document.querySelector('#level').disabled = false;
    document.querySelector('#level').classList.remove('bg-[transparent]');
    document.querySelector('#level').classList.add('bg-[white]');

  }

  clearSearchField() {
    document.querySelector('#search').value = '';
  }

  displayAllStudents(students) {

    let table = `
      <table id="table" class="relative w-full">

      <thead class="w-full bg-gray-300  text-left font-[500]  ">
        <td class="p-[10px] rounded-tl-lg ">Matric No</td>
        <td class="p-[10px] rounded-tr-lg md:rounded-[0]">Name</td>
        <td class="md:rounded-tr-lg lg:rounded-[0] w-0 invisible absolute md:relative overflow-hidden pointer-events-none md:pointer-events-auto md:visible md:w-[fit-content] ">Nationality</td>
        <td class="w-0 invisible absolute lg:relative overflow-hidden pointer-events-none lg:pointer-events-auto lg:visible lg:w-[fit-content] ">State of Origin</td>
        <td class="rounded-tr-lg w-0 invisible absolute lg:relative overflow-hidden pointer-events-none lg:pointer-events-auto lg:visible lg:w-[fit-content] ">Date of Birth</td>
      </thead>

      <tbody>
    `;

    if(students.length != 0){

      students.forEach(student => {
        table += 
          ` 
            <tr class="p-[27px] text-left border-t border-[#BDBDBD] ">
              <td class="p-[10px] ">
                ${student.matricNo}
              </td>
              <td class="p-[10px] rounded-tr-lg md:rounded-[0]">
                ${student.surname} ${student.firstname}
              </td>
              <td class="md:rounded-tr-lg lg:rounded-[0] w-0 invisible absolute md:relative overflow-hidden pointer-events-none md:pointer-events-auto md:visible md:w-[fit-content] " >
                ${student.nationality}
              </td>
              <td class="w-0 invisible absolute lg:relative overflow-hidden pointer-events-none lg:pointer-events-auto lg:visible lg:w-[fit-content] " >
                ${student.state}
              </td>
              <td class="w-0 invisible absolute lg:relative overflow-hidden pointer-events-none lg:pointer-events-auto lg:visible lg:w-[fit-content] " >
                ${student.dob}
              </td>
            </tr>
          `;
      });

      table += 
      `
          </tbody>
        </table>
      `;

      document.querySelector('#table').innerHTML = table;

    }else {
      
      table += 
      `<tr class="relative min-h-[30px] p-[27px] text-left font-[500] border-t border-[#BDBDBD] ">
        <td class="p-[10px] text-[24px] opacity-[0]">.</td>
        <p class=" absolute text-gray-400 bottom-[5px] left-0 right-0 p-[10px] text-[24px] text-center ">
          No students in this level
        </p>
      </tr>
      `;

      table += 
      `
          </tbody>
        </table>
      `;

      document.querySelector('#table').innerHTML = table;
    }
  }

  getStudent() {
    let student = {};

    student.surname = document.querySelector('#surname').value;
    student.firstname = document.querySelector('#firstname').value;
    student.middlename = document.querySelector('#middlename').value;
    student.dob = document.querySelector('#d-o-b').value;
    student.nationality = document.querySelector('#nationality').value;
    student.state = document.querySelector('#state').value;
    student.lga = document.querySelector('#lga').value;
    student.matricNo = document.querySelector('#matric-no').value;
    student.level = document.querySelector('#level').value;

    return student;
  }

  displayStats(stats) {

    if(stats){
      document.querySelector('#no-yr-1').textContent = stats.yr1;
      document.querySelector('#no-yr-2').textContent = stats.yr2;
      document.querySelector('#no-yr-3').textContent = stats.yr3;
      document.querySelector('#no-yr-4').textContent = stats.yr4; 
    }
  }


}