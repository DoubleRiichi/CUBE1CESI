<?php declare(strict_types = 1);

require __DIR__ . "/../Database/DB.php";
 $TABLENAME = "measures";
 $COL_ID    = "id_measures";
 $COL_DATE  = "date";
 $COL_TIME  = "time";
 $COL_SENSOR = "#id_sensor";

 if(isset($_GET)) {

     $option = filter_input(INPUT_GET, "option");

     switch ($option) {
         
        case "all":
            if(filter_input(INPUT_GET, "sensor") != NULL) {
                $sensor = filter_input(INPUT_GET, "sensor");
                $query = "SELECT * FROM $TABLENAME WHERE `$COL_SENSOR` = $sensor;";
             } else {
                $query = "SELECT * FROM $TABLENAME;";
            }
             $result = DB::query_db($query);
             
             echo json_encode($result);
        break;

        case "last":
            if(filter_input(INPUT_GET, "sensor") != NULL) {
                $sensor = filter_input(INPUT_GET, "sensor");
                $query = "SELECT * FROM $TABLENAME WHERE `$COL_SENSOR` = $sensor ORDER BY $COL_ID DESC LIMIT 1";
            } else {
                $query = "SELECT * FROM $TABLENAME ORDER BY $COL_ID DESC LIMIT 1;";
            }
            $result = DB::query_db($query);

            echo json_encode($result);
        break;

        case "all_one_sensor":
            $sensor = filter_input(INPUT_GET, "sensor");
            $query = "SELECT * FROM $TABLENAME WHERE $COL_ID = $sensor";

            $result = DB::query_db($query);

            echo json_encode($result);
        break;
         
        case "on_date":
             $date = filter_input(INPUT_GET, "date");
             
             if(isset($date)) {
                $query = "SELECT * FROM $TABLENAME WHERE $COL_DATE = '$date';";
                $result = DB::query_db($query);
                
                echo json_encode($result);
             }     
        break;
        
        case "between_date":
             $first_date  = filter_input(INPUT_GET, "first_date");
             $second_date = filter_input(INPUT_GET, "second_date");
             
             if(isset($first_date) && isset($second_date)) {
                 $query = "SELECT * FROM $TABLENAME WHERE $COL_DATE BETWEEN '$first_date' AND '$second_date';";
                 $result = DB::query_db($query);
                 
                 echo json_encode($result);
             }     
        break;
        
        case "order_by_date":
            $query = "SELECT * FROM $TABLENAME ORDER BY $COL_DATE DESC;";
            $result = DB::query_db($query);
            
            echo json_encode($result);    
        break;
        
        case "since_x_hours":
            $time = filter_input(INPUT_GET, "time");
            $date = filter_input(INPUT_GET, "date");
            if(isset($hour)) {
                $query = "SELECT * FROM $TABLENAME WHERE $COL_TIME > $time AND $COL_DATE = $date;";
                $result = DB::query_db($query);
            
                echo json_encode($result);
            }
        break;
    
        default:
             echo "404";
        break;
     }
 }
