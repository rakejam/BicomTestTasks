<?php
    $str = file_get_contents($argv[1]);

    $arr = explode("\r\n", $str);

    $width=0;
    $height=0;
    
    $matrix = [];
    
    foreach($arr as &$value)
    {
        $strlen = strlen($value);
        if( round($strlen/2,0) > $width)
            $width=round($strlen/2,0);
        $height++;
    }

    $width=$width*4+1;
    $height=$height*2+1;
    $emptyRow = [];

    for($i = 0; $i < $width; $i++)
        $emptyRow[] = " ";

        
    foreach($arr as &$value)
    {
        $strlen = strlen($value);  
        $newRow = $emptyRow;      
        $matrix[] = $emptyRow;  
        for($i = 0; $i < $strlen; $i += 2)
        {   
            $magic=2*($i+2);
            $newRow[$magic-4] = "|";
            $newRow[$magic-3] = " ";
            $newRow[$magic-2] = $value[$i];
            $newRow[$magic-1] = " ";
            $newRow[$magic] = "|";
        }   
        $matrix[] = $newRow;   
    }
    $matrix[] = $emptyRow;  
    
    for($i = 1; $i < $height; $i+=2)
        for($j = 2; $j < $width; $j+=4)
            if($matrix[$i][$j] != " ")
            {
                $matrix[$i-1][$j-2] = "+";
                $matrix[$i-1][$j+2] = "+";
                $matrix[$i+1][$j-2] = "+";
                $matrix[$i+1][$j+2] = "+";

                $matrix[$i-1][$j-1] = "-";
                $matrix[$i-1][$j] = "-";
                $matrix[$i-1][$j+1] = "-";

                $matrix[$i+1][$j-1] = "-";
                $matrix[$i+1][$j] = "-";
                $matrix[$i+1][$j+1] = "-";
            }

    printMatrix($matrix);
    
    function printMatrix(&$matrix)
    {
        foreach($matrix as &$row)
        {
            foreach($row as &$el)
            {
                echo $el;
            }    
            echo "\r\n";
        }   
    }
?>