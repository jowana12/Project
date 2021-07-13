var model_bg =document.querySelector('.modal-bg');
var model_close = document.querySelector('.btn-modal-cancel');
model_close.addEventListener('click', function(){
     model_bg.classList.remove('bg-active');
});