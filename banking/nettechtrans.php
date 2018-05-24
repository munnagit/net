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
    <header>
    <center><h1>NetTech Transactions</h1></center>
        <!-- <a href="http://tutorialzine.com/2015/07/freebie-7-clean-and-responsive-forms/">Download</a> -->
    </header>

    <ul>
        <li><a href="../index.php">New Client</a></li>
        <li><a href="index.php">Customer Banking</a></li>
        <li><a href="nettechtrans.php" class="active">Nettech Transactions</a></li>
        <li><a href="personal.php">Self Banking</a></li>
        <li><a href="../form-search.php">Search</a></li>
    </ul>


   <div class="main-content">

    <?php
    //phpcode responsibele for displaying user info row in table
    if (isset($_POST["cid"])) {
        $cid = $_POST['cid'];
        //echo "CID: ". $_POST['cid']. "<br />"; //Result Check
        include("../connection.php");
        $sql="SELECT * FROM tbl_clients WHERE cid = '".$cid."'";
        $res=$con->query($sql);
        $nrows=$res->num_rows;
        echo "<br>";
        echo "<form action = 'banking/index.php' method = 'POST' class='form-horizontal'>";
        print "<table class=\"responstable\">\n";
        print "         <tr>\n";
        print "            <th data-th=\"Order Details\"><span>Client ID</span></th>\n";
        print "            <th>Name</th>\n";
        print "            <th>Mobile Number</th>\n";
        print "            <th>Aadhar</th>\n";
        print "            <th>SBI ACCNO</th>\n";
        print "            <th>CIF NO</th>\n";
        print "            <th>Date Of Birth</th>\n";
        print "         </tr>";
        if ($nrows > 0) {
            while ($get_column=$res->fetch_assoc()) {
                echo "<td>". $get_column['cid']."</td>";
                echo "<td>". $get_column['cname']."</td>";
                echo "<td>". $get_column['mno']."</td>";
                echo "<td>". $get_column['uid']."</td>";
                echo "<td>". $get_column['sbiaccno']."</td>";
                echo "<td>". $get_column['cif']."</td>";
                echo "<td>". date('d-m-Y', strtotime($get_column['dob'])). "</td>";
                echo "</tr>";
            }
        }
        echo "</table>
            <br><br>
          </form>";
        mysqli_close($con);
    }

    //phpcode responsibele for displaying tbl_cash row
        include("../connection.php");
        $sql="SELECT * FROM tbl_cash";
        $res=$con->query($sql);
        $nrows=$res->num_rows;
        echo "<br>";
        echo "<form action = 'banking/index.php' method = 'POST' class='form-horizontal'>";
        print "<table class=\"responstable\">\n";
        print "         <tr>\n";
        print "            <th data-th=\"Order Details\"><span>Credit</span></th>\n";
        print "            <th><span><center>Advance</center></span></th>\n";
        print "         </tr>";
        if ($nrows > 0) {
            while ($get_column=$res->fetch_assoc()) {
                echo "<td>". $get_column['scih']."</td>";
                echo "<td><center>". $get_column['scab']."</center></td>";
                echo "</tr>";
            }
        }
        echo "</table>
            <br><br>
          </form>";
        mysqli_close($con);

    //phpcode responsibele for inserting into tbl_sbitrans
    if (isset($_POST["type"])) {
        $type = $_POST['type'];
        $opn= $_POST['opn'];
        $amt= $_POST['amt'];
        $refno= $_POST['refno'];
        //echo ": ". $_POST['birthday']. "<br />"; //Result Check

        //DB Connectivity & Insert Query
        include("../connection.php");

        $sql = "INSERT INTO tbl_sbitrans ". "(cid, type, opn, amt, refno)". "VALUES('$cid','$type','$opn','$amt','$refno')";

        if ($con->query($sql) === true) {
            //echo "New record created successfully"; echo "<br />";
            echo "<div class='alert success'>
                <span class='closebtn'>&times;</span>
                <strong>Success!</strong> Client Created Successfully !!!
                </div>";
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
        $con->close();
    }
        ?>

        <!-- You only need this form and the form-basic.css -->

        <form action = "<?php $_PHP_SELF ?>" method = "POST" class="form-basic" method="post" action="#">

            <div class="form-title-row">
                <h1>Transaction Entry</h1>
            </div>

            <div class="form-row">
                <label>
                    <span>Account Type</span>
                    <select name="type" style="padding-right: 175px;">
                        <option value="SB-G">SB-G</option>
                        <option value="SB-T">SB-T</option>
                    </select>
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Operation</span>
                    <select name="opn" style="padding-right: 143px;">
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
                <button type="submit">Enter</button>
            </div>

        </form>

    </div>

    </body>

</html>
