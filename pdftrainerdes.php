<?php
class dbObj {
    var $dbhost = "localhost";
    var $username = "root";
    var $password = "";
    var $dbname = "loginerp";
    var $conn;
    function getConnstring() {
        $conn = mysqli_connect($this->dbhost, $this->username, $this->password, $this->dbname) or die("Connection failed: " . mysqli_connect_error());

/* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    } else {
        $this->conn = $conn;
    }
    return $this->conn;
}
}
//include connection file 
include_once('fpdf.php');
 
class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('logo.jpg',10,5,40);
    $this->SetFont('Arial','B',13);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(80,10,'Student List',1,0,'C');
    // Line break
    $this->Ln(20);
}
 
// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
 
$db = new dbObj();
$connString =  $db->getConnstring();
$display_heading = array('name'=>'Name', 'college'=> 'College','yearofstudy'=> 'Year','branch'=> 'Branch','courseopted'=> 'Course','trainer'=> 'Trainer', 'totalfees'=> 'Cost in Rs.',);
 
$result = mysqli_query($connString, "SELECT name, college, yearofstudy, branch, courseopted, trainer, totalfees FROM studentdetails ORDER BY trainer DESC") or die("database error:". mysqli_error($connString));
$header = mysqli_query($connString, "SHOW columns FROM studentdetails");
 
$pdf = new PDF();
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',12);
$pdf->Ln(20);
foreach($header as $heading) {
$pdf->Cell(28,12,$display_heading[$heading['Field']],1);
}
foreach($result as $row) {
$pdf->Ln();
foreach($row as $column)
    $pdf->Cell(28,12,$column,1);
}
$pdf->Output();
?>