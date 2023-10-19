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
            url: "../scripts/submit_review.php",
            data: formData,
            headers: {
                'Content-Type' : 'application/json'
            },
            success: function (response) {
                let checkAlreadyReviewed = JSON.parse(xhr.responseText);

                if (checkAlreadyReviewed !== null) {
                    alert(checkAlreadyReviewed);

                    location.reload();
                }

                form.reset();
            }
        });

        // let formData = new FormData(form);

        // let xhr = new XMLHttpRequest();
        // xhr.open('POST', '../scripts/submit_review.php');
        // xhr.onreadystatechange = function () {
        //     if (xhr.readyState === XMLHttpRequest.DONE) {
        //         if (xhr.status === 200) {
        //             let checkAlreadyReviewed = JSON.parse(xhr.responseText);

        //             if (checkAlreadyReviewed !== null) {
        //                 alert(checkAlreadyReviewed);

        //                 location.reload();
        //             }

        //             form.reset();
        //         } else {
        //             console.error('Error:', xhr.statusText);
        //         }
        //     }
        // };

        // xhr.send(formData);
    });
});

