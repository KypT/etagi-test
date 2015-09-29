$(function () {
    var $realtyForm = $('.realty.form'),
        $creationalTriggers = $('.create'),
        $submitBtn = $realtyForm.find('.submit');

    $creationalTriggers.click(function () {
        var $this = $(this),
            klass = $this.data('class'),
            type = $this.data('type');

        showFormFor(klass, type, 'Добавление новой недвижимости.')
    });

    $realtyForm.on('submit', function(e) {

        var data = {};
        $realtyForm.find('input').each(function(_, input) {
            var $input = $(input),
                val = $.trim($input.val());

            if (val.length > 0 )
                data[$input.attr('name')] = val;
        });

        $.post('/realty/create.php', data);
        return false;
    });

    function showFormFor(klass, type, title) {
        $realtyForm[0].reset();
        $realtyForm.show();
        $realtyForm.find('input').removeAttr('required');
        $realtyForm.find('.common input').attr('required', 'true');
        $realtyForm.find('input')[0].focus();
        $realtyForm.find('h2').text(title);
        $realtyForm.find('.properties').hide();
        $realtyForm.find('input[name="class"]').val(klass);
        $realtyForm.find('input[name="type"]').val(type);

        var $classProperties = $realtyForm.find('.' + klass + '.properties');
        $classProperties.show();
        $classProperties.find('>*:not(.shared)').hide();
        $classProperties.find('.shared input').attr('required', 'true');
        $classProperties.find('.' + type).show().find('input').attr('required', 'true');
    }
});