function text_counter (input_text, target)
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
