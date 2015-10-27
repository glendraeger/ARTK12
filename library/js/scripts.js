/*
 * Bones Scripts File
 * Author: Eddie Machado
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 * There are a lot of example functions and tools in here. If you don't
 * need any of it, just remove it. They are meant to be helpers and are
 * not required. It's your world baby, you can do whatever you want.
*/


/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y };
}
// setting the viewport width
var viewport = updateViewportDimensions();


/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
*/
var waitForFinalEvent = (function () {
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
		if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;


/*
 * Here's an example so you can see how we're using the above function
 *
 * This is commented out so it won't work, but you can copy it and
 * remove the comments.
 *
 *
 *
 * If we want to only do it on a certain page, we can setup checks so we do it
 * as efficient as possible.
 *
 * if( typeof is_home === "undefined" ) var is_home = $('body').hasClass('home');
 *
 * This once checks to see if you're on the home page based on the body class
 * We can then use that check to perform actions on the home page only
 *
 * When the window is resized, we perform this function
 * $(window).resize(function () {
 *
 *    // if we're on the home page, we wait the set amount (in function above) then fire the function
 *    if( is_home ) { waitForFinalEvent( function() {
 *
 *	// update the viewport, in case the window size has changed
 *	viewport = updateViewportDimensions();
 *
 *      // if we're above or equal to 768 fire this off
 *      if( viewport.width >= 768 ) {
 *        console.log('On home page and window sized to 768 width or more.');
 *      } else {
 *        // otherwise, let's do this instead
 *        console.log('Not on home page, or window sized to less than 768.');
 *      }
 *
 *    }, timeToWaitForLast, "your-function-identifier-string"); }
 * });
 *
 * Pretty cool huh? You can create functions like this to conditionally load
 * content and other stuff dependent on the viewport.
 * Remember that mobile devices and javascript aren't the best of friends.
 * Keep it light and always make sure the larger viewports are doing the heavy lifting.
 *
*/

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
*/
function loadGravatars() {
  // set the viewport using the function above
  viewport = updateViewportDimensions();
  // if the viewport is tablet or larger, we load in the gravatars
  if (viewport.width >= 768) {
  jQuery('.comment img[data-gravatar]').each(function(){
    jQuery(this).attr('src',jQuery(this).attr('data-gravatar'));
  });
	}
} // end function


/*
 * Put all your regular jQuery in here.
*/
jQuery(document).ready(function($) {

  $('#nav-icon').click(function(){
      $('#main-navigation').slideToggle();
  });

  // PICTURE GAME
$('#game-start').click(function(){
    $('#game-start, #respond, .article-footer').hide();

    
    
    var delay = 60000; // 60000 = 1 minute
    $('#game-image').fadeIn().delay(delay).fadeOut();
    $('#game-question-container').delay(delay + 1000).fadeIn();

    //var imageHeight = $('#game-image img').height();
    //alert(imageHeight);
    //$('#content').css('height',imageHeight+'px');
   
   $('.games #sidebar1').fadeOut();
   $('.games #instructions').fadeOut();
   $('.games .ninecol').css('width','100%');

   // Game Timer Countdown
    var i = delay/1000;
    function count() { 
      if(i < 11) {
        $('#counter').css('color', 'red');
        $('#counter').css('font-size', '28px');
      } 
      $("#counter").html(i--); 

    }
    var counter = setInterval(function(){ count(); },990);




   
    return false;
});

$('#check-answers').click(function(){
    $('#game-question-container .correct').css('color','green');
    $('#game-question-container .incorrect').css('color','red');
    $('#game-image, #respond, .article-footer').fadeIn();
    //$('#game-image').css('position','relative');
    //$('#game-image').css('top','0px');
    //$('#game-image').css('border','none');
    //$('#game-image').css('padding','0px');
    $('#check-answers, #counter-container').hide();


    var correctAnswers = $('#game-question-container .correct input:checked').length;
    var numberOfQuestions = $('#game-question-container .question').length;
    var score = correctAnswers/numberOfQuestions;
    var praise_phrase;

    if(score == 1) {
      praise_phrase = " Perfect score! You are awesome! Donuts all around!";
    } else if(score >= .8) {
      praise_phrase = " Good job! How about a piece of pie!";
    } else if(score >= .6) {
      praise_phrase = " Not bad! Treat yourself to some orange juice!";
    } else if(score >= .4) {
      praise_phrase = " Okay, it was a little tricky! Try again!";
    } else if(score >= .2) {
      praise_phrase = " Concentrate a little harder next time. Try it again!";
    } else if(score == 0) {
      praise_phrase = " Uh Ohhh! Hey, try again!";
    }

    
    //alert(correctAnswers + ' out of ' + numberOfQuestions);
    $('#your-score').show();
    $('#your-score').html('You scored ' + correctAnswers + ' out of ' + numberOfQuestions + '.<br />' + praise_phrase+'<br />Correct answers are <span class="green">green</span>.<br />Incorrect answers are <span class="red">red</span><br />Look at the painting below to see what you missed...or didn\'t miss.<br /><a href="">Play Again</a>');
    return false;
});



// The ARTK12 Forgery Game
  // Copyright 2013, Glen Draeger
  
  // Load Content First
  jQuery('#forgery-scores').html('<p id="answer-buttons"><a id="show-answers">Show Answers</a><a id="hide-answers">Hide Answers</a></p><h4>Your Choices</h4><table id="forgery-table-scores"><tr><th>Right</th><th>Wrong</th><th>Total</th><th class="border-none">%</th></tr><tr><td id="f-right">0</td><td id="f-wrong">0</td><td id="f-total">0</td><td id="f-percent">-----</tr></table>');


  jQuery('#forgery-instructions').html('Click the area of the forgery image where you think the forgery is. There are 10 forgery areas.<br />Beware of the X! Correct choices show a <span style="border:1px solid red;">red border</span>.');
  
  jQuery('#you-won').html('Wow! Outstanding!<br /><a id="reload">Click here to play again</a>');

  // jQuery('#image-popup').click(function(){
  //     var href = $(this).attr('href');
  //     window.open(href,'','width=900,height=600');
  //     jQuery('#fancybox-wrap, #fancybox-overlay, #fancybox-outer').css('margin-left','-9999px');
  //     jQuery('#original-image').hide();
  //     return false;

  // });
  
  
  // The Forgery Game
  var my_box = jQuery('#forgery-game-image .box');
  
  var good_guesses = 0;
  var bad_guesses = 0;
  var your_guesses = new Array();
  var percentage;
  
  jQuery('#forgery-game-image, #forgery-game-image .right').click(function(event) {
    var score = jQuery(this).attr('data-id');
    
    if(score == '0') {
      // incorrect guess
      bad_guesses = bad_guesses + 1;
      jQuery('#f-wrong').html(bad_guesses);
      // place an x at the bad guess
      var parentOffset = $(this).offset(); 
      var relX = event.pageX - parentOffset.left;
        var relY = event.pageY - parentOffset.top;
      //figure percentage based on height and width of this element
      var height = jQuery(this).height();
      var width = jQuery(this).width();
      
      var left = ((relX/width)*100)-1;
      var top = ((relY/height)*100)-1;
      
      
      jQuery(this).append('<div style="left:'+left+'%;top:'+top+'%;" class="wrong-box">X</div>');
      
      
    } else {
      // correct guess
      guess_num = jQuery(this).attr('data-id');
      
      // end testing
      
      
      if(jQuery.inArray(guess_num, your_guesses) < 0) {
        
        your_guesses.push(guess_num);
        good_guesses = good_guesses + 1;
        jQuery('#f-right').html(good_guesses);
        jQuery(this).addClass('guessed');
        jQuery(this).html('<span>Correct!</span>');
        jQuery('#forgery-game-image .box span').delay(500).fadeOut(500);
        
        // only for testing
        //jQuery(this).html(guess_num);
        
        
      } else {
        
        alert('You\'ve already guessed this one');
        
      }
    }
    
    jQuery('#f-total').html(bad_guesses + good_guesses);
    percentage = Math.floor(good_guesses/(bad_guesses + good_guesses)*100);
    jQuery('#f-percent').html(percentage+'%');
    event.stopPropagation();
    
    if(good_guesses > 9) {jQuery('#you-won').fadeIn(500);}
  }); // eof click event
  

  jQuery('#show-answers').click(function() {
    if(confirm('Are you really sure you want to see the answers?\nCome on. Give it another shot. Don\'t give up yet!\nClick "Cancel" to keep trying.')) {
      jQuery('#forgery-game-image .box').addClass('guessed');
      jQuery('#show-answers').css('top','-50px');
      jQuery('#hide-answers').css('top','0px');
    } 
  });
  
  jQuery('#hide-answers').click(function() {
      jQuery('#forgery-game-image .box').removeClass('guessed');
      jQuery('#show-answers').css('top','0px');
      jQuery('#hide-answers').css('top','-50px');
      good_guesses = 0;
      bad_guesses = 0;
      your_guesses = new Array();
      percentage = 0;
      jQuery('#f-total').html('0');
      jQuery('#f-percent').html(percentage+'%');
      jQuery('#f-right').html('0');
      jQuery('#f-wrong').html('0');
      //event.stopPropagation();
      jQuery('#forgery-game-image .box').removeClass('guessed');
      jQuery('#forgery-game-image .wrong-box').hide();
      jQuery('#you-won').fadeOut(500);
     
  });
  
  
  jQuery('#reload').click(function(event) {
      good_guesses = 0;
    bad_guesses = 0;
    your_guesses = new Array();
    percentage = 0;
    jQuery('#f-total').html('0');
    jQuery('#f-percent').html(percentage+'%');
    jQuery('#f-right').html('0');
    jQuery('#f-wrong').html('0');
    event.stopPropagation();
    jQuery('#forgery-game-image .box').removeClass('guessed');
    jQuery('#forgery-game-image .wrong-box').hide();
    jQuery('#you-won').fadeOut(500);
  });
  
  // End Forgery Game

  /*
   * Let's fire off the gravatar function
   * You can remove this if you don't need it
  */
  loadGravatars();


}); /* end of as page load scripts */
