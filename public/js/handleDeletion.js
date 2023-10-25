document.addEventListener("DOMContentLoaded", () => {
    let username_div = document.querySelector("#user-info");
    var token = document.querySelector("input[name=_token]").value 

    $.ajax({
        type: "POST",
        url: "/handle-review",
        data: JSON.stringify({ 
            action : "check", _token : token
        }),
        contentType: "application/json",
        success: function (response) {

                let authorized_user = response["authorized_user"];
                let reviews_div = document.querySelector(".reviews-div");
                let review_divs = reviews_div.querySelectorAll("[class^='review-']");

            review_divs.forEach((review_divs) => {
                let authorized_name = review_divs.querySelector("p").innerHTML;

                if(authorized_user === authorized_name){
                    let deleteButton = document.createElement("button");
                    deleteButton.id = "delete-review";
                    deleteButton.textContent = "Изтрии ревю";

                    let firstElement = review_divs.children.item(1);

                    review_divs.insertBefore(deleteButton, firstElement);

                    deleteButton.onclick = () =>{
                        let id_review = review_divs.classList[0].replace("review-", "");

                        deleteReviewAndUpdate(id_review);

                        review_divs.remove();
                    }
                }
            });
        }
    });

    function deleteReviewAndUpdate(id_to_delete){
    // let data = new FormData();
    // data.append("id_reviews", id_to_delete);
    // data.append("action", "delete");

    // let xhr = new XMLHttpRequest();

    // xhr.open('POST', '../scripts/ReviewLogic.php');
    // xhr.onreadystatechange = function () {
    //     if (xhr.readyState === XMLHttpRequest.DONE) {
    //         if (xhr.status === 200) {
    //             // let result = JSON.parse(xhr.responseText);
    //         } else {
    //             console.error('Error:', xhr.statusText);
    //         }
    //     }
    // };

    // xhr.send(data);

        $.ajax({
            type: "POST",
            url: "/handle-review",
            data: JSON.stringify({
                id_reviews : id_to_delete,
                _token : token,
                action : "delete"
            }),
            contentType: "application/json",
        });
    }
});