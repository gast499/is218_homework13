<?php
  class CSVExceptionHandling{
    //private $fname;
    private $c = false;
    
    public function __construct(){
    }
    
    function exists($fname){
      $e = file_exists($fname);
      if (!$e) {
        echo 'fname is ' . $fname;
        echo "The file does not exist.  The program will now terminate.<br>";
        die();
      }
      else{
        echo "The file exists.<br>";
      }
      return $e;
    }
    
    function canWrite($fname){
      $cw = is_writable($fname);
      if (!$cw){
        echo 'The file is not writeable.<br>';
        $c = false;
      }
      else {
        echo 'The file is writeable.<br>';
        $c = true;
      }
      return $cw;
    }
    
    function write($fname, $array){
      if ($c){
        $f = fopen($fname, "w");
        $list = $array;

        foreach ($list as $line){
          fputcsv($f,explode(',',$line));
        }
        echo "Successfully wrote to the file.<br>";
      }
      else{
        echo "Failed to write to the file.  The file is not writeable.<br>";      
      }
    }
  }
?>