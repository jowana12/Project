var modal_bg_02 =document.querySelector('.modal-bg-02');

var modal_close = document.querySelector('.btn-modal-cancel-02');
modal_close.addEventListener('click', function(){
     modal_bg_02.classList.remove('bg-active');
});