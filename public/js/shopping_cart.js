let addButton = document.querySelectorAll(".add");

let addProduct = (id, token) =>{
    $.ajax({
        type: "POST",
        url: `/add-product`,
        data: JSON.stringify({
            'id' : id, _token : token
        }),
        contentType: "application/json",
    });

    if (!window.Echo.connector.channels['add-product']) {
        window.Echo.channel('add-product')
        .listen('SuccessfullyAddedProductToCart', (data) => {
            alert(data.message);

            document.querySelector('.count-items').textContent = data.itemsCount;
        });
    }
}

addButton.forEach(element => {
    element.addEventListener("click", () => {
        let id_food = element.attributes[1].value;

        addProduct(id_food, document.querySelector('[name="_token"]').value);
    });
});

let icon = document.getElementById('icon');

let form = document.getElementById('cart');

icon.addEventListener('click', (element) =>{
    form.submit();
});
