$(document).ready(function () {

    if (localStorage.getItem('token') != null) {

        $.ajax({
            type: "GET",
            url: "http://jobboard.com/api/authenticate/" + localStorage.getItem("token"),
            dataType: "json",
            success: function (response) {
                if (response.error == null) {

                    $.ajax({
                        type: "get",
                        url: "http://jobboard.com/api/users/" + response.userId,
                        dataType: "json",
                        success: function (response2) {
                            $("#firstname").val(response2.firstname);
                            $("#lastname").val(response2.lastname);
                            $("#email").val(response2.email);
                            $("#phone").val(response2.phone);
                            $("#password").val(response2.password);
                            $("#street").val(response2.address.street);
                            $("#city").val(response2.address.city);
                            $("#state").val(response2.address.state);
                            $("#postalcode").val(response2.address.postalcode);
                            $("#country").val(response2.address.country);
                            $("#address_id").text(response2.address.id);

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

    $("#info-edit").click(function (e) {
        e.preventDefault();
        yo = confirm("Are you sure to accept modification to your personal information!");

        if (yo) {

            datas = {
                "firstname": $("#firstname").val(),
                "lastname": $("#lastname").val(),
                "email": $("#email").val(),
                "phone": $("#phone").val(),
                "password": $("#password").val()
            };

            if (localStorage.getItem('token') != null) {

                $.ajax({
                    type: "GET",
                    url: "http://jobboard.com/api/authenticate/" + localStorage.getItem("token"),
                    dataType: "json",
                    success: function (response) {
                        if (response.error == null) {
                            $.ajax({
                                type: "PUT",
                                url: "http://jobboard.com/api/users/" + response.userId,
                                data: JSON.stringify(datas),
                                success: function (response2) {
                                    alert(response2);
                                    window.location.replace("http://jobboard.com/profile.html");
                                },

                                error: function (a, b, c) {
                                    alert("Error: " + c);
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
        }
    });

    $("#address-edit").click(function (e) {
        e.preventDefault();
        yo = confirm("Are you sure to accept modification to your personal information!");

        if (yo) {

            datas = {
                "street": $("#street").val(),
                "city": $("#city").val(),
                "state": $("#state").val(),
                "postalcode": $("#postalcode").val(),
                "country": $("#country").val()
            };

            if (localStorage.getItem('token') != null) {

                $.ajax({
                    type: "GET",
                    url: "http://jobboard.com/api/authenticate/" + localStorage.getItem("token"),
                    dataType: "json",
                    success: function (response) {
                        if (response.error == null) {
                            $.ajax({
                                type: "PUT",
                                url: "http://jobboard.com/api/address/" + $("#address_id").text(),
                                data: JSON.stringify(datas),
                                success: function (response2) {
                                    alert(response2);
                                    window.location.replace("http://jobboard.com/profile.html");
                                },

                                error: function (a, b, c) {
                                    alert("Error: " + c);
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
        }
    });


});