const { data } = require("jquery");

$(document).ready(function () {
    $('.multi-tag').select2({
        maximumSelectionLength: 2,
        placeholder: $(this).data('placeholder'),
        allowClear: true,
    });
    $('.submit_del').on('click', function () {
        var confirmSentence = $(this).data('confirm');
        return confirm(confirmSentence);
    });
});
