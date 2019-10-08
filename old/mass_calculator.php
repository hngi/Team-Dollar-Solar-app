<?php

include 'vendor/autoload.php';
//var_dump($base_url);
//exit();
// //require files
// require 'vendor/autoload.php';

// //For twig
// require_once __DIR__.'/bootstrap.php';

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// use Dompdf\Dompdf;
// //for pdf
// // require_once ('vendor/tecnickcom/tcpdf/tcpdf.php');

// //for reading
// use PhpOffice\PhpSpreadsheet\Document\Properties;
// use PhpOffice\PhpSpreadsheet\IOFactory;

// //require getcwd(). '/vendor/phpoffice/phpspreadsheet/samples/Header.php';


// date_default_timezone_set('Africa/Lagos');
// //$writer->save('helloworld2.xlsx');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
	<title>Solar Power Estimator</title>
</head>
<body>
	<div class="display2 hidden">
		<div class="calculate-display">
			<div class="calculate-display-modal">
				<h2>Total <br> Power required</h2>
				<hr>
				<div class="display-modal">
					<div class="m-auto">
						<div class="mt-10"><span class="bold">1 day: </span> <span class="val">20 kWh</span></div>
						<hr>
						<div class="mt-10"><span class="bold">7 days: </span> <span class="val1">20 kWh</span></div>
						<hr>
						<div class="mt-10"><span class="bold">30 days: </span> <span class="val2">20 kWh</span></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id = "app">
		<div class="show-display">
			<div id="item-display">
				<span class="tooltiptext hidden">Check here</span>
				<span>0</span>
				<div id="display" class="hidden"></div>
			</div>
		</div>
		<div>
			<h1>Soli Calc</h1>
			<?php
				if(!isset($_POST['mass_calc_button'])){
					//echo "Nothing";
			?>
			<form action="calculate.php" method = "POST" class="form" enctype="multipart/form-data">
			<div class="name-input">
					<!--input type="file" name="name" placeholder="Name of Electronic" accept = ".xlsx, .xls, .csv" required-->
					<input name = "file_content" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required/>
				</div>
				<div>
					<input type="submit" name = "mass_calc_button" value = "Calculate and Download">
				</div>
				<div>
					<a href = "<?php echo $base_url.'/uploads/test_document.xlsx'; ?>">Download Sample</a>
				</div>
			</form>
			<?php
			 }
			 else if (isset($_POST['mass_calc_button'])){
				//var_dump($_FILES['file_content']['type']);
				//$mimes = ['text/csv','application/vnd.ms-excel', 'text/xls', 'text/xlsx', 'application/vnd.oasis.opendocument.spreadsheet'];
				$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
				$mimes = ["text/csv", 'application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.oasis.opendocument.spreadsheet', "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"];
				if(in_array($_FILES["file_content"]["type"],$allowedFileType)){
					//exit(getcwd());
						$targetPath = $base_url.'/uploads/'.$_FILES['file_content']['name'];
		        //$targetPath = getcwd().'/uploads/'.$_FILES['file_content']['name'];
		        move_uploaded_file($_FILES['file_content']['tmp_name'], $targetPath);
						$inputFileType = 'Xlsx';
						$inputFileName = getcwd().'/uploads/test_document.xlsx';
						//load file
						$excel = IOFactory::load($inputFileName);
						//set active sheet to first sheet
						$excel->setActiveSheetIndex(0);
						$index = 2;

						$html = "<html><head><title></title></head><body><table><th>AppliancesSolarCalcRatings</th>";
							while($excel->getActiveSheet()->getCell('A'.$index)->getValue() != ""){//get the cell values
											$name = $excel->getActiveSheet()->getCell('A'.$index)->getValue();

											$quantity = $excel->getActiveSheet()->getCell('B'.$index)->getValue();

											$watt = $excel->getActiveSheet()->getCell('C'.$index)->getValue();$consumption = $watt * $quantity;

											$html.="<tr><td>".$name."</td><td>".$quantity."</td><td>".$watt."</td><td>".$consumption."</td></tr>";$index++;
										}
						$html.="</table></body></html>";

            $myfile = fopen("costing.html", "w") or die("Unable to open file!");

            fwrite($myfile, $html);
            fclose($myfile);

						// Render our view
						echo $twig->render('index.html', ['products' => $products] );

               // reference the Dompdf namespace
               //use Dompdf\Dompdf;

               $dompdf = new Dompdf();
               // Enable the HTML5 parser to tolerate poorly formed HTML
               $dompdf->set_option('isHtml5ParserEnabled', true);

               // Load into DomPDF from the external HTML file
               $content = file_get_contents('costing.html');

               $dompdf->loadHtml($content);

               // Render and download
               $dompdf->render();
               $dompdf->stream('costing.pdf');






            // $dompdf = new Dompdf();
						// // Enable the HTML5 parser to tolerate poorly formed HTML
						// $dompdf->set_option('isHtml5ParserEnabled', true);
						// // Load into DomPDF from the external HTML file
						// //$content = file_get_contents('sample.html');
						// $dompdf->loadHtml($html);
						// // Render and download
						// $dompdf->render();
						// $dompdf->stream('test.pdf');
					}
  else
  {
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
  }
}
?>		</div>
	</div>
	<script src="index.js"></script>
</body>

</html>
