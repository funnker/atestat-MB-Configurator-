$(document).ready(function() {
    $('.list').click(function() {
      const value = $(this).attr('data-filter');
      if(value == 'all') {
        $('.itemBox').show('1000');
      }
      else {
        $('.itemBox').not('.'+value).hide('1000');
        $('.itemBox').filter('.'+value).show('1000');
      }
    })
    $('.list').click(function() {
      $(this).addClass('active').siblings().removeClass();
    })

    //c
    $('.itemBox').hover(function() {
        $(this).addClass("itemBox-configure-button");
        $(this).find(".itemBox-button").addClass("itemBox-configure-button");
        $(this).find(".itemBox-button").css("opacity: 1");
    },
    function() {
        $(this).removeClass("itemBox-configure-button");
        $(this).find(".itemBox-button").removeClass("itemBox-configure-button");
        $(this).find(".itemBox-button").css("opacity: 0.5");
    });
})
