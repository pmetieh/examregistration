<?php
/**
 * Created by PhpStorm.
 * User: ICT UL
 * Date: 8/23/2016
 * Time: 6:19 PM
 */


//processing form submitted
include_once('admin/connect.php');
include_once('admin/utils.php');
//if (!isset($_POST['submit'])) exit;

//include PHPExcel library
require_once "Classes/PHPExcel/IOFactory.php";

$ea = new PHPExcel();
$ea->getProperties()
    ->setCreator("Paul C. Metieh II")
    ->setTitle("Entrance Exam Data")
    ->setCompany("University Of Liberia")
    ->setDescription("This file is generated by the testingcenterapp web application");
$header = "a1:l1";

$ews = $ea->getSheet(0);
$ews->setTitle("Entrance Exam Data");

$ews->setCellValue("a1", "ExamNo")
    ->setCellValue("b1","First Name")
    ->setCellValue("c1", "Other Name")
    ->setCellValue("d1", "Last Name")
    ->setCellValue("e1", "Date of Birth")
    ->setCellValue("f1", "High School")
    ->setCellValue("g1", "Graduation Year")
    ->setCellValue("h1", "Gender")
    ->setCellValue("i1", "Location")
    ->setCellValue("j1", "College")
    ->setCellValue("k1", "Major")
    ->setCellValue("l1", "MobileNo");


$ews->getStyle($header)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('00ffff00');
$style = array(
    'font' => array('bold' => true,),
    'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
);
$ews->getStyle($header)->applyFromArray($style);

for ($col = ord('a'); $col <= ord('l'); $col++)
{
    $ews->getColumnDimension(chr($col))->setAutoSize(true);
}
/*//load Excel template file
$objTpl = PHPExcel_IOFactory::load("template.xls");
$objTpl->setActiveSheetIndex(0);  //set first sheet as active

$objTpl->getActiveSheet()->setCellValue('C2', date('Y-m-d'));  //set C1 to current date
$objTpl->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //C1 is right-justified

$objTpl->getActiveSheet()->setCellValue('C3', stripslashes($_POST['majorId']));
$objTpl->getActiveSheet()->setCellValue('C4', stripslashes($_POST['majorName']));

$objTpl->getActiveSheet()->getStyle('C4')->getAlignment()->setWrapText(true);  //set wrapped for some long text message

$objTpl->getActiveSheet()->getColumnDimension('C')->setWidth(40);  //set column C width
$objTpl->getActiveSheet()->getRowDimension('4')->setRowHeight(120);  //set row 4 height
$objTpl->getActiveSheet()->getStyle('A4:C4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP); //A4 until C4 is vertically top-aligned*/

//prepare download
$filename=mt_rand(1,100000).'.xlsx'; //just some random filename
//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet+-');//application/vnd.ms-excel
//header('Content-Disposition: attachment;filename="'.$filename.'"');
//header('Cache-Control: max-age=0');

//get the data

$con = new Connection();
$qry = 'select * from studentbiodata';
$stmt = $con->mysql->query($qry);
$result = $stmt->fetch_all();


$ews->fromArray($result, '', 'A2');

$path = "c:\\testingcenter\\";
$writer = PHPExcel_IOFactory::createWriter($ea, 'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
//$objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
$writer->save($path.$filename);

exit; //done.. exiting!




?>