var jpeg=document.querySelector('.jpeg');

jpeg.addEventListener('click', function(){
     model_bg.classList.add('bg-active');
     var jpeg_register = document.getElementById("jpeg").value;
     document.getElementById("final").value = jpeg_register;
});

