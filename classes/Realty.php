<?
class Realty {
    static function getAttributesOf($type, $attributes) {
        $db = DB::getConnection();
        $result = array();

        foreach (RealtySpecification::attributesFor($type) as $attr)
            if (isset($attributes[$attr]))
                $result[$attr] = $attributes[$attr];

        return $result;
    }

    static function escapeData($data) {
        $db = DB::getConnection();
        $secure = array();
        foreach($data as $key => $val)
            $secure[$db->real_escape_string(htmlspecialchars($key))] = $db->real_escape_string(htmlspecialchars($val));

        return $secure;
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

    static function updateQueryFor($class, $type, $attributes) {
        $sql = "UPDATE $class SET type = '$type' ";
        foreach(RealtySpecification::attributesFor($type) as $name)
            $sql .= ", $name = '{$attributes[$name]}'";
        $sql .= " WHERE realty_id = {$attributes['id']}";
        return $sql;
    }

    public static function create($attr) {
        $db = DB::getConnection();
        $attr = self::escapeData($attr);

        if (count(array_diff(RealtySpecification::sharedAttributes(), array_keys($attr))) > 0)
            exit('Error: not all common properties are presented.');

        $shared = self::getAttributesOf('shared', $attr);

        if (count(array_diff(RealtySpecification::attributesFor($shared['type']), array_keys($attr))) > 0)
            exit('Error: not all type properties are presented.');

        $db->query("INSERT INTO realty(class, city, region, street, realtor, price, owner)
                    VALUES ( '$shared[class]', '$shared[city]', '$shared[region]', '$shared[street]',
                             '$shared[realtor]', $shared[price], '$shared[owner]' )");
        if ($db->errno) return false;

        $id = $db->insert_id;
        $db->query(self::insertQueryFor($shared['class'], $shared['type'], $id, $attr));
        if ($db->errno) return false;
        return self::get($id);
    }

    public static function all() {
        return array_merge(self::withClass('apartments'),
                           self::withClass('countryside_apartments'),
                           self::withClass('commercial_property'));
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

    static function classOf($id) {
        $db = DB::getConnection();
        return $db->query("SELECT class FROM realty WHERE id = $id;")->fetch_object()->class;
    }

    public static function get($id) {
        $db = DB::getConnection();
        $id = $db->real_escape_string($id);
        $class = self::classOf($id);
        return $db->query("SELECT * FROM realty, $class WHERE $class.realty_id = realty.id AND realty.id = $id")->fetch_object();
    }

    public static function update($data) {
        $db = DB::getConnection();
        $attr = self::escapeData($data);

        $shared = self::getAttributesOf('shared', $attr);

        $db->query("UPDATE realty SET city = '$shared[city]', region = '$shared[region]', street = '$shared[street]',
                                      realtor = '$shared[realtor]', price = '$shared[price]', owner = '$shared[owner]'
                                  WHERE id = $attr[id];");
        if ($db->errno) var_dump($db->error);

        $db->query(self::updateQueryFor($shared['class'], $shared['type'], $attr));
        if ($db->errno) var_dump($db->error);

        return true;
    }

    public static function delete($id) {
        $db = DB::getConnection();
        $id = $db->real_escape_string($id);
        $class = self::classOf($id);
        $db->query("DELETE FROM realty WHERE id = $id");
        if ($db->errno) return false;
        $db->query("DELETE FROM $class WHERE realty_id = $id");
        if ($db->errno) return false;
        return true;
    }
}