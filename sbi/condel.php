<?php
include("sessions.php");
?>
<!DOCTYPE html>
<html>
<?php
     include("connection.php");
     $cid = $_POST['cid'];
     //echo $cid;
     echo "<p> hello </p>";
     $sql="DELETE from tbl_sbiclients where cid='$cid'";
     if ($con->query($sql) === true) {
         //echo "New record created successfully"; echo "<br />";
         echo "<div class=\"container\">
         <div class=\"alert alert-success alert-dismissible\">
         <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
         <strong>Success!</strong> Client Data Deleted Successfully !!
         </div>
         <meta http-equiv=\"refresh\" content=\"0;url=form-search.php \" >
         </div>";

     } else {
         echo "Error: " . $sql . "<br>" . $con->error;
     }
     $con->close();
?>
</html>
