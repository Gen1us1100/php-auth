<?php
    require "db.php";
    $result = NULL;
    $usernameErr = $emailErr = $passwordErr = $emailErrLogin= '';
    function already_exists(string $table_name,string $col_name,string $value){
        // check if username or email already exists in database
        global $conn;
        $check_col = "SELECT {$col_name} FROM {$table_name} where $col_name=?";
        $stmt = $conn->prepare($check_col);
        $stmt->bind_param("s",$value);
        $stmt->execute();
        $stmt->store_result();
        $result = $stmt->num_rows();
        return ($result>0)?True:False;   
    }

if(isset($_POST['signup'])){
    if(empty($_POST['username'])){
        $usernameErr =  'username can\'t be empty';
    }
    else{
        $username = filter_input(INPUT_POST,'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    
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
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        }
    }
    if(isset($username)&&isset($email)&&isset($password)){
        mysqli_report(MYSQLI_REPORT_ALL);
        
        if(already_exists("users", "email","{$email}")){
            $emailErrLogin = "Email Already Exists!<br> Login instead<br>".'<a href="login.php"><button>Login</button></a>';
        }
        else if(already_exists("users", "username","{$username}")){
            $usernameErr = "user name already taken";
        }
        else{
            $query = "INSERT INTO users(email,username,password) VALUES(?,?,?);";
            $stmt = mysqli_prepare($conn,$query);
            mysqli_stmt_bind_param($stmt,"sss", $email,$username, $password);
            $result = mysqli_stmt_execute($stmt);
            print_r(mysqli_error_list($conn));
        
    }
}
}
?>

<link rel="stylesheet" href="style.css">
<h2>New Registration</h2>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" class="signup_form">
    <input type="text" name="email" placeholder="enter email">
    <?php echo ($emailErr)?$emailErr:""?>
    <input type="text" name="username" placeholder="enter username">
    <?php echo ($usernameErr)?"<p>{$usernameErr}</p>":""?>
    <input type="password" name="password" placeholder="enter Password">
    <?php echo ($passwordErr)?"<p>{$passwordErr}</p>":""?>
    <input type="submit" value="Sign Up!" name="signup">
</form>
<?php echo ($emailErrLogin)?$emailErrLogin:""?>

<?php
    if(isset($_POST["signup"])){
        $usernameErr = $emailErr = $passwordErr = '';
        // echo $email;
    }
?>