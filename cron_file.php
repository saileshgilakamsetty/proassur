<?php
	  $file = 'test1.txt';
	  date_default_timezone_set("Asia/Kolkata")
      $content = stripslashes("Time: " . date('Y-M-d h : i : s A') . "\n");
      $file_data = $content. file_get_contents($file);
      file_put_contents($file, $file_data);
?>