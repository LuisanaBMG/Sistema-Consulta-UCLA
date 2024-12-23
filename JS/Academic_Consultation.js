// This function handles dynamic section visibility based on a select dropdown
document.addEventListener('DOMContentLoaded', function () {
    const registerTypeSelect = document.getElementById('Consult_Data');

    registerTypeSelect.addEventListener('change', function (e) {
        // Array of section IDs to manage visibility
        const sections = ['section1', 'section2', 'section3', 'section4', 'section5', 'section6', 'section7'];

        // Initially hide all sections
        sections.forEach(section => {
            document.getElementById(section).style.display = 'none';
        });

        // Show the selected section
        if (this.value) {
            document.getElementById(this.value).style.display = 'block';
        }
    });
});