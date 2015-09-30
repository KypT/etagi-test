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
        $realtyForm.find('h2').text(title);
        $realtyForm.find('input[name="class"]').val(klass);
        $realtyForm.find('input[name="type"]').val(type);
        $realtyForm.find('input').removeAttr('required');
        $realtyForm.find('.form-group').hide();
        var $fields = $realtyForm.find('.' + type).show();
        $fields.find('input').attr('required', 'true');
        $realtyForm.show().find('input')[0].focus();
    }
});