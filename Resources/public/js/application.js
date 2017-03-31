/* global krcms_generate_page_permalink_route */

function text_counter(input_text, target)
{
    var input = $(input_text);
    var target = $(target);
    var max = input.attr("maxlength");
    var defaultText = input.val();

    $(input_text).keyup(function () {
        var val = input.val();
        var len = val.length;
        if (val === defaultText) {
            len = 0;
        }
        target.text(len + " van de " + max + " karakters");
    });
}

$('#krcms_page_title').change(function () {
    $.ajax({
        type: 'POST',
        url: krcms_generate_page_permalink_route,
        dataType: 'text',
        data: {
            text: $('#krcms_page_title').val(),
            page_id: $(this).data('page_id')
        }
    }).done(function (data) {
        $('#krcms_page_permalink').val(data);
    });
});

$('#save_page').on('click', function () {
    $('#pageForm').submit();
});
