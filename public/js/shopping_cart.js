let addButton = document.querySelectorAll(".add");

const socket = new WebSocket('ws://localhost:6001');

socket.addEventListener('open', () => {
    console.log('WebSocket connected');
});

socket.addEventListener('error', function(event) {
    console.error('WebSocket encountered an error:', event);
  });

let addProduct = (id, token) =>{
    // $.ajax({
    //     type: "POST",
    //     url: `/add-product`,
    //     data: JSON.stringify({
    //         'id' : id, _token : token
    //     }),
    //     contentType: "application/json",
    //     success: function (response) {
    //         alert(response['message']);
    //         document.querySelector('.count-items').textContent = response['items_count'];
    //     }
    // });

    socket.addEventListener('message', (event) => {
        const data = JSON.parse(event.data);
    
        if (data.event === 'ProductAddedToCart') {
            console.log(event);
        } else if (data.event === 'ProductRemovedFromCart') {
            console.log(event);
        }
    });
}


addButton.forEach(element => {
    element.addEventListener("click", () => {
        let id_food = element.attributes[1].value;

        addProduct(id_food, document.querySelector('[name="_token"]').value);
    });
});

let removeProduct = (id, name) =>{
    let data = new FormData();
    data.append('id', id);
    data.append('name', name);
    data.append('action', "remove");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../scripts/HandleShoppingCart.php", true);
    xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        let result = JSON.parse(xhr.responseText);
        listener();

        cart.innerHTML = result;
    }
    };

    xhr.send(data);
}

let listener = () => { 

let shoppingCart = document.getElementById("cart");

shoppingCart.addEventListener("click", (event) => {
    if (event.target.classList.contains("remove")) {
      let id = event.target.dataset.removeId;
      let name = event.target.dataset.removeName;

      removeProduct(id, name);
    }
});
}

listener();

let icon = document.getElementById('icon');

let form = document.getElementById('cart');

icon.addEventListener('click', (element) =>{
    form.submit();
});
