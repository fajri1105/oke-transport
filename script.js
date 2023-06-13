const humberger = document.querySelector('#home nav .humberger');
humberger.addEventListener('click', function(){
    const ul = document.querySelector('#home nav ul');
    ul.classList.toggle('muncul');
})