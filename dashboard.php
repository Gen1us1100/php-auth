<?php 
    session_start();
    $LoggedIn = "";
    if(isset($_SESSION["loggedin"])){
    $LoggedIn = $_SESSION["loggedin"];
    }
?>

<?php
    if($LoggedIn)
    {
        echo "<h2>Login Successful!</h2>";
        echo "Username : ".$_SESSION["username"]."<br>";
        echo "Email: ".$_SESSION["email"]."<br>";
        echo '
        <form action="index.php" method="POST">
        <a href="index.php"><button>Logout</button></a>
        </form>';
    }
    else{
        echo "<h2>You Need to Login first!</h2><br>";
        echo '<a href="login.php"><button>login</button></a>';
    }
    
?>
