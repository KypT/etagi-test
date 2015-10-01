<?php

class RealtyXmlView {

    private $exclude = ['id', 'realty_id'];

    public function display($realty) {
        echo '<?xml version="1.0" encoding="utf-8"?>';
        echo '<OBJECTS>';

        foreach($realty as $some_realty) {
            echo '<OBJECT>';

            foreach ($some_realty as $name => $val) {
                if (in_array($name, $this->exclude)) continue;
                if (empty($val)) continue;
                echo '<'.mb_convert_case($name, MB_CASE_UPPER).'>';
                echo $val;
                echo '</'.mb_convert_case($name, MB_CASE_UPPER).'>';
            }

            echo '</OBJECT>';
        }

        echo '</OBJECTS>';
    }
}