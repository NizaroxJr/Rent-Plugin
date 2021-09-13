function MinDay() {
    var minDay = document.getElementsByName("StartDay")[0].value;
    document.getElementsByName("EndDay")[0].setAttribute("min", minDay);

}

function MinWeek() {
    var minWeek = document.getElementsByName("StartWeek")[0].value;
    document.getElementsByName("EndWeek")[0].setAttribute("min", minWeek);
}

function MinMonth() {
    var minMonth = document.getElementsByName("StartMonth")[0].value;
    document.getElementsByName("EndMonth")[0].setAttribute("min", minMonth);
}


//show hourly rent by default
var dailyRent = document.getElementById("dailyRent");
var weeklyRent = document.getElementById("weeklyRent");
var monthlyRent = document.getElementById("monthlyRent");

dailyRent.style.display = "none";
weeklyRent.style.display = "none";
monthlyRent.style.display = "none";

//handle Rent Type
function RentTypeHandler(type) {
    var hourlyInput = document.getElementsByName("duration")[0];

    var dailyStartInput = document.getElementsByName("StartDay")[0];
    var dailyEndInput = document.getElementsByName("EndDay")[0];

    var weeklyStartInput = document.getElementsByName("StartWeek")[0];
    var weeklyEndInput = document.getElementsByName("EndWeek")[0];

    var monthlyStartInput = document.getElementsByName("StartMonth")[0];
    var monthlyEndInput = document.getElementsByName("EndMonth")[0];

    if (type === "Daily") {

        dailyRent.style.display = "block";

        hourlyRent.style.display = "none";
        hourlyInput.value = "";

        weeklyRent.style.display = "none";
        weeklyStartInput.value = "";
        weeklyEndInput.value = "";

        monthlyRent.style.display = "none";
        monthlyStartInput.value = "";
        monthlyEndInput.value = "";

    } else if (type === "Weekly") {

        weeklyRent.style.display = "block";

        dailyRent.style.display = "none";
        dailyStartInput.value = "";
        dailyEndInput.value = "";

        hourlyRent.style.display = "none";
        hourlyInput.value = "";

        monthlyRent.style.display = "none";
        monthlyStartInput.value = "";
        monthlyEndInput.value = "";
    } else if (type === "Monthly") {
        monthlyRent.style.display = "block";

        dailyRent.style.display = "none";
        dailyStartInput.value = "";
        dailyEndInput.value = "";

        hourlyRent.style.display = "none";
        hourlyInput.value = "";

        weeklyRent.style.display = "none";
        weeklyStartInput.value = "";
        weeklyEndInput.value = "";

    } else {
        hourlyRent.style.display = "block";

        dailyRent.style.display = "none";
        dailyStartInput.value = "";
        dailyEndInput.value = "";

        weeklyRent.style.display = "none";
        weeklyStartInput.value = "";
        weeklyEndInput.value = "";

        monthlyRent.style.display = "none";
        monthlyStartInput.value = "";
        monthlyEndInput.value = "";
    }
}