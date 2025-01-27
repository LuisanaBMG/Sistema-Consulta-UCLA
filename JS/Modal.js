// Wait for the DOM content to be fully loaded before executing
document.addEventListener('DOMContentLoaded', function () {
    // Handle view button click 
    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', function () {
            var row = this.closest('tr');
            var idStudy = row.cells[0].textContent;
            var AcronymsType = row.cells[1].textContent;
            var studyName = row.cells[2].textContent;
            var studyDate = row.cells[3].textContent;

            // Fill form fields with data from clicked row
            document.getElementById('Id_Study_Types').value = idStudy;
            document.getElementById('Acronyms_Study').value = AcronymsType;
            document.getElementById('Study_Type').value = studyName;
            document.getElementById('Date_Study').value = studyDate;

            // Hide save and delete buttons, disable form fields
            document.querySelector('.save-changes-btn').style.display = 'none';
            document.querySelector('.delete-btn').style.display = 'none';
            document.querySelectorAll('#studyTypeForm input, #studyTypeForm select').forEach(field => {
                field.disabled = true;
            });
        });
    });

    // Handle edit button click 
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            var row = this.closest('tr');
            var idStudy = row.cells[0].textContent;
            var AcronymsType = row.cells[1].textContent;
            var studyName = row.cells[2].textContent;
            var studyDate = row.cells[3].textContent;

            // Fill form fields with data from clicked row
            document.getElementById('Id_Study_Types').value = idStudy;
            document.getElementById('Acronyms_Study').value = AcronymsType;
            document.getElementById('Study_Type').value = studyName;
            document.getElementById('Date_Study').value = studyDate;

            // Show save and delete buttons, enable form fields
            document.querySelector('.save-changes-btn').style.display = 'inline-block';
            document.querySelector('.delete-btn').style.display = 'inline-block';
            document.querySelectorAll('#studyTypeForm input, #studyTypeForm select').forEach(field => {
                field.disabled = false;
            });
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Handle view button click for studies
    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', function () {
            var row = this.closest('tr');
            var Id_Units = row.cells[0].textContent;
            var Acronyms_Unit = row.cells[1].textContent;
            var Attached_Unit = row.cells[2].textContent;
            var Date_Unit = row.cells[3].textContent;

            document.getElementById('Id_Units').value = Id_Units;
            document.getElementById('Acronyms_Unit').value = Acronyms_Unit;
            document.getElementById('Attached_Unit').value = Attached_Unit;
            document.getElementById('Date_Unit').value = Date_Unit;

            document.querySelector('.save-changes-unit').style.display = 'none';
            document.querySelector('.delete-btn-unit').style.display = 'none';

            document.querySelectorAll('#unitForm input').forEach(field => {
                field.disabled = true;
            });
        });
    });

    document.querySelectorAll('.edit-btn').forEach(button => {
        // Handle edit button click 
        button.addEventListener('click', function () {
            var row = this.closest('tr');
            var Id_Units = row.cells[0].textContent;
            var Acronyms_Unit = row.cells[1].textContent;
            var Attached_Unit = row.cells[2].textContent;
            var Date_Unit = row.cells[3].textContent;

            document.getElementById('Id_Units').value = Id_Units;
            document.getElementById('Acronyms_Unit').value = Acronyms_Unit;
            document.getElementById('Attached_Unit').value = Attached_Unit;
            document.getElementById('Date_Unit').value = Date_Unit;

            document.querySelector('.save-changes-unit').style.display = 'inline-block';
            document.querySelector('.delete-btn-unit').style.display = 'inline-block';

            document.querySelectorAll('#unitForm input').forEach(field => {
                field.disabled = false;
            });
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Handle view button click for studies
    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', function () {
            var row = this.closest('tr');
            var Id_Academy = row.cells[0].textContent;
            var Academy_Number = row.cells[1].textContent;
            var Academy_Name = row.cells[2].textContent;
            var Academy_Date = row.cells[3].textContent;

            document.getElementById('Id_Academy').value = Id_Academy;
            document.getElementById('Academy_Number').value = Academy_Number;
            document.getElementById('Academy_Name').value = Academy_Name;
            document.getElementById('Academy_Date').value = Academy_Date;

            document.querySelector('.save-changes-ac').style.display = 'none';
            document.querySelector('.delete-btn-ac').style.display = 'none';

            document.querySelectorAll('#academyForm input').forEach(field => {
                field.disabled = true;
            });
        });
    });
    document.querySelectorAll('.edit-btn').forEach(button => {
        // Handle edit button click 
        button.addEventListener('click', function () {
            var row = this.closest('tr');
            var Id_Academy = row.cells[0].textContent;
            var Academy_Number = row.cells[1].textContent;
            var Academy_Name = row.cells[2].textContent;
            var Academy_Date = row.cells[3].textContent;

            document.getElementById('Id_Academy').value = Id_Academy;
            document.getElementById('Academy_Number').value = Academy_Number;
            document.getElementById('Academy_Name').value = Academy_Name;
            document.getElementById('Academy_Date').value = Academy_Date;

            document.querySelector('.save-changes-ac').style.display = 'inline-block';
            document.querySelector('.delete-btn-ac').style.display = 'inline-block';

            document.querySelectorAll('#academyForm input').forEach(field => {
                field.disabled = false;
            });
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Handle view button click for studies
    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', function () {
            var row = this.closest('tr');
            var Id_Resources = row.cells[0].textContent;
            var Acronyms_Resource = row.cells[1].textContent;
            var Resource_Name = row.cells[2].textContent;
            var Date_Resource = row.cells[3].textContent;

            document.getElementById('Id_Resources').value = Id_Resources;
            document.getElementById('Acronyms_Resource').value = Acronyms_Resource;
            document.getElementById('Resource_Name').value = Resource_Name;
            document.getElementById('Date_Resource').value = Date_Resource;

            document.querySelector('.save-changes-ur').style.display = 'none';
            document.querySelector('.delete-btn-ur').style.display = 'none';

            document.querySelectorAll('#resourcesForm input').forEach(field => {
                field.disabled = true;
            });
        });
    });

    document.querySelectorAll('.edit-btn').forEach(button => {
        // Handle edit button click 
        button.addEventListener('click', function () {
            var row = this.closest('tr');
            var Id_Resources = row.cells[0].textContent;
            var Acronyms_Resource = row.cells[1].textContent;
            var Resource_Name = row.cells[2].textContent;
            var Date_Resource = row.cells[3].textContent;

            document.getElementById('Id_Resources').value = Id_Resources;
            document.getElementById('Acronyms_Resource').value = Acronyms_Resource;
            document.getElementById('Resource_Name').value = Resource_Name;
            document.getElementById('Date_Resource').value = Date_Resource;

            document.querySelector('.save-changes-ur').style.display = 'inline-block';
            document.querySelector('.delete-btn-ur').style.display = 'inline-block';

            document.querySelectorAll('#resourcesForm input').forEach(field => {
                field.disabled = false;
            });
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Handle view button click for studies
    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', function () {
            var row = this.closest('tr');
            var Id_Associate = row.cells[0].textContent;
            var Associate_Name = row.cells[1].textContent;
            var Associate_Comment = row.cells[2].textContent;
            var Associate_Date = row.cells[3].textContent;

            document.getElementById('Id_Associate').value = Id_Associate;
            document.getElementById('Associate_Name').value = Associate_Name;
            document.getElementById('Associate_Comment').value = Associate_Comment;
            document.getElementById('Associate_Date').value = Associate_Date;

            document.querySelector('.save-changes-as').style.display = 'none';
            document.querySelector('.delete-btn-as').style.display = 'none';

            document.querySelectorAll('#associateForm input').forEach(field => {
                field.disabled = true;
            });
        });
    });
    document.querySelectorAll('.edit-btn').forEach(button => {
        // Handle edit button click 
        button.addEventListener('click', function () {
            var row = this.closest('tr');
            var Id_Associate = row.cells[0].textContent;
            var Associate_Name = row.cells[1].textContent;
            var Associate_Comment = row.cells[2].textContent;
            var Associate_Date = row.cells[3].textContent;

            document.getElementById('Id_Associate').value = Id_Associate;
            document.getElementById('Associate_Name').value = Associate_Name;
            document.getElementById('Associate_Comment').value = Associate_Comment;
            document.getElementById('Associate_Date').value = Associate_Date;

            document.querySelector('.save-changes-as').style.display = 'inline-block';
            document.querySelector('.delete-btn-as').style.display = 'inline-block';

            document.querySelectorAll('#associateForm input').forEach(field => {
                field.disabled = false;
            });
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Handle view button click for studies
    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', function () {
            var row = this.closest('tr');
            var Id_Responsible = row.cells[0].textContent;
            var Document_Type = row.cells[1].textContent;
            var Identification_Document = row.cells[2].textContent;
            var Date_Birth = row.cells[4].textContent;
            var First_Name = row.cells[5].textContent;
            var Second_Name = row.cells[6].textContent;
            var First_LastName = row.cells[7].textContent;
            var Second_LastName = row.cells[8].textContent;
            var Phone_Number = row.cells[10].textContent;
            var Email = row.cells[11].textContent;
            var Gender = row.cells[12].textContent;
            var Comment_Responsible = row.cells[13].textContent;
            var Date_Responsible = row.cells[14].textContent;

            document.getElementById('Id_Responsible').value = Id_Responsible;
            document.getElementById('Document_Type').value = Document_Type;
            document.getElementById('Identification_Document').value = Identification_Document;
            document.getElementById('Date_Birth').value = Date_Birth;
            document.getElementById('First_Name').value = First_Name;
            document.getElementById('Second_Name').value = Second_Name;
            document.getElementById('First_LastName').value = First_LastName;
            document.getElementById('Second_LastName').value = Second_LastName;
            document.getElementById('Phone_Number').value = Phone_Number;
            document.getElementById('Email').value = Email;
            document.getElementById('Gender').value = Gender;
            document.getElementById('Comment_Responsible').value = Comment_Responsible;
            document.getElementById('Date_Responsible').value = Date_Responsible;

            document.querySelector('.save-changes-rp').style.display = 'none';
            document.querySelector('.delete-btn-rp').style.display = 'none';

            document.querySelectorAll('#responsibleForm input, #responsibleForm select').forEach(field => {
                field.disabled = true;
            });
        });
    });

    document.querySelectorAll('.edit-btn').forEach(button => {
        // Handle edit button click 
        button.addEventListener('click', function () {
            var row = this.closest('tr');
            var Id_Responsible = row.cells[0].textContent;
            var Document_Type = row.cells[1].textContent;
            var Identification_Document = row.cells[2].textContent;
            var Date_Birth = row.cells[4].textContent;
            var First_Name = row.cells[5].textContent;
            var Second_Name = row.cells[6].textContent;
            var First_LastName = row.cells[7].textContent;
            var Second_LastName = row.cells[8].textContent;
            var Phone_Number = row.cells[10].textContent;
            var Email = row.cells[11].textContent;
            var Gender = row.cells[12].textContent;
            var Comment_Responsible = row.cells[13].textContent;
            var Date_Responsible = row.cells[14].textContent;

            document.getElementById('Id_Responsible').value = Id_Responsible;
            document.getElementById('Document_Type').value = Document_Type;
            document.getElementById('Identification_Document').value = Identification_Document;
            document.getElementById('Date_Birth').value = Date_Birth;
            document.getElementById('First_Name').value = First_Name;
            document.getElementById('Second_Name').value = Second_Name;
            document.getElementById('First_LastName').value = First_LastName;
            document.getElementById('Second_LastName').value = Second_LastName;
            document.getElementById('Phone_Number').value = Phone_Number;
            document.getElementById('Email').value = Email;
            document.getElementById('Gender').value = Gender;
            document.getElementById('Comment_Responsible').value = Comment_Responsible;
            document.getElementById('Date_Responsible').value = Date_Responsible;

            document.querySelector('.save-changes-rp').style.display = 'inline-block';
            document.querySelector('.delete-btn-rp').style.display = 'inline-block';

            document.querySelectorAll('#responsibleForm input, #responsibleForm select').forEach(field => {
                field.disabled = false;
            });
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Handle view button click for studies
    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', function () {
            var row = this.closest('tr');
            var Id_RA = row.cells[0].textContent;
            var A_Name = row.cells[1].textContent;
            var Full_Name = row.cells[2].textContent;
            var Date_AR = row.cells[3].textContent;

            document.getElementById('Id_RA').value = Id_RA;
            document.getElementById('A_Name').value = A_Name;
            document.getElementById('Full_Name').value = Full_Name;
            document.getElementById('Date_AR').value = Date_AR;

            document.querySelector('.save-changes-asr').style.display = 'none';
            document.querySelector('.input').style.display = 'inline-block';
            document.querySelector('.select').style.display = 'none';

            document.querySelectorAll('#ARForm input, #ARForm select').forEach(field => {
                field.disabled = true;
            });
        });
    });

    document.querySelectorAll('.edit-btn').forEach(button => {
        // Handle edit button click 
        button.addEventListener('click', function () {
            var row = this.closest('tr');
            var Id_RA = row.cells[0].textContent;
            var A_Name = row.cells[1].textContent;
            var Full_Name = row.cells[2].textContent;
            var Date_AR = row.cells[3].textContent;

            document.getElementById('Id_RA').value = Id_RA;
            document.getElementById('A_Name').value = A_Name;
            document.getElementById('Full_Name').value = Full_Name;
            document.getElementById('Date_AR').value = Date_AR;

            document.querySelector('.save-changes-asr').style.display = 'inline-block';
            document.querySelector('.input').style.display = 'none';
            document.querySelector('.select').style.display = 'inline-block';

            document.querySelectorAll('#ARForm input, #ARForm select').forEach(field => {
                field.disabled = false;
            });
        });
    });
});



document.addEventListener('DOMContentLoaded', function () {
    // Handle view button click for studies
    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', function () {
            var row = this.closest('tr');
            var Id_Studies = row.cells[0].textContent;
            var Study_Code = row.cells[1].textContent;
            var Study_Name = row.cells[2].textContent;
            var Cohort = row.cells[3].textContent;
            var Year = row.cells[4].textContent;
            var Identification_Document = row.cells[5].textContent;
            var Number_Hours = row.cells[6].textContent;
            var Comment_Studies = row.cells[7].textContent;
            var Id_Study_Types = row.cells[8].textContent;
            var Study_Type = row.cells[9].textContent;
            var Id_Units = row.cells[10].textContent;
            var Attached_Unit = row.cells[11].textContent;
            var Id_Academy = row.cells[12].textContent;
            var Academy_Name = row.cells[13].textContent;
            var Id_RA = row.cells[14].textContent;
            var Associate = row.cells[15].textContent;
            var Start_Date = row.cells[16].textContent;
            var Termination_Date = row.cells[17].textContent;
            var Date = row.cells[18].textContent;

            document.getElementById('Id_Studies').value = Id_Studies;
            document.getElementById('Study_Code').value = Study_Code;
            document.getElementById('Study_Name').value = Study_Name;
            document.getElementById('Cohort').value = Cohort
            document.getElementById('Year').value = Year;
            document.getElementById('Identification_Document').value = Identification_Document;
            document.getElementById('Number_Hours').value = Number_Hours;
            document.getElementById('Comment_Studies').value = Comment_Studies;
            document.getElementById('Id_Study_Types').value = Id_Study_Types;
            document.getElementById('Study_Type').value = Study_Type;
            document.getElementById('Id_Units').value = Id_Units;
            document.getElementById('Attached_Unit').value = Attached_Unit;
            document.getElementById('Id_Academy').value = Id_Academy;
            document.getElementById('Academy_Name').value = Academy_Name;
            document.getElementById('Id_RA').value = Id_RA;
            document.getElementById('Associate').value = Associate;
            document.getElementById('Start_Date').value = Start_Date;
            document.getElementById('Termination_Date').value = Termination_Date;
            document.getElementById('Date').value = Date;

            document.querySelector('.save-changes-st').style.display = 'none';
            document.querySelector('.delete-btn-st').style.display = 'none';
            document.querySelector('.input-st').style.display = 'inline-block';
            document.querySelector('.select-st').style.display = 'none';
            document.querySelector('.input-ac').style.display = 'inline-block';
            document.querySelector('.select-ac').style.display = 'none';
            document.querySelector('.input-ut').style.display = 'inline-block';
            document.querySelector('.select-ut').style.display = 'none';
            document.querySelector('.input-ra').style.display = 'inline-block';
            document.querySelector('.select-ra').style.display = 'none';

            document.querySelectorAll('#StudyForm input, #StudyForm select').forEach(field => {
                field.disabled = true;
            });
        });
    });


    document.querySelectorAll('.edit-btn').forEach(button => {
        // Handle edit button click 
        button.addEventListener('click', function () {
            var row = this.closest('tr');
            var Id_Studies = row.cells[0].textContent;
            var Study_Code = row.cells[1].textContent;
            var Study_Name = row.cells[2].textContent;
            var Cohort = row.cells[3].textContent;
            var Year = row.cells[4].textContent;
            var Identification_Document = row.cells[5].textContent;
            var Number_Hours = row.cells[6].textContent;
            var Comment_Studies = row.cells[7].textContent;
            var Id_Study_Types = row.cells[8].textContent;
            var Study_Type = row.cells[9].textContent;
            var Id_Units = row.cells[10].textContent;
            var Attached_Unit = row.cells[11].textContent;
            var Id_Academy = row.cells[12].textContent;
            var Academy_Name = row.cells[13].textContent;
            var Id_RA = row.cells[14].textContent;
            var Associate = row.cells[15].textContent;
            var Start_Date = row.cells[16].textContent;
            var Termination_Date = row.cells[17].textContent;
            var Date = row.cells[18].textContent;

            document.getElementById('Id_Studies').value = Id_Studies;
            document.getElementById('Study_Code').value = Study_Code;
            document.getElementById('Study_Name').value = Study_Name;
            document.getElementById('Cohort').value = Cohort;
            document.getElementById('Year').value = Year;
            document.getElementById('Identification_Document').value = Identification_Document;
            document.getElementById('Number_Hours').value = Number_Hours;
            document.getElementById('Comment_Studies').value = Comment_Studies;
            document.getElementById('Id_Study_Types').value = Id_Study_Types;
            document.getElementById('Study_Type').value = Study_Type;
            document.getElementById('Id_Units').value = Id_Units;
            document.getElementById('Attached_Unit').value = Attached_Unit;
            document.getElementById('Id_Academy').value = Id_Academy;
            document.getElementById('Academy_Name').value = Academy_Name;
            document.getElementById('Id_RA').value = Id_RA;
            document.getElementById('Associate').value = Associate;
            document.getElementById('Start_Date').value = Start_Date;
            document.getElementById('Termination_Date').value = Termination_Date;
            document.getElementById('Date').value = Date;


            document.querySelector('.save-changes-st').style.display = 'inline-block';
            document.querySelector('.delete-btn-st').style.display = 'inline-block';
            document.querySelector('.input-st').style.display = 'none';
            document.querySelector('.select-st').style.display = 'inline-block';
            document.querySelector('.input-ac').style.display = 'none';
            document.querySelector('.select-ac').style.display = 'inline-block';
            document.querySelector('.input-ut').style.display = 'none';
            document.querySelector('.select-ut').style.display = 'inline-block';
            document.querySelector('.input-ra').style.display = 'none';
            document.querySelector('.select-ra').style.display = 'inline-block';


            document.querySelectorAll('#StudyForm input, #StudyForm select').forEach(field => {
                field.disabled = false;
            });
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Handle view button click for studies
    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', function () {
            var row = this.closest('tr');
            var Id_Student = row.cells[0].textContent;
            var Document_Type = row.cells[1].textContent;
            var Identification_Document = row.cells[2].textContent;
            var First_Name = row.cells[4].textContent;
            var Second_Name = row.cells[5].textContent;
            var First_LastName = row.cells[6].textContent;
            var Second_LastName = row.cells[7].textContent;
            var Study_Name = row.cells[9].textContent;
            var Date_Birth = row.cells[10].textContent;
            var Email = row.cells[11].textContent;
            var Phone_Number = row.cells[12].textContent;
            var Gender = row.cells[13].textContent;
            var Comment_Student = row.cells[14].textContent;
            var Id_Student_Studies = row.cells[15].textContent;
            var Id_Studies = row.cells[16].textContent;
            var Book = row.cells[17].textContent;
            var Folio = row.cells[18].textContent;
            var Line = row.cells[19].textContent;
            var Start_Date = row.cells[20].textContent;
            var Termination_Date = row.cells[21].textContent;
            var Comment_SS = row.cells[22].textContent;
            var Date = row.cells[23].textContent;

            document.getElementById('Id_Student').value = Id_Student;
            document.getElementById('Document_Type').value = Document_Type;
            document.getElementById('Identification_Document').value = Identification_Document;
            document.getElementById('First_Name').value = First_Name;
            document.getElementById('Second_Name').value = Second_Name;
            document.getElementById('First_LastName').value = First_LastName;
            document.getElementById('Second_LastName').value = Second_LastName;
            document.getElementById('Study_Name').value = Study_Name;
            document.getElementById('Date_Birth').value = Date_Birth;
            document.getElementById('Email').value = Email;
            document.getElementById('Phone_Number').value = Phone_Number;
            document.getElementById('Gender').value = Gender;
            document.getElementById('Comment_Student').value = Comment_Student;
            document.getElementById('Id_Student_Studies').value = Id_Student_Studies;
            document.getElementById('Id_Studies').value = Id_Studies;
            document.getElementById('Book').value = Book;
            document.getElementById('Folio').value = Folio;
            document.getElementById('Line').value = Line;
            document.getElementById('Start_Date').value = Start_Date;
            document.getElementById('Termination_Date').value = Termination_Date;
            document.getElementById('Comment_SS').value = Comment_SS;
            document.getElementById('Date').value = Date;

            document.querySelector('.save-changes-sd').style.display = 'none';
            document.querySelector('.delete-btn-sd').style.display = 'none';

            document.querySelector('.input-sd').style.display = 'inline-block';
            document.querySelector('.select-sd').style.display = 'none';

            document.querySelectorAll('#StudentForm input, #StudentForm select').forEach(field => {
                field.disabled = true;
            });
        });
    });
    document.querySelectorAll('.edit-btn').forEach(button => {
        // Handle edit button click 
        button.addEventListener('click', function () {
            var row = this.closest('tr');
            var Id_Student = row.cells[0].textContent;
            var Document_Type = row.cells[1].textContent;
            var Identification_Document = row.cells[2].textContent;
            var First_Name = row.cells[4].textContent;
            var Second_Name = row.cells[5].textContent;
            var First_LastName = row.cells[6].textContent;
            var Second_LastName = row.cells[7].textContent;
            var Study_Name = row.cells[9].textContent;
            var Date_Birth = row.cells[10].textContent;
            var Email = row.cells[11].textContent;
            var Phone_Number = row.cells[12].textContent;
            var Gender = row.cells[13].textContent;
            var Comment_Student = row.cells[14].textContent;
            var Id_Student_Studies = row.cells[15].textContent;
            var Id_Studies = row.cells[16].textContent;
            var Book = row.cells[17].textContent;
            var Folio = row.cells[18].textContent;
            var Line = row.cells[19].textContent;
            var Start_Date = row.cells[20].textContent;
            var Termination_Date = row.cells[21].textContent;
            var Comment_SS = row.cells[22].textContent;
            var Date = row.cells[23].textContent;

            document.getElementById('Id_Student').value = Id_Student;
            document.getElementById('Document_Type').value = Document_Type;
            document.getElementById('Identification_Document').value = Identification_Document;
            document.getElementById('First_Name').value = First_Name;
            document.getElementById('Second_Name').value = Second_Name;
            document.getElementById('First_LastName').value = First_LastName;
            document.getElementById('Second_LastName').value = Second_LastName;
            document.getElementById('Study_Name').value = Study_Name;
            document.getElementById('Date_Birth').value = Date_Birth;
            document.getElementById('Email').value = Email;
            document.getElementById('Phone_Number').value = Phone_Number;
            document.getElementById('Gender').value = Gender;
            document.getElementById('Comment_Student').value = Comment_Student;
            document.getElementById('Id_Student_Studies').value = Id_Student_Studies;
            document.getElementById('Id_Studies').value = Id_Studies;
            document.getElementById('Book').value = Book;
            document.getElementById('Folio').value = Folio;
            document.getElementById('Line').value = Line;
            document.getElementById('Start_Date').value = Start_Date;
            document.getElementById('Termination_Date').value = Termination_Date;
            document.getElementById('Comment_SS').value = Comment_SS;
            document.getElementById('Date').value = Date;

            document.querySelector('.save-changes-sd').style.display = 'inline-block';
            document.querySelector('.delete-btn-sd').style.display = 'inline-block';

            document.querySelector('.input-sd').style.display = 'none';
            document.querySelector('.select-sd').style.display = 'inline-block';


            document.querySelectorAll('#StudentForm input, #StudentForm select').forEach(field => {
                field.disabled = false;
            });
        });
    });
});