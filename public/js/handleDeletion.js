document.addEventListener("DOMContentLoaded", () => {
    let username_div = document.querySelector("#user-info");
    let username = username_div.querySelector("p").innerHTML;

    $.ajax({
        type: "POST",
        url: "../assets/scripts (Replace)/submit_review.php",
        data: JSON.stringify({ username : username }),
        contentType: "application/x-www-form-urlencoded",
        success: function (response) {

                console.log(response)

                let authorized_user = JSON.parse(response["authorized_user"]);
                let reviews_div = document.querySelector(".reviews-div");
                let review_divs = reviews_div.querySelectorAll("[class^='review-']");

            review_divs.forEach((review_divs) => {
                let authorized_name = review_divs.querySelector("p").innerHTML;

                if(authorized_user === authorized_name){
                    let deleteButton = document.createElement("button");
                    deleteButton.id = "delete-review";
                    deleteButton.textContent = "Изтрии ревю";

                    deleteButton.onclick = () =>{
                        let id_review = review_divs.classList[0].replace("review-", "");

                        deleteReviewAndUpdate(id_review);

                        review_divs.remove();
                    }

                    let firstElement = review_divs.children.item(1);

                    review_divs.insertBefore(deleteButton, firstElement);
                }
            });
        }
    });

//     let xhr = new XMLHttpRequest();
//     xhr.open('POST', '../assets/scripts (Replace)/submit_review.php');
//     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//     xhr.onreadystatechange = function () {
//         if (xhr.readyState === XMLHttpRequest.DONE) {
//             if (xhr.status === 200) {
//                 let authorized_user = JSON.parse(xhr.responseText);
//                 let reviews_div = document.querySelector(".reviews-div");
//                 let review_divs = reviews_div.querySelectorAll("[class^='review-']");

//                 review_divs.forEach((review_divs) => {
//                     let authorized_name = review_divs.querySelector("p").innerHTML;

//                     if(authorized_user === authorized_name){
//                         let deleteButton = document.createElement("button");
//                         deleteButton.id = "delete-review";
//                         deleteButton.textContent = "Изтрии ревю";

//                         deleteButton.onclick = () =>{
//                             let id_review = review_divs.classList[0].replace("review-", "");

//                             deleteReviewAndUpdate(id_review);

//                             review_divs.remove();
//                         }

//                         let firstElement = review_divs.children.item(1);

//                         review_divs.insertBefore(deleteButton, firstElement);
//                     }
//                 });
//             } else {
//                 console.error('Error:', xhr.statusText);
//             }
//         }
//     };

//     //directly sending data without using formdata object
//     xhr.send("username=${username}");
// });

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
            url: "../assets/scripts (Replace)/ReviewLogic.php",
            data: JSON.stringify({
                id_reviews : id_to_delete,
                action : "delete"
            }),
            success: function (response) {
                
            }
        });
    }
});