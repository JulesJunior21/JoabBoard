var curentId = 0;


$('document').ready(() => {
    initilize();


    $("#connexion-button-company").click(function (e) {
        e.preventDefault();
        window.location.replace("http://jobboard.com/company/login.html")
    });

    $('#apply').click(function (e) {
        e.preventDefault();

        if ($("#applyform").valid()) {

            const anonymeuser = {
                "firstname": $("#firstname").val(),
                "lastname": $("#lastname").val(),
                "email": $("#email").val(),
                "phone": $("#phone").val(),
                "street": $("#street").val(),
                "city": $("#city").val(),
                "state": $("#state").val(),
                "postalcode": $("#postalcode").val(),
                "country": $("#country").val(),
                "type": 1
            }


            $.ajax({
                type: "post",
                url: "http://jobboard.com/api/users",
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify(anonymeuser),
                success: function (response) {
                    userid = response;
                    app = {
                        message: $("#message").val(),
                        applyant: userid,
                        advertisement: curentId
                    }

                    $.ajax({
                        type: "POST",
                        url: "http://jobboard.com/api/applications",
                        data: JSON.stringify(app),
                        success: function (response) {
                            alert('Application sent!');
                            window.location.replace("http://jobboard.com");
                        },

                        error: function () {


                        }
                    });
                },
                error: function () {
                    alert("Erorr in Users add");
                }
            });
        } else {
            alert("Please fill correctly all fields!");
        }



    });


    $("#apply2").click(function (e) { 
        e.preventDefault();

        if (localStorage.getItem('token') != null) {

            $.ajax({
                type: "GET",
                url: "http://jobboard.com/api/authenticate/" + localStorage.getItem("token"),
                dataType: "json",
                success: function (response) {
                    if (response.error == null) {
    
                        app = {
                            message: $("#message2").val(),
                            applyant: response.userId,
                            advertisement: curentId
                        }
    
                        $.ajax({
                            type: "POST",
                            url: "http://jobboard.com/api/applications",
                            data: JSON.stringify(app),
                            success: function (response) {
                                alert('Application sent');
                                window.location.replace("http://jobboard.com");
                            },
    
                            error: function (a, b , c) {
                                alert('You have already apply to this adverisement! Sorry! ' + c);
                                window.location.replace("http://jobboard.com");
                            }
                        });
                    }
                    else {
                        alert('You must reconnect!');
                        window.location.replace("http://jobboard.com/login.html");
                    }
                }
            });
    
        } else {
    
        }
        
    });


})



function initilize() {

    $("#acc-link").click(function (e) { 
        e.preventDefault();
        window.location.replace("http://jobboard.com/profile.html");
        
    });

    if (localStorage.getItem('token') != null) {

        $.ajax({
            type: "GET",
            url: "http://jobboard.com/api/authenticate/" + localStorage.getItem("token"),
            dataType: "json",
            success: function (response) {
                if (response.error == null) {
                    $("#connexion-button").text("Log Out");
                    $("#connexion-button-company").css('display', 'none');
                    logOut();
                }
                else {
                    $("#connexion-button").text("Log In");
                    loginIn();
                    console.log(response.error);
                }
            },
            error: function () {
                
            }
        });

    } else {
        loginIn();
        $("#connexion-button").text("Log In");
        $("#acc-link").css('display', 'none');
    }
    var data = [];

    $.ajax({
        type: "GET",
        url: " http://jobboard.com/api/advertisements/",
        dataType: "json",
        success: function (response) {

            response.forEach(element => {

                if(localStorage.getItem('token') == null) {
                    $("#ad_container").append('<div class="card"><div class="card-header text-center">' + element.company.name + '</div><div class="card-body"><h5 class="card-title">' + element.title + '</h5><p class="card-text">' + element.description + '</p><a href="#" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample' + element.id + '" aria-expanded="false" aria-controls="collapseExample">Learn more...</a><br><br><div class="collapse" id="collapseExample' + element.id + '"><div>' + element.content + '</div><span style="color: rgb(255, 94, 0); font-weight: 800; font-size: 30px;">Contact </span><br><br><p> <span style="color: seagreen;">Tel: </span>' + element.company.phone + '</p><p><span style="color: seagreen;">Email: </span>' + element.company.email + '</p><button id="' + element.id + '" class="open btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" onclick="changeId(event)">Apply<span hidden>' + element.id + '</span></button></div></div><div class="card-footer text-muted">' + moment(element.creatAt.date).fromNow() + '</div></div><br>');
                } else {
                    $("#ad_container").append('<div class="card"><div class="card-header text-center">' + element.company.name + '</div><div class="card-body"><h5 class="card-title">' + element.title + '</h5><p class="card-text">' + element.description + '</p><a href="#" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample' + element.id + '" aria-expanded="false" aria-controls="collapseExample">Learn more...</a><br><br><div class="collapse" id="collapseExample' + element.id + '"><div>' + element.content + '</div><span style="color: rgb(255, 94, 0); font-weight: 800; font-size: 30px;">Contact </span><br><br><p> <span style="color: seagreen;">Tel: </span>' + element.company.phone + '</p><p><span style="color: seagreen;">Email: </span>' + element.company.email + '</p><button id="' + element.id + '" class="open btn btn-success" data-toggle="modal" data-target="#exampleModal2" data-whatever="@mdo" onclick="changeId(event)">Apply<span hidden>' + element.id + '</span></button></div></div><div class="card-footer text-muted">' + moment(element.creatAt.date).fromNow() + '</div></div><br>');
                }


            });

            $("#ad_container").paginate({
                scope: 'div',
                perPage: 4 
            });

        },

        error: function (jq, status, error) {
            console.log(error);
        }

    });
}

function changeId(e) {

    curentId = e.target.id;

}

function loginIn() {
    $("#connexion-button").click(function (e) {
        e.preventDefault();
        window.location.replace("http://jobboard.com/login.html");
    });
}

function logOut() {
    $("#connexion-button").click(function (e) {
        e.preventDefault();
        $val = confirm("Do you want to log out?");

        if ($val) {
            localStorage.clear();
            window.location.replace("http://jobboard.com");

        }
    });
}
