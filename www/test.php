<?php 	
//I will share my code:

//In your given example date:


//It will go like this:




   function dateName($date) {

        $result = "";

        $convert_date = strtotime($date);
        $month = date('F',$convert_date);
        $year = date('Y',$convert_date);
        $name_day = date('l',$convert_date);
        $day = date('j',$convert_date);


        $result = $month . "  " . $year ;

        return $result;
    }

    $dateValue = date('Y-m-d H:i:s');
    echo dateName($dateValue);