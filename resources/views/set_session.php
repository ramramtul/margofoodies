<?php
use Session;
Session::set('or', $request->input('role') );
 <script>
 $.ajax({
         url: "calculate",
    });  
 </script>

?>