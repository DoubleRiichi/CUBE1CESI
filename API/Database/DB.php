<?php declare(strict_types = 1);
 error_reporting(E_ALL); ini_set('display_errors', '1'); //Should be removed

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Database
 *
 * @author lain
 */
class DB {
       
        protected const HOST   = "localhost";
        protected const PORT   = "3306";
        protected const DBNAME = "meteocube2";
        protected const ENC    = "utf8";
        protected const USER   = "meteocube";
        protected const PASS   = "rock";
        
        
        private static function connect_db(): PDO {
            
            $db = new PDO("mysql:host="    . self::HOST   . ";
                                 port="    . self::PORT   . ";
                                 dbname="  . self::DBNAME . ";
                                 charset=" . self::ENC    . ";",
                                 self::USER, self::PASS);
            
            return $db;
        }
 
        
        public static function query_db(string $query): array {
            
            $db = self::connect_db();
                
            $req = $db->prepare($query);
            $req->execute();
    
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }
        
        
        public static function insert_db(string $query): void {
            
            $db = self::connect_db();
            
            $req = $db->prepare($query);
            
            $req->execute(); 
        }

        public static function test() {
            echo "passed";
        }
}
