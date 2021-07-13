var sos =document.querySelector('.sos');

sos.addEventListener('click', function(){
     model_bg.classList.add('bg-active');
     var sos_register = document.getElementById("sos").value;
     document.getElementById("final").value = sos_register;
});

