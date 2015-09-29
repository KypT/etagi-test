<!DOCTYPE html>
<head>
    <title>Этажи. Каталог недвижимости</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <link rel="stylesheet" href="/assets/stylesheets/form.css">
    <link rel="stylesheet" href="/assets/stylesheets/index.css">
</head>

<body>
    <div class="container">
        <h1>Hello, Etagi</h1>
        <table class="table table-striped table-bordered">
        </table>

        <div class="btn-group add-realty">
            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Добавить <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li class="dropdown-header">Квартиру:</li>
                <li class="create" data-class="apartments" data-type="apartment">Квартиру</li>
                <li class="create" data-class="apartments" data-type="pension">Пансионат</li>
                <li class="create" data-class="apartments" data-type="room">Комнату</li>
                <li class="create" data-class="apartments" data-type="dormitory">Общежитие</li>
                <li class="dropdown-header">Загородная надвижимость:</li>
                <li class="create" data-class="countryside_apartments" data-type="land">Земельный участок</li>
                <li class="create" data-class="countryside_apartments" data-type="countryhouse">Дачу</li>
                <li class="create" data-class="countryside_apartments" data-type="house">Дом</li>
                <li class="create" data-class="countryside_apartments" data-type="cottage">Коттедж</li>
                <li class="create" data-class="countryside_apartments" data-type="townhouse">Таунхаус</li>
                <li class="dropdown-header">Коммерческая недвижимость:</li>
                <li class="create" data-class="commercial_property" data-type="office">Офисное помещение</li>
                <li class="create" data-class="commercial_property" data-type="store">Торговое помещение</li>
                <li class="create" data-class="commercial_property" data-type="stock">Складское помещение</li>
            </ul>
        </div>

        <? include '_form.php' ?>
    </div>

    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="/assets/javascripts/index.js"></script>
</body>