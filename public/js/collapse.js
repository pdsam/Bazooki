$(document).ready(function () {
    $('.collapse').on('show.bs.collapse', function(event) {
        event.stopPropagation();
        const span = $(`[data-target='#${this.id}'] .fa`);
        span.addClass('fa-chevron-up');
        span.removeClass('fa-chevron-down');
    });

    $('.collapse').on('hide.bs.collapse', function(event) {
        event.stopPropagation();
        const span = $(`[data-target='#${this.id}'] .fa`);
        span.addClass('fa-chevron-down');
        span.removeClass('fa-chevron-up');
    });
});