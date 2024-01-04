let stars = document.getElementsByClassName('fa-star');

for(let i = 0; i < stars.length; i++){
    let element = stars[i];

    element.addEventListener('click', () =>{
        if(element.classList.contains('checked')){
            for (let j = i + 1; j < stars.length; j++) {
                stars[j].classList.remove('checked');
            }
        }else{
            element.classList.toggle('checked');

            for (let j = 0; j < i; j++) {
                stars[j].classList.add('checked');
            } 
        }

        var rating = document.getElementsByClassName('checked').length;
        
        document.querySelector("input[name=rating]").value = rating;
    });
}