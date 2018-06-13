<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>NetTech</title>

	<link rel="stylesheet" href="assets/demo.css">
    <link rel="stylesheet" href="assets/form-basic.css">

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
   <!-- Css Responsible for parallal buttons -->
	 <style>
	 	#button1{
	     width: 300px;
	     height: 40px;
	 		margin: 50px;
	 		display: inline;
	 		}
	 		#button2{
	 		    width: 300px;
	 		    height: 40px;
	 				margin: 50px;
	 				display: inline;
	 		}
	 		#container{
	 		    text-align: center;
	 		}
	 	</style>
</head>

<body>
	<?php
	include("sessions.php");
	if (isset($_POST["name"])) {
	    $name = $_POST['name'];
	    $cifno= $_POST['cifno'];
	    $accno= $_POST['accno'];
			$accno= $_POST['aadhar'];
	    $gender= $_POST['gender'];
	    $village= $_POST['village'];
	    $acctype= $_POST['acctype'];
	    $oap= $_POST['oap'];
	    //echo "Order: ". $_POST['birthday']. "<br />"; //Result Check

	    //DB Connectivity & Insert Query
	    include("connection.php");

	    $sql = "INSERT INTO tbl_sbiclients ". "(name, cifno, accno, gender, village, acctype, oap)". "VALUES('$name','$cifno','$accno', '$gender','$village','$acctype','$oap')";

	    if ($con->query($sql) === true) {
	        //echo "New record created successfully"; echo "<br />";
	        echo "<div class='alert success' style='background-color: #49ce49';>
	        <span class='closebtn'>&times;</span>
	        <center><strong>Success!</strong> Client Created Successfully !!! <center>
	        </div>";
	    } else {
	        echo "Error: " . $sql . "<br>" . $con->error;
	    }
	    $con->close();
	}
	include("headrow.php");
	?>

	    <ul>
	        <li><a href="index.html" class="active">New Client</a></li>
	        <li><a href="./banking/personal.php">Self Banking</a></li>
	        <li><a href="form-search.php">Search</a></li>
	    </ul>


	    <div class="main-content">

	        <!-- You only need this form and the form-basic.css -->

	        <form action = "<?php $_PHP_SELF ?>" method = "POST" class="form-basic" method="post" action="#">

	            <div class="form-title-row">
	                <h1>SBI-Client Bio Enrollment</h1>
	            </div>

	            <div class="form-row">
	                <label>
	                    <span>Name</span>
	                    <input type="text" name="name" required>
	                </label>
	            </div>

	            <div class="form-row">
	                <label>
	                    <span>CIF No</span>
	                    <input maxlength="11" type="text" name="cifno">
	                </label>
	            </div>

	            <div class="form-row">
	                <label>
	                    <span>Acc No</span>
	                    <input maxlength="16" type="text" name="accno">
	                </label>
	            </div>

							<div class="form-row">
	                <label>
	                    <span>Aadhar</span>
	                    <input maxlength="12" type="text" name="aadhar">
	                </label>
	            </div>

							<div class="form-row">
									<label>
											<span>Gender</span>
											<select name="gender">
													<option value="M">Male</option>
													<option value="F">Female</option>
											</select>
									</label>
							</div>

							<div class="form-row">
									<label>
											<span>Village</span>
											<select name="village" style="padding-right: 16px;">
													<option value="Cheyur">Cheyur</option>
													<option value="Muriyandam Palayam">Muriyandam Palayam</option>
													<option value="Thandukaran Palayam">Thandukaran Palayam</option>
													<option value="Kanur">Kanur</option>
													<option value="Chellappan Palayam">Chellappan Palayam</option>
													<option value="Otchampalayam">Otchampalayam</option>
													<option value="Papankulam">Papankulam</option>
													<option value="Pothampalayam">Pothampalayam</option>
													<option value="Thathanoor">Thathanoor</option>
													<option value="Periyakattup Palayam">Periyakattup Palayam</option>
											</select>
									</label>
							</div>

							<div class="form-row">
									<label>
											<span>Account Type</span>
											<select name="acctype" style="padding-right: 163px;">
													<option value="SB-G">SB-G</option>
													<option value="SB-T">SB-T</option>
											</select>
									</label>
							</div>


							<div class="form-row">
									<label>
											<span>OAP</span>
											<select name="oap" style="padding-right: 163px;">
													<option value="No">Yes</option>
													<option value="Yes">No</option>
											</select>
									</label>
							</div>

	                <div class="form-row" style="display: inline">
										<center>
	                <button type="submit" id='float1' style="margin: 30px 10px; display: inline; width: 25%; margin-left: 80px;">Submit</button>
									<button type="reset" id='float1' style="margin: 20px; display: inline; width: 25%">Reset</button>
								</center>
	            </div>

	        </form>

	  </div>

</body>

</html>
