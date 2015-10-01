<?php

class RealtySpecification {
    private static $spec = array(
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
        'office' => ['number', 'area', 'floor', 'max_floor'],
        'store' => ['number', 'area', 'floor', 'max_floor'],
        'stock' => ['number', 'area', 'floor', 'max_floor'],
    );

    private static $names = array(
        'shared' => ['class' => 'класс', 'type' => 'тип', 'city' => 'город', 'region' => 'регион', 'street' => 'улица',
                     'realtor' => 'риэлтор', 'price' => 'цена', 'owner' => 'владелец', 'house_number' => 'номер дома',
                     'apartment_number' => 'номер квартиры', 'number' => 'номер дома', 'floor' => 'этаж',
                     'max_floor' => 'этажность', 'area' => 'общая площадь', 'area_type_1' => 'площадь участка',
                     'area_type_2' => 'площаль дома'],

        'apartment' => ['living_area' => 'жилая площадь', 'kitchen_area' => 'площадь кухни'],
        'pension' => [],
        'room' => ['area' => 'площадь комнаты'],
        'dormitory' => [],
        'land' => ['number' => 'номер участка'],
        'countryhouse' => ['number' => 'номер участка'],
        'house' => [],
        'cottage' => [],
        'townhouse' => ['area_type_1' => 'общая площадь', 'area_type_2' => 'жилая площадь'],
        'office' => ['area' => 'площадь'],
        'store' => ['area' => 'площадь'],
        'stock' => ['area' => 'площадь'],
    );

    private static $typeNames = array(
        'apartments' => 'квартиры',
        'countryside_apartments' => 'загородная недвижимость',
        'commercial_property' => 'коммерческая недвижимость',
        'apartment' => 'квартиры',
        'pension' => 'пансионаты',
        'room' => 'комнаты',
        'dormitory' => 'общежития',
        'land' => 'земельные участки',
        'countryhouse' => 'дачи',
        'house' => 'дома',
        'cottage' => 'коттеджы',
        'townhouse' => 'таунхаузы',
        'office' => 'офиссные помещения',
        'store' => 'торговые помещения',
        'stock' => 'складские помещения',
    );

    public static function sharedAttributes() {
        return self::$spec['shared'];
    }

    public static function allAttributesFor($type) {
        return array_merge(self::$spec['shared'], self::$spec[$type]);
    }

    public static function attributesFor($type) {
        return self::$spec[$type];
    }

    public static function nameFor($type, $attribute = '') {
        if (empty($attribute))
            return self::$typeNames[$type];

        if (isset(self::$names[$type][$attribute]))
            return self::$names[$type][$attribute];

        if (isset(self::$names['shared'][$attribute]))
            return self::$names['shared'][$attribute];

        return $attribute;
    }
}