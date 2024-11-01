<?php
/*
Plugin Name: Simple Linkedin Feeds

Plugin URI: https://wordpress.org/support/profile/amybeagh

Description: Simple Linkedin Feeds - Quick, small and easy to display linkedin Feeds for wordpress.

Version: 1.0

Author: Amy Beagh

Author URI: https://wordpress.org/support/profile/amybeagh

*/
class sldw_lkedwidget{

 public $options;

 

 public function __construct() {

        $this->options = get_option('sldw_linkedin_widget_options');

        $this->sldw_linkedin_widget_register_settings_and_fields();

    }
 

 public static function add_sldw_linkedin_widget_options_page(){

        add_options_page('Simple Linkedin Feeds', 'Simple Linkedin Feeds', 'administrator', __FILE__, array('sldw_lkedwidget','sldw_linkedin_widget_options'));

    }



 public static function sldw_linkedin_widget_options(){

?>
<div class="wrap">
<div class="sldw_main_display">
  <h2 class="sldw_top_style">Simple Linkedin Feeds Setting</h2>
  <form method="post" action="options.php" enctype="multipart/form-data" class="sldw_frm">
    <?php settings_fields('sldw_linkedin_widget_options'); ?>
    <?php do_settings_sections(__FILE__); ?>
    <p class="submit">
      <input name="submit" type="submit" class="button-submit" value="Save Changes"/>
    </p>
  </form>
  <script type="text/javascript">

	jQuery(document).ready(function() {
	/** Toggle form **/	
			jQuery('.sldw_cstshowhide').click(function(){
			 if (jQuery(this).text() == "More"){
			   jQuery(this).text("Less")
			 }else{
			   jQuery(this).text("More");
			 }
			jQuery(this).closest('.sldw_customidinfo').find('.sldw_cstidinfocontent').slideToggle();
		});
	});

</script> 
</div>
</div>
<?php

    }

 

 public function sldw_linkedin_widget_register_settings_and_fields(){

 register_setting('sldw_linkedin_widget_options', 'sldw_linkedin_widget_options',array($this,'sldw_linkedin_widget_validate_settings'));

 add_settings_section('sldw_linkedin_widget_main_section', '', array($this,'sldw_linkedin_widget_main_section_cb'), __FILE__);

 //Start Creating Fields and Options

 //Linkedin Profile ID
 add_settings_field('sldw_linkedin_id', 'Linkedin ID', array($this,'sldw_linkedin_id_settings'), __FILE__,'sldw_linkedin_widget_main_section');

 //marginTop
 add_settings_field('sldw_marginTop', 'Margin Top', array($this,'sldw_marginTop_settings'), __FILE__,'sldw_linkedin_widget_main_section');

 //width
 add_settings_field('sldw_width', 'Width', array($this,'sldw_width_settings'), __FILE__,'sldw_linkedin_widget_main_section');

 //height
 add_settings_field('sldw_height', 'Height', array($this,'sldw_height_settings'), __FILE__,'sldw_linkedin_widget_main_section');

// show hide options
 add_settings_field('sldw_status', 'Display on Frontend', array($this,'sldw_status_settings'),__FILE__,'sldw_linkedin_widget_main_section');

 //alignment option
 add_settings_field('sldw_alignment', 'Alignment Position', array($this,'sldw_position_settings'),__FILE__,'sldw_linkedin_widget_main_section');
 //jQuery options



 }
 public function sldw_linkedin_widget_validate_settings($plugin_options){
     return($plugin_options);
 }

 public function sldw_linkedin_widget_main_section_cb(){
   //optional
 }
 //sldw_linkedin_id_settings
 public function sldw_linkedin_id_settings() {
        if(empty($this->options['sldw_linkedin_id'])) $this->options['sldw_linkedin_id'] = "linkedin";
        echo '<input name="sldw_linkedin_widget_options[sldw_linkedin_id]" type="text" value="'.$this->options['sldw_linkedin_id'].'" />
		<div class="sldw_idinfo">If Your linkedin public profile url is www.linkedin.com/in/<u>yourname</u> then linkedin ID id : <u>yourname</u>.<br/> But If Your Linkedin Profile url is : https://in.linkedin.com/in/firstname-lastname-xxxxxxxxx Then Change Your Public Profile URL.</div>

		<div class="sldw_customidinfo"><h4>Customizing Your Public Profile URL : <span class="sldw_cstshowhide">More</span></h4>

			<div class="sldw_cstidinfocontent" style="display:none;">

			<ol>

			<li>Move your cursor over Profile at the top of your homepage and select Edit Profile.</li>

			<li>You\'ll see a URL link under your profile photo like www.linkedin.com/in/yourname. Move your cursor over the link and click the  Settings icon next to it.</li>

			<li>Under the Your public profile URL section on the right, click the Edit icon next to your URL.</li>

			<li>Type the last part of your new custom URL in the text box.</li>

			<li>Click Save.</li>

			</ol>

			</div>

		</div> 

		';
    }
//sldw_position_settings

 public function sldw_position_settings(){
        if(empty($this->options['sldw_alignment'])) $this->options['sldw_alignment'] = "left";
        $items = array('left','right');
        foreach($items as $item){
            $selected = ($this->options['sldw_alignment'] === $item) ? 'checked = "checked"' : '';
			echo "<input type='radio' name='sldw_linkedin_widget_options[sldw_alignment]' value=".$item." $selected> ".ucfirst($item)."&nbsp;";
        }
 }
 
 //sldw_marginTop_settings
 public function sldw_marginTop_settings() {
        if(empty($this->options['sldw_marginTop'])) $this->options['sldw_marginTop'] = "100";
        echo '<input name="sldw_linkedin_widget_options[sldw_marginTop]" type="text" value="'.$this->options['sldw_marginTop'].'" />';
    }

 //sldw_width_settings
 public function sldw_width_settings() {
        if(empty($this->options['sldw_width'])) $this->options['sldw_width'] = "365";
        echo '<input name="sldw_linkedin_widget_options[sldw_width]" type="text" value="'.$this->options['sldw_width'].'" />';
    }
	
 //sldw_height_settings
 public function sldw_height_settings() {
        if(empty($this->options['sldw_height'])) $this->options['sldw_height'] = "160";
        echo '<input name="sldw_linkedin_widget_options[sldw_height]" type="text" value="'.$this->options['sldw_height'].'" />';
    }
	
	// show hide settings
public function sldw_status_settings()
{
	if(empty($this->options['sldw_status'])) $this->options['sldw_status'] = "on";
	$status_itms = array('on','off');
	foreach($status_itms as $status_val){
		$checked_st = ($this->options['sldw_status'] === $status_val) ? 'checked = "checked"' : '';
		echo "<input type='radio' name='sldw_linkedin_widget_options[sldw_status]' value='$status_val' $checked_st> ".ucfirst($status_val)."&nbsp;";
	}
}
    



 // put jQuery settings before here



}



add_action('admin_menu', 'sldw_linkedin_widget_trigger_options_function');
function sldw_linkedin_widget_trigger_options_function(){
    sldw_lkedwidget::add_sldw_linkedin_widget_options_page();
}

add_action('admin_init','sldw_linkedin_widget_trigger_create_object');
function sldw_linkedin_widget_trigger_create_object(){
    new sldw_lkedwidget();
}



add_action('wp_footer','sldw_linkedin_widget_add_content_in_footer');
function sldw_linkedin_widget_add_content_in_footer(){
 $sldw_options = get_option('sldw_linkedin_widget_options');
 extract($sldw_options);
 $total_height=$height-110;
 $total_width=$width+40;
 $print_linkedin = '';
 $print_linkedin .= '<script type="IN/MemberProfile" data-id="http://www.linkedin.com/in/'.$sldw_linkedin_id.'" data-format="inline" data-related="false"></script>';

?>
<script type="text/javascript">

jQuery(document).ready(function() {

/** Toggle form **/	

jQuery('#sldw_linkediniconlinkleft').click(function(){

	jQuery(this).parent().toggleClass('sldw_show');

});

});

</script> 
<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
<?php 
if($sldw_status=='on'){
if($sldw_alignment=='left'){?>
<style type="text/css">

div.sldw_linkedin_widget1{

	left: -<?php echo trim($sldw_width+10);?>px; 

	top: <?php echo $sldw_marginTop;?>px; 

	z-index: 10000; 

	height:<?php echo trim($sldw_height+30);?>px;	

	-webkit-transition: all .5s ease-in-out;

	-moz-transition: all .5s ease-in-out;

	-o-transition: all .5s ease-in-out;

	transition: all .5s ease-in-out;

	}

div.sldw_linkedin_widget1.sldw_show{

	left:0;

	}	

div.sldw_linkedin_widget2{

	text-align: left;

	width:<?php echo trim($sldw_width);?>px;

	height:<?php echo trim($sldw_height);?>px;

	}

div.sldw_linkedin_widget1 .sldw_linkediniconlinkleft {		

	right: -45px;

    text-align: right;

}

</style>
<div id="sldw_linkedin_widget_display">
  <div id="sldw_linkedin_widget1" class="sldw_linkedin_widget1"><a id="sldw_linkediniconlinkleft" class="sldw_linkediniconlinkleft" href="javascript:;"><img class="outer" src="<?php echo plugins_url( 'assets/sldw_icon.png', __FILE__ );?>" alt=""></a>
    <div id="sldw_linkedin_widget2" class="sldw_linkedin_widget2"><?php echo $print_linkedin; ?></div>
  </div>
</div>
<?php } else { ?>
<style type="text/css">

div.sldw_linkedin_widget1{

	right: -<?php echo trim($sldw_width+10);?>px;

	top: <?php echo $sldw_marginTop;?>px;

	z-index: 10000; 

	height:<?php echo trim($sldw_height+30);?>px;

	-webkit-transition: all .5s ease-in-out;

	-moz-transition: all .5s ease-in-out;

	-o-transition: all .5s ease-in-out;

	transition: all .5s ease-in-out;

	}

div.sldw_linkedin_widget1.sldw_show{

	right:0;

	}	

div.sldw_linkedin_widget2{

	text-align: left;

	width:<?php echo trim($sldw_width);?>px;

	height:<?php echo trim($sldw_height);?>px;

	}

div.sldw_linkedin_widget1 .sldw_linkediniconlinkleft {		

	left: -45px;

    text-align: left;

}		

</style>
<div id="sldw_linkedin_widget_display">
  <div id="sldw_linkedin_widget1" class="sldw_linkedin_widget1"><a id="sldw_linkediniconlinkleft" class="sldw_linkediniconlinkleft" href="javascript:;"><img class="outer" src="<?php echo plugins_url( 'assets/sldw_icon.png', __FILE__ );?>" alt=""></a>
    <div id="sldw_linkedin_widget2" class="sldw_linkedin_widget2"><?php echo $print_linkedin; ?></div>
  </div>
</div>
<?php } 
}


}



add_action( 'wp_enqueue_scripts', 'register_sldw_linkedin_widget_styles' );

add_action( 'admin_enqueue_scripts', 'register_sldw_linkedin_widget_styles' );

function register_sldw_linkedin_widget_styles() {

    wp_register_style( 'register_sldw_linkedin_widget_styles', plugins_url( 'assets/sldw_main.css' , __FILE__ ) );

    wp_enqueue_style( 'register_sldw_linkedin_widget_styles' );

 }
 
 /* add shortcode function */
function shortcode_sldw_functions()
{
 $sldw_options = get_option('sldw_linkedin_widget_options');
 extract($sldw_options);
 $total_height=$height-110;
 $total_width=$width+40;
 $print_linkedin = '';
 
 if($sldw_linkedin_id == ''){
 
  $print_linkedin.='<div class="error_sldw">Please Fill Out The Simple Linkedin Feeds Configuration First</div>'; 
 
 } else {
 
  $print_linkedin .= '<script type="IN/MemberProfile" data-id="http://www.linkedin.com/in/'.$sldw_linkedin_id.'" data-format="inline" data-related="false"></script>';
 
 }
 return $print_linkedin;
}
add_shortcode('sldw_simple_linkedin_widget', 'shortcode_sldw_functions');

/* end of shortcode function */

