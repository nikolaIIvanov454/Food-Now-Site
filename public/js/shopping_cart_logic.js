let removeProduct = () => {
    let id = document.getElementById('row-id').value;
    let token = document.querySelector('[name="_token"]').value;

    $.ajax({
        type: "POST",
        url: "/remove-product",
        data: JSON.stringify({
            'id': id, _token: token
        }),
        contentType: "application/json",
        success: function () {
            location.reload();
        }
    });

    if (!window.Echo.connector.channels['remove-product']) {
        window.Echo.channel('remove-product')
            .listen('DeleteProductFromCart', (data) => {
                location.reload();
            });
    }
}

let checkout = (event) => {
    let form = document.getElementById('checkout-form');
    event.preventDefault();

    let formData = new FormData(form);

    $.ajax({
        type: "POST",
        url: "/checkout",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            swal("Успешно завършване на поръчката", "", "success");

            setTimeout(function () {
                location.reload(true);
            }, 1000);
        },
        error: function (message) {
            swal("Възникна проблем", "", "error");
        }
    });
}