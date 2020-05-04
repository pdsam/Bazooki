$('#bid-form').submit( async (e) => {
    e.preventDefault();

    const form = $('#bid-form :input');

    const valArray = form.serializeArray();
    const id = valArray[1].value;
    
    const amount = await fetch(`/auctions/${id}/bid`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': valArray[0].value,
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        //credentials: 'same-origin',
        body: form.serialize()
    });

    const val = await amount.text();
    $('#price').html(val);

});

