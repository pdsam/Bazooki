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

function updateCertificationStatus(auction_id, newCertificationStatus) {
    $.ajax({
        url: "/mod/certifications/" + auction_id,
        type: "PATCH",
        data: {certificationStatus: newCertificationStatus, _method: "PATCH"},
        success: () => {
            $("#certification" + auction_id).closest(".certification-card").slideUp();
        }
    });
}