$(document).ready(function () {
    if (localStorage.getItem('token') != null) {

        $.ajax({
            type: "GET",
            url: "http://jobboard.com/api/authenticate/" + localStorage.getItem("token"),
            dataType: "json",
            success: function (response) {
                if (response.error == null) {

                    $.ajax({
                        type: "GET",
                        url: "http://jobboard.com/api/users",
                        dataType: "json",
                        success: function (response) {
                            response.forEach(element => {

                                $("#ver1-content").append('<tr class="row100 body"><td class="cell100 column1">' + element.firstname + ' ' + element.lastname + '</td><td class="cell100 column2">' + element.email + '</td><td class="cell100 column3">' + element.phone + '</td><td class="cell100 column4"> ' + element.address.street + ' ' + element.address.city + ' ' + element.address.postalcode + '</td><td class="cell100 column5"><button id="btndelete' + element.id + '" class="btn btn-primary">Delete</button></td></tr>');


                                $('#btndelete' + element.id + '').click(function (e) {
                                    e.preventDefault();
                                    yesno = confirm("Do you want delete this user?");
                                    if(yesno) {
                                        $.ajax({
                                            type: "delete",
                                            url: "http://jobboard.com/api/users/" + element.id,
                                            success: function (response) {
                                                alert(response);
                                                location.reload();
                                            },

                                            error: function (a, b, c) { 
                                                alert("error: " + c);
                                             }
                                        });
                                    }
                                });
                            });

                        }
                    });


                    $.ajax({
                        type: "GET",
                        url: "http://jobboard.com/api/companies",
                        dataType: "json",
                        success: function (response) {
                            response.forEach(element => {
                                $("#ver2-content").append('<tr class="row100 body"><td class="cell100 column1">' + element.name + '</td><td class="cell100 column2">' + element.email + '</td><td class="cell100 column3">' + element.phone + '</td><td class="cell100 column4"> ' + element.address.street + ' ' + element.address.city + ' ' + element.address.postalcode + '</td><td class="cell100 column5"><button id="btndeletecomp' + element.id + '" class="btn btn-primary">Delete</button></td></tr>');

                                $('#btndeletecomp' + element.id + '').click(function (e) {
                                    e.preventDefault();
                                    yesno = confirm("Do you want delete this companies?");
                                    if(yesno) {
                                        $.ajax({
                                            type: "delete",
                                            url: "http://jobboard.com/api/companies/" + element.id,
                                            success: function (response) {
                                                alert(response);
                                                location.reload();
                                            },

                                            error: function (a, b, c) { 
                                                alert("error: " + c);
                                             }
                                        });
                                    }
                                });
                            });


                        }
                    });

                    $.ajax({
                        type: "GET",
                        url: "http://jobboard.com/api/applications",
                        dataType: "json",
                        success: function (response) {
                            response.forEach(element => {
                                $("#ver3-content").append('<tr class="row100 body"><td class="cell100 column1">' + element.id + '</td><td class="cell100 column2">' + element.applyant.firstname + ' ' + element.applyant.lastname  + '</td><td class="cell100 column3">' + element.advertisements.id + ' /' + element.advertisements.title + ' ' + element.advertisements.company.name + '</td><td class="cell100 column4"> ' + element.advertisements.company.name + '</td><td class="cell100 column5"><button id="btndeleteapp' + element.id + '" class="btn btn-primary">Delete</button></td></tr>');

                                $('#btndeleteapp' + element.id + '').click(function (e) {
                                    e.preventDefault();
                                    yesno = confirm("Do you want delete this application?");
                                    if(yesno) {
                                        $.ajax({
                                            type: "DELETE",
                                            url: "http://jobboard.com/api/applications/" + element.id,
                                            success: function (response) {
                                                alert(response);
                                                location.reload();
                                            },

                                            error: function (a, b, c) { 
                                                alert("error: " + c);
                                             }
                                        });
                                    }
                                });
                            });


                        }
                    });

                    $.ajax({
                        type: "GET",
                        url: "http://jobboard.com/api/advertisements",
                        dataType: "json",
                        success: function (response) {
                            response.forEach(element => {
                                $("#ver4-content").append('<tr class="row100 body"><td class="cell100 column1">' + element.title + '</td><td class="cell100 column2">' + element.description + '</td><td class="cell100 column3">' + element.creatAt.date + '</td><td class="cell100 column4"> ' + element.company.name + '</td><td class="cell100 column5"><button id="btndeleteadd' + element.id + '" class="btn btn-primary">Delete</button></td></tr>');

                                $('#btndeleteadd' + element.id + '').click(function (e) {
                                    e.preventDefault();
                                    yesno = confirm("Do you want delete this application?");
                                    if(yesno) {
                                        $.ajax({
                                            type: "DELETE",
                                            url: "http://jobboard.com/api/advertisements/" + element.id,
                                            success: function (response) {
                                                alert(response);
                                                location.reload();
                                            },

                                            error: function (a, b, c) { 
                                                alert("error: " + c);
                                             }
                                        });
                                    }
                                });
                            });


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
        alert("error");
    }
});