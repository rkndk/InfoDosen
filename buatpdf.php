<?php 
include "session.php";
mysql_connect("localhost","root","");
mysql_select_db("projectpbw");
$id = $_GET['id'];
$result=mysql_query("SELECT * FROM pesan where idpesan=$id");         

while($row = mysql_fetch_array($result))
{
    $perim = $row["penerima"];
    $pirim = $row["pengirim"];    
    $subject = $row["subject"];
    $isipesan = $row["isipesan"];
}

$sqlpengirim=mysql_query("select * from mahasiswa,dosen where nip=$pirim or nim=$pirim");
$sqlpenerima=mysql_query("select * from dosen,mahasiswa where nip=$perim or nim=$perim");     

while ($r = mysql_fetch_array($sqlpengirim)) 
{
    $pengirim = $r["nama"];
}
while ($ro = mysql_fetch_array($sqlpenerima)) 
{
    $penerima = $ro["nama"];
}
require_once ("fpdf/fpdf.php");

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('logoon.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,'Mailbox',1,0,'C');
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

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
//$pdf->Cell(0,10,'Printing line number ',0,1);
$pdf->setFillColor(136,69,19);
$pdf->setTextColor(0,0,0);
$pdf->setDrawColor(222,184,135);
$pdf->Ln();
$pdf->Cell(50,10,'Pengirim : '.$pengirim,1,0,'L');
$pdf->Ln();
$pdf->Cell(50,10,'Penerima : '.$penerima,1,0,'L');
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(10,5,'Isi Pesan: ',0,1,'L');
$pdf->Ln();
$pdf->Cell(0,1,$isipesan,0,1,'L');

$pdf->Output();

?>