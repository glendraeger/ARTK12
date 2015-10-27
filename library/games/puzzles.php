 <div id="puzzle-instructions">
<p>Click on one of the rectangles to move it to the blank space. See how fast you can put together the art. If you need help, click the button labeled "Original".</p>
</div>

<?php 
$size = 'artk12-puzzle';
$attr = array(
    'class' => 'jqPuzzle jqp-r4-c4-h16-S',
    );

the_post_thumbnail($size, $attr); 

//echo '<div class="help-image">';
//echo '<h2>A little help is here...</h2>';
//the_post_thumbnail($size);
//echo '</div>';
?>