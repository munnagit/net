<?php 	include("../sessions.php"); ?>
<!DOCTYPE html>
<html>

 <head>

  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/x-icon" href="../images/logo.png" />

    <!-- Required CSS for multi column div side by side -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <title>Basic Form</title>

  	<link rel="stylesheet" href="../assets/demo.css">
    <link rel="stylesheet" href="../assets/form-basic.css">

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

    <!-- Required CSS for table -->
    <!--<link rel="stylesheet" href="assets/normalize.css"> -->
    <link rel="stylesheet" href="../assets/style.css">
    <script src='http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js'></script>



 </head>



 <body>

      <?php include("../headrow.php"); ?>
    <ul>
        <li><a href="../index.php">New Client</a></li>
        <li><a href="index.php" class="active">Customer Banking</a></li>
        <!-- <li><a href="personal.php">Self Banking</a></li> -->
        <li><a href="../form-search.php">Search</a></li>
        <li><a href="../trans.php">Transactions</a></li>
        <li><a href="../report.php">Reports</a></li>
    </ul>

   <div class="main-content">

    <?php

          //increase decrease drawerTable
          function updateCash($updIn, $cash, $arith)
          {
              include("../connection2.php");

              if ($updIn == "cash") {
                  $sql = "UPDATE tbl_cash SET cash = cash $arith $cash WHERE id=1";
                 
              } else if ($updIn == "account") {
                  $sql = "UPDATE tbl_cash SET account = account $arith $cash WHERE id=1";
              }

              if ($con->query($sql) === true) {  } else {
                  echo "Error: " . $sql . "<br>" . $con->error;
              }
          }

          if (isset($_REQUEST["cid"])) {
              $cid = $_REQUEST["cid"];
              echo '<div class="w3-row">';
              echo '<div class="w3-col w3-lightgray w3-container" style="width:20%">';
              echo "<form action=\"#\" method=\"post\" id=\"myForm\">
                <input type=\"hidden\" name=\"cid\" value=\"$cid\" />
              </form>";
              //phpcode responsibele for displaying user info row in table
              //echo "CID: ". $_POST['cid']. "<br />"; //Result Check
              include("../connection.php");
              $sql="SELECT * FROM tbl_sbiclients WHERE cid = '".$cid."'";
              $res=$con->query($sql);
              $nrows=$res->num_rows;
              $get_column=$res->fetch_assoc();
              echo "<center>";
              echo "<form action = 'banking/index.php' method = 'POST' class='form-horizontal'>";
              print "<table class=\"responstable\" style=\"margin: 0 auto;\">\n";
              print "         <tr>\n";
              print "            <th data-th=\"User Details\"><span>Client ID</span></th>\n";
              echo "<td>". $get_column['cid']."</td>";
              echo "</tr>";
              echo "<tr>";
              print "            <th><center>Name</center></th>\n";
              echo "<td>". $get_column['name']."</td>";
              echo "</tr>";
              echo "<tr>";
              print "            <th>OAP</th>\n";
              if ($get_column['oap'] == "Yes")
              {
               echo "<td style='color: red;background-color: #eded15;'>". $get_column['oap']."</td>";
              }else {
                 echo "<td>". $get_column['oap']."</td>";
               }
              echo "</tr>";
              echo "<tr>";
              print "            <th><center>CIF</center></th>\n";
              echo "<td>". $get_column['cifno']."</td>";
              echo "</tr>";
              echo "<tr>";
              print "            <th><center>Account</center></th>\n";
              echo "<td>". $get_column['accno']."</td>";
              echo "</tr>";
              echo "<tr>";
              print "            <th><center>Aadhar</center></th>\n";
              echo "<td>". $get_column['aadhar']."</td>";
              echo "</tr>";
              echo "<tr>";
              print "            <th>Gender</th>\n";
              echo "<td>". $get_column['gender']."</td>";
              echo "</tr>";
              echo "<tr>";
              print "            <th>Village</th>\n";
              echo "<td>". $get_column['village']."</td>";
              echo "</tr>";
              echo "<tr>";
              print "            <th>Type</th>\n";
              echo "<td>". $get_column['acctype']."</td>";
              echo "</tr>";

              echo "</center>";

              echo "</table>
              <br><br>
                </form>";
                echo '</div>';
              mysqli_close($con);
          }

          //phpcode responsibele for inserting into tbl_sbitrans
          if (isset($_POST["oap"])) {
              $oap = $_POST['oap'];
              $opn= $_POST['opn'];
              $amt= $_POST['amt'];
              $refno= $_POST['refno'];
              //echo ": ". $_POST['birthday']. "<br />"; //Result Check

              //DB Connectivity & Insert Query
              include("../connection.php");
              date_default_timezone_set("Asia/Kolkata");
              $stamp=date("Y-m-d H:i:s");
              $sql = "INSERT INTO tbl_sbitrans ". "(cid, oap, opn, amt, refno, stamp)". "VALUES('$cid','$oap','$opn','$amt','$refno','$stamp')";
              if ($con->query($sql) === true) {
                  //echo "New record created successfully"; echo "<br />";
                  /*echo "<div onclick=\"submitform()\" class='alert success'>
                      <span class='closebtn'>&times;</span>
                      <strong>Success!</strong> Transaction Entered Successfully !!!
                      </div>";*/
                  if ($opn=="Deposit") {
                      $sql = "UPDATE tbl_cash SET scih=scih+'$amt'";
                      $con->query($sql);
                      updateCash("cash",$amt,"+");

                      $sql = "UPDATE tbl_cash SET scab=scab-'$amt'";
                      $con->query($sql);
                      updateCash("account",$amt,"-");
                  } else {
                      $sql = "UPDATE tbl_cash SET scih=scih-'$amt'";
                      $con->query($sql);
                      updateCash("cash",$amt,"-");

                      $sql = "UPDATE tbl_cash SET scab=scab+'$amt'";
                      $con->query($sql);
                      updateCash("account",$amt,"+");
                  }
              } else {
                  echo "Error: " . $sql . "<br>" . $con->error;
              }
              echo "<meta http-equiv=\"refresh\" content=\"0;?cid=$cid \" >";
              $con->close();
          }
        ?>

        <!-- You only need this form and the form-basic.css -->


        <div class="w3-col w3-lightgray w3-container" style="width:60%">

        <form action = "<?php $_PHP_SELF ?>" method = "POST" class="form-basic" method="post">

            <div class="form-title-row">
                <h1>Transaction Entry</h1>
            </div>

            <div class="form-row">
                <label>
                    <span>OAP</span>
                    <select id="oap" name="oap" style="padding-right: 175px;">
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Operation</span>
                    <select name="opn" id="opn">
                    <!--  <option value="blank">&nbsp;</option> -->
                      <option value="Withdrawal">Withdrawal</option>
                      <option value="Deposit">Deposit</option>
                    </select>
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Amount</span>
                    <input type="text" name="amt" required>
                </label>
            </div>

            <div class="form-row">
                    <label>
                        <span>Refrence Number</span>
                        <input type="text" onkeyup="this.value = this.value.toUpperCase()"; name="refno" required>
                    </label>
            </div>

            <div class="form-row">
                <input type='hidden' name='cid' value='<?php echo "$cid";?>'/>
                <button type="submit" >Enter</button>
            </div>

        </form>

    </div>
    <div class="w3-col w3-lightgray w3-container" style="width:20%">
    <?php
    include("../connection.php");
    $sql="SELECT * FROM tbl_sbitrans WHERE cid = '".$cid."' order by stamp desc limit 5";
    $res=$con->query($sql);
    $nrows=$res->num_rows;
    print "<table class=\"responstable\" style=\"margin: 0 auto;max-width: 1250px\">\n";
    print "         <tr>\n";
    print "            <th><center>Mode</center></th>\n";
    print "            <th><center>Amt</center></th>\n";
    print "            <th><center>Date</center></th>\n";
    print "         </tr>";
    if ($nrows > 0) {
        while ($get_column=$res->fetch_assoc()) {
            if ($get_column['oap'] == "Yes")
            {
              echo"<tr style='color: red;background-color: #eded15;'>";
              $sub = substr($get_column['opn'],0,1);
              echo "<td>". $sub ."</td>";
              echo "<td><center>". $get_column['amt']."</center></td>";
              echo "<td><center>". date('d M',strtotime($get_column['stamp']))."</center></td>";
              echo "</tr>";
             //echo "<td style='color: red;background-color: #eded15;'>". $get_column['oap']."</td>";
            }else {
              echo"<tr>";
              $sub = substr($get_column['opn'],0,1);
              echo "<td>". $sub ."</td>";
              echo "<td><center>". $get_column['amt']."</center></td>";
              echo "<td><center>". date('d M',strtotime($get_column['stamp']))."</center></td>";
              echo "</tr>";
           }

        }
    }

    mysqli_close($con);
    ?>
    </center></div>
  </div>


  </div>


  <!-- Select Option Change based on another Select, This has to be below html defenition -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script>
      var lookup = {
     'No': ['Deposit','Withdrawal'],
     'Yes': ['Withdrawal']
     };

     $('#oap').on('change', function() {
     var selectValue = $(this).val();
     $('#opn').empty();
     for (i = 0; i < lookup[selectValue].length; i++) {
        $('#opn').append("<option value='" + lookup[selectValue][i] + "'>" + lookup[selectValue][i] + "</option>");
     }
  });
  </script>

    </body>

</html>
