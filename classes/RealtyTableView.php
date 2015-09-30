<?php

class RealtyTableView {

    private function addressOf($realty) {
        if ($realty->class == "apartments")
            $rest = "$realty->house_number, $realty->apartment_number";
        else
            $rest = "$realty->number";

        return "$realty->city, $realty->region, $realty->street, ".$rest;
    }

    private function row($realty) {
        $spec = RealtySpecification::attributesFor($realty->type);
        echo "<tr>";
        echo "<td>".$this->addressOf($realty)."</td>";
        foreach ($spec as $attr) {
            echo "<td>".$realty->{$attr}."</td>";
        }
        echo "<td>".$realty->realtor."</td>";
        echo "<td>".$realty->price."</td>";
        echo "</tr>";
    }

    private function typeHeader($type) {
        $spec = RealtySpecification::attributesFor($type);

        echo "<tr><th colspan='".(count($spec) + 3)."'><h3>".RealtySpecification::nameFor($type)."</h3></th></tr>";
        echo "<tr>";
        echo "<th>Адрес</th>";
        foreach ($spec as $attr) {
            echo "<th>".RealtySpecification::nameFor($type, $attr)."</th>";
        }
        echo "<th>Риэлтор</th>";
        echo "<th>Цена</th>";
        echo "<tr>";
    }

    public function display($tree) {
        foreach($tree as $class => $types) {
            echo "<h2>".RealtySpecification::nameFor($class)."</h2>";

            foreach ($types as $type => $realties) {
                echo "<table class='table'>";
                $this->typeHeader($type);

                foreach ($realties as $realty)
                    $this->row($realty);

                echo "</table>";
            }
        }
    }
}