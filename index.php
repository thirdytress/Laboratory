<?php

include("connections.php");

$name = $address = $email = $password = $cpassword = "";
$nameErr = $addressErr = $emailErr = $passwordErr = $cpasswordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty ($_POST["name"])) {
        $nameErr = "Name is required!";
    } else {
        $name = $_POST["name"];
    }

    if (empty ($_POST["address"])) {
        $addressErr = "Address is required!";
    } else {
        $address = $_POST["address"];
    }

    if (empty ($_POST["email"])) {
        $emailErr = "Email is required!";
    } else {
        $email = $_POST["email"];
    }

    if (empty ($_POST["password"])) {
        $passwordErr = "Password is required!";
    } else {
        $password = $_POST["password"];
    }

    if (empty ($_POST["cpassword"])) {
        $cpasswordErr = "Confirm Password is required!";
    } else {
        $cpassword = $_POST["cpassword"];
    }
    

    if ($name && $address && $email && $password && $cpassword) {

        $check_email = mysqli_query($connections, "SELECT * FROM mytbl WHERE email='$email'");
        $check_email_row = mysqli_num_rows($check_email);

        if ($check_email_row > 0){

            $emailErr = "Email is already registered!";
        }else{

            $query = mysqli_query($connections, "INSERT INTO mytbl (name, address, email, password,account_type) VALUES ('$name', '$address', '$email', '$cpassword', '2')");

            echo "<script language='javascript'>alert('Record has been inserted!')</script>";
            echo "<script>window.location.href='index.php';</script>";
            
        }
    }
        

}

?>

<style>
.error { 
     color:red;
}
   
</style>

<br>

<?php include("nav.php"); ?>

<br>
<br>


<form method="POST" action="<?php htmlspecialchars ("PHP_SELF"); ?>">

Name: <input type="text" name= "name" value="<?php echo $name; ?>"> <br>
<span class="error"><?php echo $nameErr; ?> </span> <br>

Address: <input type="text" name= "address" value="<?php echo $address; ?>"> <br>
<span class="error"><?php echo $addressErr; ?> </span> <br>

Email: <input type="text" name= "email" value="<?php echo $email; ?>"> <br>
<span class="error"><?php echo $emailErr; ?> </span> <br>

Password: <input type="password" name= "password" value="<?php echo $password; ?>"> <br>
<span class="error"><?php echo $passwordErr; ?> </span> <br>

Confirm Password: <input type="password" name= "cpassword" value="<?php echo $cpassword; ?>"> <br>
<span class="error"><?php echo $cpasswordErr; ?> </span> <br>

<input type="submit" name="Submit">

</form>

<hr>

<?php

    

        


    
    $view_query = mysqli_query($connections,"SELECT * FROM mytbl");

    echo "<table border='1' width='50%'>
            <tr>
                <td>Name</td>
                <td>Address</td>
                <td>Email</td>

                <td>Options</td>
            </tr>";

    while($row = mysqli_fetch_assoc($view_query)){

            $user_id = $row["id"];

            $db_name = $row["name"];
            $db_address = $row["address"];
            $db_email = $row["email"];

        echo "<tr> 
                <td>$db_name</td>
                <td>$db_address</td>
                <td>$db_email</td>

                <td>
                    <a href='Edit.php?id=$user_id'>Update</a>

                    |&nbsp;

                    <a href='ConfirmDelete.php?id=$user_id'>Delete</a>
                </td>
        
            </tr>";

                
    }
        echo "</table>";
?>

<hr>

<?php

$Kyla = "Kyla";
$Thirdy = "Thirdy";
$Kys = "Kys";
    
$names = array("Thirdy", "Kyla", "Kys");

foreach($names as $display_names){

    echo $display_names . "<br>";


}
    
?>