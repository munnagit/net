<?php
    //phpcode responsibele for displaying tbl_cash row
    echo '<head>';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
    echo '<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">';
    echo '</head>';
    include("connection.php");
    $sql="SELECT * FROM tbl_cash";
    $res=$con->query($sql);
    $nrows=$res->num_rows;
    if ($nrows > 0) {
      while ($get_column=$res->fetch_assoc()) {
         echo '<header>';
         echo '<div class="w3-row">';
         echo '<div class="w3-col w3-black w3-container" style="width:20%"><p><center>Cash Balance</center></p></div>';
         echo '<div class="w3-col w3-black w3-container" style="width:60%"><p><h1>NetTech SBI Automation<h1></p></div>';
         echo '<div class="w3-col w3-black w3-container" style="width:20%"><center>Account Balance</center></div>';
         echo '</div>';
         echo '<div class="w3-col w3-black w3-container" style="width:20%"><p><center>'. $get_column['scih'].'</center></p></div>';
         echo '<div class="w3-col w3-black w3-container" style="width:60%"></div>';
         echo '<div class="w3-col w3-black w3-container" style="width:20%"><p>'. $get_column['scab'].'</p></div>';
         echo '</header>';
       }
     }
    mysqli_close($con);
 ?>
