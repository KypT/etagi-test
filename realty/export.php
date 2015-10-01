<?php
    include "../classes/DB.php";
    include "../classes/RealtySpecification.php";
    include "../classes/RealtyXmlView.php";
    include "../classes/Realty.php";

    header('Content-Type: text/xml');

    (new RealtyXmlView())->display(Realty::all());
