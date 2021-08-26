require('./bootstrap');
$(document).ready(function () {
    $('.submit_del').on('click',function () {
        return confirm('Are you sure');
    })
});
