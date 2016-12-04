<html>
<head>
</head>
<body>

<form action="main.php" method="get">
Enter a make:   <input type="text" name="make"><br>
<input type="submit" value="Submit"><br>
</form>

<?php
  include_once('CSVExceptionHandling.php');
  
  $h = new CSVExceptionHandling();
  $file="cars.csv";
  $h->exists($file);
  $csv= file_get_contents($file);
  $array = array_map("str_getcsv", explode("\n", $csv));
  $json = json_encode($array);
  print_r($json);
  echo '<br><br>';
  $make = $_GET["make"];
  
  $handler = fopen("cars.csv", "r");
  $mainarray = array();
  while (!feof($handler) ) {

    $line_of_text = fgetcsv($handler, 1024);
    
    if($line_of_text[0] == $make){
      $a = array($line_of_text[0], $line_of_text[1], $line_of_text[2]);
      
      //print $line_of_text[0] . $line_of_text[1]. $line_of_text[2] . "<BR>";
      array_push($mainarray, $a);
    }

  }
  $j = json_encode($mainarray);
  print_r($j);
  fclose($handler);
  
  echo '<br><br>';
  if (($h->exists('out.csv')) and ($h->canWrite('out.csv'))){
    $fo = fopen('out.csv', 'w');
    foreach($mainarray as $car){
      fputcsv($fo, $car);
    }
    echo 'Successfully wrote to file.';
    fclose($fo);
  }
?>
</body>
</html>