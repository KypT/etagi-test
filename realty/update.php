<?php
    include "../classes/DB.php";
    include "../classes/RealtySpecification.php";
    include "../classes/Realty.php";

    $realty = Realty::update($_POST);

    header('Content-Type: application/json');

    if ($realty)
        $res = array('updated' => 'ok', 'realty' => $realty);
    else
        $res = array('updated' => 'false');

    echo json_encode($res);