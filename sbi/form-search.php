<?php include("sessions.php"); ?>
<!DOCTYPE html>
<html>

 <head>

	 <meta charset="utf-8">
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">

 	 <title>Client Search</title>

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
    </ul>


    <div class="main-content">
        <!-- You only need this form and the form-search.css -->

        <form action = "<?php $_PHP_SELF ?>" method = "POST" class="form-search" method="post" action="#">
            <input type="search" name="search" placeholder="Name or CIF or ACC...">
            <button type="submit">Search</button>
            <i class="fa fa-search"></i>
        </form>


        <!-- phpcode responsible for find and list client details row matching phone no -->
        <?php
         if (isset($_POST["search"])) {
             $cifno = $_POST['search'];
             //echo "Mno: ". $_POST['search']. "<br />"; //Result Check
             include("connection.php");
             $sql="SELECT * FROM tbl_sbiclients where cifno like \"$cifno%\" or accno like \"$cifno%\" or aadhar like \"$cifno%\" or mob like \"$cifno%\" or cardno like \"$cifno%\"";
             $res=$con->query($sql);
             $nrows=$res->num_rows;
             echo "<br><br><br>";


             //echo "<form action = 'banking/index.php' method = 'POST' class='form-horizontal'>";

             if (isset($_POST['banking'])) {
                echo "<form action = 'banking/index.php' method = 'POST' class='form-horizontal'>";
            }

             echo "<form action = 'banking/index.php' method = 'POST' class='form-horizontal'>";
             print "<table class=\"responstable\" style=\"margin: 0 auto;max-width: 1250px\">\n";
             print "         <tr>\n";
             print "            <th><span>Select</span></th>\n";
             print "            <th data-th=\"Order Details\"><span>CID</span></th>\n";
             print "            <th><center>Name</center></th>\n";
             print "            <th><center>Mobile</center></th>\n";
             print "            <th><center>CIF</center></th>\n";
             print "            <th><center>Account</center></th>\n";
             print "            <th><center>Card</center></th>\n";
             print "            <th><center>Aadhar</center></th>\n";
             print "            <th>Gender</th>\n";
             print "            <th>Village</th>\n";
             print "            <th>Type</th>\n";
             print "            <th>Bank</th>\n";
             print "            <th>OAP</th>\n";
             print "         </tr>";
             if ($nrows > 0) {
                 while ($get_column=$res->fetch_assoc()) {
                     echo"<tr>
                    <td><input type='radio' name='cid' value=" . $get_column['cid']. " />";
                     echo "<td>". $get_column['cid']."</td>";
                     echo "<td>". $get_column['name']."</td>";
                     echo "<td>". $get_column['mob']."</td>";
                     echo "<td>". $get_column['cifno']."</td>";
                     echo "<td>". $get_column['accno']."</td>";
                     echo "<td>". $get_column['cardno']."</td>";
                     echo "<td>". $get_column['aadhar']."</td>";
                     echo "<td>". $get_column['gender']."</td>";
                     echo "<td>". $get_column['village']."</td>";
                     echo "<td>". $get_column['acctype']."</td>";
                     echo "<td>". $get_column['bname']."</td>";
                     echo "<td>". $get_column['oap']."</td>";
                     echo "</tr>";
                 }
             }
             //search with username
             else {
                 $cname = $_POST['search'];
                 //echo "Client Name: ". $_POST['search']. "<br />"; //print variable value
                 $sql="SELECT * FROM tbl_sbiclients WHERE name like '".$cname."%'";
                 $res=$con->query($sql);
                 $nrows=$res->num_rows;
                 if ($nrows > 0) {
                     while ($get_column=$res->fetch_assoc()) {
                         echo "<tr> <td><input type='radio' name='cid' value=" . $get_column['cid']. " />";
                         echo "<td>". $get_column['cid']."</td>";
                         echo "<td>". $get_column['name']."</td>";
                         echo "<td>". $get_column['mob']."</td>";
                         echo "<td>". $get_column['cifno']."</td>";
                         echo "<td>". $get_column['accno']."</td>";
                         echo "<td>". $get_column['cardno']."</td>";
                         echo "<td>". $get_column['aadhar']."</td>";
                         echo "<td>". $get_column['gender']."</td>";
                         echo "<td>". $get_column['village']."</td>";
                         echo "<td>". $get_column['acctype']."</td>";
                         echo "<td>". $get_column['bname']."</td>";
                         echo "<td>". $get_column['oap']."</td>";
                         echo "</tr>";
                     }
                 }
             }
             echo "</table>
            <br>
            <div style='width:100&#37;;'>

              <div id='float1' style='width:50%;float:left;padding: 12px'>
              <button style='float:right' type='submit' name='banking' value='banking'>Banking</button>
              </div>

              <div id='float2' style='width:50%;float:left;padding: 12px'>
              <button type='submit' name='edit' value='edit' formaction='index.php'>Edit</button>
              <button type='submit' onclick='myFunction()' name='delete' value='delete' formaction='condel.php' style='margin-left: 15px;'>Delete</button>


            </div>
              </div>




          </form>";

             mysqli_close($con);
         }
        ?>

  </div>

 </body>

</html>
