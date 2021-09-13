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

    if (type === "Daily") {


        dailyRent.style.display = "block";
        hourlyRent.style.display = "none";
        weeklyRent.style.display = "none";
        monthlyRent.style.display = "none";
    } else if (type === "Weekly") {


        dailyRent.style.display = "none";
        hourlyRent.style.display = "none";
        weeklyRent.style.display = "block";
        monthlyRent.style.display = "none";
    } else if (type === "Monthly") {
        dailyRent.style.display = "none";
        hourlyRent.style.display = "none";
        weeklyRent.style.display = "none";
        monthlyRent.style.display = "block";
    } else {
        hourlyRent.style.display = "block";
        dailyRent.style.display = "none";
        weeklyRent.style.display = "none";
        monthlyRent.style.display = "none";
    }
}