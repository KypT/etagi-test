<?
    function field($attributeName, $label, $class = '', $type = 'text', $pattern='') {
        $id = uniqid($attributeName);
        return
            "<div class=' col-md-4 form-group $class'>
                <label for='$id'>$label:</label>
                <input class='form-control' id='$id' name='$attributeName' type='$type' ".(empty($pattern)? '' : "pattern='$pattern' title='Введите число с плавяющей точкой' ")."/>
            </div>";
    }
?>

<form class="realty form" action="#" accept-charset="utf-8">
    <h2 class="title"></h2>
    <?
        $float_pattern = '\-?\d+(\.\d{0,})?';
        $apartments = 'apartment pension room dormitory ';
        $countryside_apartments = 'land countryhouse house cottage townhouse ';
        $commercial_property = 'office store stock ';
        $realty = $apartments.$countryside_apartments.$commercial_property;
    ?>

    <div class="row">
        <?// class properties ?>
        <?= field('city',   'Город',  $realty) ?>
        <?= field('region', 'Регион', $realty) ?>
        <?= field('street', 'Улица',  $realty) ?>

        <? // apartments type properties ?>
        <?= field('house_number',     'Номер дома',     $apartments, 'number') ?>
        <?= field('apartment_number', 'Номер квартиры', $apartments, 'number') ?>
        <?= field('floor',            'Этаж',           $apartments, 'number') ?>
        <?= field('max_floor',        'Этажность',      $apartments, 'number') ?>

        <?= field('living_area',  'Жилая площадь',   'apartment', 'text', $float_pattern) ?>
        <?= field('kitchen_area', 'Площадь кухни',   'apartment', 'text', $float_pattern) ?>
        <?= field('area',         'Общая площадь',   'pension dormitory apartment', 'text', $float_pattern) ?>
        <?= field('area',         'Площадь комнаты', 'room', 'text', $float_pattern) ?>

        <?// countryside apartments properties ?>
        <?= field('number',      'Номер участка',   'land countryhouse', 'number') ?>
        <?= field('number',      'Номер дома',      'house cottage townhouse', 'number') ?>
        <?= field('area_type_1', 'Площадь участка', 'land countryhouse house cottage') ?>
        <?= field('area_type_2', 'Площадь дома',    'countryhouse house cottage') ?>
        <?= field('max_floor',   'Этажность',       'countryhouse house cottage townhouse', 'number') ?>
        <?= field('floor',       'Этаж',            'townhouse', 'number') ?>
        <?= field('area_type_1', 'Общая площадь',   'townhouse', 'text', $float_pattern) ?>
        <?= field('area_type_2', 'Жилая площадь',   'townhouse', 'text', $float_pattern) ?>

        <?// commercial property properties ?>
        <?= field('number',    'Номер дома', $commercial_property, 'number') ?>
        <?= field('area',      'Площадь',    $commercial_property, 'text', $float_pattern) ?>
        <?= field('floor',     'Этаж',       $commercial_property, 'number') ?>
        <?= field('max_floor', 'Этажность',  $commercial_property, 'number') ?>

        <?= field('realtor', 'Риэлтор', $realty) ?>
        <?= field('price',   'Цена',    $realty, 'number') ?>
        <?= field('owner',   'Владелец', $realty) ?>

        <div class="<?= $realty ?>">
            <input type="hidden" name="class"/>
            <input type="hidden" name="type"/>
            <input type="hidden" name="id"/>
        </div>
    </div>

    <button class="btn btn-success submit">Сохранить <span class="glyphicon glyphicon-ok"></span></button>
</form>