// Primary Javascript file

$ = jQuery;

jQuery(document).ready(function($){

  (function(){
    nightTimeInit();
  })();

  function nightTimeInit() {
    var transition;
    var starInterval;
    var duration = 2000;

    $('.moon svg').click(function(){
      if($('html').hasClass('night')) {
        nightOff();
      } else {
        nightOn();
      }
    });

    function nightOn() {
      $('.night-cover').css({height: ''});
      $('.night-cover').css({height: $(document).height() });
      $('html').addClass('night night-transition');

      clearTimeout(transition);
      transition = setTimeout(function(){
        $('html').removeClass('night-transition');
      }, duration);

      starsOn();
    }

    function nightOff() {
      $('html').removeClass('night').addClass('night-transition');

      clearTimeout(transition);
      transition = setTimeout(function(){
        $('html').removeClass('night-transition');
        starsOff();
      }, duration);
    }

    function starsOn() {
      starInterval = setInterval(function(){
        var position = 'style="top: ' + (Math.random()*100) + '%; left: ' + (Math.random()*100) + '%;"';
        var star = '<div class="star"' + position + '></div>';
        $('.star-wrapper').append(star);
        $('.star').last().addClass('active');
      }, 2000);
    }

    function starsOff() {
      clearInterval(starInterval);
      $('.star-wrapper').empty();
    }

  } // nightTimeInit

});

$(window).resize(function(){
  $('.night-cover').css({height: ''});
  $('.night-cover').css({height: $(document).height() });
});
