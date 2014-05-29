<?php

# Example of a generated ODS file to be uploaded from web user

include("ods.php");

header('Content-Description: File Transfer');
header('Content-Type: application/ods');
header('Content-Disposition: attachment; filename="test.ods"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');

# Create new ODS document
$object = newOds();

# First row... (last parameter true = use bold character , default is normal)
$object->addCell (0,0,0,"TITLE",'string',true);

# Second row... fields
$object->addCell (0,1,0,"AAA",'string',true);
$object->addCell (0,1,1,"BBB",'string',true);
$object->addCell (0,1,2,"CCC",'string',true);
$object->addCell (0,1,3,"DDD",'string',true);

$line = 2;

$table = Array( Array ( "abc", 0.1, 0.2, 0.3 ) ,
	      Array ( "def", 1.0, 1.1, 2.3 ) ,
	      ... );

for ($row = 0; $row < 3; $row++)
 
  # Populate table...
  $object->addCell (0,$line,0, $table[$row][0]  ,'string');
  $object->addCell (0,$line,1, $table[$row][1] ,'float');
  $object->addCell (0,$line,2, $table[$row][2] ,'float');
  $object->addCell (0,$line,2, $table[$row][3] ,'float');

  $line ++;

}

# write ods to a temp file
$tmpfname = tempnam("/tmp", "foo").".ods";
saveOds ($object, $tmpfname);

# send it to web user...
readfile($tmpfname);

?>
