const { data } = require("jquery");

$(document).ready(function () {

    function checkIfDuplicateExists(w){
        return new Set(w).size !== w.length
    }

    $('.submit_del').on('click', function () {
        var confirmSentence = $(this).data('confirm');
        return confirm(confirmSentence);
    });

    var dataInput = $('#tags_name').data('taglist');
    $('#tags_name').tokenfield({
        autocomplete: {
            source: dataInput,
            delay: 100
        },
        showAutocompleteOnFocus: true,
        limit : 5,
    });
    $('#tags_name').on('change', function () {
        var selectedList = ($('#tags_name').val().split(", "));
        console.log(selectedList);
        console.log(checkIfDuplicateExists(selectedList));
        if (checkIfDuplicateExists(selectedList)) {
            $('#duplicate-tags').css("display","block");
            $('#submit-form-add').attr("disabled", true);
        } else {
            $('#duplicate-tags').css("display","none");
            $('#submit-form-add').attr("disabled", false);
        }
    });

    $('.vote-up').on('click', function (event) {
        event.preventDefault();
        $questionId = $(this).data('id');
        document.getElementById('up-vote-question-' + $questionId).submit();
    });

    $('.vote-down').on('click', function (event) {
        event.preventDefault();
        $questionId = $(this).data('id');
        document.getElementById('down-vote-question-' + $questionId).submit();
    });
});
