<?
    function field($attributeName, $label, $type = 'text', $class = '') {
        return
            "<div class='field $class'>
                <label for='#$attributeName'>$label:</label>
                <input id='#$attributeName' required='required' type='$type'/>
            </div>";
    }
?>

<form action="#" accept-charset="utf-8">
    <?// shared properties ?>
    <div class="shared">
        <?= field('city',    'Город') ?>
        <?= field('region',  'Регион') ?>
        <?= field('street',  'Улица') ?>
        <?= field('realtor', 'Риэлтор') ?>
        <?= field('price',   'Цена', 'number') ?>
        <?= field('owner',   'Владелец') ?>
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
            <?= field('living_area', 'Жилая площадь') ?>
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
            <?= field('area_type_1', 'Площадь дома') ?>
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
            <?= field('area', 'Площадь') ?>
            <?= field('floor', 'Этаж', 'number') ?>
            <?= field('max_floor', 'Этажность', 'number') ?>
        </div>
    </div>
</form>