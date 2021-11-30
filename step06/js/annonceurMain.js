$(function(){
	$("#wizard").steps({
        headerTag: "h4",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        transitionEffectSpeed: 500,
        onStepChanging: function (event, currentIndex, newIndex) { 
            if ( newIndex === 1 ) {
                $('.steps ul').addClass('step-2');
            } else {
                $('.steps ul').removeClass('step-2');
            }
            if ( newIndex === 2 ) {
                $('.steps ul').addClass('step-3');
            } else {
                $('.steps ul').removeClass('step-3');
            }

            if ( newIndex === 3 ) {
                $('.steps ul').addClass('step-4');
                $('.actions ul').addClass('step-last');
            } else {
                $('.steps ul').removeClass('step-4');
                $('.actions ul').removeClass('step-last');
            }
            return true; 
        },
        labels: {
            finish: "Sign up",
            next: "Next",
            previous: "Previous"
        }
    });
    // Custom Steps Jquery Steps
    $('.wizard > .steps li a').click(function(){
    	$(this).parent().addClass('checked');
		$(this).parent().prevAll().addClass('checked');
		$(this).parent().nextAll().removeClass('checked');
    });
    // Custom Button Jquery Steps
    $('.forward').click(function(){
    	$("#wizard").steps('next');
    })
    $('.backward').click(function(){
        $("#wizard").steps('previous');
    })
    // Checkbox
    $('.checkbox-circle label').click(function(){
        $('.checkbox-circle label').removeClass('active');
        $(this).addClass('active');
    })
})

$(document).ready(function () {

    $("[href='#finish']").click(function (e) { 
        e.preventDefault();
        if($("#company-form").valid()) {
            const company = {

                "name" : $("#company_name").val(),
                "activity" : $("#activity").find(":selected").text(),
                "description" : $("#description").val(),
                "email" : $("#email").val(),
                "phone" : $("#phone").val(),
                "city" : $("#city").val(),
                "street" : $("#street").val(),
                "postalcode" : $("#postalcode").val(),
                "state" : $("#country").val(),
                "country" : $("#country").val(),
                "password" : $("#password").val()
            }
    
            $.ajax({
                type: "POST",
                url: "http://jobboard.com/api/companies",
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify(company) ,
                success: function (response) {
                    alert('Company n°: ' + response + " added!" );
                    window.location.replace("http://jobboard.com");
                }
            });
        } else {
            alert("Please fill all inputs correctly");
        }

    });
});
