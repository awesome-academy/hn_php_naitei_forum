require("./bootstrap");
$(document).ready(function () {
    $("#logout_app").on("click", function (event) {
        event.preventDefault();
        $("#logout-form").submit();
    });
});
