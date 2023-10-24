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
            success: function (response) {
                if (response["message"] !== null) {
                    alert(response["message"]);

                    location.reload();
                }

                form.reset();
            }
        });
    });
});

