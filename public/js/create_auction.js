$(function () {

    // INITIALIZE DATEPICKER PLUGIN
    $('.datepicker-start').datepicker({
        clearbtn: true,
        format: "dd/mm/yyyy"
    });

    $('.datepicker-end').datepicker({
        clearbtn: true,
        format: "dd/mm/yyyy"
    });

    // FOR DEMO PURPOSE
    $('#reservationDate').on('change', function () {
        var pickedDate = $('input').val();
        $('#pickedDate').html(pickedDate);
    });
});

$(function(){$("select").imagepicker();});


function addRequiredInputs() {

    const formBody = document.getElementById("createAuctionForm");

    const days = $("#days").val();
    const hours = $("#hours").val();
    const mins = $("#mins").val();
    const durationInSeconds = mins*60 + hours*60*60 + days*24*60*60;

    const durationInput = document.createElement("input");
    durationInput.setAttribute("name", "duration");
    durationInput.setAttribute("type", "hidden");
    durationInput.setAttribute("value", durationInSeconds);
    formBody.appendChild(durationInput);

    document.querySelectorAll(".image_picker_image").forEach((node) => {
        const newInput = document.createElement("input");
        newInput.setAttribute("name", "photos");
        newInput.setAttribute("type", "hidden");
        newInput.setAttribute("value", node.getAttribute("src"));
        formBody.appendChild(newInput);
    });

    return true;
}