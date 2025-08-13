<?php

$user_id = $_REQUEST["id"];

$user_id;

include ("connections.php");

$get_record = mysqli_query($connections, "SELECT * FROM mytbl WHERE id='$user_id'");

while ($row_edit = mysqli_fetch_assoc($get_record)) {

  $db_name = $row_edit['name'];
  $db_address = $row_edit['address'];
  $db_email = $row_edit['email'];
  $db_section = $row_edit['section'];
  $db_contact = $row_edit['contact'];

}
    
?>

<form method = "POST" action = "Update_Record.php">

<input type = "hidden" name = "user_id" value = "<?php echo $user_id; ?>">
<input type = "text" name = "new_name" value = "<?php echo $db_name; ?>"><br>
<input type = "text" name = "new_address" value = "<?php echo $db_address; ?>"><br>
<input type = "email" name = "new_email" value = "<?php echo $db_email; ?>"><br>
<input type = "text" name = "new_section" value = "<?php echo $db_section; ?>"><br>
<input type = "text" name = "new_contact" value = "<?php echo $db_contact; ?>"><br>    
<input type = "submit" value = "Update">


</form>