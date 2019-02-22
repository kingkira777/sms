<?php
error_reporting(0);
require_once '../app.class.php';
require_once '../../modules/tcpdf/tcpdf.php';

$app = new App();

$studno = $_GET['studno'];


//GET STUDENT INFO
$sinfo = "SELECT * FROM students a
    left join courses b on a.stud_course = b.c_id
    WHERE a.stud_no = ?";
$rsinof= $app->Connect()->prepare($sinfo);
$rsinof->execute([$studno]);
$studinfo = $rsinof->fetch();

//GET GRADE
$ginfo = "SELECT * FROM remarks a
    left join subjects b on a.r_subject = b.sub_code
    WHERE a.r_studno = ?";
$rginfo = $app->Connect()->prepare($ginfo);
$rginfo->execute([$studno]);

//GET OVER ALL AVERAGE
$gave = "SELECT * FROM overalremarks WHERE or_studno = ?";
$rgave = $app->Connect()->prepare($gave);
$rgave->execute([$studno]);
$rmark = $rgave->fetch();


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('CWPS');
$pdf->SetTitle('Student Grades');
$pdf->SetSubject('grades');
$pdf->SetKeywords('grades,remarks');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH,PDF_HEADER_TITLE,PDF_HEADER_STRING);
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 50, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '',12);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect

// Set some content to print
$html = '
        <h4>Student Grades</h4>
        
        <table border="1" cellpadding="4">
            <tr>
                <td colspan="2">NAME: '.$studinfo['stud_lastname'].' '.$studinfo['stud_firstname'].' '.$studinfo['stud_middlename'].'</td>
                <td>DOB: '.$studinfo['stud_dob'].'</td>
            </tr>
            <tr>
                <td>COURSE: '.$studinfo['c_name'].'</td>
                <td>SECTION: '.$studinfo['stud_section'].'</td>
                <td>YEAR LEVEL: '.$studinfo['stud_ylevel'].'</td>
            </tr>
   
        </table>
';

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

$pdf->Ln(10);
$pdf->Cell(45, 10, 'Subject', 1, 0,'C');
$pdf->Cell(45, 10, 'Description', 1, 0,'C');
$pdf->Cell(45, 10, 'Units', 1, 0,'C');
$pdf->Cell(45, 10, 'Average', 1, 1,'C');

while($rr = $rginfo->fetch()){
        $sub = $rr['sub_code'];
        $subdes = $rr['sub_description'];
        $subunits = $rr['sub_units'];
        $ave = $rr['r_average'];
        $pdf->Cell(45, 10, $sub, 1, 0,'C');
        $pdf->Cell(45, 10, $subdes, 1, 0,'C');
        $pdf->Cell(45, 10, $subunits, 1, 0,'C');
        $pdf->Cell(45, 10, $ave, 1, 1,'C');
    
}

$pdf->Cell(0, 10, 'AVERAGE: '.$rmark['or_remark'], 1, 1,'R');
// ---------------------------------------------------------


//HEADER

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('Student-Grades.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

