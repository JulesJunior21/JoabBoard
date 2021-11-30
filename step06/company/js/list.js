$(document).ready(function () {
    $("#userName").text(localStorage.getItem("nameCompany") ? localStorage.getItem("nameCompany") : "none");


    $("#logout-button").click(function (e) {
        e.preventDefault();

        localStorage.removeItem("tokenCompany");
        localStorage.removeItem("nameCompany");

        window.location.replace("http://jobboard.com");

    });
});