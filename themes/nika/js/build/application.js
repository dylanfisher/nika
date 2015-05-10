// Primary Javascript file

$ = jQuery;

jQuery(document).ready(function($){

  var clockTimer;

  nightTimeInit();
  surveyInit();

  function nightTimeInit() {
    var transition;
    var starInterval;
    var duration = 2000;
    var screensaverTimer;
    var screensaverWaitPeriod = 60000;

    screensaverTimout();

    $('.moon svg').click(function(){
      if($('html').hasClass('night')) {
        nightOff();
      } else {
        nightOn();
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

      if(typeof callback == 'function') callback();
    }

    function nightOff(callback) {
      $('html').removeClass('night').addClass('night-transition');

      clearTimeout(transition);
      transition = setTimeout(function(){
        $('html').removeClass('night-transition');

        starsOff();

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

    // screensaver
    function screensaverTimout() {
      screensaverTimer = setInterval(function(){
        if($('html.night, html.night-transition').length) return;
        nightOn();
        startClock();
        $('html').addClass('screensaver');
      }, screensaverWaitPeriod);
    }

    $(document).on('mousemove.screensaverEvent', function(){
      clearInterval(screensaverTimer);
      screensaverTimout();

      if($('html.night.screensaver, html.night-transition.screensaver').length) {
        nightOff();
        stopClock();
        $('html').removeClass('screensaver');
      }
    });

  } // nightTimeInit

  function startClock() {
    var today=new Date();
    var h=today.getHours();
    if (h > 12) {
      h -= 12;
    } else if (h === 0) {
      h = 12;
    }
    var m=today.getMinutes();
    var s=today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);

    document.getElementById('screensaver-clock').innerHTML = h+':'+m+':'+s;

    var monthNames = [
      'January', 'February', 'March',
      'April', 'May', 'June', 'July',
      'August', 'September', 'October',
      'November', 'December'
    ];

    var day = today.getDate();
    var monthIndex = today.getMonth();
    var year = today.getFullYear();

    document.getElementById('screensaver-date').innerHTML = monthNames[monthIndex] + ' ' + day + ', ' + year;

    clockTimer = setTimeout(function(){
      startClock();
    },500);
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

});

$(window).resize(function(){
  $('.night-cover').css({height: ''});
  $('.night-cover').css({height: $(document).height() });
});
