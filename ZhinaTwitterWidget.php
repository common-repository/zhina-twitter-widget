<?php
/*
 * Plugin Name: ZhinaTwitterWidget
 * Version: 1.0
 * Description: A wordpress widget for Zhina bloggers, using Javascript so that it is compatible with WP-super-cache.
 * Author: zckevin
 * Author URI: http://zckev.in/
 */

//ZhinaTwitterWidget Class
class ZhinaTwitterWidget extends WP_Widget {
	function ZhinaTwitterWidget() {
		parent::WP_Widget(false, $name = 'ZhinaTwitterWidget');	
	}

	/** @see WP_Widget::widget */	
	function widget($args, $instance) {		
		extract( $args );
		?>
			<?php echo $before_widget; ?>
				<?php echo $before_title . $instance['title'] . $after_title; ?>
					<div id='<?php $id = mt_rand(1, 100000); echo $id; ?>'>
					</div>
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
					<script src="wp-content/plugins/zhina-twitter-widget/phoenix_search.php?id=<?php echo $id; ?>"></script>
					<script>
						$.getJSON("wp-content/plugins/zhina-twitter-widget/user_timeline.php?screen_name=<?php echo $instance['twitterUserName'];?>&count=<?php echo $instance['tweetsAmount'];?>&callback=?", twitterCallback2);
					</script>
			<?php echo $after_widget; ?>
		<?php
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {				
		return $new_instance;
	}

	/** @see WP_Widget::form */
	function form($instance) {
		$title = esc_attr(strip_tags($instance['title']));
		$twitterUserName = esc_attr(strip_tags($instance['twitterUserName']));
		$tweetsAmount = esc_attr(strip_tags($instance['tweetsAmount']));
		
		?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if ($title){echo $title;} else{echo "Tweets";} ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('twitterUserName'); ?>"><?php _e('Twitter User Name:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('twitterUserName'); ?>" name="<?php echo $this->get_field_name('twitterUserName'); ?>" type="text" value="<?php if ($twitterUserName){echo $twitterUserName;} else{echo "zckevin";} ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('tweetsAmount'); ?>"><?php _e('Tweets Amount:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('tweetsAmount'); ?>" name="<?php echo $this->get_field_name('tweetsAmount'); ?>" type="text" value="<?php if ($tweetsAmount){echo $tweetsAmount;}else {echo "5";} ?>" /></label></p>
		<?php 
	}
} // class ZhinaTwitterWidget

// regeist ZhinaTwitterWidget
add_action('widgets_init', create_function('', 'return register_widget("ZhinaTwitterWidget");'));
?>