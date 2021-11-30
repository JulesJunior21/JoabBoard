var curentId = 0;

$('document').ready(() => {
    initilize();

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
                url: "http://127.0.0.1/JobBoard/step05/api/v1/users",
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
                        url: "http://127.0.0.1/JobBoard/step05/api/v1/applications",
                        data: JSON.stringify(app),
                        success: function (response) {

                        },

                        error: function () {

                            
                        }
                    });
                },
                error: function () {
                    alert("Eroor in Users add");
                }
            });
        } else {
            alert("Please fill correctly all fields!");
        }



    });
})



function initilize() {

    $("#alert-danger").hide();

    $.ajax({
        type: "GET",
        url: " http://127.0.0.1/JobBoard/step04/api/v1/advertisements/",
        dataType: "json",
        success: function (response) {
            console.log(response);
            response.forEach(element => {
                $("#ad_container").append('<div class="card text-center"><div class="card-header">' + element.company.name + '</div><div class="card-body"><h5 class="card-title">' + element.title + '</h5><p class="card-text">' + element.description + '</p><a href="#" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample' + element.id + '" aria-expanded="false" aria-controls="collapseExample">Learn more...</a><br><br><div class="collapse" id="collapseExample' + element.id + '"><span style="color: rgb(255, 94, 0); font-weight: 800; font-size: 30px;">Description</span><br><div>' + element.description + '</div><span style="color: rgb(255, 94, 0); font-weight: 800; font-size: 30px;">Salary</span><br><div>' + element.salary + 'Euros/month</div><span style="color: rgb(255, 94, 0); font-weight: 800; font-size: 30px;">Objectives</span><br><div>' + element.objectives + '</div><span style="color: rgb(255, 94, 0); font-weight: 800; font-size: 30px;">Responsabilities</span><br>' + element.responsabilities + '<div></div><span style="color: rgb(255, 94, 0); font-weight: 800; font-size: 30px;">Requirements</span><br><div>' + element.requirements + '</div><span style="color: rgb(255, 94, 0); font-weight: 800; font-size: 30px;">Contact </span><br><br><p> <span style="color: seagreen;">Tel: </span>' + element.company.phone + '</p><p><span style="color: seagreen;">Email: </span>' + element.company.email + '</p><button id="' + element.id + '" class="open btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" onclick="changeId(event)">Apply<span hidden>' + element.id + '</span></button></div></div><div class="card-footer text-muted">' + moment(element.creatAt.date).fromNow() + '</div></div><br>');
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
