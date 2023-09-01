<?php
    
    
    // get contents of a file into a string
    $filename = "mails.txt";
    $handle = fopen($filename, "r");
    $contents = fread($handle, filesize($filename));
    // echo $contents . "<br>";
    fclose($handle);

    echo "<br>";
    $fd = fopen ("mails.txt", "r");

    while (!feof ($fd)) 

    {

    $buffer = fgets($fd, 4096);
    // echo $buffer."<br>";

    $lines[] = $buffer;
    echo "<br >". $buffer;

    }

    fclose ($fd);
 

?>