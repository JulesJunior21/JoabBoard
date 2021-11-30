var datas = [];
var isEdit = false;
var currentId = 0;
$(document).ready(function () {

    $("#save-ad").click(function (e) { 
        e.preventDefault();
        if(!isEdit) {
            title = $("title").val();
            content = document.getElementsByClassName('note-editable')[0].innerHTML;
            data = {
                "title" : $("#title").val(),
                "description" : $("#description").val(),
                "content" : document.getElementsByClassName('note-editable')[0].innerHTML,
                "company" : localStorage.getItem("idCompany")
            }
    
            $.ajax({
                type: "post",
                url: "http://jobboard.com/api/advertisements",
                data: JSON.stringify(data),
                success: function (response) {
                    alert(response);
                    location.replace("http://jobboard.com/company/my-ads.html");
                },
    
                error : function (a, b ,c) {
                    alert(b  + ": " + c);
                }
            });
        } else {
            title = $("title").val();
            content = document.getElementsByClassName('note-editable')[0].innerHTML;
            data = {
                "title" : $("#title").val(),
                "description" : $("#description").val(),
                "content" : document.getElementsByClassName('note-editable')[0].innerHTML,
                "company" : localStorage.getItem("idCompany")
            }
    
            $.ajax({
                type: "put",
                url: "http://jobboard.com/api/advertisements/" + currentId,
                data: JSON.stringify(data),
                success: function (response) {
                    alert(response);
                    location.replace("http://jobboard.com/company/my-ads.html");
                },
    
                error : function (a, b ,c) {
                    alert(b  + ": " + c);
                }
            });
        }

        isEdit = false;


    });

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
            var count = 0 ;
            datas = response.advertisements;
            $("#job-number").text(datas.length);
            datas.forEach(element => {
                
                if(count % 2 == 0) {
                    $("#ad-container").append('<div class="card shadow mb-4"><div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary"> Add n° '+ element.id + ' ' + element.title + '</h6></div><div class="card-body">' + element.content + '<br><a id="'+ element.id +'" href="#" class="btn btn-primary" data-toggle="modal"data-target="#largeModal" onclick="getId(event)">Edit</a><button id="'+ element.id +'" class="btn btn-danger supp" onclick="removeAdd(event)">Remove</button></div><div class="card-header py-3"><button type="button" class="btn btn-default" >' + element.applications.length +' application(s)</button></div></div>')
                } else {
                    $("#ad-container2").append('<div class="card shadow mb-4"><div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary"> Add n° '+ element.id + ' ' + element.title + '</h6></div><div class="card-body">' + element.content + '<br><a id="'+ element.id +'" href="#" class="btn btn-primary" data-toggle="modal"data-target="#largeModal" onclick="getId(event)">Edit</a><button id="'+ element.id +'" class="btn btn-danger supp" onclick="removeAdd(event)">Remove</button></div><div class="card-header py-3"><button type="button" class="btn btn-default" >' + element.applications.length +' application(s)</button></div></div>')
                }

                count++;

            });
            
        }
    });


});

function getId(e) {
    currentId = e.target.id;
    isEdit = true;
    datas.find(function(element, index){
        if(element.id == currentId) {
            $("#title").val(element.title);
            $("#description").text(element.description);
            document.getElementsByClassName('note-editable')[0].innerHTML = element.content;
            return true;
        }
    });
}

function addButton() {
    isEdit = false;
    $("#title").val("");
    $("#description").text("");
    document.getElementsByClassName('note-editable')[0].innerHTML = "";
}

function removeAdd(e) {
    currentId = e.target.id;

    deleted = confirm('Do yout want really delet this add? ');


    if(deleted) {
        $.ajax({
            type: "delete",
            url: "http://jobboard.com/api/advertisements/" + currentId,
            success: function (response) {
                alert("Advertisement n°" + currentId + " successfully deleted!");
                location.replace("http://jobboard.com/company/my-ads.html");
            },
            error: function (a, b ,c) {
                alert('error ' + c);
            }
        });
    }

}