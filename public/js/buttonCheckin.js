$(document).ready(function(){
    $("#form-horizontal-checkin").hide();

    // var email = <?php session()->get('user')->email ?>
    // document.getElementById("email").value = $document.getElementById("email").defaultValue =  ;

    function change(){
        var defaults = document.getElementById("singgahah");
        if(defaults == "Singgah"){
            document.getElementById("singgahah").innerHTML = "Pernah Singgah"; 
        } else {
            document.getElementById("singgahah").innerHTML = "Singgah";
        }
    }
});