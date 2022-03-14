
$(document).ready(function (e) {

    
    //when user keyup coin input rate will change
    $('#coin').on('keyup keypress', function () {
      let coin = Math.abs(parseInt($('#coin').val()));
     
      if ($('#coin').val() === "") {
        $('#rate').text('0 MMK');
      } else {
        $('#rate').text(coin * rate + " MMK");
  
      }
    });

});