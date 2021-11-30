$(document).ready(function () {
    

    $("#login-button").click(function (e) { 
        e.preventDefault();

        $data = {
            "email" : $("#email").val(),
            "password" : $("#password").val()
        };

        $.ajax({
            type: "post",
            url: "http://jobboard.com/api/authenticateCompany",
            data: JSON.stringify($data),
            dataType: "json",
            success: function (response) {
                if(response.token != null) {
                    localStorage.clear();
                    localStorage.setItem("tokenCompany", response.token);
                    localStorage.setItem("nameCompany", response.userName);
                    localStorage.setItem("idCompany", response.userId);
                    console.log (localStorage.getItem("idCompany"));
                    window.location.replace("http://jobboard.com/company/index.html");
                }
                else {
                    alert('Error: please check your email and password');
                }

            },
            error: function (a,b,c) {

                alert('Error 500: Server error! ');
            }
        });

    });
});