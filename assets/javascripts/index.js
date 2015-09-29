$(function() {
    var $realtyForm = $('.realty.form'),

    $creationalTriggers = $('.create');
    if ($creationalTriggers.length > 0) {
        $creationalTriggers.click(function() {
            var $this = $(this),
                klass = $this.data('class'),
                type = $this.data('type');

            showFormFor(klass, type, 'Добавление новой недвижимости.')
        });
    }

    function showFormFor(klass, type, title) {
        $realtyForm.show();
        $realtyForm.find('input')[0].focus();
        $realtyForm.find('h2').text(title);
        $realtyForm.find('.properties').hide();

        var $classProperties = $realtyForm.find('.' + klass + '.properties');
        $classProperties.show();
        $classProperties.find('>*:not(.shared)').hide();
        $classProperties.find('.' + type).show();
    }
});