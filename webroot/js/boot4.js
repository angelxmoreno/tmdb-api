$(document).ready(function(){
    var $modalListGroupItems = $('.modal-body .list-group-item');
    $modalListGroupItems.css('cursor', 'pointer');
    $modalListGroupItems.click(function(){
        $(this).toggleClass('active');
    });
});
