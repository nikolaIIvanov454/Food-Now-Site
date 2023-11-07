let addButton = document.querySelectorAll(".add");

let addProduct = (id, name, weight, price) =>{
    let data = new FormData();
    data.append('id_cart', id);
    data.append('cart_name', name);
    data.append('cart_weight', weight);
    data.append('cart_price', price);
    data.append('cart_quantity', 1);
    data.append('action', "add");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../scripts/HandleShoppingCart.php", true);
    xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        let result = JSON.parse(xhr.responseText);
        let cart = document.getElementById("cart");
        cart.innerHTML = result;
    }
    };

    xhr.send(data);
}

addButton.forEach(element => {
    element.addEventListener("click", () => {
        let id_food = element.attributes[1].value;
        let food_name = element.attributes[2].value;
        let food_weight = element.attributes[3].value;
        let food_price = element.attributes[4].value;

        addProduct(id_food, food_name, food_weight, food_price);
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

        // attachListener();
    }
    };

    xhr.send(data);
}

// let attachListener = () =>{
//     let removeButton = document.querySelectorAll(".remove");

//     removeButton.forEach(element => {
//         element.addEventListener("click", () => {
//             let id = element.dataset.removeId;
    
//             removeProduct(id);
//         });
//     });
// }

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


// attachListener();