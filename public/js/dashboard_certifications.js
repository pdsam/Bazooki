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