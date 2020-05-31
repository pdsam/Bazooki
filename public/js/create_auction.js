$(function () {

    // INITIALIZE DATEPICKER PLUGIN
    $('.datepicker-start').datepicker({
        clearbtn: true,
        format: "dd-mm-yyyy"
    });

    $('.datepicker-end').datepicker({
        clearbtn: true,
        format: "dd-mm-yyyy"
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

    // if certification uploaded, must select checkbox
    const certification = formBody.querySelector("input[name=certification]");
    const certification_check = formBody.querySelector("input[name=certification_check]");
    if (certification.value != "" && certification_check.checked != true)
        return false;

    const days = $("#days").val();
    const hours = $("#hours").val();
    const mins = $("#mins").val();
    const durationInSeconds = mins*60 + hours*60*60 + days*24*60*60;

    const durationInput = document.createElement("input");
    durationInput.setAttribute("name", "duration");
    durationInput.setAttribute("type", "hidden");
    durationInput.setAttribute("value", durationInSeconds);
    formBody.appendChild(durationInput);
    
    return true;
}

let nextImageID = 1;
$("#auctionImageInput").change(function() {
    document.querySelector(".thumbnails").innerHTML = "";
    for (let i = 0; i < $(this).prop("files").length; i++) {
        const newLi = document.createElement("li");
        const newDiv = document.createElement("div");
        newDiv.classList="thumbnail";
        const newImg = document.createElement("img");
        newImg.classList="image_picker_image";
        newLi.appendChild(newDiv);
        newDiv.appendChild(newImg);
        
        const file = $(this).prop("files")[i];
        const reader = new FileReader();
    
        reader.onloadend = function() {
            newImg.setAttribute("src", reader.result);
        }

        reader.readAsDataURL(file);
        document.querySelector(".thumbnails").appendChild(newLi);
    }
});

$(document).ready(function() {
    $('.auction_categories').select2({
        theme: "classic",
        closeOnSelect: false,
        placeholder: "Categories",
    });
});