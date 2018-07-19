<?php
include("sessions.php");
require('mysql_table.php');

// Connect to database
include("connection.php");

$from= $_POST['from'];
//adding +1 with today to make the sql work as expected
$todate = new DateTime($_POST['to']);
$todate->modify('+1 day');
$to = $todate->format('Y-m-d') . "\n";


//echo $from;
//echo $to;

$pdf=new FPDF();

//Disable automatic page break
$pdf->SetAutoPageBreak(false);

//Add first page
$pdf->AddPage();

//set initial y axis position per page
$y_axis_initial = 25;
 $y_axis = 18;
 $row_height = 13;


//print column titles
$pdf->SetFillColor(215,255,215);
$pdf->SetFont('Arial','B',12);
$pdf->SetY($y_axis_initial);
$pdf->SetX(5);
$pdf->Cell(12,6,'CID',1,0,'L',1);
$pdf->Cell(12,6,'TID',1,0,'L',1);
$pdf->Cell(55,6,'NAME',1,0,'C',1);
$pdf->Cell(14,6,'AMT',1,0,'L',1);
$pdf->Cell(12,6,'OAP',1,0,'L',1);
$pdf->Cell(25,6,'OPN',1,0,'C',1);
$pdf->Cell(20,6,'REFNO',1,0,'L',1);
$pdf->Cell(25,6,'DATE',1,0,'C',1);
$pdf->Cell(25,6,'TIME',1,0,'C',1);
$pdf->SetFont('Arial','',12);
$pdf->SetFillColor(255,255,255);
$y_axis = $y_axis + $row_height;

//Select the Products you want to show in your PDF file
//$result=query('SELECT a.cid,a.name,b.amt FROM tbl_sbitrans b,tbl_sbiclients a where b.cid = a.cid ORDER BY b.stamp desc LIMIT 25',$con);
$sql="SELECT a.cid,b.tid,a.name,b.amt,b.oap,b.opn,b.refno,b.stamp FROM tbl_sbitrans b,tbl_sbiclients a where b.cid = a.cid and b.stamp between '$from' and '$to' ORDER BY b.stamp";
//echo $sql;
$result=$con->query($sql);
//initialize counter
$i = 0;

//Set maximum rows per page
$max = 25;

//Set Row Height
$row_height = 6;

while($row = $result->fetch_assoc())
{
    //If the current row is the last one, create new page and print column title
    if ($i == $max)
    {
        $pdf->AddPage();

        // //print column titles for the current page
        $pdf->SetY($y_axis_initial);
        $pdf->SetX(5);
				$pdf->Cell(30,6,'CID',1,0,'L',1);
				$pdf->Cell(50,6,'NAME',1,0,'L',1);
				$pdf->Cell(30,6,'AMOUNT',1,0,'R',1);
				$pdf->Cell(30,6,'OAP',1,0,'R',1);
				$pdf->Cell(30,6,'Operation',1,0,'R',1);
				$pdf->Cell(30,6,'Refno',1,0,'R',1);

        //Go to next row
        $y_axis = $y_axis + $row_height;

        //Set $i variable to 0 (first row)
        $i = 0;
    }

    $cid = $row['cid'];
		$tid = $row['tid'];
    $name = $row['name'];
    $amt = $row['amt'];
		$oap = $row['oap'];
		$opn = $row['opn'];
		$refno = $row['refno'];
		$stamp = $row['stamp'];
		$date = date('d-m-Y',strtotime($stamp));
		$time = date('h:i:s',strtotime($stamp));

    $pdf->SetY($y_axis);
    $pdf->SetX(5);
    $pdf->Cell(12,6,$cid,1,0,'L',1);
		$pdf->Cell(12,6,$tid,1,0,'L',1);
    $pdf->Cell(55,6,$name,1,0,'C',1);
    $pdf->Cell(14,6,$amt,1,0,'L',1);
		$pdf->Cell(12,6,$oap,1,0,'L',1);
		$pdf->Cell(25,6,$opn,1,0,'L',1);
		$pdf->Cell(20,6,$refno,1,0,'L',1);
		$pdf->Cell(25,6,$date,1,0,'L',1);
		$pdf->Cell(25,6,$time,1,0,'C',1);

    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
}

mysqli_close($con);

//Send file
$pdf->Output();


?>
