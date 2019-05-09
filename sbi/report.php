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

   <!-- Below two scripts are for enabling jquery based date picker to support firefox -->
   <script type="text/javascript">
       var datefield = document.createElement("input")
       datefield.setAttribute("type", "date")
       if (datefield.type != "date") { //if browser doesn't support input type="date", load files for jQuery UI Date Picker
           document.write('<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />\n')
           document.write('<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"><\/script>\n')
           document.write('<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"><\/script>\n')
       }
   </script>

   <script>
       if (datefield.type != "date") { //if browser doesn't support input type="date", initialize date picker widget:
           jQuery(function ($) { //on document.ready
               $('#birthday').datepicker();
           })
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
        <!-- <li><a href="./banking/personal.php">Self Banking</a></li> -->
        <li><a href="form-search.php" >Search</a></li>
        <li><a href="trans.php">Transactions</a></li>
        <li><a href="stats.php" >Statistics</a></li>
        <li><a href="report.php" class="active">Reports</a></li>
    </ul>


    <div class="main-content">
      <form  method = "POST" class="form-basic" method="post" action="output.php" target = '_blank'>

          <div class="form-title-row">
              <h1>Report Generation</h1>
          </div>
      <div class="form-row">
          <label>
              <span>From</span>
              <input type="date" id="birthday" name="from" size="20" />
          </label>
      </div>

      <div class="form-row">
          <label>
              <span>To</span>
              <input type="date" id="birthday" name="to" size="20" />
          </label>
      </div>

      <div class="form-row">
          <button type="submit" style="margin: 40px 220px 0;">Generate</button>
      </div>

    </form>
  </div>

 </body>

</html>
