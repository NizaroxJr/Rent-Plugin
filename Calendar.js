function RpCalendar() {
    var minDate = document.getElementsByName("StartDate")[0].value;
    document.getElementsByName("EndDate")[0].setAttribute("min", minDate);
}