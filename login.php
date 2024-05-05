<?php
    require "db.php";
    require_once "functions.php";
    $emailErr = $passwordErr = "";
    $LoggedIn = False;
    if(isset($_POST['login'])){
        if(empty($_POST['email'])){
            $emailErr = 'email can\'t be empty';
        }
        else{
            
            $email = filter_input(INPUT_POST,'email', FILTER_SANITIZE_EMAIL);
            
        }
        if(empty($_POST['password'])){
            $passwordErr ='password can\'t be empty';
        }
        else{
            if(strlen(trim($_POST['password'])) < 8){
                $passwordErr = 'password length must be greater than 8';
            }
            else{
            $password = filter_input(INPUT_POST,'password');
            }
        }
        if(isset($email) && isset($password)){
            if(already_exists("users","email","{$email}")){
                mysqli_report(MYSQLI_REPORT_ALL);
                $query = "SELECT * from users where email=?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s",$email);
                $stmt->execute();
                $result = $stmt->get_result();
                // $stmt->store_result();
                $user=mysqli_fetch_assoc($result);
                $email = $user["email"];
                $username = $user["username"];
                $password_hash = $user["password"];
                
                if(password_verify($password,$password_hash)){
                    
                    $LoggedIn = True;
                }
                
            }
        }
    }
?>
<h2>Login</h2>
<link rel="stylesheet" href="style.css">
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" class="signup_form" >
    <input type="text" name="email" placeholder="enter email">
    <?php echo ($emailErr)?"<p>{$emailErr}</p>":""?>
    <input type="password" name="password" placeholder="enter Password">
    <?php echo ($passwordErr)?"<p>{$passwordErr}</p>":""?>
    <input type="submit" value="Login!" name="login">
</form>

<?php
if(isset($_POST['login'])){
    if($LoggedIn){
        echo "Login Successful!<br>";
        echo "Username : {$username}<br>";
        echo "Email: {$email}";
    }
    else{
        echo "Incorrect Password! Retry";
    }
}
?>
