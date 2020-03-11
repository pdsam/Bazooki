function updateMaBidDisplay() {
    $('#maxBidDisplay').html(`${$('#maxBid').val()} $`);
}

$('#maxBid').on('change', function() {
    updateMaBidDisplay();
});

$(document).ready(function() {
    updateMaBidDisplay();
});