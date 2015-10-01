<?php
    include "../classes/DB.php";
    include "../classes/RealtySpecification.php";
    include "../classes/Realty.php";

    $realty = Realty::create($_POST);

    header('Content-Type: application/json');
    if ($realty)
        $res = array('created' => true, 'realty' => $realty);
    else
        $res = array('created' => false);

    echo json_encode($res);