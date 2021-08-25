require("./bootstrap");
$(document).ready(function () {
    $(".submit_del").on("click", function () {
        return confirm("Are you sure");
    });
});
$(document).ready(function () {
    $("#logout_app").on("click", function (event) {
        event.preventDefault();
        $("#logout-form").submit();
    });
});
