$(document).ready(function () {
    

    $("#submit-form").click(function (e) { 
        e.preventDefault();

        $data = {
            "email" : $("#email").val(),
            "password" : $("#password").val()
        };

        $.ajax({
            type: "post",
            url: "http://jobboard.com/api/authenticate",
            data: JSON.stringify($data),
            dataType: "json",
            success: function (response) {
                if(response.token != null) {
                    localStorage.clear();
                    localStorage.setItem("token", response.token);
                    
                    if(response.usertype == 3) {
                        window.location.replace("http://jobboard.com/superadmin/index.html");
                    } else {
                        window.location.reload();
                    }
                    
                }
                else {
                    alert('Error: please check your email and password');
                }

            },
            error: function (a, b ,c) {

                alert('Error 500: Server error!' + c);
            }
        });

    });
});