<?php
    include "../classes/DB.php";
    include "../classes/RealtySpecification.php";
    include "../classes/Realty.php";

    $updated = Realty::update($_POST);

    header('Content-Type: application/json');

    echo json_encode(array('updated' =>  $updated));