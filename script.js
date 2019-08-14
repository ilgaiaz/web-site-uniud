//Function for message and div show
function errorMessage(div_id, message){
    $(div_id).append("<p>"+ message +"</p>");
    $(div_id).show();
}

function successMessage(div_id, message){
    $(div_id).append("<p>"+ message +"</p>");
    $(div_id).show();
}

function showDiv(idToShow){
    $(idToShow).show();
}

//Function for profile page  
function showMod(){
    $("#show-info").hide();
    $("#mod-info").show();
};

$(document).ready(function(){
    $("#submit-mod-data").on('click', function(event){
        showMod();
    });
    $("#submit-back-mod").on('click', function(event){
        $("#mod-info").hide();
        $("#show-info").show();
    });
});