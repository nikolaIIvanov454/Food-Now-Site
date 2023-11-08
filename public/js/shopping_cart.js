let addButton = document.querySelectorAll(".add");

let addProduct = (id) =>{
    $.ajax({
        type: "GET",
        url: `/add-product?id=${id}&quantity=${1}`,
        success: function (response) {
            alert(response['message']);
            // let result = JSON.parse(xhr.responseText);
            // let cart = document.getElementById("cart");
            // cart.innerHTML = result;
        }
    });
}

let counter = 0;

addButton.forEach(element => {
    element.addEventListener("click", () => {
        let id_food = element.attributes[1].value;

        addProduct(id_food);

        counter++;

        document.querySelector('.count-items').textContent = counter;
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