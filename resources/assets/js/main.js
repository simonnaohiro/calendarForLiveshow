let submit = document.getElementById('submit');
let load_ani = document.getElementById('load-ani');
let alert = document.getElementById('alert');

console.log(alert);


submit.addEventListener('click', function(){
    load_ani.classList.add('loader');
    // console.log(alert.textContent);
    console.log(alert);
});

// if()