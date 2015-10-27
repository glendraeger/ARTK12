jQuery(document).ready(function($) {

	var the_image1 = '';
	var the_image2 = '';
	var parent1 = '';
	var parent2 = '';
	var total_correct = 0;
	var total_guesses = 0;
	var store_guesses = 0;
	var first_click = '';
	var i = 0; // for timer

	//simple utility object to start and stop an interval       
    // var IntervalUtil = function(functionCall, interval){
    //     var intervalObj = 0,
    //         INTERVAL    = interval;
    //     var callback = functionCall;
    //     function startTimer(){
    //         console.log('start timer', intervalObj)
    //         if(intervalObj === 0){
    //             intervalObj = setInterval(callback, INTERVAL)
    //         }
    //     }   
    //     function stopTimer(){
    //         clearInterval(intervalObj);
    //         intervalObj = 0;
    //         console.log('timer stopped', intervalObj);
    //     }
    //     return {
    //         startTimer : startTimer,
    //         stopTimer  : stopTimer
    //     }
    // };  

	$('#matching-game .matching-image').flip();

	$('.close-btn').click(function(){
		id_to_close = $(this).attr('data-id');
		$('#'+id_to_close).fadeOut();
		function count() { 
		     $("#timer").html(i++); 
		 }
		 window.intervalID = setInterval(function(){ count(); },1000);

		 if(total_correct == 9) { // Game has ended with 9 correct guesses
			$('#moves-done').html(total_guesses);
    		$('#time-done').html(i);
    		var combined_score = total_guesses + (i / 4);
    		$('#combined-score').html(Math.floor(combined_score));
			$('#matching-completed-message').fadeIn();
			clearInterval(window.intervalID);
		}


	});


	$('#button-close').click(function() {
		$('#matching-completed-message').fadeOut();
	});



	$('#matching-game .matching-image').click(function(){


		total_guesses++;
		$("#moves").html(total_guesses);

		if(first_click == '') {
			//alert('start time');
			first_click = 'started';
			
			
		    function count() { 
		      $("#timer").html(i++); 
		    }
		    window.intervalID = setInterval(function(){ count(); },1000);
		}

		if(the_image1 == '') {
				the_image1 = $(this).children('.back').attr('class');
				parent1 = $(this).attr('id');
				//alert(window.parent1);
			} else {
				the_image2 = '';
				the_image2 = $(this).children('.back').attr('class');
				parent2 = $(this).attr('id');
				//alert(window.parent2);
			}
			
		if( (the_image1 != '') && (the_image2 != '') && (parent1 != parent2) ) {
			if(the_image1 == the_image2) {

				clearInterval(window.intervalID);
				//alert('you did it');
				var id = $('#'+parent1).attr('data-popup-id');
				
				$('#'+id).delay(500).fadeIn(); // disable for testing
				$('#'+parent1+','+'#'+parent2).unbind();
				$("#timer").unbind();
				total_correct++;
				//total_guesses++;
				//alert(total_correct);
				the_image1 = '';
				the_image2 = '';
				parent1 = '';
				parent2 = '';
				

			} else {
				// If images do not match flip them back
				//alert('RATS!');
				//alert(parent1 + '----' + parent2);
				
				setTimeout(function() {
					$('#'+parent1+','+'#'+parent2).flip(false);
					//total_guesses++;
					the_image1 = '';
					the_image2 = '';
					parent1 = '';
					parent2 = '';
				},1000);


			}

		}


		
	});
});