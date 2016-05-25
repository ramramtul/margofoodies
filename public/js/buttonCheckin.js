$(document).ready(function(){
    $("#namaku").hide();
    $("#restoranku").hide();
    // var email = <?php session()->get('user')->email ?>
    // document.getElementById("email").value = $document.getElementById("email").defaultValue =  ;

    
});

function change(){
        var defaults = document.getElementById("singgahah").innerHTML;
        if(defaults == "Singgah"){
            if(document.getElementById("namaku").value == "kosong"){
                document.getElementById("singgahah").innerHTML = "Singgah";
                alert("anda harus login terlebih dahulu");
            } else {
                document.getElementById("singgahah").innerHTML = "Pernah Singgah"; 
            }
        } else {
            document.getElementById("singgahah").innerHTML = "Singgah";
        }
}