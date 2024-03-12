<?php 

error_reporting(E_ALL);
ini_set('display_errors', 'On');

class Database {
       
    protected const HOST   = "localhost";
    protected const PORT   = "3306";
    protected const DBNAME = "meteocube";
    protected const ENC    = "utf8";
    protected const USER   = "meteocube";
    protected const PASS   = "rock";

    static function connect_db() {

        $db = new PDO("mysql:host=" . self::HOST . //host = localhost par exemple ou l'adresse IP du serveur
                    ";port="         . self::PORT . //port = le port utilisé par la base de donnée (par exemple dans la configuration virtual host apache)
                    ";dbname="       . self::DBNAME . //nom de la base de donnée
                    ";charset="      . self::ENC,  //encodage des caractères (utf-8, ascii, iso etc..)
                    self::USER, self::PASS);//nom d'utilisateur et mot de passe de la base de donnée
        
        return $db; 
    }


    static function insert_measure($temp, $humidite, $pression, $date) {
        
        $db = self::connect_db(); //on ouvre un connection vers la ddb

        $req = $db->prepare("INSERT INTO `relevés` (`Température`, `Humidité`, `Pression`, `Date`, `#id_sonde`) VALUES ($temp, $humidite, $pression, $date, 1);"); 
        // "->" en php c'est l'équivalent du . dans d'autre language, il permet d'utiliser une méthode d'un objet ou une variable.
        // on utilise la méthode prepare de la classe PDO sur l'object $db pour préparer une requête SQL
        
        $req->execute(); // on execute ensuite la requêtre SQL préparée au préalable

        return "Done";
    }

    static function get_all_measures() {

        $db = self::connect_db();

        $req = $db->prepare("SELECT * FROM `relevés`");

        $req->execute();

        return $req->fetchAll(PDO::FETCH_ASSOC); //fetchALL ordonne à PDO de récupérer les résultats de la commande SQL, 
        //et FETCH_ASSOC précise que     l'on veut le résultat sous forme de tableau
    }
}
