let area = document.getElementById("oblast");

let firstOption = document.createElement("option");
firstOption.innerHTML = "Изберете град:";
area.appendChild(firstOption);

area[0].disabled = true;
area[0].hidden = true;

//THIS HERE IS FOR GETTING THE OPTIONS FROM THE DATABASE DYNAMICALLY

const xhr = new XMLHttpRequest();
xhr.open('POST', '../assets/scripts (Replace)/getOptions.php');
xhr.onreadystatechange = function () {
if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
            let result = JSON.parse(xhr.responseText);

            for (let index = 0; index < result.length; index++) {
                const element = result[index];

                let newOption = document.createElement("option");
                newOption.value = element['city'];
                newOption.innerHTML = element['city'];
                area.appendChild(newOption);
            }
        }
    } else {
        // console.error('Error:', xhr.statusText);
    }
};

xhr.send();


//THIS IS FOR GOING TO THE CLICKED RESTAURANT

let showRestaurant = (element) => {
    let restaurant = element;
    let form = restaurant.children[0];

    console.log(form)
    
    form.submit();
}

//THIS IS FOR MANIPULATION OF THE FAVOURITE BUTTON

let favouriteButton = document.querySelectorAll("#favourite");

let AJAXRequest = (button, restaurant_id) => {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `/get-favourited?id=${restaurant_id}`);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const result = JSON.parse(xhr.responseText)["status"];

                if (result === "favourited") {
                    button.firstChild.classList.replace("fa-regular", "fa-solid");
                } else if (result === "unfavourited") {
                    button.firstChild.classList.replace("fa-solid", "fa-regular");
                }
            } else {
                console.error('Error:', xhr.statusText);
            }
        }
    };

    xhr.send();
}

// let saveFavourited = () =>{
//     const xhr = new XMLHttpRequest();
//     xhr.open('GET', '/get-favourited');
//     xhr.onreadystatechange = function () {
//         if (xhr.readyState === XMLHttpRequest.DONE) {
//             if (xhr.status === 200) {
//                 const result = JSON.parse(xhr.responseText);

//                 for (let i = 0; i < result.length; i++) {
//                     for (let y = 0; y < favouriteButton.length; y++) {
//                         const element = favouriteButton[y];
                        
//                         if(result[i]['id_restaurant'] == element.parentElement.parentElement.children[1].value){
//                             element.firstChild.classList.replace("fa-regular", "fa-solid");
//                         }
//                     }
//                 }
//             } else {
//                 console.error('Error:', xhr.statusText);
//             }
//         }
//     };

//     xhr.send();
// }

// saveFavourited();

favouriteButton.forEach(element => {
    element.addEventListener("click", (event) => {
        event.stopPropagation();
        event.preventDefault();

        let restaurant_id = element.parentElement.parentElement.children[1].value;

        AJAXRequest(element, restaurant_id);
    });
});