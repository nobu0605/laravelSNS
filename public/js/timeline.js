$(function(){
'use strict';

  $('#imgFile').change(
  function () {
    if (!this.files.length) {
        return;
    }

    var file = $(this).prop('files')[0];
    var fr = new FileReader();
    $('.preview').css('background-image', 'none');
    fr.onload = function() {
        $('.preview').css('background-image', 'url(' + fr.result + ')');
    }
    fr.readAsDataURL(file);
    $(".preview img").css('opacity', 0);
  }
);
   
  $(".modalOpen").click(function(){
    var href = $(this).attr("href");      
    $(href).fadeIn();
    $(this).addClass("open");

    return false;
  });
   
  $(".modalClose").click(function(){
    $(this).parents(".modal").fadeOut();
    $(".modalOpen").removeClass("open");

    return false;
  });  
    

});