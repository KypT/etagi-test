<?php
    include "../classes/DB.php";
    include "../classes/RealtySpecification.php";
    include "../classes/Realty.php";

    $ok = Realty::delete(htmlspecialchars($_POST['id']));
    header('Content-Type: application/json');
    $res = array('deleted' => $ok);
    echo json_encode($res);
?>