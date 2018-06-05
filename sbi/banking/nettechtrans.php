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

    <!-- Require JS for TextBox On focus out Calculation -->
    <script>
      function chkAdvance() {
      var x = document.getElementById("sp");
      var y = document.getElementById("cashpay");
      var z = document.getElementById("adv");
      var c = document.getElementById("cdt");
      var p = document.getElementById("pft");
      var cp = document.getElementById("cp");
      var fo = document.getElementById("info");
      if ( 0 < +y.value - +x.value )
      {
        z.value = +y.value - +x.value;
        c.value = " ";
      }
      else {
        c.value = Math.abs(+y.value - +x.value);
        z.value = " ";
      }

      if ( 0 < x.value)
      {
        p.value = x.value - cp.value
      }
      else {
        c.value = cp.value
      }

      fo.style.display = "block";
     }

     function cpValue()
     {
       var a = document.getElementById("adv");
       var b = document.getElementById("tadv");
       var c = document.getElementById("cdt");
       var d = document.getElementById("tcdt");
       var e = document.getElementById("pft");
       var f = document.getElementById("tpft");
       b.innerHTML = a.value;
       d.innerHTML = c.value;
       f.innerHTML = e.value;
     }
    </script>
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
          print "<table class=\"responstable\" style= \"margin: 0 auto;max-width: 1250px\";>\n";
          print "         <tr>\n";
          print "            <th data-th=\"Order Details\"><span>Client ID</span></th>\n";
          print "            <th><center>Name</center></th>\n";
          print "            <th>Mobile Number</th>\n";
          print "            <th>Aadhar</th>\n";
          print "            <th>Date Of Birth</th>\n";
          print "         </tr>";
          if ($nrows > 0) {
              while ($get_column=$res->fetch_assoc()) {
                  echo "<td>". $get_column['cid']."</td>";
                  echo "<td WIDTH='25%''>". $get_column['cname']."</td>";
                  echo "<td>". $get_column['mno']."</td>";
                  echo "<td>". $get_column['uid']."</td>";
                  echo "<td>". date('d-m-Y', strtotime($get_column['dob'])). "</td>";
                  echo "</tr>";
              }
          }
          echo "</table>
              <br><br>
            </form>";
          mysqli_close($con);
      }

      //phpcode responsibele for displaying credit advance row
          include("../connection.php");
          $sql="SELECT * FROM tbl_cash";
          $res=$con->query($sql);
          $nrows=$res->num_rows;
          echo "<br>";
          echo "<form action = 'banking/index.php' method = 'POST' class='form-horizontal'>";
          print "<table class=\"responstable\" style= \"margin: 0 auto;max-width: 650px\";>\n";
          print "         <tr>\n";
          print "            <th data-th=\"Credit Details\"><span>Credit</span></th>\n";
          print "            <th><span><center>Advance</center></span></th>\n";
          print "         </tr>";
          if ($nrows > 0) {
              while ($get_column=$res->fetch_assoc()) {
                  echo "<td style=\"color :red\">". $get_column['scih']."</td>";
                  echo "<td style=\"color :green\"><center>". $get_column['scab']."</center></td>";
                  echo "</tr>";
              }
          }
          echo "</table>
              <br><br>
            </form>";
          mysqli_close($con);

          //phpcode responsibele for inserting into tbl_nettrans
          if (isset($_POST["des"])) {
              $des = $_POST['des'];
              $sp= $_POST['sp'];
              $cp= $_POST['cp'];
              $cashpay= $_POST['cashpay'];
              $adv= $_POST['adv'];
              $cdt= $_POST['cdt'];
              $pft= $_POST['pft'];

              //echo "Order: ". $_POST['adv']. "<br />"; //Result Check

              //DB Connectivity & Insert Query
              include("../connection.php");

              $sql = "INSERT INTO tbl_nettrans ". "(cid, des, sp, cp, cashpay, adv, cdt, pft)". "VALUES('$cid','$des','$sp','$cp','$cashpay','$adv','$cdt','$pft')";

              if ($con->query($sql) === true) {
                  //echo "New record created successfully"; echo "<br />";
                  echo "<div class='alert success'>
                  <span class='closebtn'>&times;</span>
                  <strong>Success!</strong> Transaction Created Successfully !!!
                  </div>";
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

                <!-- Example Select box
                <!--<div class="form-row">
                    <label>
                        <span>Account Type</span>
                        <select name="type" style="padding-right: 175px;">
                            <option value="SB-G">SB-G</option>
                            <option value="SB-T">SB-T</option>
                        </select>
                    </label>
                </div> -->

                <div class="form-row">
                  <label>
                      <span>Description</span>
                      <input type="text" name="des">
                  </label>
                </div>

                <div class="form-row">
                    <label>
                        <span>Selling Price</span>
                        <input type="number" name="sp" id="sp">
                    </label>
                </div>

                <div class="form-row">
                    <label>
                        <span>Credit / Cost Price</span>
                        <input type="number" name="cp" id="cp">
                    </label>
                </div>

                <div class="form-row">
                    <label>
                        <span>Advance / Cash Payment </span>
                        <input type="number" name="cashpay" id="cashpay" onfocusout="chkAdvance(); cpValue();" />
                    </label>
                </div>

              <!--  <div class="form-row" style="display: none;"> -->
                <div class="form-row" style="display: none;">
                        <label>
                            <span>Advance</span>
                            <input type="number" name="adv" id="adv" readonly="readonly" />
                        </label>
                </div>

                <div class="form-row" style="display: none;">
                        <label>
                            <span>Credit</span>
                            <input type="number" name="cdt" id="cdt" readonly="readonly" />
                        </label>
                </div>

                <div class="form-row" style="display: none;">
                        <label>
                            <span>Profit</span>
                            <input type="number" name="pft" id="pft" readonly="readonly" />
                        </label>
                </div>

                <div class="form-row" id="info" style="display: none;">
                <table class="responstable" style="margin: 0 auto;max-width: 650px; border: 0px;">
                  <tbody>
                    <tr>
                      <th data-th="Credit Details" style="background-color: #6f7479"><span>Adv</span></th>
                      <th style="background-color: #6f7479"><span><center>Cdt</center></span></th>
                      <th style="background-color: #6f7479"><span><center>Nav</center></span></th>
                    </tr>
                    <tr>
                      <td style="color :blue" ><center><p id="tadv"></p></center></td>
                      <td style="color :red"><center><p id="tcdt"></p></center></td>
                      <td style="color :green"><center><p id="tpft"></td></center></td>
                    </tr>
                  </tbody>
              </table>
            </div>

             <div class="form-row">
                 <input type='hidden' name='cid' value='<?php echo "$cid";?>'/>
                 <button type="submit">Enter</button>
             </div>

            </form>

    </div>

    </body>

</html>
