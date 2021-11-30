$(document).ready(function () {
    $("#userName").text(localStorage.getItem("nameCompany")? localStorage.getItem("nameCompany") : "none");


    $("#logout-button").click(function (e) { 
        e.preventDefault();

        localStorage.removeItem("tokenCompany");
        localStorage.removeItem("nameCompany");

        window.location.replace("http://jobboard.com");
        
    });

    $.ajax({
        type: "GET",
        url: "http://jobboard.com/api/companies/" + localStorage.idCompany,
        success: function (response) {
            var count = 0 ;
            var countAcc = 0;
            var countPend = 0;
            datas = response.advertisements;

            $("#number-add").text(datas.length);

            datas.forEach(element => {
                count += element.applications.length;
                element.applications.forEach(datom => {
                    if(datom.status) {
                        countAcc++;
                    } else {
                        countPend++;
                    }
                });
            });

            $("#number-request").text(count);
            $("#number-acc").text(countAcc);
            $("#number-pend").text(countPend);
            
        }
    });

});