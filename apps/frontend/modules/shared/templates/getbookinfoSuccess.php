<?php
	//get the result of the adlibris scraping via isbn
	if(!isset($bookinfo)){
		echo get_component('shared', 'getBookInfo', array('isbn' => $isbn));
	}
	else{
    if($editable){
        echo json_encode( $bookinfo );
    } else {
        echo '<div>';
          echo image_tag("/uploads/books/".$bookinfo['imgUrl']);
          echo '<p class="title">'.$bookinfo['title'].'<p>';
          echo '<p class="authors">By: '.$bookinfo['authors'].'<br/><br/>';
          echo 'ISBN: '.$bookinfo['isbn10'].'</p>';
        echo '</div>';
        echo '<div><strong>Beskrivning</strong><br/>'.$bookinfo['description'].'</div>';
        
    }
	}
?>