<?
class DB {

    protected const HOST   = "localhost";
    protected const PORT   = "3306";
    protected const DBNAME = "meteocube";
    protected const ENC    = "utf8";
    protected const USER   = "root";
    protected const PASS   = "";

    public static function connect() {

        $db = new PDO("mysql:host=" . self::HOST . //host = localhost par exemple ou l'adresse IP du serveur
                    ";port="         . self::PORT . //port = le port utilisé par la base de donnée (par exemple dans la configuration virtual host apache)
                    ";dbname="       . self::DBNAME . //nom de la base de donnée
                    ";charset="      . self::ENC,  //encodage des caractères (utf-8, ascii, iso etc..)
                    self::USER, self::PASS);//nom d'utilisateur et mot de passe de la base de donnée

        return $db;
    }
}
