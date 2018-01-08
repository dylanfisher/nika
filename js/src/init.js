// Primary Javascript file

$ = jQuery;
var App = {};

jQuery(document).ready(function($){

  var clockTimer;

  App.windowWidth = $(window).width();
  App.windowHeight = $(window).height();
  App.documentWidth = $(document).width();
  App.documentHeight = $(document).height();

  $(window).on('scroll', function() {
    App.scrollTop = $(window).scrollTop();
  });

  App.isHome = function() {
    return $('body').hasClass('home');
  };

  var homeScrollHalfwayPoint = App.windowHeight / 2 + 120;

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

      if($('html').hasClass('night')) {
        nightOff();
      } else {
        nightOn();
      }
    });

    $(document).on('click', function(e){
      if(!$('html').hasClass('night-transition') && !$(e.target).closest('a').length && $('html').hasClass('night')) {
        nightOff();
      }
    });

    function nightOn(callback) {
      $('.night-cover').show().css({height: ''});
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
        $('.night-cover').hide().css({height: ''});

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

    $(window).resize(function() {
      homeScrollHalfwayPoint = App.windowHeight / 2 + 120;
    });

    $(window).scroll(function() {
      var st = App.scrollTop;

      if ( st >= homeScrollHalfwayPoint ) {
        $html.addClass('scrolled-halfway');
      } else {
        $html.removeClass('scrolled-halfway');
      }
    });
  }

  var $homeCarousels = $('.home-carousel');

  $homeCarousels.each(function() {
    var $homeCarousel = $(this);

    if ( $homeCarousel.hasClass('home-carousel-slide-count-1') ) {
      var $video = $homeCarousel.find('video');

      if ( $video.length ) {
        $video.get(0).play();
      }

      return;
    }

    $homeCarousel.flickity({
      adaptiveHeight: true,
      wrapAround: true,
      imagesLoaded: true,
        arrowShape: {
        x0: 10,
        x1: 70, y1: 50,
        x2: 70, y2: 30,
        x3: 70
      }
    });

    $homeCarousel.on( 'select.flickity', function() {
      var flkty = $homeCarousel.data('flickity');
      var $currentSlide = $(flkty.selectedElement);
      var $video = $currentSlide.find('video');
      var $allVideos = $homeCarousel.find('video');
      var index = $currentSlide.attr('data-index');
      // var $infoWrapper = $('.home-carousel__slide-info[data-index="' + index + '"]');
      // var $allInfoWrappers = $('.home-carousel__slide-info');

      if ( $video.length ) {
        $video.get(0).play();
        // window.setTimeout(function() {
        //   $homeCarousel.flickity('resize');
        // }, 250);
      } else {
        $allVideos.each(function() {
          $(this).get(0).pause();
        });
      }

      // $allInfoWrappers.hide();
      // $infoWrapper.show();
    });

    $homeCarousel.on('staticClick.flickity', function() {
      $homeCarousel.flickity('next');
    });
  });

  // Hide down arrow when you scroll
  var $downArrow = $('.home__down-arrow');
  if ( $downArrow.length ) {

    $(window).on('scroll', function() {
      if ( App.scrollTop > homeScrollHalfwayPoint ) {
        $downArrow.addClass('active');
      } else {
        $downArrow.removeClass('active');
      }
    });
  }

  var $masonry = $('.masonry');
  if ( $masonry.length ) {
    $masonry.each(function() {
      var $grid = $(this).masonry({
        itemSelector: '.grid-item',
        columnWidth: '.grid-sizer',
        percentPosition: true,
      });

      // layout Masonry after each image loads
      $grid.imagesLoaded().progress( function() {
        $grid.masonry('layout');
      });
    });
  }

}); // document ready

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

// Sketch book lightbox
$(document).on('click', '[data-lightbox]', function(e) {
  e.preventDefault();

  var url = $(this).attr('href');

  if ( !url ) {
    console.log('No URL specified for lightbox');
    return;
  }

  App.lightbox.new();

  $.ajax({
    url: url
  }).done(function(data) {
    var $sketchWrapper = $(data).find('.single-sketch-outer-wrapper');

    $sketchWrapper.find('.grid-sizer').remove();

    App.lightbox.load( $sketchWrapper.html() );
  });
});

$(document).on('click', '.close-icon-wrapper', function(e) {
  if ( App.lightbox.isOpen ) {
    e.preventDefault();
    App.lightbox.destroy();
  }
});

// Lightbox
App.lightbox = {};

App.lightbox.new = function() {
  var lightboxHTML = '<div class="lightbox" id="lightbox">' +
                       '<div class="lightbox__inner wrapper">' +
                         '<div class="lightbox__loading-message medium-sans">' +
                           'Loading...' +
                         '</div>' +
                       '</div>' +
                     '</div>';

  $('html').addClass('lightbox-is-open').append( lightboxHTML );
};

App.lightbox.load = function(content) {
  var $lightbox = $('#lightbox');
  var $lightboxInner = $lightbox.find('.lightbox__inner');

  $lightboxInner.html( content );
};

App.lightbox.destroy = function() {
  $('html').removeClass('lightbox-is-open');
  $('#lightbox').remove();
};

App.lightbox.isOpen = function() {
  return $(html).hasClass('lightbox-is-open');
};

$(document).on('keyup', function(e) {
  if ( e.keyCode === 27 ) {
    if ( App.lightbox.isOpen ) {
      App.lightbox.destroy();
    }
  }
});

$(document).on('click', function(e) {
  if ( App.lightbox.isOpen ) {
    if ( !$(e.target).closest('a').length ) {
      App.lightbox.destroy();
    }
  }
});

// Infinite loader
$(function() {
  var loadingInProgress = false;
  var $sketchbook = $('.sketches');

  loadNextSketchbookPage();

  function loadNextSketchbookPage() {
    var $nextPageWrapper = $('.next-page-wrapper');
    var $nextPageLink = $nextPageWrapper.find('a');

    if ( $sketchbook.length && $nextPageLink.length ) {
      var infiniteLoadPoint = App.documentHeight - ( App.windowHeight * 2 );
      var url = $nextPageLink.attr('href');

      $(window).resize(function() {
        infiniteLoadPoint = App.documentHeight - ( App.windowHeight * 2 );
      });

      $(window).on('scroll.infiniteLoaderEvents app:infiniteLoaderInit', function() {
        if ( !loadingInProgress && App.scrollTop > infiniteLoadPoint ) {
          loadingInProgress = true;

          $.ajax({
            method: 'GET',
            url: url
          }).done(function(data) {
            var $newSketchbook = $(data).find('.sketches');

            $newSketchbook.find('.grid-sizer').remove();

            $newContent = $( $newSketchbook.html() );

            turnOffEvents();
            $nextPageWrapper.remove();

            $sketchbook.append( $newContent ).masonry( 'appended', $newContent );

            $sketchbook.imagesLoaded().progress( function() {
              $sketchbook.masonry('layout');
            });

            loadingInProgress = false;

            $(document).trigger('app:sketchbookInit');

            loadNextSketchbookPage();
          });
        }
      });

      $(window).trigger('app:infiniteLoaderInit');
    } else {
      turnOffEvents();
    }
  }

  function turnOffEvents() {
    $(window).off('scroll.infiniteLoaderEvents app:infiniteLoaderInit');
  }
});
