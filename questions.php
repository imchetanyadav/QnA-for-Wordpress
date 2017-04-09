<?php /* Template Name: questions */ 
get_header(); 
global $wpdb;
?>

<?php

function custom_query_vars_filter( $vars ){
  $vars[] = "quizid";
  return $vars;
}
add_filter( 'query_vars', 'custom_query_vars_filter' );
$quizid = $_GET['quizid'];

if($quizid != 0){
    $query = "SELECT name FROM quiz WHERE id=" . $quizid;
    $quizNameResult = $wpdb->get_results($query);
    if(!empty($quizNameResult)){
        foreach($quizNameResult as $name);
            $quizName = $name->name;
    }
}
else
    $quizName = "Something went wrong";

?>

<div class="header"><?php echo $quizName ?></div>
 
 <?php 
 	if($quizid == 0) echo "<a href='https://www.decipherias.com/quiz/'> Go to MCQ page</a>";
        else{
	 	$quizQuery = "SELECT * FROM questions WHERE quizid=" . $quizid;
	        $result =$wpdb->get_results($quizQuery);
	        if(!empty($result)){
	            foreach($result as $quizRow){
	            ?>
	            <div class="question"><div class="title"><?php echo "Q) " . nl2br($quizRow->question); ?></div>
	                <ol class="options">
	                    <li><?php echo $quizRow->option1?></li>
	                    <li><?php echo $quizRow->option2?></li>
	                    <li><?php echo $quizRow->option3?></li>
	                    <li><?php echo $quizRow->option4?></li>
	                </ol>
	                <div class="answer">
	                    <span class="anstext">Select an option to reveal answer</span>
	                    <span class="ansoption"><?php echo $quizRow->answer;?></span>
	                </div><hr>
	            </div>
	            <?php
	            }
	        }
	}
 ?>
<script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
 <script>
	$('.options li').on('click',function(){
		$(this).parent().siblings('.answer').css("background-color","limegreen");
		$(this).parent().siblings('.answer').children('.anstext').html("Correct answer:");
		$(this).parent().siblings('.answer').children('.ansoption').css("display","inline-block");
	    });
</script> 

<?php get_footer(); ?>