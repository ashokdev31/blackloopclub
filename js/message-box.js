$(document).ready(function () {
    
    $('.gtb-button').click(function () {
        $('.gtb-panel').show();
        $('.online-panel').hide();
        $('.deposit-panel').hide();
        $('.transfer-panel').hide();
    });
    
    $('.online-button').click(function () {
        $('.online-panel').show();
        $('.gtb-panel').hide();
        $('.deposit-panel').hide();
        $('.transfer-panel').hide();
    });
    
    $('.deposit-button').click(function () {
        $('.deposit-panel').show();
        $('.gtb-panel').hide();
        $('.online-panel').hide();
        $('.transfer-panel').hide();
    });
    
    $('.transfer-button').click(function () {
        $('.transfer-panel').show();
        $('.gtb-panel').hide();
        $('.online-panel').hide();
        $('.deposit-panel').hide();
    });
    
    
    
});


