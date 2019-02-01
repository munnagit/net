<?php include("sessions.php"); ?>
<!DOCTYPE html>
<html>

 <head>

	 <meta charset="utf-8">
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <link rel="icon" type="image/x-icon" href="images/logo.png" />


	 <link rel="stylesheet" href="assets/demo.css">
	 <link rel="stylesheet" href="assets/form-search.css">
   <link rel="stylesheet" href="assets/form-basic.css">

   <!-- Required CSS for table -->
   <!--<link rel="stylesheet" href="assets/normalize.css"> -->
   <link rel="stylesheet" href="assets/style.css">
   <script src='http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js'></script>

   <!-- include jQuery library and table sorter plugin http://www.developerdesks.com/simple-table-sorting-in-jquery-with-mysql-data -->
   <script type='text/javascript' src='js/jquery-latest.js'>
   </script>
   <script type='text/javascript' src='js/jquery.tablesorter.min.js'>
   </script>

   <!-- script needed for sorting table -->
   <script type='text/javascript'>
    $(document).ready(function() {
    $("#table_sort").tablesorter({

    });
    });
   </script>
 </head>
 <body>
   <?php
       //phpcode responsibele for displaying tbl_cash row
       include("headrow.php");
    ?>

    <ul>
        <li><a href="index.php">New Client</a></li>
        <li><a href="./banking/personal.php">Self Banking</a></li>
        <li><a href="form-search.php" >Search</a></li>
        <li><a href="trans.php" class="active">Transactions</a></li>
        <li><a href="stats.php" >Statistics</a></li>
        <li><a href="report.php">Reports</a></li>
    </ul>


    <div class="main-content">
        <!-- phpcode responsible for find and list client details row matching phone no -->
        <?php

             //$cifno = $_POST['search'];
             //echo "Mno: ". $_POST['search']. "<br />"; //Result Check
             include("connection.php");
             $sql="SELECT a.cid,a.name,b.tid,b.amt,b.oap,b.opn,b.refno,b.stamp FROM tbl_sbitrans b,tbl_sbiclients a where b.cid = a.cid ORDER BY b.stamp desc LIMIT 25";
             $res=$con->query($sql);
             $nrows=$res->num_rows;
             echo "<br><br><br>";
             //echo "<form action = 'banking/index.php' method = 'POST' class='form-horizontal'>";
             //print "<table class=\"bordered\" id=\"sortedtable\" cellspacing=\"0\" style=\"margin: 0 auto;max-width: 1250px\">\n";
             print "<table id=\"table_sort\" class=\"responstable\" style=\"margin: 0 auto;max-width: 1250px\">\n";
             echo "<thead>\n<tr>";
             print "         <tr>\n";
             print "            <th><center>Client ID</center></th>\n";
             print "            <th><center>Name</center></th>\n";
             print "            <th><center>Trans ID</center></th>\n";
             print "            <th><center>Amount</center></th>\n";
             print "            <th><center>Operation</center></th>\n";
             print "            <th><center>OAP</center></th>\n";
             print "            <th><center>Ref No</center></th>\n";
             print "            <th><center>Time</center></th>\n";
             print "         </tr>";
             print "</thead><tbody>";
             if ($nrows > 0) {
                 while ($get_column=$res->fetch_assoc()) {
                     echo"<tr>";
                     echo "<td>". $get_column['cid']."</td>";
                     echo "<td>". $get_column['name']."</td>";
                     echo "<td>". $get_column['tid']."</td>";
                     echo "<td>". $get_column['amt']."</td>";
                     echo "<td>". $get_column['opn']."</td>";
                     echo "<td>". $get_column['oap']."</td>";
                     echo "<td>". $get_column['refno']."</td>";
                     echo "<td><center>". date('d-m-Y H:i',strtotime($get_column['stamp']))."</center></td>";
                     echo "</tr>";
                 }
             }
             print "</tbody></table>";
             mysqli_close($con);
        ?>

  </div>

 </body>

</html>
