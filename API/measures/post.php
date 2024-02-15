<?php declare(strict_types = 1);
 //MVP:
 require_once(__DIR__ . "/../Database/DB.php");
 
 $TABLENAME = "measures";
 $COL_DATE  = "date";
 $COL_TIME  = "time";
 $COL_HUMIDITY = "humidity";
 $COL_TEMP = "temperature";
 $COL_PRESSURE = "pressure";
 $COL_ROOM = "position";
 $COL_SENSOR = "#id_sensor";


 if(isset($_POST)) {
     
     $option = filter_input(INPUT_POST, "option");

     switch($option) {
         
        case "measure":

            $humidity = filter_input(INPUT_POST, "humidity");
            $pressure = filter_input(INPUT_POST, "pressure");
            $temperature = filter_input(INPUT_POST, "temperature");
            $date = filter_input(INPUT_POST, "date");
            $time = filter_input(INPUT_POST, "time");
            $sensor = filter_input(INPUT_POST, "sensor");
            
            $query = "INSERT INTO `$TABLENAME` (`$COL_TEMP`, `$COL_HUMIDITY`, `$COL_PRESSURE`, `$COL_DATE`, `$COL_TIME`, `$COL_SENSOR`) VALUES ($temperature, $humidity, $pressure, '$date', '$time', $sensor);";
            
            DB::insert_db($query);
            echo $query;
        break;
    
    
        default:
            echo "404";
        break;
     }
 }
