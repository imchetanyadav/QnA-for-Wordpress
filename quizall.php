<?php /* Template Name: quizall */ 
get_header(); 
global $wpdb;
?>

<?php

function custom_query_vars_filter( $vars ){
  $vars[] = "category";
  return $vars;
}
add_filter( 'query_vars', 'custom_query_vars_filter' );
$category = $_GET['category'];

if(!is_null($category)){
    $quizCategory = $category;
}
else
    $quizCategory = "Something went wrong";

?>

<div class="header"><?php echo $quizCategory ?></div>

<?php 
 	if(is_null($category)) echo "<a href='https://www.decipherias.com/quiz/'> Go to MCQ page</a>";
        else{
	 	$query = "SELECT * FROM quiz WHERE category='". $quizCategory ."'";
		$quizNameResult = $wpdb->get_results($query);
		if(!empty($quizNameResult)){
		foreach($quizNameResult as $name){?>
		       <div class="quizname">
		           <a class='quizlink' target='_blank' href="<?php echo esc_url( add_query_arg( 'quizid', $name->id, site_url( '/questions/' ) ) )?>"><?php echo $name->name?></a>
		       </div>
		       
		<?php } }
	}
 ?>
 <?php get_footer(); ?>