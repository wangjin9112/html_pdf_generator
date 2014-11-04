<?php

function print_header($file_out)
{
   header('Content-type: application/pdf');
   header('Content-Disposition: attachment; filename="'.$file_out.'"');
   echo file_get_contents($file_out);
   exit;  
}

if ( isset($argv[1])) 
{
$url = $argv[1]; 
}
else 
{
$url = $_GET['url']; 
}

$file_out = 'pdfs/'. md5( $url).".pdf"; 

//disable caching for speed checks
//if ( file_exists($file_out) ) 
{
	print_header($file_out); 
} 


$commd = "/usr/local/bin/wkhtmltopdf  --orientation Landscape --page-size A3  ". escapeshellcmd($url)." " . escapeshellcmd($file_out); 
exec($commd);

print_header($file_out);
?>
