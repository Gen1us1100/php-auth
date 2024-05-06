<?php
    require("db.php");
    session_start();
    
    if(isset($_SESSION["loggedin"])){
        session_destroy();
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth using xampp</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="signup.php"><button>Sign Up</button></a>
<?php echo '<a href="login.php"><button>Login</button></a>'?>
</body>
</html>
