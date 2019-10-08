<?php
require_once('vendor/autoload.php');

// reference the Dompdf namespace
use Dompdf\Dompdf;

$dompdf = new Dompdf();
// Enable the HTML5 parser to tolerate poorly formed HTML
$dompdf->set_option('isHtml5ParserEnabled', true);

// Load into DomPDF from the external HTML file
$content = file_get_contents('costing.html');

$dompdf->loadHtml($content);

// Render and download
$dompdf->render();
$dompdf->stream('costing.pdf');
