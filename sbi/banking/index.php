<!DOCTYPE html>
<html>

 <head>

  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Basic Form</title>

  	<link rel="stylesheet" href="../assets/demo.css">
    <link rel="stylesheet" href="../assets/form-basic.css">

    <!-- Required CSS for table -->
    <!--<link rel="stylesheet" href="assets/normalize.css"> -->
    <link rel="stylesheet" href="../assets/style.css">
    <script src='http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js'></script>


    <!-- Require for Alert Box Color Warnings -->
    <style>
        .alert
        {
        padding: 20px;
        background-color: #f44336;
        color: white;
        opacity: 1;
        transition: opacity 0.6s;
        margin-bottom: 15px;
        }

        .alert.success {background-color: #4CAF50;}
        .alert.info {background-color: #2196F3;}
        .alert.warning {background-color: #2446F3;}

        .closebtn
            {
                margin-left: 15px;
                color: white;
                font-weight: bold;
                float: right;
                font-size: 22px;
                line-height: 20px;
                cursor: pointer;
                transition: 0.3s;
            }

        .closebtn:hover {
                color: black;
            }
    </style>

 </head>



 <body>
      <?php 	include("../headrow.php"); ?>
    <ul>
        <li><a href="../index.php">New Client</a></li>
        <li><a href="index.php" class="active">Customer Banking</a></li>
        <li><a href="personal.php">Self Banking</a></li>
        <li><a href="../form-search.php">Search</a></li>
    </ul>

   <div class="main-content">

    <?php
          if (isset($_REQUEST["cid"])) {
              $cid = $_REQUEST["cid"];

              echo "<form action=\"#\" method=\"post\" id=\"myForm\">
                <input type=\"hidden\" name=\"cid\" value=\"$cid\" />
              </form>";
              //phpcode responsibele for displaying user info row in table
              //echo "CID: ". $_POST['cid']. "<br />"; //Result Check
              include("../connection.php");
              $sql="SELECT * FROM tbl_sbiclients WHERE cid = '".$cid."'";
              $res=$con->query($sql);
              $nrows=$res->num_rows;
              echo "<form action = 'banking/index.php' method = 'POST' class='form-horizontal'>";
              print "<table class=\"responstable\" style=\"margin: 0 auto;max-width: 1250px\">\n";
              print "         <tr>\n";
              print "            <th data-th=\"Order Details\"><span>Client ID</span></th>\n";
              print "            <th><center>Name</center></th>\n";
              print "            <th><center>CIF</center></th>\n";
              print "            <th><center>Account</center></th>\n";
              print "            <th><center>Aadhar</center></th>\n";
              print "            <th>Gender</th>\n";
              print "            <th>Village</th>\n";
              print "            <th>Type</th>\n";
              print "            <th>OAP</th>\n";
              print "         </tr>";
              if ($nrows > 0) {
                  while ($get_column=$res->fetch_assoc()) {
                      echo "<td>". $get_column['cid']."</td>";
                      echo "<td>". $get_column['name']."</td>";
                      echo "<td>". $get_column['cifno']."</td>";
                      echo "<td>". $get_column['accno']."</td>";
                      echo "<td>". $get_column['aadhar']."</td>";
                      echo "<td>". $get_column['gender']."</td>";
                      echo "<td>". $get_column['village']."</td>";
                      echo "<td>". $get_column['acctype']."</td>";
                      echo "<td>". $get_column['oap']."</td>";
                      echo "</tr>";
                  }
              }
              echo "</table>
              <br><br>
                </form>";
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

              $sql = "INSERT INTO tbl_sbitrans ". "(cid, oap, opn, amt, refno)". "VALUES('$cid','$oap','$opn','$amt','$refno')";
              if ($con->query($sql) === true) {
                  //echo "New record created successfully"; echo "<br />";
                  /*echo "<div onclick=\"submitform()\" class='alert success'>
                      <span class='closebtn'>&times;</span>
                      <strong>Success!</strong> Transaction Entered Successfully !!!
                      </div>";*/
                  if ($opn=="Deposit") {
                      $sql = "UPDATE tbl_cash SET scih=scih+'$amt'";
                      $con->query($sql);

                      $sql = "UPDATE tbl_cash SET scab=scab-'$amt'";
                      $con->query($sql);
                  } else {
                      $sql = "UPDATE tbl_cash SET scih=scih-'$amt'";
                      $con->query($sql);

                      $sql = "UPDATE tbl_cash SET scab=scab+'$amt'";
                      $con->query($sql);
                  }
              } else {
                  echo "Error: " . $sql . "<br>" . $con->error;
              }
              echo "<meta http-equiv=\"refresh\" content=\"0;?cid=$cid \" >";
              $con->close();
          }
        ?>

        <!-- You only need this form and the form-basic.css -->

        <form action = "<?php $_PHP_SELF ?>" method = "POST" class="form-basic" method="post">

            <div class="form-title-row">
                <h1>Transaction Entry</h1>
            </div>

            <div class="form-row">
                <label>
                    <span>OAP</span>
                    <select name="oap" style="padding-right: 175px;">
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Operation</span>
                    <select name="opn">
                        <option value="Deposit">Deposit</option>
                        <option value="Withdrawal">Withdrawal</option>
                    </select>
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Amount</span>
                    <input type="text" name="amt">
                </label>
            </div>

            <div class="form-row">
                    <label>
                        <span>Refrence Number</span>
                        <input type="text" name="refno">
                    </label>
            </div>

            <div class="form-row">
                <input type='hidden' name='cid' value='<?php echo "$cid";?>'/>
                <button type="submit" >Enter</button>
            </div>

        </form>

    </div>

    </body>

</html>
