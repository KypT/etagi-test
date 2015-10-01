<?php

class RealtyTableView {

    private function addressOf($realty) {
        if ($realty->class == "apartments")
            $rest = "$realty->house_number, $realty->apartment_number";
        else
            $rest = "$realty->number";

        return "$realty->city, $realty->region, $realty->street, ".$rest;
    }

    private function withoudAddress($class, $specs) {
        if ($class == "apartments")
            unset($specs[0], $specs[1]);
        else
            unset($specs[0]);

        return $specs;
    }

    private function editButton($realty) {
        return "<button data-id='$realty->id' class='btn btn-xs btn-warning edit'><span class='glyphicon glyphicon-pencil'></span> изменить</button>";
    }

    private function deleteButton($realty) {
        return "<button data-id='$realty->id' class='btn btn-xs btn-danger delete'><span class='glyphicon glyphicon-remove'></span> удалить</button>";
    }

    private function row($realty) {
        $spec = $this->withoudAddress($realty->class, RealtySpecification::attributesFor($realty->type));

        echo "<tr data-id='$realty->id'>";
        echo "<td>".$this->addressOf($realty)."</td>";
        foreach ($spec as $attr) {
            echo "<td>".$realty->{$attr}."</td>";
        }
        echo "<td>".$realty->realtor."</td>";
        echo "<td>".$realty->price."</td>";
        echo "<td>".$this->editButton($realty)."</td>";
        echo "<td>".$this->deleteButton($realty)."</td>";
        echo "</tr>";
    }

    private function typeHeader($class, $type) {
        $spec = $this->withoudAddress($class, RealtySpecification::attributesFor($type));

        echo "<tr><th colspan='".(count($spec) + 5)."'><h3>".RealtySpecification::nameFor($type)."</h3></th></tr>";
        echo "<tr>";
        echo "<th>Адрес</th>";
        foreach ($spec as $attr) {
            echo "<th>".RealtySpecification::nameFor($type, $attr)."</th>";
        }
        echo "<th>Риэлтор</th>";
        echo "<th>Цена</th>";
        echo "<th width='90px'></th>";
        echo "<th width='90px'></th>";
        echo "</tr>";
    }

    public function display($tree) {
        foreach($tree as $class => $types) {
            echo "<h2>".RealtySpecification::nameFor($class)."</h2>";

            foreach ($types as $type => $realties) {
                echo "<table class='table $type'>";
                $this->typeHeader($class, $type);

                foreach ($realties as $realty)
                    $this->row($realty);

                echo "</table>";
            }
        }
    }
}