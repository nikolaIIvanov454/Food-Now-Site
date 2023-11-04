let area = document.getElementById('oblast');

let firstOption = document.createElement('option');
firstOption.innerHTML = 'Изберете град:';
area.appendChild(firstOption);

area[0].disabled = true;
area[0].hidden = true;

//THIS HERE IS FOR GETTING THE OPTIONS FROM THE DATABASE DYNAMICALLY

$.ajax({
    url: '/get-options',
    type: 'GET',
    dataType: 'json',
    success: function(result) {
        for (let index = 0; index < result.length; index++) {
            const element = result[index];

            let newOption = $('<option></option>');
            newOption.val(element['city']);
            newOption.text(element['city']);
            $('#oblast').append(newOption);
        }
    },
    error: function(error) {
        console.error('Error:', error);
    }
});


//THIS IS FOR GOING TO THE CLICKED RESTAURANT


let showRestaurant = (element) => {
    let restaurant = element;
    let form = restaurant.children[0];
    
    form.submit();
}

//THIS IS FOR MANIPULATION OF THE FAVOURITE BUTTON

let favouriteButton = document.querySelectorAll('#favourite');

let counter = 0;

let AJAXRequest = (button, restaurant_id) => {
    counter++;

    $.ajax({
        type: "GET",
        url: `/get-favourited?id=${restaurant_id}`,
        headers: {
            'Content-Type' : 'application/json'
        },
    });

    if (counter % 2 === 0) {
        button.firstChild.classList.replace('fa-regular', 'fa-solid');
    } else if (counter % 2 === 1) {
        button.firstChild.classList.replace('fa-solid', 'fa-regular');
    }
}

// let saveFavourited = () =>{
//     const xhr = new XMLHttpRequest();
//     xhr.open('GET', '/get-favourited?checkFavourited=true');
//     xhr.setRequestHeader('Content-Type', 'application/json');
//     xhr.onreadystatechange = function () {
//         if (xhr.readyState === XMLHttpRequest.DONE) {
//             if (xhr.status === 200) {
//                 const result = JSON.parse(xhr.responseText);

//                 for (let i = 0; i < result.length; i++) {
//                     for (let y = 0; y < favouriteButton.length; y++) {
//                         const element = favouriteButton[y];

//                         console.log(element.parentElement.parentElement.children);
                        
//                         if(result[i]['id'] == element.parentElement.parentElement.children[1].value){
//                             element.firstChild.classList.replace('fa-regular', 'fa-solid');
//                         }
//                     }
//                 }
//             } else {
//                 console.error('Error:', xhr.statusText);
//             }
//         }
//     };

let saveFavourited = () =>{
    $.ajax({
        type: "GET",
        url: "/get-favourited?checkFavourited=true",
        headers: {
            'Content-Type' : 'application/json'
        },
        success: function (response) {
            for (let i = 0; i < response.length; i++) {
                for (let y = 0; y < favouriteButton.length; y++) {
                    const element = favouriteButton[y];

                    console.log(response[i]['id_restaurant'])
                    
                    if(response[i]['id_restaurant'] == element.parentElement.parentElement.children[1].value){
                        element.firstChild.classList.replace('fa-regular', 'fa-solid');
                    }
                }
            }
        }
    });
}

saveFavourited();

favouriteButton.forEach(element => {
    element.addEventListener('click', (event) => {
        event.stopPropagation();
        event.preventDefault();

        let restaurant_id = element.parentElement.parentElement.children[1].value;

        AJAXRequest(element, restaurant_id);
    });
});