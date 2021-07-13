var icons =document.querySelector('.icons');

icons.addEventListener('click', function(){
     model_bg.classList.add('bg-active');
     var icons_register = document.getElementById("icons").value;
     document.getElementById("final").value = icons_register;
});

