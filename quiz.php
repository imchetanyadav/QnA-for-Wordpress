<?php /* Template Name: quiz */ 
get_header(); ?>
 
<?php
	global $wpdb;
	$categoryQuery = "SELECT DISTINCT category FROM quiz";
	$result =$wpdb->get_results($categoryQuery);
	foreach($result as $row){
		$categories[] = $row->category;
	}
?>

<div class="quiz">
	<?php
	    foreach($categories as $category){
	    	$countRow = "SELECT COUNT(id) count FROM quiz WHERE category = '". $category ."'";
                $countResult = $wpdb->get_results($countRow);
                if(!empty($countResult)){
                    foreach($countResult as $countRow)
                        $count = $countRow->count;
                }
	        $nameQuery = "SELECT * FROM quiz WHERE category = '". $category . "' LIMIT 10";?>
	        <div class="category"> 
	            <div class="categoryTitle"><?php echo $category;?></div>
	            <?php $name = $wpdb->get_results($nameQuery);
	                if(!empty($name)){
	                    foreach($name as $nameRow){?>
	                       <div class="quizname">
	                           <a class='quizlink' target='_blank' href="<?php echo esc_url( add_query_arg( 'quizid', $nameRow->id, site_url( '/questions/' ) ) )?>"><?php echo $nameRow->name?></a>
	                       </div>
	                       
	            <?php } } if($count>10){ ?>
	            <div class="viewmore"><a target='_blank' href="<?php echo esc_url( add_query_arg( 'category', $nameRow->category, site_url( '/quizall/' ) ) )?>">View More</a></div>
                    <?php } ?>
	        </div>
	<?php }?>
</div>
<?php get_footer(); ?>
