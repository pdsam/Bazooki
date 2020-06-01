function deleteModerator(moderatorID) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        url: "/mod/moderators/" + moderatorID,
        type: "DELETE",
        data: {_method: "DELETE"},
        success: (response) => {
            if(response.success) {
                $("#moderator" + moderatorID).slideUp("normal", function() {
                    $(this).remove();
                    if($(".moderator-card").length == 0) {
                        $("<p class='mt-3'>There are no moderators \\_(ツ)_/¯</p>").insertAfter('#moderator-list');
                    }
                });
            }

            if (response.error)
                console.log(response.error);
        }
    });
}