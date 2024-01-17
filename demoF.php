<?php 
$newText = "Have a great learning";
#$myFile = fopen("demo.txt","w") or exit("unable to open file"); it will write.
 $myFile = fopen("demo.txt","a") or exit("unable to open file");#it will append
 fwrite($myFile,$newText);
 echo "file got open and written! \n";
 echo filesize("demo.txt");
 fclose($myFile);
 echo "\n file got closed!";
 ?>
