<?php

// Based on http://wordpress.org/support/topic/add-an-extra-text-input-field-on-admin-post-page

function evd_add_meta_box() {
	add_meta_box( 'evd-meta-box', 'EvD Post Options', 'evd_render_post_meta', 'post', 'side', 'high' );
	add_meta_box( 'evd-meta-box', 'EvD Page Options', 'evd_render_post_meta', 'page', 'side', 'high' );
	add_meta_box( 'evd-meta-box', 'EvD Page Options', 'evd_render_post_meta', 'reading-list', 'side', 'high' );
}
add_action( 'admin_menu', 'evd_add_meta_box' );

function evd_render_post_meta( $object, $box ) { 
    $duration = get_post_meta( $object->ID, 'duration', true );
    $duration = secondsToHMS($duration);
    $source = get_post_meta( $object->ID, 'source', true );
    $sourcelink = get_post_meta( $object->ID, 'sourcelink', true );
    $via = get_post_meta( $object->ID, 'via', true );
    $vialink = get_post_meta( $object->ID, 'vialink', true );
	$featuredpost = get_post_meta( $object->ID, 'featuredpost', true );
    $wpautop = get_post_meta( $object->ID, 'wpautop', true );
    $fullWidth = get_post_meta( $object->ID, 'fullWidth', true );

?>
<p>
<label for="duration">Media Duration<br /><em>(HH:MM:SS, 24 hour max)</em></label><br />
<input type="text" name="duration" id="duration" value="<?php echo $duration; ?>"/>
<input type="hidden" name="evd_meta_box_nonce" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<p>
<label for="source">Source</label><br />
<input type="text" name="source" id="source" value="<?php echo $source; ?>"/>
<input type="hidden" name="evd_meta_box_nonce" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<p>
<label for="sourcelink">Source link</em></label><br />
<input type="text" name="sourcelink" id="sourcelink" value="<?php echo $sourcelink; ?>"/>
<input type="hidden" name="evd_meta_box_nonce" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<p>
<label for="via">Via</label><br />
<input type="text" name="via" id="via" value="<?php echo $via; ?>"/>
<input type="hidden" name="evd_meta_box_nonce" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<p>
<label for="vialink">Via link</label><br />
<input type="text" name="vialink" id="vialink" value="<?php echo $vialink; ?>"/>
<input type="hidden" name="evd_meta_box_nonce" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<p>
<label for="featuredpost">Featured Post</label><br />
<input type="checkbox" name="featuredpost" id="featuredpost" value="true"<?php if($featuredpost=='true'){ ?> checked<?php } ?> /> Featured on home page?<br/>
<input type="hidden" name="evd_meta_box_nonce" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<p>
<label for="wpautop">Disable auto-HTML</label><br />
<input type="radio" name="wpautop" id="wpautop" value="true"<?php if($wpautop=='true'){ ?> checked<?php } ?> /> true<br />
<input type="radio" name="wpautop" id="wpautop" value="false"<?php if($wpautop!='true'){ ?> checked<?php } ?> /> false
<input type="hidden" name="evd_meta_box_nonce" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<p>
<label for="fullWidth">Full Width</label><br />
<input type="radio" name="fullWidth" id="fullWidth" value="true"<?php if($fullWidth=='true'){ ?> checked<?php } ?> /> true<br />
<input type="radio" name="fullWidth" id="fullWidth" value="false"<?php if($fullWidth!='true'){ ?> checked<?php } ?> /> false
<input type="hidden" name="evd_meta_box_nonce" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php 

}

function evd_save_post_meta_box( $post_id, $post ) {

	if ( !wp_verify_nonce( $_POST['evd_meta_box_nonce'], plugin_basename( __FILE__ ) ) )
		return $post_id;

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;
    
    if(strtotime($_POST['duration'])){
	$meta_value = get_post_meta( $post_id, 'duration', true );
    	$new_meta_value = strtotime($_POST['duration']);
        $new_meta_value = $new_meta_value - strtotime('00:00'); // convert timestamp to seconds
        if($new_meta_value<86400){
        	if ( $new_meta_value && !$meta_value )
        		add_post_meta( $post_id, 'duration', $new_meta_value, true );
                
            else if ( $new_meta_value && $meta_value )
                update_post_meta( $post_id, 'duration', $new_meta_value, $meta_value);
        
        	else if ( !$new_meta_value && $meta_value )
        		delete_post_meta( $post_id, 'duration', $meta_value );
        }
    }
       
        else if ( $new_meta_value && $meta_value )
            update_post_meta( $post_id, 'customTitle', $new_meta_value, $meta_value);
    
    	else if ( !$new_meta_value && $meta_value )
    		delete_post_meta( $post_id, 'customTitle', $meta_value );

    $meta_value = get_post_meta( $post_id, 'source', true );
    	$new_meta_value = $_POST['source'];
    
    	if ( $new_meta_value )
    		update_post_meta( $post_id, 'source', $new_meta_value, $meta_value); 
    	
    	elseif ( !$new_meta_value && $meta_value )
    		delete_post_meta( $post_id, 'source', $meta_value );
    		
    		
    		
    		
     $meta_value = get_post_meta( $post_id, 'sourcelink', true );
    	$new_meta_value = $_POST['sourcelink'];
    
    	if ( $new_meta_value )
    		update_post_meta( $post_id, 'sourcelink', $new_meta_value, $meta_value );
    
    	elseif ( !$new_meta_value && $meta_value )
    		delete_post_meta( $post_id, 'sourcelink', $meta_value );
    		
    		


     $meta_value = get_post_meta( $post_id, 'via', true );
    	$new_meta_value = $_POST['via'];
    
    	if ( $new_meta_value )
    		update_post_meta( $post_id, 'via', $new_meta_value, $meta_value );
    
    	elseif ( !$new_meta_value && $meta_value )
    		delete_post_meta( $post_id, 'via', $meta_value );




     $meta_value = get_post_meta( $post_id, 'vialink', true );
    	$new_meta_value = $_POST['vialink'];
    
    	if ( $new_meta_value )
    		update_post_meta( $post_id, 'vialink', $new_meta_value, $meta_value );
    
    	elseif ( !$new_meta_value && $meta_value )
    		delete_post_meta( $post_id, 'vialink', $meta_value );


    $meta_value = get_post_meta( $post_id, 'fullWidth', true );
    	$new_meta_value = $_POST['fullWidth'];
    
    	if ( 'true' == $new_meta_value )
    		add_post_meta( $post_id, 'fullWidth', $new_meta_value, true );
    
    	elseif ( 'false' == $new_meta_value && $meta_value )
    		delete_post_meta( $post_id, 'fullWidth', $meta_value );


    $meta_value = get_post_meta( $post_id, 'featuredpost', true );
    	$new_meta_value = isset($_POST['featuredpost']) ? $_POST['featuredpost'] : 'false';
    
    	if ( 'true' == $new_meta_value )
    		add_post_meta( $post_id, 'featuredpost', $new_meta_value, true );
    
    	elseif ( 'false' == $new_meta_value && $meta_value )
    		delete_post_meta( $post_id, 'featuredpost', $meta_value );
            
    $meta_value = get_post_meta( $post_id, 'wpautop', true );
        $new_meta_value = $_POST['wpautop'];
    
        if ( 'true' == $new_meta_value )
    		add_post_meta( $post_id, 'wpautop', $new_meta_value, true );
    
    	elseif ( 'false' == $new_meta_value && $meta_value )
    		delete_post_meta( $post_id, 'wpautop', $meta_value );
}
add_action( 'save_post', 'evd_save_post_meta_box', 10, 2 );






function evd_add_css_box() {
	add_meta_box( 'evd-css-box', 'EvD Post CSS', 'evd_render_post_css', 'post', 'normal', 'default' );
	add_meta_box( 'evd-css-box', 'EvD Page CSS', 'evd_render_post_css', 'page', 'normal', 'default' );
	add_action('admin_enqueue_scripts','enqueue_ace');
}
add_action( 'admin_menu', 'evd_add_css_box' );

function evd_render_post_css( $object, $box ) { 
	$postCSS = get_post_meta( $object->ID, 'postCSS', true )
	
?>
<p>
<label for="postCSS">Post CSS</label><br />
<div id="postCSS_editor" style="border:1px solid #eee;width:100%;height:200px;position:relative;display:block;"><?php echo $postCSS; ?></div>
<script>
var postCSS = ace.edit("postCSS_editor"); 
postCSS.setTheme("ace/theme/textmate"); 
postCSS.getSession().setMode("ace/mode/css");
postCSS.getSession().on('change', function(e) { document.getElementById('postCSS').value = postCSS.getSession().getValue(); });
</script>
<textarea name="postCSS" id="postCSS" cols="60" rows="4" tabindex="30" style="width: 100%;display:none;"><?php echo $postCSS; ?></textarea>
<input type="hidden" name="evd_css_box_nonce" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php 

}

function evd_save_post_css_box( $post_id, $post ) {

	if ( !wp_verify_nonce( $_POST['evd_css_box_nonce'], plugin_basename( __FILE__ ) ) )
		return $post_id;

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'postCSS', true );
	$new_meta_value = $_POST['postCSS'];

	if ( $new_meta_value!='' && !$meta_value )
		add_post_meta( $post_id, 'postCSS', $new_meta_value, true );
		
	else if ( $new_meta_value!='' && $meta_value )
		update_post_meta( $post_id, 'postCSS', $new_meta_value );

	else if ( $meta_value ) delete_post_meta( $post_id, 'postCSS', $meta_value );
}
add_action( 'save_post', 'evd_save_post_css_box', 10, 2 );









?>