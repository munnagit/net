<html>
<head>
<link rel="stylesheet" href="css/menu.css">
<link rel="stylesheet" href="css/style.css">
     <script src="js/prefixfree.min.js"></script>
     <link rel='stylesheet prefetch' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>
     <link href='http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css' rel='stylesheet' type='text/css'>


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
 <div class='alert success'>
        <span class='closebtn'>&times;</span>
        <strong>Success!</strong> Order Posted Successfully !!!
        </div>;
<?php
$t=time();
$date = date('Y-m-d',$t);
echo $date;
?>
</html>
