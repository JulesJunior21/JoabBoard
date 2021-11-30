$(document).ready(function () {
    $("#userName").text(localStorage.getItem("nameCompany") ? localStorage.getItem("nameCompany") : "none");


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

            response.advertisements.forEach(add => {
                if(add.applications.length != 0) {
                    $("#main-container").append('<br><div id="second-container' + add.id +  '" class="d-flex flex-row flex-wrap"></div></div>');
                    count = 0 ;
                    add.applications.forEach(app => {
                        if(app.status == 1) {
                            count ++;
                            $('#second-container' + add.id).append('<div><div class="card" style="width: 18rem; margin: 10px;"><div class="card-body"><h5 class="card-title"><a id="app-user-name'+ app.id +'" data-toggle="collapse" href="#collapseUserInfo' +app.id+ '" role="button" aria-expanded="false"aria-controls="collapseUserInfo' + app.id + '">'+ app.applyant.firstname+ ' ' +app.applyant.lastname+  '</a></h5><!-- User information --><div class="collapse" id="collapseUserInfo'+app.id+'"><span>Firstname: '+ app.applyant.firstname+'</span><br><span>Lastname: '+ app.applyant.lastname+'</span><br><span>Email: '+ app.applyant.email+'</span><br><span>Phone: '+ app.applyant.phone +'<span><br><br><span><a data-toggle="collapse" href="#collapseAddressInfo'+ app.id +'"role="button" aria-expanded="false"aria-controls="collapseAddressInfo'+  app.id +'">Address</a></span><br><br><div class="collapse" id="collapseAddressInfo'+app.id+ '"><span>Street: '+ app.applyant.address.street +'</span><br><span>City: '+ app.applyant.address.city +'</span><br><span>State: '+ app.applyant.address.state +'</span><br><span>Postalcode: '+ app.applyant.address.postalcode +'</span><br><span>Country: ' +  app.applyant.address.country+  '</span></div></div><br><h6><a data-toggle="collapse" href="#collapseMessage'+app.id+'" role="button"aria-expanded="false" aria-controls="collapseMessage'+app.id+'">Message</a></h6><div class="collapse" id="collapseMessage'+app.id+'"><p id="app-message" class="card-text">'+ app.message + '</p></div><br></div></div></div>');
                        }

                    });
                    
                }

            });
        }
    });

    
});