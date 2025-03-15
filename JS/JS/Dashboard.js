(function () {
    // Function to update time every second
    var UpdateTime = function () {

        // Get current date and time components
        var date = new Date(),
            hours = date.getHours(),
            ampm,
            minutes = date.getMinutes(),
            seconds = date.getSeconds(),
            dayWeek = date.getDay(),
            day = date.getDate(),
            month = date.getMonth(),
            year = date.getFullYear();

        // Get DOM elements for time display
        var pHours = document.getElementById('hours'),
            pAmPm = document.getElementById('ampm'),
            pMinutes = document.getElementById('minutes'),
            pSeconds = document.getElementById('seconds'),
            pDayWeek = document.getElementById('day-week'),
            pDay = document.getElementById('day'),
            pMonth = document.getElementById('month'),
            pYear = document.getElementById('year');

        // Define arrays for week and month names
        var week = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
        // Set day names and numbers
        pDayWeek.textContent = week[dayWeek];
        pDay.textContent = day;

        // Define arrays for week and month names
        var Month = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        // Set day names and numbers
        pMonth.textContent = Month[month];
        pYear.textContent = year;

        // Convert 12-hour format
        if (hours >= 12) {
            hours = hours - 12;
            ampm = 'PM';
        } else {
            ampm = 'AM';
        }

        // Format time components
        if (hours == 0) {
            hours = 12;
        }

        pHours.textContent = hours;
        pAmPm.textContent = ampm;

        if (minutes < 10) { minutes = "0" + minutes };
        if (seconds < 10) { seconds = "0" + seconds };



        pMinutes.textContent = minutes;
        pSeconds.textContent = seconds;
    };

    // Initial call and set interval for continuous updates
    UpdateTime();
    var interval = setInterval(UpdateTime, 1000);

}())