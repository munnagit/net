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
        <li><a href="trans.php" >Transactions</a></li>
        <li><a href="stats.php" class="active">Statistics</a></li>
        <li><a href="report.php">Reports</a></li>
    </ul>


    <div class="main-content">
        <!-- phpcode responsible for find and list client details row matching phone no -->
        <?php
            define("Year", "Year");
            define("Month", "Month");
            define("Week", "Week");
            define("Today", "Today");
            
            $countClient="SELECT COUNT(*) FROM tbl_sbiclients";
            $countTrans="SELECT COUNT(*) FROM tbl_sbitrans";
            $countOapTrans="SELECT COUNT(*) FROM tbl_sbitrans WHERE oap='Yes'";
            $countRegTrans="SELECT COUNT(*) FROM tbl_sbitrans WHERE oap='No'";
            $countDeposit="SELECT COUNT(*) FROM tbl_sbitrans WHERE opn='Deposit'";
            $countWithdrawal="SELECT COUNT(*) FROM tbl_sbitrans WHERE opn='Withdrawal'";
            $sumDep="SELECT SUM(amt) as 'COUNT(*)' FROM tbl_sbitrans WHERE opn='Deposit'";
            $sumWdl="SELECT SUM(amt) as 'COUNT(*)' FROM tbl_sbitrans WHERE opn='Withdrawal'";
            $sumRegWdl="SELECT SUM(amt) as 'COUNT(*)' FROM tbl_sbitrans WHERE opn='Withdrawal' AND oap='No'";
            $sumRegDep="SELECT SUM(amt) as 'COUNT(*)' FROM tbl_sbitrans WHERE opn='Deposit' AND oap='No'";
            $sumOapWdl="SELECT SUM(amt) as 'COUNT(*)' FROM tbl_sbitrans WHERE opn='Withdrawal' AND oap='Yes'";

            $sqlQuery = array($countClient, $countTrans, $countOapTrans, $countRegTrans, $countDeposit, $countWithdrawal, $sumDep, $sumWdl, $sumRegWdl, $sumRegDep, $sumOapWdl);
            $colName = array("Client","Transaction","OAP","Regular","Deposit","Withdrawal","Sum-DEP","Sum-WDL","sumREG-WDL","sumREG-DEP","sumOAP-WDL");
            $period = array("def","Year","Month","Week","Today");

             function identifyDate($period, $sql)
             {
                date_default_timezone_set("Asia/Kolkata");
                $today=date("Y-m-d");

                if (strpos($sql, 'tbl_sbitrans') !== false) {
                    $columnFlag = "stamp";
                }
                else {
                    $columnFlag = "dor"; 
                }

                if (strpos($sql, 'WHERE') !== false) {
                    $whereFlag = "AND";
                }
                else {
                    $whereFlag = "WHERE"; 
                }

                 switch ($period){
                     case Year:
                     $dt = date("Y-m-d", strtotime("-365 days"));
                     $cc = " ". $sql . " ". $whereFlag ." ".$columnFlag." BETWEEN '".$dt."' AND '".$today."'";
                     //echo $cc . " ---- <br>";
                     $get_column = runSql($cc);
                     return $get_column;
                     break;

                     case Month:
                     $dt = date("Y-m-d", strtotime("-30 days"));
                     $cc = $sql . " ". $whereFlag ."  ".$columnFlag." BETWEEN '".  $dt."' AND '".$today."'";
                     //echo $cc . "<br>";
                     $get_column = runSql($cc);
                     return $get_column;
                     break;
                     
                     case Week:
                     $dt = date("Y-m-d", strtotime("-7 days"));
                     $cc = $sql . " ". $whereFlag ." ".$columnFlag." BETWEEN '".  $dt."' AND '".$today."'";
                     //echo $cc . "<br>";
                     $get_column = runSql($cc);
                     return $get_column;
                     break;

                     case Today:
                     $cc = $sql . " ". $whereFlag ." ".$columnFlag." = '".$today."'";
                     //echo $cc . "<br>";
                     $get_column = runSql($cc);
                     return $get_column;
                     break;

                     default:
                     $cc = $sql;
                     //echo $cc . "<br>";
                     $get_column = runSql($cc);
                     return $get_column;
                     break;
                 }
             }
             

             function runSql($sql) {
                include("connection.php");
                //echo $sql . "<br>";
                $res=$con->query($sql) or die($con->error);
                $get_column=$res->fetch_assoc();
                mysqli_close($con);
                return $get_column;
             }
             
             echo "<br><br><br>";
             //echo "<form action = 'banking/index.php' method = 'POST' class='form-horizontal'>";
             //print "<table class=\"bordered\" id=\"sortedtable\" cellspacing=\"0\" style=\"margin: 0 auto;max-width: 1250px\">\n";
             print "<table id=\"table_sort\" class=\"responstable\" style=\"margin: 0 auto;max-width: 1250px\">\n";
             echo "<thead>\n<tr>";
             print "         <tr>\n";
             print "             <th>***</th>";
             print "            <th><center>Total</center></th>\n";
             print "            <th><center>Yearly</center></th>\n";
             print "            <th><center>Monthly</center></th>\n";
             print "            <th><center>Weekly</center></th>\n";
             print "            <th><center>Today</center></th>\n";
             print "         </tr>";
             print "</thead><tbody>";

             for ($i=0;$i<11;$i++)
             {
                echo"<tr>";
                echo "<th>".$colName[$i]."</th>";
                for ($j=0;$j<5;$j++)
                {
                    $get_column = identifyDate($period[$j],$sqlQuery[$i]);
                    echo "<td>". $get_column['COUNT(*)'] ."</td>";
                }
                echo"<tr>";
            }
             print "</tbody></table>";
        ?>

  </div>

 </body>

</html>
