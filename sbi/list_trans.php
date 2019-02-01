<?php include("sessions.php"); ?>
<!DOCTYPE html>
<html>

 <head>

	 <meta charset="utf-8">
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">

 	 <title>Edit Transaction</title>

	 <link rel="stylesheet" href="assets/demo.css">
	 <link rel="stylesheet" href="assets/form-search.css">
   <link rel="stylesheet" href="assets/form-basic.css">

   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

   <link rel="icon" type="image/x-icon" href="images/logo.png" />

    <!-- Required CSS for table -->
    <!--<link rel="stylesheet" href="assets/normalize.css"> -->
    <link rel="stylesheet" href="assets/style.css">
    <script src='http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

     <!-- Below script required for selecting radion button when click on row -->
    <script>
       $(function() { // <== Doc ready

            $('tr').click(function(event) {

                if(event.target.type != "radio") {

                    var that = $(this).find('input:radio');
                    that.attr('checked', !that.is(':checked'));

                }
            });
        });
    </script>

    <script>
      function myFunction() {
        alert("Kindly Conform Delete");
        }
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
        <li><a href="form-search.html" class="active">Search</a></li>
        <li><a href="trans.php">Transactions</a></li>
        <li><a href="report.php">Reports</a></li>
    </ul>


    <div class="main-content">
        <!-- You only need this form and the form-search.css -->


        <!-- phpcode responsible for showing transaction for selected cid -->
        <?php
         if (isset($_POST["cid"])) {
             $cid = $_POST['cid'];
             //echo "Mno: ". $_POST['search']. "<br />"; //Result Check
             include("connection.php");
             $sql="SELECT * FROM tbl_sbitrans WHERE cid = \"$cid%\" LIMIT 50 ";
             $res=$con->query($sql);
             $nrows=$res->num_rows;
             echo "<br><br><br>";

             echo "<form method = 'POST' class='form-horizontal' action='edit_trans.php'>";
             print "<table class=\"responstable\" style=\"margin: 0 auto;max-width: 1250px\">\n";
             print "         <tr>\n";
             print "            <th><span>Select</span></th>\n";
             print "            <th data-th=\"Transaction Details\"><span>TID</span></th>\n";
             print "            <th><center>OAP</center></th>\n";
             print "            <th><center>Mode</center></th>\n";
             print "            <th><center>Amount</center></th>\n";
             print "            <th><center>RefNO</center></th>\n";
             print "            <th><center>Time</center></th>\n";
             print "         </tr>";
             if ($nrows > 0) {
                 while ($get_column=$res->fetch_assoc()) {
                     echo"<tr>
                    <td><input type='radio' name='tid' value=" . $get_column['tid']. " />";
                    echo "<td>". $get_column['tid']."</td>";
                     echo "<td>". $get_column['oap']."</td>";
                     echo "<td>". $get_column['opn']."</td>";
                     echo "<td>". $get_column['amt']."</td>";
                     echo "<td>". $get_column['refno']."</td>";
                     echo "<td>". $get_column['stamp']."</td>";
                     echo "</tr>";
                 }
             }
             echo "</table>
            <br>
            <div style='width:100&#37;;'>

              <div id='float1' style='width:50%;float:left;padding: 12px'>
              <button style='float:right' type='submit' name='edit' value='Edit'>Edit</button>
              </div>

            </div>
          </form>";

             mysqli_close($con);
         }
        ?>

  </div>

 </body>

</html>
