$('document').ready( () => {
    initilize();
})



function initilize() {

    
    $.ajax({
        type: "GET",
        url: "crudAd.php?id=all",
        dataType: "json",
        success: function (response) {
            console.log(response);
            response.forEach(element => {
                $.ajax({
                    type: "GET",
                    url: "crudComp.php?id=" + element.company.id,
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        $("#ad_container").append('<div class="card text-center"><div class="card-header">'+ response.name + '</div><div class="card-body"><h5 class="card-title">' + element.title +'</h5><p class="card-text">' + element.description + '</p><a href="#" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample' + element.id +'" aria-expanded="false" aria-controls="collapseExample">Learn more...</a><br><br><div class="collapse" id="collapseExample'+ element.id +'"><span style="color: rgb(255, 94, 0); font-weight: 800; font-size: 30px;">Description</span><br><div>'+ element.description +'</div><span style="color: rgb(255, 94, 0); font-weight: 800; font-size: 30px;">Salary</span><br><div>'+ element.salary +'Euros/month</div><span style="color: rgb(255, 94, 0); font-weight: 800; font-size: 30px;">Objectives</span><br><div>'+ element.objectives +'</div><span style="color: rgb(255, 94, 0); font-weight: 800; font-size: 30px;">Responsabilities</span><br>' + element.responsabilities +'<div></div><span style="color: rgb(255, 94, 0); font-weight: 800; font-size: 30px;">Requirements</span><br><div>' + element.requirements +'</div><span style="color: rgb(255, 94, 0); font-weight: 800; font-size: 30px;">Contact </span><br><br><p> <span style="color: seagreen;">Tel: </span> 0748044545454</p><p><span style="color: seagreen;">Email: </span> example@gmail.com</p><button class="btn btn-success">Postuler</button></div></div><div class="card-footer text-muted">'+ moment(element.date.date).fromNow()+ '</div></div><br>');

                    }
                });
            });
        },

        error: function () {
            console.log('error');
        } 

    });

}