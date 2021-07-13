var model_bg =document.querySelector('.modal-bg');
var model_close = document.querySelector('.btn-modal-cancel');
var error = document.getElementById("error").value;

model_close.addEventListener('click', function(){
     model_bg.classList.remove('bg-active');
     

});

if(error == 1){
	alert("Please complete the fields!");
}