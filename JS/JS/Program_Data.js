// Wait for the DOM content to be fully loaded before executing
document.addEventListener('DOMContentLoaded', function () {
    const saveButton = document.querySelector('#program_form button[type="button"]');
    if (saveButton) {
        saveButton.style.display = 'none';
    }
});

document.addEventListener('DOMContentLoaded', function () {
    // Handle changes to the Register Type select element
    const registerTypeSelect = document.getElementById('Register_Type');

    registerTypeSelect.addEventListener('change', function (e) {
        // Array of section IDs to manage visibility
        const sections = ['section1', 'section2', 'section3', 'section4', 'section5'];

        // Hide all sections initially
        sections.forEach(section => {
            document.getElementById(section).style.display = 'none';
        });

        // Show the selected section
        if (this.value) {
            document.getElementById(this.value).style.display = 'block';

            // Show the save button if a section is selected
            const saveButton = document.querySelector('#program_form button[type="button"]');
            if (saveButton) {
                saveButton.style.display = 'inline-block';
            }
        } else {
            // Hide the save button if no section is selected
            const saveButton = document.querySelector('#program_form button[type="button"]');
            if (saveButton) {
                saveButton.style.display = 'none';
            }
        }
    });
});

