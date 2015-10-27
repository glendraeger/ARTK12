<?php

function artk12_matching_game() {

$image_array = array(
	array(
		'image1' => 'http://glen.local:8888/_glendraeger/aa_2015_sites/artk12/wp-content/uploads/2015/09/africa-cover-small.jpg',
		'image2' => 'http://glen.local:8888/_glendraeger/aa_2015_sites/artk12/wp-content/uploads/2015/09/africa-cover-small.jpg',
		'popup' => 'http://glen.local:8888/_glendraeger/aa_2015_sites/artk12/wp-content/uploads/2015/08/canada-cover.jpg',
		'popup_content' => '<p>Test Content</p>'
	),
	array(
		'image1' => 'http://glen.local:8888/_glendraeger/aa_2015_sites/artk12/wp-content/uploads/2015/06/europe_cover-72.jpg',
		'image2' => 'http://glen.local:8888/_glendraeger/aa_2015_sites/artk12/wp-content/uploads/2015/06/europe_cover-72.jpg',
		'popup' => 'http://glen.local:8888/_glendraeger/aa_2015_sites/artk12/wp-content/uploads/2015/06/europe_cover-72.jpg',
		'popup_content' => '<p>Test Content</p>'
	),
	array(
		'image1' => 'http://glen.local:8888/_glendraeger/aa_2015_sites/artk12/wp-content/uploads/2015/08/canada-cover.jpg',
		'image2' => 'http://glen.local:8888/_glendraeger/aa_2015_sites/artk12/wp-content/uploads/2015/08/canada-cover.jpg',
		'popup' => 'http://glen.local:8888/_glendraeger/aa_2015_sites/artk12/wp-content/uploads/2015/08/canada-cover.jpg',
		'popup_content' => '<p>Test Content</p>'
	),
	array(
		'image1' => 'http://glen.local:8888/_glendraeger/aa_2015_sites/artk12/wp-content/uploads/2015/06/europe_cover-72.jpg',
		'image2' => 'http://glen.local:8888/_glendraeger/aa_2015_sites/artk12/wp-content/uploads/2015/06/europe_cover-72.jpg',
		'popup' => 'http://glen.local:8888/_glendraeger/aa_2015_sites/artk12/wp-content/uploads/2015/06/europe_cover-72.jpg',
		'popup_content' => '<p>Test Content</p>'
	),
	array(
		'image1' => 'http://glen.local:8888/_glendraeger/aa_2015_sites/artk12/wp-content/uploads/2015/08/canada-cover.jpg',
		'image2' => 'http://glen.local:8888/_glendraeger/aa_2015_sites/artk12/wp-content/uploads/2015/08/canada-cover.jpg',
		'popup' => 'http://glen.local:8888/_glendraeger/aa_2015_sites/artk12/wp-content/uploads/2015/08/canada-cover.jpg',
		'popup_content' => '<p>Test Content</p>'
	),
	array(
		'image1' => 'http://glen.local:8888/_glendraeger/aa_2015_sites/artk12/wp-content/uploads/2015/06/europe_cover-72.jpg',
		'image2' => 'http://glen.local:8888/_glendraeger/aa_2015_sites/artk12/wp-content/uploads/2015/06/europe_cover-72.jpg',
		'popup' => 'http://glen.local:8888/_glendraeger/aa_2015_sites/artk12/wp-content/uploads/2015/06/europe_cover-72.jpg',
		'popup_content' => '<p>Test Content</p>'
	),
	array(
		'image1' => 'http://glen.local:8888/_glendraeger/aa_2015_sites/artk12/wp-content/uploads/2015/08/canada-cover.jpg',
		'image2' => 'http://glen.local:8888/_glendraeger/aa_2015_sites/artk12/wp-content/uploads/2015/08/canada-cover.jpg',
		'popup' => 'http://glen.local:8888/_glendraeger/aa_2015_sites/artk12/wp-content/uploads/2015/08/canada-cover.jpg',
		'popup_content' => '<p>Test Content</p>'
	),
	array(
		'image1' => 'http://glen.local:8888/_glendraeger/aa_2015_sites/artk12/wp-content/uploads/2015/06/europe_cover-72.jpg',
		'image2' => 'http://glen.local:8888/_glendraeger/aa_2015_sites/artk12/wp-content/uploads/2015/06/europe_cover-72.jpg',
		'popup' => 'http://glen.local:8888/_glendraeger/aa_2015_sites/artk12/wp-content/uploads/2015/06/europe_cover-72.jpg',
		'popup_content' => '<p>Test Content</p>'
	),
	array(
		'image1' => 'http://glen.local:8888/_glendraeger/aa_2015_sites/artk12/wp-content/uploads/2015/08/canada-cover.jpg',
		'image2' => 'http://glen.local:8888/_glendraeger/aa_2015_sites/artk12/wp-content/uploads/2015/08/canada-cover.jpg',
		'popup' => 'http://glen.local:8888/_glendraeger/aa_2015_sites/artk12/wp-content/uploads/2015/08/canada-cover.jpg',
		'popup_content' => '<p>Test Content</p>'
	),


);

// create another array with all these images


$image_array_2 = array();
$image_array_popups = array();
$x = 1;	// this is for the array itself
$y = 1; // is to create a common class for each two images
foreach($image_array as $info) {

	$image_array_2[$x]['image1'] = $info['image1'];
	$image_array_2[$x]['class1'] = 'class-'.$y;
	$image_array_popups[$x]['image'] = $info['popup'];
	$image_array_popups[$x]['id'] = 'class-'.$y;
	$image_array_popups[$x]['content'] = $info['popup_content'];
	$x++;

	$image_array_2[$x]['image1'] = $info['image2'];;
	$image_array_2[$x]['class1'] = 'class-'.$y;
	$x++;


$y++;
}

?>

<script>

jQuery(document).ready(function($) {

	var the_image1 = '';
	var the_image2 = '';
	var parent1 = '';
	var parent2 = '';
	var total_correct = 0;
	var total_guesses = 0;

	$('#matching-game .matching-image').flip();

	// $('#matching-game .matching-image').on('flip:done',function(){


			
			

	//  });

	$('.close-btn').click(function(){
		id_to_close = $(this).attr('data-id');
		$('#'+id_to_close).fadeOut();
	});


	$('#matching-game .matching-image').click(function(){

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
			
		if( (the_image1 != '') && (the_image2 != '') ) {
			if(the_image1 == the_image2) {
				//alert('you did it');
				var id = $('#'+parent1).attr('data-popup-id');
				$('#'+id).delay(500).fadeIn();
				total_correct++;
				total_guesses++;
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
					total_guesses++;
					the_image1 = '';
					the_image2 = '';
					parent1 = '';
					parent2 = '';
				},1000);


			}
		}

		if(total_correct == 9) {
			alert('YOU DID IT! Total Guesses: '+ total_guesses);
		}
		
	});
});

</script>

<div id="matching-game">

<?php 
shuffle($image_array_2);
$x = 1; // we want to give each .matching-image a unique id
foreach($image_array_2 as $info) { 
?>
<div class="matching-image" id="parent-<?php echo $x; ?>" data-popup-id="<?php echo $info['class1']; ?>">

	<div class="back <?php echo $info['class1']; ?>"><img src="<?php echo $info['image1'] ?>" /></div>
	<div class="front"><span style="color:#ffffff;"><?php echo $info['class1']; ?></span></div>

</div>

<?php 
$x++;
} 
?>

</div>

<div id="matching-popups">
<?php

foreach($image_array_popups as $info) { 

?>
<div class="main-popup" id="<?php echo $info['id']; ?>">
	<div class="popup-content">
		<span data-id="<?php echo $info['id']; ?>" class="close-btn">Close</span>
		<?php echo $info['content']; ?>
		<img src="<?php echo $info['image'] ?>" />
	</div>
</div>

<?php } ?>
</div>



<?php
$wow = 'WOW!';
return $wow;


} // EOF FUNCTION 


add_shortcode('wow','artk12_matching_game');




?>










