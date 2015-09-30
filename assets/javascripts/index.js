$(function () {
    var $realtyForm = $('.realty.form'),
        $editButtons = $('.btn.edit'),
        $deleteButtons = $('.btn.delete'),
        $creationalTriggers = $('.create'),
        $submitBtn = $realtyForm.find('.submit');

    $creationalTriggers.click(function () {
        var $this = $(this),
            klass = $this.data('class'),
            type = $this.data('type');

        showFormFor(klass, type, 'Добавление новой недвижимости', 'create')
    });

    $editButtons.click(function() {
        var id = $(this).data('id'),
            realty = getRealty(id);

        showFormFor(realty.class, realty.type, 'Изменение недвижимости', 'update');
        prefillForm(realty);
    });

    $deleteButtons.click(function() {
        var id = $(this).data('id'),
            ok = confirm('Точно?');

        if (ok)
            $.post('/realty/delete.php', {id: id}, function(res) {
                if (res.deleted == true)
                    removeRealty(id);
            });
    });

    $realtyForm.on('submit', function(e) {
        var data = {},
            type = $realtyForm.find('input[name="type"]').val();

        $realtyForm.find('.' + type + ' input').each(function(_, input) {
            var $input = $(input),
                val = $.trim($input.val());

            if (val.length > 0 )
                data[$input.attr('name')] = val;
        });

        $.post($realtyForm.attr('action'), data, function(res) {
            if (res.created == 'true') {
                window.location.reload();
            }
            else if (res.updated == 'true')
                window.location.reload();
        });
        return false;
    });

    function showFormFor(klass, type, title, action) {
        $realtyForm.attr('action', '/realty/' + action + '.php');
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

    function prefillForm(realty) {
        for (prop in realty) {
            $realtyForm.find('input[name=' + prop + ']').val(realty[prop]);
        }
    }

    function getRealty(id) {
        for (var i = 0; i < realty.length; i++)
            if (realty[i].id == id)
                return realty[i];
        return undefined;
    }

    function removeRealty(id) {
        $('tr[data-id=' + id + ']').remove();
    }

});