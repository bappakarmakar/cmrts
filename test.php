<?php
 function get_all_directory_and_files($dir){
 
     $dh = new DirectoryIterator($dir);   
     // Dirctary object 
     foreach ($dh as $item) {
         if (!$item->isDot()) {
            if ($item->isDir()) {
                get_all_directory_and_files("$dir/$item");
            } else {
                echo $dir . "/" . $item->getFilename();
                echo "<br>";
            }
         }
      }
   }
 
  # Call function 
  
  get_all_directory_and_files('C:\xampp\htdocs\cmrts');
  // test Data
?>
