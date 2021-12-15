<?php 
$cyr = [
    'а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п',
    'р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',
    'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П',
    'Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я'
];
$lat = [
    'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p',
    'r','s','t','u','f','h','ts','ch','sh','sht','a','i','y','e','yu','ya',
    'A','B','V','G','D','E','Io','Zh','Z','I','Y','K','L','M','N','O','P',
    'R','S','T','U','F','H','Ts','Ch','Sh','Sht','A','I','Y','e','Yu','Ya'
];

// Getting barcode value
// $barcode=12345678;
$barcode=$_POST['barcode'];

// Getting full name of a patient and switching it to latin if cryllic
// $fullName="ДАВЛЕТОВА К";
$fullName=$_POST['patient_name'];
$fullNameLat = str_replace($cyr, $lat, $fullName);

// Getting branch name and switching it to latin if cryllic
// $branchName="Some more text";
$branchName=$_POST['branch_name'];
$branchNameLat = str_replace($cyr, $lat, $branchName);

// Getting patient ID
// $patientId = 16832;
$patientId = $_POST['patient_id'];

// Getting tube type and switching it to latin if cryllic
// $tubeType = "Голубой";
$tubeType = $_POST['tube_type'];
$tubeTypeLat = str_replace($cyr, $lat, $tubeType);


// Getting barcode printing time
$date=date('d.m H:i', time());



define('BARCODEPRINTER','\\\\DESKTOP-QHVND05\\xprinter');
$toPrint=<<<text
SIZE 58,30 mm
CLS
GAP 2 mm,0
DIRECTION 1,0
SHIFT 0
BARCODE 15,115,"128",100,0,0,4,4,"$barcode"
TEXT 225,18,"2",0,2,2,"$barcode"
TEXT 10,18,"2",0,2,2,"$patientId"
TEXT 14,72,"1",0,2,2,"$fullNameLat"
TEXT 370,205,"2",270,1,1,"$tubeTypeLat"
TEXT 425,215,"2",270,1,1,"$date"
PRINT 1
CUT
text;
file_put_contents(BARCODEPRINTER, $toPrint);
?>