<?

class Realty {
    static private $attributesMap = array(
        'shared' => ['class', 'type', 'city', 'region', 'street', 'realtor', 'price', 'owner'],
        'apartment' => ['house_number', 'apartment_number', 'area', 'living_area', 'kitchen_area', 'floor', 'max_floor'],
        'pension' => ['house_number', 'apartment_number', 'area', 'floor', 'max_floor'],
        'room' => ['house_number', 'apartment_number', 'area', 'floor', 'max_floor'],
        'dormitory' => ['house_number', 'apartment_number', 'area', 'floor', 'max_floor'],
        'land' => ['number', 'area_type_1'],
        'countryhouse' => ['number', 'area_type_1', 'area_type_2', 'max_floor'],
        'house' => ['number', 'area_type_1', 'area_type_2', 'max_floor'],
        'cottage' => ['number', 'area_type_1', 'area_type_2', 'max_floor'],
        'townhouse' => ['number', 'area_type_1', 'area_type_2', 'floor', 'max_floor'],
        'office' => ['house_number', 'area', 'floor', 'max_floor'],
        'store' => ['house_number', 'area', 'floor', 'max_floor'],
        'stock' => ['house_number', 'area', 'floor', 'max_floor'],
    );

    static function getAttributesOf($type, $attributes) {
        $db = DB::getConnection();
        $result = array();

        foreach (self::$attributesMap[$type] as $attr)
            if (isset($attributes[$attr]))
                $result[$attr] = $db->real_escape_string(htmlspecialchars($attributes[$attr]));

        return $result;
    }

    static function insertQueryFor($class, $type, $id, $attributes) {
        $sql = "INSERT INTO $class ( realty_id, type";
        foreach(self::$attributesMap[$type] as $name)
            $sql .= ", $name";
        $sql .=  " ) VALUES ( $id, '$type'";
        foreach(self::$attributesMap[$type] as $val)
            $sql .= ", '{$attributes[$val]}'";
        return $sql.");";
    }

    public static function create($attr) {
        $db = DB::getConnection();

        if (count(array_diff(self::$attributesMap['shared'], array_keys($attr))) > 0)
            exit('Error: not all common properties are presented.');

        $shared = self::getAttributesOf('shared', $attr);

        if (count(array_diff(self::$attributesMap[$shared['type']], array_keys($attr))) > 0)
            exit('Error: not all type properties are presented.');

        $db->query("INSERT INTO realty(class, city, region, street, realtor, price, owner)
                    VALUES ( '$shared[class]', '$shared[city]', '$shared[region]', '$shared[street]',
                             '$shared[realtor]', $shared[price], '$shared[owner]' )");

        $db->query(self::insertQueryFor($shared['class'], $shared['type'], $db->insert_id, $attr));
    }
}