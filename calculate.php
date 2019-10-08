<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//ob_start();
//phpinfo();
include_once ('vendor/autoload.php');
use Dompdf\Dompdf;
//include 'vendor/autoload.php';


if(!isset($_POST['mass_calc_button'])){
    Header("Location : mass_calculator.php");
}else if(isset($_POST['mass_calc_button'])){

    //var_dump($_FILES['file']['type']);
    //$mimes = ['text/csv','application/vnd.ms-excel', 'text/xls', 'text/xlsx', 'application/vnd.oasis.opendocument.spreadsheet'];
    $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
    $mimes = ["text/csv", 'application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.oasis.opendocument.spreadsheet', "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"];

    if(in_array($_FILES["file"]["type"],$allowedFileType)){
        $inputFileType = 'Xlsx';

        $targetPath = "uploads/".$_FILES['file']['name'];
        //echo "Current directory  : ".getcwd().'uploads';
        //chmod('uploads', 755); //make the folder writeable
        //move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        move_uploaded_file($_FILES['file']['name'], '/uploads');

        //var_dump($base_url);
        //exit($_FILES['file']['tmp_name']);
        $inputFileName = $_FILES['file']['tmp_name'];
        //$inputFileName = "uploads/".$_FILES['file']['tmp_name'];
        //load file
        //var_dump($inputFileName);
        //$testing_excel->load($inputFileName);

        //var_dump($_FILES['file']);
        //  Read your Excel workbook
        try {
            //chmod(getcwd().'uploads', 777); //make the folder writeable
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
            //var_dump($objPHPExcel);
            //echo "Just finished reading";
        } catch(Exception $e) {
            die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }
        //exit("Now");
        //$phpWord = PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
        $excel = $objPHPExcel;
        //$excel = IOFactory::load($inputFileName);
        //var_dump($phpWord);
        //set active sheet to first sheet
        $excel->setActiveSheetIndex(0);
        $index = 2;

        $total = 0;
        $html = "<html><head><title></title></head><body>";
        $html .= "<table border = '2'>";
        $html .= "<th>
                    <td>Name</td>
                    <td>Quantity</td>
                    <td>Watt</td>
                    <td>Subtotal</td>
                    </th>";
        while($excel->getActiveSheet()->getCell('A'.$index)->getValue() != ""){
            //get the cell values
            $name       =       $excel->getActiveSheet()->getCell('A'.$index)->getValue();
            $quantity   =       $excel->getActiveSheet()->getCell('B'.$index)->getValue();
            $watt       =       $excel->getActiveSheet()->getCell('C'.$index)->getValue();

            $subtotal = $watt * $quantity;
            $total += $subtotal;
            $html       .=      "<tr><td></td><td>".$name."</td><td>".$quantity."</td><td>".$watt."</td><td>".$subtotal."</td></tr>";
            $index++;
        }

        $html .= "<tr><td></td><td><b>Total</b></td><td></td><td></td><td>".$total."</td></tr>";
        $html .="</table></body></html>";



    //do the pdf processing here
    $dompdf = new Dompdf();
    // Enable the HTML5 parser to tolerate poorly formed HTML
    $dompdf->set_option('isHtml5ParserEnabled', true);

    // Load into DomPDF from the external HTML file
    $content = file_get_contents('costing.html');

    $dompdf->loadHtml($html);

    // Render and download
    $dompdf->render();
    $dompdf->stream('costing.pdf');

    header("Location : mass_calculator.php");
}else{
  echo "Print Nothing For You";
}
// reference the Dompdf namespace

}
