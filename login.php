<?php

$email = $password = "";

$emailErr = $passwordErr = "";


if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = $_POST["email"];
        
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = $_POST["password"];
    }

    if($email && $password) {
        include("connections.php");

        $check_email = mysqli_query($connections, "SELECT * FROM mytbl WHERE email='$email'");

        $check_email_row = mysqli_num_rows($check_email);

        if($check_email_row >0){

            while($row = mysqli_fetch_assoc($check_email)){

                $user_id = $row["id"];

                $db_password = $row["password"];
                $account_type = $row["account_type"];

                if($password == $db_password){

                    session_start();

                    $_SESSION["id"] = $user_id;

                    if($db_account_type == "1"){
                        echo "<script>window.location.href='admin';</script>";
                    }else{
                        echo "<script>window.location.href='user';</script>";

                    }
                }else{

                    $passwordErr = "Password is incorrect!";
                }

        }

        }else{

            $emailErr = "Email is not registered!";          
        }
        
        
    }
}

?>

<style>
.error {
    color: red;
}
</style>


<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

    <input type="text" name="email" value="<?php echo $email; ?>"> <br>
    <span class="error"><?php echo $emailErr; ?></span> <br>

    <input type="password" name="password" value="<?php echo $password; ?>"> <br>
    <span class="error"><?php echo $passwordErr; ?></span> <br>

    <input type="submit" value="Login">


</form>