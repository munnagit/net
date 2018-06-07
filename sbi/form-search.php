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
 </head>

 <body>
  <header>
		<h1>NetTech SBI Automation</h1>
  </header>

    <ul>
        <li><a href="index.php">New Client</a></li>
        <li><a href="./banking/personal.php">Self Banking</a></li>
        <li><a href="form-search.html" class="active">Search</a></li>
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
             $sql="SELECT * FROM tbl_sbiclients where cifno like \"$cifno%\" or accno like \"$cifno%\"";
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
             print "            <th data-th=\"Order Details\"><span>Client ID</span></th>\n";
             print "            <th>Name</th>\n";
             print "            <th>CIF No.</th>\n";
             print "            <th>Acc No.</th>\n";
             print "            <th>Gender</th>\n";
             print "            <th>Village</th>\n";
             print "            <th>Type</th>\n";
             print "            <th>OAP</th>\n";
             print "         </tr>";
             if ($nrows > 0) {
                 while ($get_column=$res->fetch_assoc()) {
                     echo"<tr>
                    <td><input type='radio' name='cid' value=" . $get_column['cid']. " />";
                     echo "<td>". $get_column['cid']."</td>";
                     echo "<td>". $get_column['name']."</td>";
                     echo "<td>". $get_column['cifno']."</td>";
                     echo "<td>". $get_column['accno']."</td>";
                     echo "<td>". $get_column['gender']."</td>";
                     echo "<td>". $get_column['village']."</td>";
                     echo "<td>". $get_column['acctype']."</td>";
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
                         echo "<td>". $get_column['cifno']."</td>";
                         echo "<td>". $get_column['accno']."</td>";
                         echo "<td>". $get_column['gender']."</td>";
                         echo "<td>". $get_column['village']."</td>";
                         echo "<td>". $get_column['acctype']."</td>";
                         echo "<td>". $get_column['oap']."</td>";
                         echo "</tr>";
                     }
                 }
             }
             echo "</table>
            <br><br><br><br><br>
            <div style='width:100&#37;;'>

              <div id='float1' style='width:51%;float:left;padding: 12px'>
              <button style='float:right' type='submit' name='banking' value='banking'>Banking</button>
              </div>
            </div>


          </form>";

             mysqli_close($con);
         }
        ?>

  </div>

 </body>

</html>