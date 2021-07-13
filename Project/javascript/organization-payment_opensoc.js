var opensoc=document.querySelector('.opensoc');

opensoc.addEventListener('click', function(){
     model_bg.classList.add('bg-active');
     var opensoc_register = document.getElementById("opensoc").value;
     document.getElementById("final").value = opensoc_register;
});

