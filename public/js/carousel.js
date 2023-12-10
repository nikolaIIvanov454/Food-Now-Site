var splide = new Splide('.splide', {
    type: 'fade',
    rewind: true,	
    focus: 'center',
    autoplay: true,
    interval: 3000,
    width: '100%',	
    breakpoints: {
    768: {
        perPage: 2,
    },
    576: {
        perPage: 1,
    },
}
});


splide.mount();