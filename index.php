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

echo "\n". $url."\n"; 
$file_out = 'pdfs/'. md5( $url).".pdf"; 

if ( file_exists($file_out) ) 
{
	print_header($file_out); 
} 


exec("/usr/local/bin/wkhtmltopdf  --orientation Landscape --page-size A3  ". $url." " . $file_out) ; 
print_header($file_out);
?>
