$(".form-modal-button").on("click", function() {
    $(this).closest(".modal-content").find("form").submit();
});