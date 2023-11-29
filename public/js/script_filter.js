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

let AJAXRequest = (button, restaurant_id) => {

    $.ajax({
        type: "GET",
        url: `/get-favourited?id=${restaurant_id}`,
        headers: {
            'Content-Type' : 'application/json'
        },
        success: function (response) {

            if (response['status'] === 'favourited') {
                button.firstChild.classList.replace('fa-regular', 'fa-solid');
            } else if (response['status'] === 'unfavourited') {
                button.firstChild.classList.replace('fa-solid', 'fa-regular');
            }
        }
    });
}

let saveFavourited = () =>{
    $.ajax({
        type: "GET",
        url: "/get-favourited",
        headers: {
            'Content-Type' : 'application/json'
        },
        success: function (response) {
            for (let i = 0; i < response.length; i++) {
                for (let y = 0; y < favouriteButton.length; y++) {
                    const element = favouriteButton[y];
                    
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