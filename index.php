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

</head>

<body>
<?php
if (isset($_POST["name"])) {
    $name = $_POST['name'];
    $mob= $_POST['mob'];
    $uid= $_POST['uid'];
    $adrs= $_POST['adrs'];
    $sbiaccno= $_POST['sbiaccno'];
    $cif= $_POST['cif'];
    $cty= $_POST['cty'];
    $email= $_POST['email'];
    $gndr= $_POST['gndr'];
    $birthday= $_POST['birthday'];
    $dor= date('Y-m-d');
    echo "Order: ". $_POST['birthday']. "<br />"; //Result Check
  
    //DB Connectivity & Insert Query
    include("connection.php");
    
    $sql = "INSERT INTO tbl_clients ". "(cname, mno, uid, address,sbiaccno, cif, city, email, gender, dob, dor)". "VALUES('$name','$mob','$uid','$adrs','$sbiaccno','$cif','$cty','$email','$gndr','$birthday','$dor')";
         
    if ($con->query($sql) === true) {
        //echo "New record created successfully"; echo "<br />";
        echo "<div class='alert success'>
        <span class='closebtn'>&times;</span>
        <strong>Success!</strong> Client Created Successfully !!!
        </div>";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
    $con->close();
}
?> 
    <header>
        <center><h1>NetTech New Customer</h1></center>
        <!-- <a href="http://tutorialzine.com/2015/07/freebie-7-clean-and-responsive-forms/">Download</a> -->
    </header>

    <ul>
        <li><a href="index.html" class="active">New Client</a></li>
        <li><a href="./banking/personal.php">Self Banking</a></li>
        <li><a href="form-search.php">Search</a></li>
    </ul>


    <div class="main-content">

        <!-- You only need this form and the form-basic.css -->

        <form action = "<?php $_PHP_SELF ?>" method = "POST" class="form-basic" method="post" action="#">

            <div class="form-title-row">
                <h1>Client Bio Enrollment</h1>
            </div>

            <div class="form-row">
                <label>
                    <span>Name</span>
                    <input type="text" name="name">
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Mobile</span>
                    <input maxlength="10" type="text" name="mob">
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Aadhar</span>
                    <input maxlength="12" type="text" name="uid">
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Address</span>
                    <textarea name="adrs"></textarea>
                </label>
            </div>

            <div class="form-row">
                    <label>
                        <span>SBI ACCNO</span>
                        <input  maxlength="11" type="text" name="sbiaccno">
                    </label>
            </div>

            <div class="form-row">
                    <label>
                        <span>CIF</span>
                        <input maxlength="11" type="text" name="cif">
                    </label>
            </div>

            <div class="form-row">
                    <label>
                        <span>City</span>
                        <input type="text" name="cty">
                    </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Email</span>
                    <input type="email" name="email">
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Gender</span>
                    <select name="gndr" style="padding-right: 163px;">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Date Of Birth</span>
                    <input type="date" id="birthday" name="birthday" size="20" />  
                </label>
            </div>


            <div class="form-row">
                <button type="submit">Create</button>
            </div>

        </form>

    </div>

</body>

</html>