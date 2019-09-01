/*Set the cookie 
cname = cookie name
cvalue = value of cookie 
exdays = exipration day (eg. 30 days)
*/
function setCookie(cname, cvalue, exdays = null) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    if(exdays === null){
        document.cookie = cname + "=" + cvalue + "; path=/";
    }else {
        document.cookie = cname + "=" + cvalue + ";" + expires + "; secure ; httponly; path=/";
    }
};

function deleteCookie(cname){
    document.cookie = cname + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
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

function checkCookie() {
    //Get cookie to fix
    if (getCookie("username") == "" && getCookie("session_destroyed") != "true"){
        setCookie("session_destroyed", "true")
        window.location.href = "logout.php";
    }
};

function showStoreButton(){
    if(getCookie("session_destroyed") != "true" && getCookie("username") != ""){
        $("#submit-save-product").show();
    } else {
        $("#submit-save-product").hide();
    }
}

$(window).on("load", function(){
    checkCookie();
    /**Use cookie for show the store button in projects.php */
    showStoreButton();
});