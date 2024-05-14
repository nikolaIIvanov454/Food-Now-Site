let area = document.getElementById("oblast");

let firstOption = document.createElement("option");
firstOption.innerHTML = "Изберете град:";
area.appendChild(firstOption);

area[0].disabled = true;
area[0].hidden = true;

let button = document.querySelector("input[type=submit]");

if (area.value === "Изберете град:") {
    button.disabled = true;
}

area.addEventListener("change", function () {
    button.disabled = false;
});

let restaurants_div = document.getElementsByClassName("item-shell");

$.ajax({
    url: "/get-options",
    type: "GET",
    dataType: "json",
    success: function (result) {
        for (let index = 0; index < result.length; index++) {
            const element = result[index];

            let newOption = $("<option></option>");
            newOption.val(element["city"]);
            newOption.text(element["city"]);
            $("#oblast").append(newOption);
        }
    },
    error: function (error) {
        console.error("Error:", error);
    },
});

//THIS IS FOR GOING TO THE CLICKED RESTAURANT

let showRestaurant = (element) => {
    let restaurant = element;
    let form = restaurant.children[0];

    form?.submit();
};

//THIS IS FOR MANIPULATION OF THE FAVOURITE BUTTON

let favouriteButton = document.querySelectorAll("#favourite");

let favourite_counter = document.querySelectorAll(".favourite-counter");

let AJAXRequest = (button, restaurant_id) => {
    $.ajax({
        type: "GET",
        url: `/get-favourited?id=${restaurant_id}`,
        headers: {
            "Content-Type": "application/json",
        },
        success: function (response) {
            if (response["status"] === "favourited") {
                button.firstChild.classList.replace("fa-regular", "fa-solid");

                for (let index = 0; index < favourite_counter.length; index++) {
                    const currentCounter = favourite_counter[index];

                    if (
                        restaurant_id ===
                        currentCounter.getAttribute("restaurant_id")
                    ) {
                        let previousValue = parseInt(currentCounter.innerText);

                        currentCounter.innerText = previousValue + 1;
                    }
                }
            } else if (response["status"] === "unfavourited") {
                button.firstChild.classList.replace("fa-solid", "fa-regular");

                for (let index = 0; index < favourite_counter.length; index++) {
                    const currentCounter = favourite_counter[index];

                    if (
                        restaurant_id ===
                        currentCounter.getAttribute("restaurant_id")
                    ) {
                        let previousValue = parseInt(currentCounter.innerText);

                        currentCounter.innerText = previousValue - 1;
                    }
                }
            }
        },
    });
};

let checkFavourited = () => {
    $.ajax({
        type: "GET",
        url: "/get-favourited",
        headers: {
            "Content-Type": "application/json",
        },
        success: function (response) {
            for (let i = 0; i < response.length; i++) {
                for (let y = 0; y < favouriteButton.length; y++) {
                    const element = favouriteButton[y];

                    if (
                        response[i]["id_restaurant"] ==
                        element.parentElement.parentElement.children[1].value
                    ) {
                        element.firstChild.classList.replace(
                            "fa-regular",
                            "fa-solid"
                        );
                    }
                }
            }
        },
    });
};

checkFavourited();

favouriteButton.forEach((element) => {
    element.addEventListener("click", (event) => {
        event.stopPropagation();
        event.preventDefault();

        let restaurant_id =
            element.parentElement.parentElement.children[1].value;

        AJAXRequest(element, restaurant_id);
    });
});
