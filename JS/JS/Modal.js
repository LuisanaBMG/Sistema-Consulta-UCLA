// Wait for the DOM content to be fully loaded before executing
document.addEventListener('DOMContentLoaded', function () {
    // Handle view button click 
    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', function () {
            var row = this.closest('tr');
            var idProgram = row.cells[0].textContent;
            var AcronymsType = row.cells[1].textContent;
            var programName = row.cells[2].textContent;
            var programDate = row.cells[3].textContent;

            // Fill form fields with data from clicked row
            document.getElementById('Id_Program_Types').value = idProgram;
            document.getElementById('Acronyms_Program').value = AcronymsType;
            document.getElementById('Program_Type').value = programName;
            document.getElementById('Date_Program').value = programDate;

            // Hide save and delete buttons, disable form fields
            document.querySelector('.save-changes-btn').style.display = 'none';
            document.querySelector('.delete-btn').style.display = 'none';
            document.querySelectorAll('#programTypeForm input, #programTypeForm select').forEach(field => {
                field.disabled = true;
            });
        });
    });

    // Handle edit button click 
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            var row = this.closest('tr');
            var idProgram = row.cells[0].textContent;
            var AcronymsType = row.cells[1].textContent;
            var programName = row.cells[2].textContent;
            var programDate = row.cells[3].textContent;

            // Fill form fields with data from clicked row
            document.getElementById('Id_Program_Types').value = idProgram;
            document.getElementById('Acronyms_Program').value = AcronymsType;
            document.getElementById('Program_Type').value = programName;
            document.getElementById('Date_Program').value = programDate;

            // Show save and delete buttons, enable form fields
            document.querySelector('.save-changes-btn').style.display = 'inline-block';
            document.querySelector('.delete-btn').style.display = 'inline-block';
            document.querySelectorAll('#programTypeForm input, #programTypeForm select').forEach(field => {
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
            var Id_Organization = row.cells[0].textContent;
            var Organization_Number = row.cells[1].textContent;
            var Organization_Name = row.cells[2].textContent;
            var Responsible_Id = row.cells[3].textContent;
            var Organization_Date = row.cells[4].textContent;

            document.getElementById('Id_Organization').value = Id_Organization;
            document.getElementById('Organization_Number').value = Organization_Number;
            document.getElementById('Organization_Name').value = Organization_Name;
            document.getElementById('Responsible_Id').value = Responsible_Id;
            document.getElementById('Organization_Date').value = Organization_Date;

            document.querySelector('.input-id').style.display = 'inline-block';
            document.querySelector('.select-id').style.display = 'none';
            document.querySelector('.save-changes-ac').style.display = 'none';
            document.querySelector('.delete-btn-ac').style.display = 'none';

            document.querySelectorAll('#organizationForm input, #organizationForm select').forEach(field => {
                field.disabled = true;
            });
        });
    });
    document.querySelectorAll('.edit-btn').forEach(button => {
        // Handle edit button click 
        button.addEventListener('click', function () {
            var row = this.closest('tr');
            var Id_Organization = row.cells[0].textContent;
            var Organization_Number = row.cells[1].textContent;
            var Organization_Name = row.cells[2].textContent;
            var Responsible_Id = row.cells[3].textContent;
            var Organization_Date = row.cells[4].textContent;

            document.getElementById('Id_Organization').value = Id_Organization;
            document.getElementById('Organization_Number').value = Organization_Number;
            document.getElementById('Organization_Name').value = Organization_Name;
            document.getElementById('Responsible_Id').value = Responsible_Id;
            document.getElementById('Organization_Date').value = Organization_Date;

            document.querySelector('.input-id').style.display = 'none';
            document.querySelector('.select-id').style.display = 'inline-block';
            document.querySelector('.save-changes-ac').style.display = 'inline-block';
            document.querySelector('.delete-btn-ac').style.display = 'inline-block';

            document.querySelectorAll('#organizationForm input, #organizationForm select').forEach(field => {
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
            var Approval_Date = row.cells[3].textContent;
            var Date_Resource = row.cells[4].textContent;

            document.getElementById('Id_Resources').value = Id_Resources;
            document.getElementById('Acronyms_Resource').value = Acronyms_Resource;
            document.getElementById('Resource_Name').value = Resource_Name;
            document.getElementById('Approval_Date').value = Approval_Date;
            document.getElementById('Date_Resource').value = Date_Resource;

            document.querySelector('.save-changes-ur').style.display = 'none';
            document.querySelector('.delete-btn-ur').style.display = 'none';

            document.querySelectorAll('#resourcesForm input, #resourcesForm select').forEach(field => {
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
            var Approval_Date = row.cells[3].textContent;
            var Date_Resource = row.cells[4].textContent;

            document.getElementById('Id_Resources').value = Id_Resources;
            document.getElementById('Acronyms_Resource').value = Acronyms_Resource;
            document.getElementById('Resource_Name').value = Resource_Name;
            document.getElementById('Approval_Date').value = Approval_Date;
            document.getElementById('Date_Resource').value = Date_Resource;

            document.querySelector('.save-changes-ur').style.display = 'inline-block';
            document.querySelector('.delete-btn-ur').style.display = 'inline-block';

            document.querySelectorAll('#resourcesForm input, #resourcesForm select').forEach(field => {
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
            var First_Name = row.cells[4].textContent;
            var Second_Name = row.cells[5].textContent;
            var First_LastName = row.cells[6].textContent;
            var Second_LastName = row.cells[7].textContent;
            var Phone_Number = row.cells[9].textContent;
            var Email = row.cells[10].textContent;
            var Gender = row.cells[11].textContent;
            var Type_Responsible = row.cells[12].textContent;
            var Status_Responsible = row.cells[13].textContent;
            var Comment_Responsible = row.cells[14].textContent;
            var Date_Responsible = row.cells[15].textContent;

            document.getElementById('Id_Responsible').value = Id_Responsible;
            document.getElementById('Document_Type').value = Document_Type;
            document.getElementById('Identification_Document').value = Identification_Document;
            document.getElementById('First_Name').value = First_Name;
            document.getElementById('Second_Name').value = Second_Name;
            document.getElementById('First_LastName').value = First_LastName;
            document.getElementById('Second_LastName').value = Second_LastName;
            document.getElementById('Phone_Number').value = Phone_Number;
            document.getElementById('Email').value = Email;
            document.getElementById('Gender').value = Gender;
            document.getElementById('Type_Responsible').value = Type_Responsible;
            document.getElementById('Status_Responsible').value = Status_Responsible;
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
            var First_Name = row.cells[4].textContent;
            var Second_Name = row.cells[5].textContent;
            var First_LastName = row.cells[6].textContent;
            var Second_LastName = row.cells[7].textContent;
            var Phone_Number = row.cells[9].textContent;
            var Email = row.cells[10].textContent;
            var Gender = row.cells[11].textContent;
            var Type_Responsible = row.cells[12].textContent;
            var Status_Responsible = row.cells[13].textContent;
            var Comment_Responsible = row.cells[14].textContent;
            var Date_Responsible = row.cells[15].textContent;

            document.getElementById('Id_Responsible').value = Id_Responsible;
            document.getElementById('Document_Type').value = Document_Type;
            document.getElementById('Identification_Document').value = Identification_Document;
            document.getElementById('First_Name').value = First_Name;
            document.getElementById('Second_Name').value = Second_Name;
            document.getElementById('First_LastName').value = First_LastName;
            document.getElementById('Second_LastName').value = Second_LastName;
            document.getElementById('Phone_Number').value = Phone_Number;
            document.getElementById('Email').value = Email;
            document.getElementById('Gender').value = Gender;
            document.getElementById('Type_Responsible').value = Type_Responsible;
            document.getElementById('Status_Responsible').value = Status_Responsible;
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
            var Id_Program = row.cells[0].textContent;
            var Program_Code = row.cells[1].textContent;
            var Program_Name = row.cells[2].textContent;
            var Year = row.cells[3].textContent;
            var Comment_Programs = row.cells[4].textContent;
            var Number_Hours = row.cells[5].textContent;
            var Approval_Date = row.cells[6].textContent;
            var Id_Cohort = row.cells[7].textContent;
            var Cohort = row.cells[8].textContent;
            var Number_Females = row.cells[9].textContent;
            var Number_Males = row.cells[10].textContent;
            var Start_Date = row.cells[11].textContent;
            var Termination_Date = row.cells[12].textContent;
            var Comment_Cohort = row.cells[13].textContent;
            var Id_Program_Types = row.cells[14].textContent;
            var Program_Type = row.cells[15].textContent;
            var Id_Units = row.cells[16].textContent;
            var Attached_Unit = row.cells[17].textContent;
            var Id_Organization = row.cells[18].textContent;
            var Organization_Name = row.cells[19].textContent;
            var Id_Resources = row.cells[20].textContent;
            var Acronyms_Resource = row.cells[21].textContent;
            var Date = row.cells[22].textContent;

            document.getElementById('Id_Program').value = Id_Program;
            document.getElementById('Program_Code').value = Program_Code;
            document.getElementById('Program_Name').value = Program_Name;       
            document.getElementById('Year').value = Year;           
            document.getElementById('Comment_Programs').value = Comment_Programs;
            document.getElementById('Number_Hours').value = Number_Hours;
            document.getElementById('Approval_Date').value = Approval_Date;
            document.getElementById('Id_Cohort').value = Id_Cohort;
            document.getElementById('Cohort').value = Cohort;
            document.getElementById('Number_Females').value = Number_Females;
            document.getElementById('Number_Males').value = Number_Males;
            document.getElementById('Start_Date').value = Start_Date;
            document.getElementById('Termination_Date').value = Termination_Date;
            document.getElementById('Comment_Cohort').value = Comment_Cohort;
            document.getElementById('Id_Program_Types').value = Id_Program_Types;
            document.getElementById('Program_Type').value = Program_Type;
            document.getElementById('Id_Units').value = Id_Units;
            document.getElementById('Attached_Unit').value = Attached_Unit;
            document.getElementById('Id_Organization').value = Id_Organization;
            document.getElementById('Organization_Name').value = Organization_Name;
            document.getElementById('Id_Resources').value = Id_Resources;
            document.getElementById('Acronyms_Resource').value = Acronyms_Resource;
            document.getElementById('Date').value = Date;

            document.querySelector('.save-changes-st').style.display = 'none';
            document.querySelector('.delete-btn-st').style.display = 'none';
            document.querySelector('.input-st').style.display = 'inline-block';
            document.querySelector('.select-st').style.display = 'none';
            document.querySelector('.input-ac').style.display = 'inline-block';
            document.querySelector('.select-ac').style.display = 'none';
            document.querySelector('.input-ut').style.display = 'inline-block';
            document.querySelector('.select-ut').style.display = 'none';
            document.querySelector('.input-ar').style.display = 'inline-block';
            document.querySelector('.select-ar').style.display = 'none';

            document.querySelectorAll('#ProgramForm input, #ProgramForm select').forEach(field => {
                field.disabled = true;
            });
        });
    });


    document.querySelectorAll('.edit-btn').forEach(button => {
        // Handle edit button click 
        button.addEventListener('click', function () {
            var row = this.closest('tr');
            var Id_Program = row.cells[0].textContent;
            var Program_Code = row.cells[1].textContent;
            var Program_Name = row.cells[2].textContent;
            var Year = row.cells[3].textContent;
            var Comment_Programs = row.cells[4].textContent;
            var Number_Hours = row.cells[5].textContent;
            var Approval_Date = row.cells[6].textContent;
            var Id_Cohort = row.cells[7].textContent;
            var Cohort = row.cells[8].textContent;
            var Number_Females = row.cells[9].textContent;
            var Number_Males = row.cells[10].textContent;
            var Start_Date = row.cells[11].textContent;
            var Termination_Date = row.cells[12].textContent;
            var Comment_Cohort = row.cells[13].textContent;
            var Id_Program_Types = row.cells[14].textContent;
            var Program_Type = row.cells[15].textContent;
            var Id_Units = row.cells[16].textContent;
            var Attached_Unit = row.cells[17].textContent;
            var Id_Organization = row.cells[18].textContent;
            var Organization_Name = row.cells[19].textContent;
            var Id_Resources = row.cells[20].textContent;
            var Acronyms_Resource = row.cells[21].textContent;
            var Date = row.cells[22].textContent;

            document.getElementById('Id_Program').value = Id_Program;
            document.getElementById('Program_Code').value = Program_Code;
            document.getElementById('Program_Name').value = Program_Name;         
            document.getElementById('Year').value = Year;           
            document.getElementById('Comment_Programs').value = Comment_Programs;
            document.getElementById('Number_Hours').value = Number_Hours;
            document.getElementById('Approval_Date').value = Approval_Date;
            document.getElementById('Id_Cohort').value = Id_Cohort;
            document.getElementById('Cohort').value = Cohort;
            document.getElementById('Number_Females').value = Number_Females;
            document.getElementById('Number_Males').value = Number_Males;
            document.getElementById('Start_Date').value = Start_Date;
            document.getElementById('Termination_Date').value = Termination_Date;
            document.getElementById('Comment_Cohort').value = Comment_Cohort;
            document.getElementById('Id_Program_Types').value = Id_Program_Types;
            document.getElementById('Program_Type').value = Program_Type;
            document.getElementById('Id_Units').value = Id_Units;
            document.getElementById('Attached_Unit').value = Attached_Unit;
            document.getElementById('Id_Organization').value = Id_Organization;
            document.getElementById('Organization_Name').value = Organization_Name;
            document.getElementById('Id_Resources').value = Id_Resources;
            document.getElementById('Acronyms_Resource').value = Acronyms_Resource;
            document.getElementById('Date').value = Date;


            document.querySelector('.save-changes-st').style.display = 'inline-block';
            document.querySelector('.delete-btn-st').style.display = 'inline-block';
            document.querySelector('.input-st').style.display = 'none';
            document.querySelector('.select-st').style.display = 'inline-block';
            document.querySelector('.input-ac').style.display = 'none';
            document.querySelector('.select-ac').style.display = 'inline-block';
            document.querySelector('.input-ut').style.display = 'none';
            document.querySelector('.select-ut').style.display = 'inline-block';
            document.querySelector('.input-ar').style.display = 'none';
            document.querySelector('.select-ar').style.display = 'inline-block';

            document.querySelectorAll('#ProgramForm input, #ProgramForm select').forEach(field => {
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
            var Student_Code = row.cells[9].textContent; 
            var Program_Name = row.cells[10].textContent;
            var Email = row.cells[11].textContent;
            var Phone_Number = row.cells[12].textContent;
            var Gender = row.cells[13].textContent;
            var Social_Network = row.cells[14].textContent;
            var Comment_Student = row.cells[15].textContent;
            var Id_Student_Programs = row.cells[16].textContent;
            var Id_Program = row.cells[17].textContent;
            var Book = row.cells[18].textContent;
            var Folio = row.cells[19].textContent;
            var Line = row.cells[20].textContent;
            var Comment_SS = row.cells[21].textContent;
            var Date = row.cells[22].textContent;

            document.getElementById('Id_Student').value = Id_Student;
            document.getElementById('Document_Type').value = Document_Type;
            document.getElementById('Identification_Document').value = Identification_Document;
            document.getElementById('First_Name').value = First_Name;
            document.getElementById('Second_Name').value = Second_Name;
            document.getElementById('First_LastName').value = First_LastName;
            document.getElementById('Second_LastName').value = Second_LastName;       
            document.getElementById('Student_Code').value = Student_Code;
            document.getElementById('Program_Name').value = Program_Name;
            document.getElementById('Email').value = Email;
            document.getElementById('Phone_Number').value = Phone_Number;
            document.getElementById('Gender').value = Gender;
            document.getElementById('Social_Network').value = Social_Network;
            document.getElementById('Comment_Student').value = Comment_Student;
            document.getElementById('Id_Student_Programs').value = Id_Student_Programs;
            document.getElementById('Id_Program').value = Id_Program;
            document.getElementById('Book').value = Book;
            document.getElementById('Folio').value = Folio;
            document.getElementById('Line').value = Line;
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
            var Student_Code = row.cells[9].textContent; 
            var Program_Name = row.cells[10].textContent;
            var Email = row.cells[11].textContent;
            var Phone_Number = row.cells[12].textContent;
            var Gender = row.cells[13].textContent;
            var Social_Network = row.cells[14].textContent;
            var Comment_Student = row.cells[15].textContent;
            var Id_Student_Programs = row.cells[16].textContent;
            var Id_Program = row.cells[17].textContent;
            var Book = row.cells[18].textContent;
            var Folio = row.cells[19].textContent;
            var Line = row.cells[20].textContent;
            var Comment_SS = row.cells[21].textContent;
            var Date = row.cells[22].textContent;

            document.getElementById('Id_Student').value = Id_Student;
            document.getElementById('Document_Type').value = Document_Type;
            document.getElementById('Identification_Document').value = Identification_Document;
            document.getElementById('First_Name').value = First_Name;
            document.getElementById('Second_Name').value = Second_Name;
            document.getElementById('First_LastName').value = First_LastName;
            document.getElementById('Second_LastName').value = Second_LastName;       
            document.getElementById('Student_Code').value = Student_Code;
            document.getElementById('Program_Name').value = Program_Name;
            document.getElementById('Email').value = Email;
            document.getElementById('Phone_Number').value = Phone_Number;
            document.getElementById('Gender').value = Gender;
            document.getElementById('Social_Network').value = Social_Network;
            document.getElementById('Comment_Student').value = Comment_Student;
            document.getElementById('Id_Student_Programs').value = Id_Student_Programs;
            document.getElementById('Id_Program').value = Id_Program;
            document.getElementById('Book').value = Book;
            document.getElementById('Folio').value = Folio;
            document.getElementById('Line').value = Line;
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