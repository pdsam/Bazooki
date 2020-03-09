$(document).ready(function () {
    $('#categoryGroup').on('click', function() {
console.log('cona');
        $('.catIcon').addClass('fa-chevron-down').removeClass('fa-chevron-up');
    });

    $('#categoryGroup').on('hide.bs.toggle', function() {
        $('.catIcon').addClass('fa-chevron-up').removeClass('fa-chevron-down');
    });
});
