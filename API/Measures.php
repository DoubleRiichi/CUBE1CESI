<?php require_once(__DIR__ . "/DB.php");

$TABLENAME = "measures";

function get_all_measures() {
    $db = DB::connect();
    $req = $db->prepare("SELECT * FROM $TABLENAME");

    $req->execute();

    return $req->fetchAll(PDO::FETCH_ASSOC);
}

echo get_all_measures();
?>
