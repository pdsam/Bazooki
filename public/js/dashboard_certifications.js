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

function updateCertificationStatus(auction_id, certification_id, newCertificationStatus) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        url: "/mod/certifications/" + certification_id,
        type: "PATCH",
        data: {certificationStatus: newCertificationStatus, _method: "PATCH"},
        success: (response) => {
            if(response.success) {
                $("#certification" + auction_id).closest(".certification-card").slideUp("normal", function() {
                    $(this).remove();
                    if($(".certification-card").length == 0) {
                        $("<p class='mt-3'>There are no certificates requiring validation \\_(ツ)_/¯</p>").insertAfter('meta[name="csrf-token"]');
                    }
                });
            }

            if (response.error)
                console.log(response.error);
        }
    });
}