<?php
include("sessions.php");
?>
<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" type="image/x-icon" href="images/logo.png" />
	<!-- Below two scripts are for alert bar with close button -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

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

	<!-- code for onselect bank selection display -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script type="text/javascript">
		    $(function () {
		        $("#atype").change(function () {
		            if ($(this).val() == "Other Banks") {
		                $("#bndiv").show();
		            } else {
		                $("#bndiv").hide();
		            }
		        });
		    });
		</script>


</head>

<body>
	<?php
	if (isset($_POST["name"])) {
	    $name = $_POST['name'];
			$mob = $_POST['mob'];
	    $cifno = $_POST['cifno'];
	    $accno = $_POST['accno'];
			$bname = $_POST['bname'];
			$cardno = $_POST['cardno'];
			$aadhar = $_POST['aadhar'];
	    $gender = $_POST['gender'];
	    $village = $_POST['village'];
	    $acctype = $_POST['acctype'];
	    $oap = $_POST['oap'];
	    //echo "Order: ". $_POST['birthday']. "<br />"; //Result Check

	    //DB Connectivity & Insert Query
	    include("connection.php");

			if (isset($_POST["cid"]))
			{
				$cid = $_POST["cid"];
				if(empty($cid)){
				$sql = "INSERT INTO tbl_sbiclients ". "(name, mob, cifno, accno, cardno, aadhar, gender, village, acctype, bname, oap)". "VALUES('$name','$mob','$cifno','$accno','$cardno','$aadhar', '$gender','$village','$acctype','$bname','$oap')";
			}
			else {
				//echo $cid;
				//$sql = "UPDATE tbl_sbiclients set ". "(name, cifno, accno, gender, village, acctype, oap)". "VALUES('$name','$cifno','$accno', '$gender','$village','$acctype','$oap')";
 			  $sql = "UPDATE tbl_sbiclients set name = '$name', mob = $mob, cifno = $cifno, accno = $accno, cardno = $cardno, aadhar = $aadhar, gender = '$gender', village = '$village', acctype = '$acctype', bname = '$bname', oap = '$oap' where cid = $cid";
			}
		}


	    if ($con->query($sql) === true) {
	        //echo "New record created successfully"; echo "<br />";
	        echo "<div class=\"container\">
					<div class=\"alert alert-success alert-dismissible\">
    			<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
    			<strong>Success!</strong> Client Data Updated Successfully !!
  				</div>
					<meta http-equiv=\"refresh\" content=\"0;url=form-search.php \" >
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
					<li><a href="trans.php">Transactions</a></li>
	    </ul>


	    <div class="main-content">

	        <!-- You only need this form and the form-basic.css -->

	        <form action = "<?php $_PHP_SELF ?>" method = "POST" class="form-basic" method="post" action="#">
              <?php
							if (isset($_POST["cid"]))
							{
								$cid = $_POST['cid'];
								//echo $cid;
								include("connection.php");
								$sql="SELECT * FROM tbl_sbiclients WHERE cid = '".$cid."'";
								$res=$con->query($sql);
								$nrows=$res->num_rows;
								$get_column=$res->fetch_assoc();
							}
							?>

	            <div class="form-title-row">
	                <h1>SBI-Client Bio Enrollment</h1>
	            </div>

	            <div class="form-row">
	                <label>
	                    <span>Name</span>
	                    <input type="text" name="name" value="<?php echo $get_column['name'] ?>" required />
	                </label>
	            </div>

							<div class="form-row">
	                <label>
	                    <span>Mobile</span>
	                    <input type="text" name="mob" value="<?php echo $get_column['mob'] ?>" required />
	                </label>
	            </div>

	            <div class="form-row">
	                <label>
	                    <span>CIF No</span>
	                    <input maxlength="11" type="text" name="cifno" value="<?php echo $get_column['cifno'] ?>" required />
	                </label>
	            </div>

	            <div class="form-row">
	                <label>
	                    <span>Acc No</span>
	                    <input maxlength="16" type="text" name="accno" value="<?php echo $get_column['accno'] ?>" required />
	                </label>
	            </div>

							<div class="form-row">
	                <label>
	                    <span>Card No</span>
	                    <input maxlength="16" type="text" name="cardno" value="<?php echo $get_column['cardno'] ?>" required />
	                </label>
	            </div>

							<div class="form-row">
	                <label>
	                    <span>Aadhar</span>
	                    <input maxlength="12" type="text" name="aadhar" value="<?php echo $get_column['aadhar']  ?>" required />
	                </label>
	            </div>

							<div class="form-row">
									<label>
											<span>Gender</span>
											<select name="gender">
												  <option value="<?php if (isset($_POST['cid'])) { echo $get_column['gender']; }  ?>"> <?php if (isset($_POST['cid'])) { echo $get_column['gender']; }  ?> </option>
													<option value="M">M</option>
													<option value="F">F</option>
											</select>
									</label>
							</div>

							<div class="form-row">
									<label>
											<span>Village</span>
											<input type="text" name="village" list="villages" value="<?php if (isset($_POST['cid'])) { echo $get_column['village']; }  ?>" style="padding-right: 16px;">
													<datalist id="villages">
													<option  > <?php if (isset($_POST['cid'])) { echo $get_column['village']; }  ?> </option>
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
												  </datalist>
									</label>
							</div>

							<div class="form-row">
									<label>
											<span>Account Type</span>
											<select name="acctype" id="atype">
												  <option value="<?php if (isset($_POST['cid'])) { echo $get_column['acctype']; }  ?>"> <?php if (isset($_POST['cid'])) { echo $get_column['acctype']; }  ?> </option>
													<option value="SB-G">SB-G</option>
													<option value="SB-T">SB-T</option>
													<option value="Other Banks">Other Banks</option>
											</select>
									</label>
							</div>

							<div class="form-row"  id="bndiv" style="display: none">
									<label>
											<span>Bank</span>
											<input type="text" value="SBI" name="bname" list="banks" />
													<datalist id="banks">
													  <option value="<?php if (isset($_POST['cid'])) { echo $get_column['bname']; }  ?>"> <?php if (isset($_POST['cid'])) { echo $get_column['acctype']; }  ?> </option>
														<option value="SBI" selected>SBI</option>
														<option value="HDFC">HDFC</option>
														<option value="ICICI">ICICI</option>
														<option value="IDBI">IDBI</option>
														<option value="Union Bank">Union Bank</option>
														<option value="Bank of Baroda">Bank of Baroda</option>
														<option value="Canara Bank">Canara Bank</option>
														<option value="Axis Bank">Axis Bank</option>
														<option value="Punjab National Bank">Punjab National Bank</option>
														<option value="Indian Bank">Indian Bank</option>
												  </datalist>
									</label>
							</div>


							<div class="form-row">
									<label>
											<span>OAP</span>
											<select name="oap" style="padding-right: 163px;">
												  <option value="<?php if (isset($_POST['cid'])) { echo $get_column['oap']; }  ?>"> <?php if (isset($_POST['cid'])) { echo $get_column['oap']; }  ?> </option>
													<option value="No">No</option>
													<option value="Yes">Yes</option>
											</select>
									</label>
							</div>

	                <div class="form-row" style="display: inline">
										<center>
											<input type=hidden name=cid value="<?php if (isset($_POST["cid"])) { echo $cid; } ?>" />
	                <button type="submit" id='float1' style="margin: 30px 10px; display: inline; width: 25%; margin-left: 80px;">Submit</button>
									<button type="reset" id='float1' style="margin: 20px; display: inline; width: 25%">Reset</button>
								</center>
	            </div>

	        </form>

	  </div>

</body>

</html>
