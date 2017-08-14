// Primary Javascript file

$ = jQuery;
var App = {};

jQuery(document).ready(function($){

  var clockTimer;

  App.windowWidth = $(window).width();
  App.windowHeight = $(window).height();
  App.documentWidth = $(document).width();
  App.documentHeight = $(document).height();

  App.isHome = function() {
    return $('body').hasClass('home');
  };

  nightTimeInit();
  surveyInit();

  function nightTimeInit() {
    if ( $(window).width() < 900 ) return;

    var transition;
    var starInterval;
    var duration = 2000;
    var screensaverOn = false;
    var screensaverTimer;
    var screensaverWaitPeriod = 60000;

    screensaverTimout();

    $('.website-info-link').click(function(e){
      e.preventDefault();

      if($('body').hasClass('home')) {
        if($('html').hasClass('night')) {
          nightOff();
        } else {
          nightOn();
        }
      }
    });

    $(document).on('click', function(e){
      if($('body').hasClass('home')) {
        if(!$('html').hasClass('night-transition') && !$(e.target).closest('a').length && $('html').hasClass('night')) {
          nightOff();
        }
      }
    });

    function nightOn(callback) {
      $('.night-cover').css({height: ''});
      $('.night-cover').css({height: $(document).height() });
      $('html').addClass('night night-transition');

      clearTimeout(transition);
      transition = setTimeout(function(){
        $('html').removeClass('night-transition');
      }, duration);

      starsOn();
      startClock();

      if(typeof callback == 'function') callback();
    }

    function nightOff(callback) {
      $('html').removeClass('night').addClass('night-transition');

      clearTimeout(transition);
      transition = setTimeout(function(){
        $('html').removeClass('night-transition');
        $('.night-cover').css({height: ''});

        starsOff();
        stopClock();

        if(typeof callback == 'function') callback();
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

    // screensaver on
    function screensaverTimout() {
      if ( !screensaverOn ) return;
      screensaverTimer = setInterval(function(){
        if($('html.night, html.night-transition').length) return;
        nightOn();
        $('html').addClass('screensaver screensaver-transition');
      }, screensaverWaitPeriod);
    }

    $(document).on('mousemove.screensaverEvent', function(){
      clearInterval(screensaverTimer);
      screensaverTimout();

      // screensaver off
      if($('html.night.screensaver, html.night-transition.screensaver').length) {
        nightOff(function(){
          $('html').removeClass('screensaver-transition');
        });
        $('html').removeClass('screensaver');
      }
    });

  } // nightTimeInit

  function startClock() {
    var today=new Date();
    var h=today.getHours();
    var meridian = 'am';
    if (h > 12) {
      h -= 12;
      meridian = 'pm';
    } else if (h === 0) {
      h = 12;
      meridian = 'am';
    }
    var m=today.getMinutes();
    var s=today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);

    $('.screensaver-clock').get(0).innerHTML = h+':'+m+meridian;

    var monthNames = [
      'January', 'February', 'March',
      'April', 'May', 'June', 'July',
      'August', 'September', 'October',
      'November', 'December'
    ];

    var day = today.getDate();
    var monthIndex = today.getMonth();
    var year = today.getFullYear();

    $('.screensaver-date').get(0).innerHTML = monthNames[monthIndex] + ' ' + day + ', ' + year;

    clockTimer = setTimeout(function(){
      startClock();
    },60000);
  }

  function stopClock() {
    clearTimeout(clockTimer);
  }

  function checkTime(i) {
    if (i<10) {i = '0' + i;}  // add zero in front of numbers < 10
    return i;
  }

  function surveyInit() {
    var survey = $('.survey');
    var surveyItems = survey.find('.survey-item');
    if(survey.length) {
      survey.prepend('<div class="new-question">New Question</div>');
      surveyItems.find('.question').prepend('Q. ');
      surveyItems.find('.answer').prepend('A. ');
      randomSurveyItem();
    }

    function randomSurveyItem() {
      var random = Math.floor(Math.random() * surveyItems.length);
      var item = surveyItems.eq(random);
      if(item.hasClass('active')) {
        randomSurveyItem();
      } else {
        surveyItems.removeClass('active');
        item.addClass('active');
      }
    }

    $(document).on('click', '.new-question', function(){
      randomSurveyItem();
    });
  }

  var $moon = $('#moon');

  if ( App.isHome() ) {
    var $html = $('html');

    $(window).scroll(function() {
      var st = $(window).scrollTop();
      var offsetPoint = App.windowHeight - 80;

      if ( st >= offsetPoint ) {
        $html.addClass('header-is-fixed');
      } else {
        $html.removeClass('header-is-fixed');
      }
    });
  }

  var $homeCarousel = $('.home-carousel');

  $homeCarousel.flickity({
    adaptiveHeight: true,
    prevNextButtons: false,
    wrapAround: true,
    imagesLoaded: true
  });

  $homeCarousel.on( 'select.flickity', function() {
    var flkty = $homeCarousel.data('flickity');
    var $currentSlide = $(flkty.selectedElement);
    var $video = $currentSlide.find('video');
    var $allVideos = $homeCarousel.find('video');
    var index = $currentSlide.attr('data-index');
    var $infoWrapper = $('.home-carousel__slide-info[data-index="' + index + '"]');
    var $allInfoWrappers = $('.home-carousel__slide-info');

    if ( $video.length ) {
      $video.get(0).play();
    } else {
      $allVideos.each(function() {
        $(this).get(0).pause();
      });
    }

    $allInfoWrappers.hide();
    $infoWrapper.show();
  });

});

$(window).resize(function(){
  App.windowWidth = $(window).width();
  App.windowHeight = $(window).height();
  App.documentWidth = $(document).width();
  App.documentHeight = $(document).height();

  $('.night-cover').css({height: ''});
  $('.night-cover').css({height: $(document).height() });
});

$(document).on('click', '.home__down-arrow', function() {
  $('html, body').animate({ scrollTop: App.windowHeight }, 1000);
});
