<?php

$email = $password = "";

$emailErr = $passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty($_POST["email"])){

        $emailErr = "Email is required";

    } else {

        $email = $_POST["email"];
    }

    if(empty($_POST["password"])){

        $passwordErr = "Password is required";

    } else {

        $password = $_POST["password"];
    }

    if ($email && $password) {

        include("connections.php");

        $check_email = mysqli_query($connections, "SELECT * FROM mytbl WHERE email='$email'");

       $check_email_row = mysqli_num_rows($check_email);
       
         if($check_email_row > 0){

            while($row = mysqli_fetch_assoc($check_email)){

                $db_password = $row["password"];
                $db_account_type = $row["account_type"];

                if($password == $db_password){

                    if($db_account_type == "1"){

                        echo "<script>window.location.href='admin';</script>";


                    
                    }else{

                        echo"<script>window.location.href='user';</script>";

                    }

                } else {
                    
                    $passwordErr = "Incorrect Password!";

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

<form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
 
<input type="text" name="email" value="<?php echo $email; ?>"> <br>
<span class="error"><?php echo $emailErr; ?></span><br>

<input type="password" name="password" value=""> <br>
<span class="error"><?php echo $passwordErr; ?></span><br>

<input type="submit" value="Login">

</form>