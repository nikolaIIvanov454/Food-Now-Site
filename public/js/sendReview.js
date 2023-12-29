document.addEventListener("DOMContentLoaded", () => {
    let form = document.querySelector(".review-form");
    let submitButton = form.querySelector(".submit-button");

    submitButton.addEventListener("click", function (event) {
        event.preventDefault();

        let reviewText = document.querySelector("#review");

        let notFilled = false;

        if (reviewText.value === "" || reviewText.value === null) {
            alert("Моля попълнете всички полета!");

            notFilled = true;

            return;
        }

        let formData = new FormData(form);

        $.ajax({ 
            type: "POST",
            url: "/handle-review",
            data: formData,
            processData: false,
            contentType: false,
        });

        if (!window.Echo.connector.channels['add-review']) {
            window.Echo.channel('add-review')
            .listen('AddReview', (data) => {

                console.log(data.message);

                if (data.message !== null) {
                    alert(data.message);
                }

                location.reload();
            });
        }else if (!window.Echo.connector.channels['check-review']) {
            window.Echo.channel('check-review')
            .listen('AlreadyReviewed', (data) => {
                alert(data.message);
            });
        }
    });
});

