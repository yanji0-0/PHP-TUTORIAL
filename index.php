<?php


    include ("connections.php");

$name = $address = $email = $section = $contact = $password = $cpassword = "";
$nameErr = $addressErr = $emailErr = $sectionErr = $contactErr = $passwordErr = $cpasswordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = htmlspecialchars($_POST["name"]);
    }

    if (empty($_POST["address"])) {
        $addressErr = "Address is required";
    } else {
        $address = htmlspecialchars($_POST["address"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    } else {
        $email = htmlspecialchars($_POST["email"]);
    }

    if (empty($_POST["section"])) {
        $sectionErr = "Section is required";
    } else {
        $section = htmlspecialchars($_POST["section"]);
    }

    if (empty($_POST["contact"])) {
        $contactErr = "Contact is required";
    } else {
        $contact = htmlspecialchars($_POST["contact"]);
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = htmlspecialchars($_POST["password"]);
    }

    if (empty($_POST["cpassword"])) {
        $cpasswordErr = "Confirm Password is required";
    } else{
        $cpassword = htmlspecialchars($_POST["cpassword"]);
    }



if ($name && $address && $email && $section && $contact && $password && $cpassword) {

    $check_email = mysqli_query($connections, "SELECT * FROM mytbl WHERE email='$email'");

    $check_email_row = mysqli_num_rows($check_email);

    if ($check_email_row > 0) {

        $emailErr = "Email is already registered!";
        
    }else{
         
        $query = mysqli_query($connections, "INSERT INTO mytbl (name, address, email, section, contact, password, account_type) VALUES ('$name', '$address', '$email', '$section', '$contact', '$cpassword', '2')");
        
        echo "<script language='javascript'>alert('New record has been inserted!')</script>";
        echo "<script>window.location.href='index.php';</script>";

    }

   

}
}

?>

<style>
    .error {
        color: red;
    }
</style>

<br>

<?php include("nav.php"); ?>

<br>
<br>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

    Name: <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Complete Name"><br>
    <span class="error"><?php echo $nameErr; ?></span><br>

    Address: <input type="text" name="address" value="<?php echo $address; ?>" placeholder="Complete Address"><br>
    <span class="error"><?php echo $addressErr; ?></span><br>

    Email: <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Email Address"><br>
    <span class="error"><?php echo $emailErr; ?></span><br>

    Section: <input type="text" name="section" value="<?php echo $section; ?>" placeholder="Section"><br>
    <span class="error"><?php echo $sectionErr; ?></span><br>

    Contact: <input type="text" name="contact" value="<?php echo $contact; ?>" placeholder="Contact"><br>
    <span class="error"><?php echo $contactErr; ?></span><br>

    Password: <input type="password" name="password" value="<?php echo $password; ?>" placeholder="Password"><br>
    <span class="error"><?php echo $passwordErr; ?></span><br>

    Confirm Password: <input type="password" name="cpassword" value="<?php echo $cpassword; ?>" placeholder="Confirm Password"><br>
    <span class="error"><?php echo $cpasswordErr; ?></span><br>

    <input type="submit" value="Submit">
</form>

<hr>

<?php



$view_query = mysqli_query($connections, "SELECT * FROM mytbl");

echo"<table border='1' width='50%'>";
echo "<tr>
        <th>Name</th>
        <th>Address</th>
        <th>Email</th>
        <th>Section</th>
        <th>Contact</th>

        <th>Option</th>

      </tr>";

while($row = mysqli_fetch_assoc($view_query)) {

  $user_id = $row['id'];

  $db_name = $row['name'];
  $db_address = $row['address'];
  $db_email = $row['email'];
  $db_section = $row['section'];
  $db_contact = $row['contact'];

  echo "<tr>
          <td>$db_name</td>
          <td>$db_address</td>
          <td>$db_email</td>
          <td>$db_section</td>
          <td>$db_contact</td>

          <td>

          <a href='Edit.php?id=$user_id'>Update</a>

          &nbsp;

          <a href='ConfirmDelete.php?id=$user_id'>Delete</a>

          </td>


        </tr>";

 
}

echo "</table>";

?>

<hr>

<?php

$Paul = "Paul";
$Mica = "Mica";
$Kaye = "Kaye";
$MJ ="MJ";
$Marian = "Marian";
$Justine = "Justine";


$names = array("Kaye","Paul","Mica", "MJ", "Marian", "Justine");

foreach($names as $display_names){

    echo $display_names . "<br>";


}

?>