<?
class Realty {
    static function getAttributesOf($type, $attributes) {
        $db = DB::getConnection();
        $result = array();

        foreach (RealtySpecification::attributesFor($type) as $attr)
            if (isset($attributes[$attr]))
                $result[$attr] = $db->real_escape_string(htmlspecialchars($attributes[$attr]));

        return $result;
    }

    static function insertQueryFor($class, $type, $id, $attributes) {
        $sql = "INSERT INTO $class ( realty_id, type";
        foreach(RealtySpecification::attributesFor($type) as $name)
            $sql .= ", $name";
        $sql .=  " ) VALUES ( $id, '$type'";
        foreach(RealtySpecification::attributesFor($type) as $val)
            $sql .= ", '{$attributes[$val]}'";
        return $sql.");";
    }

    public static function create($attr) {
        $db = DB::getConnection();

        if (count(array_diff(RealtySpecification::sharedAttributes(), array_keys($attr))) > 0)
            exit('Error: not all common properties are presented.');

        $shared = self::getAttributesOf('shared', $attr);

        if (count(array_diff(RealtySpecification::attributesFor($shared['type']), array_keys($attr))) > 0)
            exit('Error: not all type properties are presented.');

        $db->query("INSERT INTO realty(class, city, region, street, realtor, price, owner)
                    VALUES ( '$shared[class]', '$shared[city]', '$shared[region]', '$shared[street]',
                             '$shared[realtor]', $shared[price], '$shared[owner]' )");

        $db->query(self::insertQueryFor($shared['class'], $shared['type'], $db->insert_id, $attr));
    }

    public static function withClass($class) {
        $sql = "SELECT * FROM realty, $class WHERE realty.id = $class.realty_id;";
        $result = DB::getConnection()->query($sql);
        $realties = [];
        while ($realty = $result->fetch_object() )
            array_push($realties, $realty);
        return $realties;
    }

    public static function getTree($classes = ['apartments', 'countryside_apartments', 'commercial_property']) {
        $tree = array();
        foreach ($classes as $class) {
            $realties = Realty::withClass($class);

            foreach ($realties as $realty) {
                $type = $realty->type;

                if (!isset($tree[$class][$type]))
                    $tree[$class][$type] = array();

                array_push($tree[$class][$type], $realty);
            }
        }

        return $tree;
    }
}