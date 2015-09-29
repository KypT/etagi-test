<?
    function field($attributeName, $label, $type = 'text', $class = '') {
        $id = uniqid($attributeName);
        return
            "<div class='form-group $class'>
                <label for='$id'>$label:</label>
                <input class='form-control' id='$id' name='$attributeName' type='$type'/>
            </div>";
    }
?>

<form class="realty form container" action="#" accept-charset="utf-8">
    <h2 class="title"></h2>

    <div class="common">
        <?= field('city',    'Город') ?>
        <?= field('region',  'Регион') ?>
        <?= field('street',  'Улица') ?>
    </div>

    <?// apartments properties ?>
    <div class="apartments properties">
        <div class="shared">
            <?= field('house_number',     'Номер дома', 'number') ?>
            <?= field('apartment_number', 'Номер квартиры', 'number') ?>
            <?= field('floor',            'Этаж', 'number') ?>
            <?= field('max_floor',        'Этажность', 'number') ?>
        </div>

        <div class="apartment">
            <?= field('living_area',  'Жилая площадь') ?>
            <?= field('kitchen_area', 'Площадь кухни') ?>
        </div>

        <div class="pension dormitory apartment">
            <?= field('area', 'Общая площадь') ?>
        </div>

        <div class="room">
            <?= field('area', 'Площадь комнаты') ?>
        </div>
    </div>

    <?// countryside apartments properties ?>
    <div class="countryside_apartments properties">
        <div class="land countryhouse">
            <?= field('number', 'Номер участка', 'number') ?>
        </div>

        <div class="house cottage townhouse">
            <?= field('number', 'Номер дома', 'number') ?>
        </div>

        <div class="land countryhouse house cottage">
            <?= field('area_type_1', 'Площадь участка') ?>
        </div>

        <div class="countryhouse house cottage">
            <?= field('area_type_2', 'Площадь дома') ?>
        </div>

        <div class="countryhouse house cottage townhouse">
            <?= field('max_floor', 'Этажность', 'number') ?>
        </div>

        <div class="townhouse">
            <?= field('floor', 'Этаж', 'number') ?>
            <?= field('area_type_1', 'Общая площадь') ?>
            <?= field('area_type_2', 'Жилая площадь') ?>
        </div>
    </div>

    <?// commercial property properties ?>
    <div class="commercial_property properties">
        <div class="shared">
            <?= field('house_number', 'Номер дома', 'number') ?>
            <?= field('area',         'Площадь') ?>
            <?= field('floor',        'Этаж', 'number') ?>
            <?= field('max_floor',    'Этажность', 'number') ?>
        </div>
    </div>

    <div class="common">
        <?= field('realtor', 'Риэлтор') ?>
        <?= field('price',   'Цена', 'number') ?>
        <?= field('owner',   'Владелец') ?>

        <input type="hidden" name="class"/>
        <input type="hidden" name="type"/>
    </div>

    <button class="btn btn-success submit">Добавить <span class="glyphicon glyphicon-ok"></span></button>
</form>