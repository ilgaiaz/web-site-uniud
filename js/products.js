function updateResult(class_selector){
    
    var checker = document.getElementsByClassName(class_selector);
    //Get result value from table and convert in number       
    var text_sum_p = document.getElementById("p_tot").innerHTML;
    var text_sum_c = document.getElementById("c_tot").innerHTML;
    var numbers_sum_p = text_sum_p.match(/(\d[\d\.]*)/g);
    var numbers_sum_c = text_sum_c.match(/(\d[\d\.]*)/g);
    var sum_p = parseInt(numbers_sum_p,10);
    var sum_c = parseFloat(numbers_sum_c,10);
    /*Get the value from the row linked with the clicked image*/
    var text_p = checker[1].innerHTML;
    var text_c = checker[2].innerHTML;
    var numbers_p = text_p.match(/(\d[\d\.]*)/g);
    var numbers_c = text_c.match(/(\d[\d\.]*)/g);
    /********************/
    /*Check if the clicked image show or hide info
    then make a sum or difference with the total stored in the table */
    if (window.getComputedStyle(checker[2]).display !== "none") {
        sum_p += parseInt(numbers_p);
        sum_c += parseFloat(numbers_c);
    } else {
        sum_p -= parseInt(numbers_p);
        sum_c -= parseFloat(numbers_c);
    }
    //Show result in the table
    $("#p_tot").text(sum_p + " W");
    $("#c_tot").text("€" + sum_c.toFixed(2));   
}
            
function showInfo(el){
    //Get the class value to show when the image is clicked
    var showPar = "." + el.getAttribute("value");
    $(showPar).toggle();
    updateResult(el.getAttribute("value"));
}