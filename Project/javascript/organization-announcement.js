var model_btn =document.querySelector('.btn_reply');
var model_bg =document.querySelector('.modal-bg');
var model_close = document.querySelector('.modal-close');

model_btn.addEventListener('click', function(){
     model_bg.classList.add('bg-active');

});

model_close.addEventListener('click', function(){
     model_bg.classList.remove('bg-active');
});

var btn_delete_reply =document.querySelector('.btn-delete-reply');
var model_bg_reply =document.querySelector('.modal-bg-reply');
var btn_model_cancel = document.querySelector('.btn-modal-cancel');

btn_delete_reply.addEventListener('click', function(){
     model_bg_reply.classList.add('bg-active1');
 });

 btn_model_cancel.addEventListener('click', function(){
     model_bg_reply.classList.remove('bg-active1');
});

var btn_delete_announcement =document.querySelector('.btn_delete');
var model_bg_announcement =document.querySelector('.modal-bg-announcement');
var btn_model_announcement_cancel = document.querySelector('.btn-modal-announcement-cancel');

btn_delete_announcement.addEventListener('click', function(){
     model_bg_announcement.classList.add('bg-active2');
 });

 btn_model_announcement_cancel.addEventListener('click', function(){
     model_bg_announcement.classList.remove('bg-active2');
});
