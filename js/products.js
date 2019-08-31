var idArray = new Array();

function numberFromText(text, typeOfData){
    //use regex for remove all char who aren't number
    var numbers = text.match(/(\d[\d\.]*)/g);
    var res;
    //check  the number type and return the number
    if(typeOfData == "int"){
        res = parseInt(numbers,10);
    } else if(typeOfData == "float") {
        res = parseFloat(numbers,10);
    }
    return res;
}

function updateResult(class_selector){
    //Retrive the value stored on the cells (where there is the tot) 
    var text_res_p = document.getElementById("p_tot").innerHTML;
    var text_res_c = document.getElementById("c_tot").innerHTML;
    //Convert the result in number  
    var sum_p = numberFromText(text_res_p, "int");
    var sum_c = numberFromText(text_res_c, "float");

     /*Retrieve the class of the row to show/hide
     the class is passed by the image who store the value, and it is passed when
     the image is clicked 
    var selected_id = array();*/
    var checker = document.getElementsByClassName(class_selector);

    /*In this case we obtain an array of HTML object
    so get the power and cost ones and convert it in number*/
    var text_p = checker[1].innerHTML;
    var text_c = checker[2].innerHTML;
    var number_p = numberFromText(text_p, "int");
    var number_c = numberFromText(text_c, "float");
    /********************/
   
    //Store the id product for user save
    var idProd = numberFromText(class_selector, "int");
     /*Check if the clicked image show or hide info
    then make a sum or difference with the total stored in the table */
    if (window.getComputedStyle(checker[2]).display !== "none") {
        //could be useful save a variable for know what component is set to show!!!!!!!!!!!
        //maybe save class_selector in a vector and extract his id
        idArray.push(idProd);
        sum_p += number_p;
        sum_c += number_c;
    } else {
        idArray.splice(idArray.indexOf(idProd), 1 );
        sum_p -= number_p;
        sum_c -= number_c;
    }
    //Show result in the table
    $("#p_tot").text(sum_p + " W");
    $("#c_tot").text("€" + sum_c.toFixed(2));   
};

//Retrieve value from image (image's value is the class name of that table row )
function toggleInfo(el){
    $("#stored-data").hide();
    //Get the class value to show when the image is clicked
    var showPar = "." + el.getAttribute("value");
    $(showPar).toggle();
    $(el).toggleClass("selected");
    //pass the row's class
    updateResult(el.getAttribute("value"));
};

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}

function storeData(){
    //If user is logged in show the save button
    if (getCookie("session_destroyed") == "true" ){
        $("#save-error").show();
    }
};

//If a user is logged in show the save button
$(document).ready(function(){
    if(getCookie("session_destroyed") != "true" ){
        $("#submit-save-product").show();
    };
    $("#submit-save-product").on("click", function(){
        if(idArray.length == 0){
            $("#stored-data").html('<div class="alert alert-danger"><strong>Errore!</strong> Inserire almeno un componente</div>');
            $("#stored-data").show();
        }else{
            var myJSONText = JSON.stringify(idArray);
            $.ajax({ 
                type: "POST", 
                url: "services/store.php", 
                data: { kvcArray : myJSONText }, 
                success: function() { 
                    console.log("Success");
                    console.log(myJSONText);
                    $("#stored-data").html('<div class="alert alert-success"><strong>Successo!</strong> Dati inseriti correttamente</div>');
                    $("#stored-data").show();
                } 
            }); 
        }
    });
});