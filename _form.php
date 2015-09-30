<?
    function field($attributeName, $label, $class = '', $type = 'text') {
        $id = uniqid($attributeName);
        return
            "<div class=' col-md-4 form-group $class'>
                <label for='$id'>$label:</label>
                <input class='form-control' id='$id' name='$attributeName' type='$type'/>
            </div>";
    }
?>

<form class="realty form container" action="#" accept-charset="utf-8">
    <h2 class="title"></h2>
    <?
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

        <?= field('living_area',  'Жилая площадь',   'apartment') ?>
        <?= field('kitchen_area', 'Площадь кухни',   'apartment') ?>
        <?= field('area',         'Общая площадь',   'pension dormitory apartment') ?>
        <?= field('area',         'Площадь комнаты', 'room') ?>

        <?// countryside apartments properties ?>
        <?= field('number',      'Номер участка',   'land countryhouse', 'number') ?>
        <?= field('number',      'Номер дома',      'house cottage townhouse', 'number') ?>
        <?= field('area_type_1', 'Площадь участка', 'land countryhouse house cottage') ?>
        <?= field('area_type_2', 'Площадь дома',    'countryhouse house cottage') ?>
        <?= field('max_floor',   'Этажность',       'countryhouse house cottage townhouse', 'number') ?>
        <?= field('floor',       'Этаж',            'townhouse', 'number') ?>
        <?= field('area_type_1', 'Общая площадь',   'townhouse') ?>
        <?= field('area_type_2', 'Жилая площадь',   'townhouse') ?>

        <?// commercial property properties ?>
        <?= field('number',    'Номер дома', $commercial_property, 'number') ?>
        <?= field('area',      'Площадь',    $commercial_property) ?>
        <?= field('floor',     'Этаж',       $commercial_property, 'number') ?>
        <?= field('max_floor', 'Этажность',  $commercial_property, 'number') ?>

        <?= field('realtor', 'Риэлтор', $realty) ?>
        <?= field('price',   'Цена',    $realty, 'number') ?>
        <?= field('owner',   'Владелец', $realty) ?>

        <input type="hidden" name="class" class="realty"/>
        <input type="hidden" name="type" class="realty"/>
    </div>

    <button class="btn btn-success submit">Добавить <span class="glyphicon glyphicon-ok"></span></button>
</form>