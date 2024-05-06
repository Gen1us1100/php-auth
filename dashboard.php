<?php 
    session_start();
?>
<h2>Login Successful!</h2>
<?php

    echo "Username : ".$_SESSION["username"]."<br>";
    echo "Email: ".$_SESSION["email"];
?>