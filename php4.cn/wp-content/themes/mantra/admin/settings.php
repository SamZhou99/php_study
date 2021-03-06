<?php
// Callback functions

// General suboptions description

function  cryout_section_layout_fn() {

//	echo "<p>".__("Settings for adjusting your blog's layout.", "mantra")."</p>";
}

function   cryout_section_presentation_fn() {

//	echo "<p>".__("Settings for adjusting your blog's layout.", "mantra")."</p>";
}


function   cryout_section_text_fn() {
	//echo "<p>".__("All text related customization options.", "mantra")."</p>";
}

function   cryout_section_graphics_fn() {
//	echo "<p>".__("Settings for hiding or showing different graphics.", "mantra")."</p>";
}

function   cryout_section_post_fn() {
	//echo "<p>".__("Settings for hiding or showing different post tags.", "mantra")."</p>";
}

function   cryout_section_excerpt_fn() {
//	echo "<p>".__("Settings for post excerpts", "mantra")."</p>";
}

function   cryout_section_appereance_fn() {
//	echo "<p>".__("Set text and background colors.", "mantra")."</p>";
}


function   cryout_section_featured_fn() {
//	echo "<p>".__("Insert the addreses for your social media. Leave blank if not the case.
//	Please type the whole address (including <i>http://</i> ) Example : <u>http://www.facebook.com</u>.", "mantra")."</p>";
}

function   cryout_section_social_fn() {
//	echo "<p>".__("Insert the addreses for your social media. Leave blank if not the case.
//	Please type the whole address (including <i>http://</i> ) Example : <u>http://www.facebook.com</u>.", "mantra")."</p>";
}

function   cryout_section_misc_fn() {

}

////////////////////////////////
//// LAYOUT SETTINGS ///////////
////////////////////////////////


// RADIO-BUTTON - Name: ma_options[side]
function cryout_setting_side_fn() {
global $mantra_options;
	$items = array("1c", "2cSr", "2cSl", "3cSr" , "3cSl", "3cSs");
	$layout_text["1c"] = __("One column (no sidebars)","mantra");
	$layout_text["2cSr"] = __("Two columns,  sidebar on the right","mantra");
	$layout_text["2cSl"] = __("Two columns,  sidebar on the left","mantra");
	$layout_text["3cSr"] = __("Three columns, sidebars on the right","mantra");
	$layout_text["3cSl"] = __("Three columns, sidebars on the left","mantra");
	$layout_text["3cSs"] = __("Three columns, one sidebar on each side","mantra");

// For backward compatibility;
	if ($mantra_options['mantra_side'] == 'Disable') $mantra_options['mantra_side'] = '1c';
	if ($mantra_options['mantra_side'] == 'Right') $mantra_options['mantra_side'] = '2cSr';
	if ($mantra_options['mantra_side'] == 'Left') $mantra_options['mantra_side'] = '2cSl';


	foreach($items as $item) {

		$checkedClass = ($mantra_options['mantra_side']==$item) ? ' checkedClass' : '';
		echo "<label id='$item' class='layouts  $checkedClass'><input ";
		checked($mantra_options['mantra_side'],$item);
		echo " value='$item' onClick=\"changeBorder('$item','layouts');\" name='ma_options[mantra_side]' type='radio' /><img src='".get_template_directory_uri()."/admin/images/".$item.".png'/><span> $layout_text[$item]</span></label>";
	}
		echo "<div><small>".__("Choose your layout ","mantra")."</small></div>";
}

 //SLIDER - Name: ma_options[sidewidth]
function cryout_setting_sidewidth_fn()
   {
global $mantra_options;
	$items = array ("Absolute" , "Relative");
	$itemsare = array( __("Absolute","mantra"), __("Relative","mantra"));
	echo __("Dimensions to use: ","mantra")." <select id='mantra_dimselect' name='ma_options[mantra_dimselect]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_dimselect'],$item);
	echo ">$itemsare[$id]</option>";
}
echo "</select>";

   ?><script>

	jQuery(function() {

		jQuery( "#slider-range" ).slider({
			range: true,
			step:10,
			min: 0,
			max: 1980,
			values: [ <?php echo $mantra_options['mantra_sidewidth'] ?>, <?php echo ($mantra_options['mantra_sidewidth']+$mantra_options['mantra_sidebar']); ?> ],
			slide: function( event, ui ) {
		
											}
	
										});

			jQuery( "#mantra_sidewidth" ).val( <?php echo $mantra_options['mantra_sidewidth'];?> );
			jQuery( "#mantra_sidebar" ).val( <?php echo $mantra_options['mantra_sidebar'];?> );
	var	percentage =parseInt(	jQuery( "#slider-range .ui-slider-range" ).css('width'));
	var leftwidth =	parseInt(jQuery( "#slider-range .ui-slider-range" ).position().left);
			jQuery( "#barb" ).css('left',150+leftwidth+percentage/2+"px");
			jQuery( "#contentb" ).css('left',210+leftwidth/2+"px");
			jQuery( "#totalb" ).css('left',100+(percentage+leftwidth)/2+"px");
							});

		jQuery( "#slider-range" ).bind( "slide", function(event, ui) {
			range=ui.values[ 1 ] - ui.values[ 0 ];

 			if (ui.values[ 0 ]<500) {ui.values[ 0 ]=500; return false;};
			if(	range<220 || range>800 ){ ui.values[ 1 ] =  <?php echo $mantra_options['mantra_sidebar']+$mantra_options['mantra_sidewidth'];?>; return false;  };			
																	
			jQuery( "#mantra_sidewidth" ).val( ui.values[ 0 ] );
			jQuery( "#mantra_sidebar" ).val( ui.values[ 1 ] - ui.values[ 0 ] );
			jQuery( "#totalsize" ).html( ui.values[ 1 ]);
			jQuery( "#contentsize" ).html( ui.values[ 0 ]);jQuery( "#barsize" ).html( ui.values[ 1 ]-ui.values[ 0 ]);

	var	percentage =parseInt(	jQuery( "#slider-range .ui-slider-range" ).css('width'));
	var leftwidth =	parseInt(jQuery( "#slider-range .ui-slider-range" ).position().left);
			jQuery( "#barb" ).css('left',180+leftwidth+percentage/2+"px");
			jQuery( "#contentb" ).css('left',220+leftwidth/2+"px");	
			jQuery( "#totalb" ).css('left',100+(percentage+leftwidth)/2+"px");
																	});		




jQuery(function() {

		jQuery( "#slider-rangeRel" ).slider({
			range: true,
			step:1,
			min: 0,
			max: 100,
			values: [ <?php echo $mantra_options['mantra_sidewidthRel'] ?>, <?php echo ($mantra_options['mantra_sidewidthRel']+$mantra_options['mantra_sidebarRel']); ?> ],
			slide: function( event, ui ) {
		
											}
	
										});

			jQuery( "#mantra_sidewidthRel" ).val( <?php echo $mantra_options['mantra_sidewidthRel'];?> );
			jQuery( "#mantra_sidebarRel" ).val( <?php echo $mantra_options['mantra_sidebarRel'];?> );
	var	percentageRel =parseInt(	jQuery( "#slider-rangeRel .ui-slider-range" ).css('width'));
	var leftwidthRel =	parseInt(jQuery( "#slider-rangeRel .ui-slider-range" ).position().left);
			jQuery( "#barbRel" ).css('left',150+leftwidthRel+percentageRel/2+"px");
			jQuery( "#contentbRel" ).css('left',210+leftwidthRel/2+"px");
			jQuery( "#totalbRel" ).css('left',100+(percentageRel+leftwidthRel)/2+"px");
							});

		jQuery( "#slider-rangeRel" ).bind( "slide", function(event, ui) {
			range=ui.values[ 1 ] - ui.values[ 0 ];

 			if (ui.values[ 0 ]<40) {ui.values[ 0 ]=40; return false;};
			if(	range<20 || range>50 ){ ui.values[ 1 ] =  <?php echo $mantra_options['mantra_sidebarRel']+$mantra_options['mantra_sidewidthRel'];?>; return false;  };			
																	
			jQuery( "#mantra_sidewidthRel" ).val( ui.values[ 0 ] );
			jQuery( "#mantra_sidebarRel" ).val( ui.values[ 1 ] - ui.values[ 0 ] );
			jQuery( "#totalsizeRel" ).html( ui.values[ 1 ]);
			jQuery( "#contentsizeRel" ).html( ui.values[ 0 ]);jQuery( "#barsizeRel" ).html( ui.values[ 1 ]-ui.values[ 0 ]);

	var	percentageRel =parseInt(	jQuery( "#slider-rangeRel .ui-slider-range" ).css('width'));
	var leftwidthRel =	parseInt(jQuery( "#slider-rangeRel .ui-slider-range" ).position().left);
			jQuery( "#barbRel" ).css('left',180+leftwidthRel+percentageRel/2+"px");
			jQuery( "#contentbRel" ).css('left',220+leftwidthRel/2+"px");	
			jQuery( "#totalbRel" ).css('left',100+(percentageRel+leftwidthRel)/2+"px");
																	});	
							
	</script>

<div id="absolutedim">

	<b id="contentb" style="display:block;float:left;position:absolute;margin-top:-20px;"><?php _e("Content =","mantra");?> <span id="contentsize"><?php echo $mantra_options['mantra_sidewidth'];?></span>px</b>
	<b id="barb" style="margin-left:40px;color:#F6A828;display:block;float:left;position:absolute;margin-top:-20px;" ><?php _e("Sidebar(s) =","mantra");?> <span id="barsize"><?php echo $mantra_options['mantra_sidebar'];?></span>px</b>
	<b id="totalb" style="margin-left:40px;color:#999;display:block;float:left;position:absolute;margin-top:12px;" >^&mdash;&mdash;&mdash; <?php _e("Total width =","mantra");?>  <span id="totalsize"><?php echo $mantra_options['mantra_sidewidth']+ $mantra_options['mantra_sidebar'];?></span>px &mdash;&mdash;&mdash;^</b>

<p>
	<?php echo  "<input type='hidden'  name='ma_options[mantra_sidewidth]' id='mantra_sidewidth'   />";
	 echo  "<input type='hidden'  name='ma_options[mantra_sidebar]' id='mantra_sidebar'   />";?>
</p>
<div id="slider-range"></div>

 <?php
   echo "<div><small>".__("选择<b>内容</b>和<b>工具栏(s)</b>的宽度。内容部分的宽度至少为500px，工具栏最小宽度为220px，最大宽度为800px。<br />如果你选择了三栏式（两列工具栏），那么每列工具栏的宽度为所设置的宽度的一半。","mantra")."</small></div>"; ?>


</div><!-- End absolutedim -->

<div id="relativedim">

	<b id="contentbRel" style="display:block;float:left;position:absolute;margin-top:-20px;"><?php _e("Content =","mantra");?> <span id="contentsizeRel"><?php echo $mantra_options['mantra_sidewidthRel'];?></span>%</b>
	<b id="barbRel" style="margin-left:40px;color:#F6A828;display:block;float:left;position:absolute;margin-top:-20px;" ><?php _e("Sidebar(s) =","mantra");?>  <span id="barsizeRel"><?php echo $mantra_options['mantra_sidebarRel'];?></span>%</b>
	<b id="totalbRel" style="margin-left:40px;color:#999;display:block;float:left;position:absolute;margin-top:12px;" >^&mdash;&mdash;&mdash; <?php _e("Total width =","mantra");?>  <span id="totalsizeRel"><?php echo $mantra_options['mantra_sidewidthRel']+$mantra_options['mantra_sidebarRel'];?></span>% &mdash;&mdash;&mdash;^</b>

<p>
	<?php echo  "<input type='hidden'  name='ma_options[mantra_sidewidthRel]' id='mantra_sidewidthRel'   />";
	echo  "<input type='hidden'  name='ma_options[mantra_sidebarRel]' id='mantra_sidebarRel'   />";?>

</p>
<div id="slider-rangeRel"></div>
 <?php
   echo "<div><small>".__("Select the width of your <b>content</b> and <b>sidebar(s)</b>. 
 		These are realtive dimmensions - relative to the user's browser. The total width is a percentage of the browser's width.<br />
	 While the content cannot be less than 40% wide, the sidebar area is at least 20% and no more than 50%.<br />
	If you went for a 3 column area ( with 2 sidebars) they will each have half the selected width.","mantra")."</small></div>"; ?>
</div><!-- End relativedim -->
<?php
  
   }


 //SELECT - Name: ma_options[hheight]
function  cryout_setting_hheight_fn() {
	global $mantra_options;?>
<input id='mantra_hheight' name='ma_options[mantra_hheight]' size='4' type='text' value='<?php echo esc_attr( intval($mantra_options['mantra_hheight'] )) ?>'  />  px
<?php
$totally = $mantra_options['mantra_sidebar']+$mantra_options['mantra_sidewidth']+50;

$checkedClass = ($mantra_options['mantra_hcenter']=='1') ? ' checkedClass' : '';

echo " <label id='hcenter' for='mantra_hcenter' class='socialsdisplay $checkedClass'><input  ";
		 checked($mantra_options['mantra_hcenter'],'1');
echo "value='1' id='mantra_hcenter'  name='ma_options[mantra_hcenter]' type='checkbox' style='margin-left:20px;'/> 顶部图片水平居中 </label>";


echo "<div><small>".__("Select the header's height. After saving the settings go and upload your new header image. The header's width will be = ","mantra").$totally."px.</small></div>";
}


////////////////////////////////
//// PRESENTATION SETTINGS /////////////
////////////////////////////////


//CHECKBOX - Name: ma_options[frontpage]
function cryout_setting_frontpage_fn() {
	global $mantra_options;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","mantra"), __("Disable","mantra"));
	echo "<select id='mantra_frontpage' name='ma_options[mantra_frontpage]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_frontpage'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("允许演示首页。该页面会成为网站的新首页。页面带有幻灯片和为演示准备的栏目文本和图片。<br>如果你已经选择了“允许”，但没有看到演示页面，那么到 <a href='options-reading.php'>设置 &raquo; 阅读 </a> 并且确保已经选择<Strong>你的最新文章</strong>作为<strong>首页显示</strong>。","mantra")."</small></div>";

}

//CHECKBOX - Name: ma_options[frontslider]
function cryout_setting_frontslider_fn() {
	global $mantra_options;


	echo "<div class='slmini'><b>".__("Slider Dimensions:","mantra")."</b> ";
	echo "<input id='mantra_fpsliderwidth' name='ma_options[mantra_fpsliderwidth]' size='4' type='text' value='".esc_attr( $mantra_options['mantra_fpsliderwidth'] )."'  /> px (".__("width","mantra").") <strong>X</strong> ";
	echo "<input id='mantra_fpsliderheight' name='ma_options[mantra_fpsliderheight]' size='4' type='text' value='".esc_attr( $mantra_options['mantra_fpsliderheight'] )."'  />  px (".__("height","mantra").")";
	echo "<small>".__("The dimensions of your slider. Make sure your images are of the same size.","mantra")."</small></div>";

	echo "<div class='slmini'><b>".__("Animation:","mantra")."</b> ";
	$items = array ("random" , "fold", "fade", "slideInRight", "slideInLeft", "sliceDown", "sliceDownLeft", "sliceUp", "sliceUpLeft", "sliceUpDown" , "sliceUpDownLeft", "boxRandom", "boxRain", "boxRainReverse", "boxRainGrow" , "boxRainGrowReverse");
	$itemsare = array( __("Random","mantra"), __("Fold","mantra"), __("Fade","mantra"), __("SlideInRight","mantra"), __("SlideInLeft","mantra"), __("SliceDown","mantra"), __("SliceDownLeft","mantra"), __("SliceUp","mantra"), __("SliceUpLeft","mantra"), __("SliceUpDown","mantra"), __("SliceUpDownLeft","mantra"), __("BoxRandom","mantra"), __("BoxRain","mantra"), __("BoxRainReverse","mantra"), __("BoxRainGrow","mantra"), __("BoxRainGrowReverse","mantra"));
	echo "<select id='mantra_fpslideranim' name='ma_options[mantra_fpslideranim]'>";
	foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_fpslideranim'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<small>".__("The transition effect your slider will have.","mantra")."</small></div>";
	
	echo "<div class='slmini'><b>".__("Border Settings:","mantra")."</b> ";
	echo __('Width' ,'mantra').": <input id='mantra_fpsliderborderwidth' name='ma_options[mantra_fpsliderborderwidth]' size='2' type='text' value='".esc_attr( $mantra_options['mantra_fpsliderborderwidth'] )."'  /> px / ";
	echo __('Color','mantra').': <input type="text" id="mantra_fpsliderbordercolor" name="ma_options[mantra_fpsliderbordercolor]"  style="width:100px;" value="'.esc_attr( $mantra_options['mantra_fpsliderbordercolor'] ).'"  />';
	echo '<div id="mantra_fpsliderbordercolor2"></div>';
	echo "<small>".__("The width and color of the slider's border.","mantra")."</small></div>";

	echo "<div class='slmini'><b>".__("Animation Time:","mantra")."</b> ";
	echo "<input id='mantra_fpslidertime' name='ma_options[mantra_fpslidertime]' size='4' type='text' value='".esc_attr( $mantra_options['mantra_fpslidertime'] )."'  /> ".__("milliseconds (1000ms = 1 second) ","mantra");
	echo "<small>".__("The time in which the transition animation will take place.","mantra")."</small></div>";

	echo "<div class='slmini'><b>".__("Pause Time:","mantra")."</b> ";
	echo "<input id='mantra_fpsliderpause' name='ma_options[mantra_fpsliderpause]' size='4' type='text' value='".esc_attr( $mantra_options['mantra_fpsliderpause'] )."'  /> ".__("milliseconds (1000ms = 1 second) ","mantra");
	echo "<small>".__("The time in which a slide will be still and visible.","mantra")."</small></div>";


	echo "<div class='slmini'><b>".__("Slider navigation:","mantra")."</b> ";
	$items = array ("Numbers" , "Bullets" ,"None");
	$itemsare = array( __("Numbers","mantra"), __("Bullets","mantra"), __("None","mantra"));
	echo "<select id='mantra_fpslidernav' name='ma_options[mantra_fpslidernav]'>";
	foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_fpslidernav'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<small>".__("Your slider navigation type. Shown under the slider.","mantra")."</small></div>";

	echo "<div class='slmini'><b>".__("Slider arrows:","mantra")."</b> ";
	$items = array ("Always Visible" , "Visible on Hover" ,"Hidden");
	$itemsare = array( __("Always Visible","mantra"), __("Visible on Hover","mantra"), __("Hidden","mantra"));
	echo "<select id='mantra_fpsliderarrows' name='ma_options[mantra_fpsliderarrows]'>";
	foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_fpsliderarrows'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<small>".__("The Left and Right arrows on your slider","mantra")."</small></div>";

?>

<script>
var $categoryName;

jQuery(document).ready(function(){
     jQuery('#categ-dropdown').change(function(){
			$categoryName=this.options[this.selectedIndex].value.replace(/\/category\/archives\//i,"");
			doAjaxRequest();
     });
		 
});
function doAjaxRequest(){
     // here is where the request will happen
     jQuery.ajax({
          url: ajaxurl,
          data:{
               'action':'do_ajax',
               'fn':'get_latest_posts',
               'count':10,
				'categName':$categoryName
               },
          dataType: 'JSON',
          success:function(data){
		 jQuery('#post-dropdown').html(data);
        	

                             },
          error: function(errorThrown){
               alert('error');
               console.log(errorThrown);
          }
 
     });
 
}
</script>
<!--
<select name="categ-dropdown" id="categ-dropdown" multiple='multiple' > 
 <option value=""><?php echo esc_attr(__('Select Category','mantra')); ?></option> 
 <?php 
  $categories=  get_categories(); 
  foreach ($categories as $category) {
  	$option = '<option value="/category/archives/'.$category->category_nicename.'">';
	$option .= $category->cat_name;
	$option .= ' ('.$category->category_count.')';
	$option .= '</option>';
	echo $option;
  }
 ?>
</select>
<select name="post-dropdown" id="post-dropdown">
</select>
-->

<?php

}

//CHECKBOX - Name: ma_options[frontslider2]
function cryout_setting_frontslider2_fn() {
	global $mantra_options;
?>

<?php
$items = array("Custom Slides", "Latest Posts", "Random Posts", "Sticky Posts", "Latest Posts from Category" , "Random Posts from Category", "Specific Posts");
	$itemsare = array( __("Custom Slides","mantra"), __("Latest Posts","mantra"), __("Random Posts","mantra"),__("Sticky Posts","mantra"), __("Latest Posts from Category","mantra"), __("Random Posts from Category","mantra"), __("Specific Posts","mantra"));
	echo "<p><strong>选择你想加载到幻灯片的内容: </strong> ";
	echo "<select id='mantra_slideType' name='ma_options[mantra_slideType]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_slideType'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select></p>";
	
?>

<div id="sliderLatestPosts" class="slideDivs">
<span><?php _e('Latest posts will be loaded into the slider.','mantra'); ?> </span> 
</div>

<div id="sliderRandomPosts" class="slideDivs">
<span><?php _e('Random  posts will be loaded into the slider.','mantra'); ?> </span> 
</div>

<div id="sliderLatestCateg" class="slideDivs">
<span><?php _e('Latest posts from the category you choose will be loaded in the slider.','mantra'); ?> </span>

</div>

<div id="sliderRandomCateg" class="slideDivs">
<span><?php _e('Random posts from the category you choose will be loaded into the slider.','mantra'); ?> </span>
</div>

<div id="sliderStickyPosts" class="slideDivs">
<span><?php _e('Only sticky posts will be loaded into the slider.','mantra'); ?> </span>
</div>

<div id="sliderSpecificPosts" class="slideDivs">
<span><?php _e('List the post IDs you want to display (separated by a comma): ','mantra'); ?> </span> 
 <input id='mantra_slideSpecific' name='ma_options[mantra_slideSpecific]' size='44' type='text' value='<?php echo esc_attr( $mantra_options['mantra_slideSpecific'] ) ?>'  /> 
</div>

<div id="slider-category">
<span><?php _e('<br> Choose the cateogry: ','mantra'); ?> </span>
<select id="mantra_slideCateg" name='ma_options[mantra_slideCateg]' > 
 <option value=""><?php echo esc_attr(__('Select Category','mantra')); ?></option> 
 <?php  echo $mantra_options["mantra_slideCateg"];
  $categories=  get_categories(); 
  foreach ($categories as $category) {
  	$option = '<option value="'.$category->category_nicename.'" ';
	$option .= selected($mantra_options["mantra_slideCateg"], $category->category_nicename, false).' >';
	$option .= $category->cat_name;
	$option .= ' ('.$category->category_count.')';
	$option .= '</option>';
	echo $option;
  }
 ?>
</select>
</div>

<span id="slider-post-number"><?php _e('Number of posts to show:','mantra'); ?>
 <input id='mantra_slideNumber' name='ma_options[mantra_slideNumber]' size='3' type='text' value='<?php echo esc_attr( $mantra_options['mantra_slideNumber'] ) ?>'  /> 
 </span>


<div id="sliderCustomSlides" class="slideDivs">
<div class="slidebox"> 
<h4 class="slidetitle" ><?php _e("Slide 1","mantra");?> </h4>
<div class="slidercontent">
<h5><?php _e("Image","mantra");?></h5>
<input type="text" value="<?php echo  esc_url($mantra_options['mantra_sliderimg1']); ?>" name="ma_options[mantra_sliderimg1]" id="mantra_sliderimg1" class="slideimages" />
<span class="description"><a href="#" class="upload_image_button"><?php _e( 'Upload or select image from gallery', 'mantra' );?></a> </span>                                
<h5> <?php _e("Title","mantra");?> </h5>
<input id='mantra_slidertitle1' name='ma_options[mantra_slidertitle1]' size='50' type='text' value='<?php echo esc_attr( $mantra_options['mantra_slidertitle1'] ) ?>'  />            
<h5> <?php _e("Text","mantra");?> </h5>
<textarea id='mantra_slidertext1' name='ma_options[mantra_slidertext1]' rows='3' cols='50' type='textarea' ><?php echo esc_attr($mantra_options['mantra_slidertext1']) ?></textarea>
<h5> <?php _e("Link","mantra");?> </h5>
<input id='mantra_sliderlink1' name='ma_options[mantra_sliderlink1]' size='50' type='text' value='<?php echo esc_url( $mantra_options['mantra_sliderlink1'] ) ?>'  />            
</div>
</div>

<div class="slidebox"> 
<h4 class="slidetitle" > <?php _e("Slide 2","mantra");?> </h4>
<div class="slidercontent">
<h5><?php _e("Image","mantra");?></h5>
<input type="text" value="<?php echo  esc_url($mantra_options['mantra_sliderimg2']); ?>" name="ma_options[mantra_sliderimg2]" id="mantra_sliderimg2" class="slideimages" />
<span class="description"><a href="#" class="upload_image_button"><?php _e( 'Upload or select image from gallery', 'mantra' );?></a> </span>     
<h5> <?php _e("Title","mantra");?> </h5>
<input id='mantra_slidertitle2' name='ma_options[mantra_slidertitle2]' size='50' type='text' value='<?php echo esc_attr( $mantra_options['mantra_slidertitle2'] ) ?>'  />                            
<h5> <?php _e("Text","mantra");?> </h5>
<textarea id='mantra_slidertext2' name='ma_options[mantra_slidertext2]' rows='3' cols='50' type='textarea' ><?php echo esc_attr($mantra_options['mantra_slidertext2']) ?></textarea>
<h5> <?php _e("Link","mantra");?> </h5>
<input id='mantra_sliderlink2' name='ma_options[mantra_sliderlink2]' size='50' type='text' value='<?php echo esc_url( $mantra_options['mantra_sliderlink2'] ) ?>'  />            
</div>
</div>

<div class="slidebox"> 
<h4 class="slidetitle" > <?php _e("Slide 3","mantra");?> </h4>
<div class="slidercontent">
<h5><?php _e("Image","mantra");?></h5>
<input type="text" value="<?php echo  esc_url($mantra_options['mantra_sliderimg3']); ?>" name="ma_options[mantra_sliderimg3]" id="mantra_sliderimg3" class="slideimages" />
<span class="description"><a href="#" class="upload_image_button"><?php _e( 'Upload or select image from gallery', 'mantra' );?></a> </span>   
<h5> <?php _e("Title","mantra");?> </h5>
<input id='mantra_slidertitle3' name='ma_options[mantra_slidertitle3]' size='50' type='text' value='<?php echo esc_attr( $mantra_options['mantra_slidertitle3'] ) ?>'  />                              
<h5> <?php _e("Text","mantra");?> </h5>
<textarea id='mantra_slidertext3' name='ma_options[mantra_slidertext3]' rows='3' cols='50' type='textarea' ><?php echo esc_attr($mantra_options['mantra_slidertext3']) ?></textarea>
<h5> <?php _e("Link","mantra");?> </h5>
<input id='mantra_sliderlink3' name='ma_options[mantra_sliderlink3]' size='50' type='text' value='<?php echo esc_url( $mantra_options['mantra_sliderlink3'] ) ?>'  />            
</div>
</div>

<div class="slidebox"> 
<h4 class="slidetitle" > <?php _e("Slide 4","mantra");?> </h4>
<div class="slidercontent">
<h5><?php _e("Image","mantra");?></h5>
<input type="text" value="<?php echo  esc_url($mantra_options['mantra_sliderimg4']); ?>" name="ma_options[mantra_sliderimg4]" id="mantra_sliderimg4" class="slideimages" />
<span class="description"><a href="#" class="upload_image_button"><?php _e( 'Upload or select image from gallery', 'mantra' );?></a> </span>   
<h5> <?php _e("Title","mantra");?> </h5>
<input id='mantra_slidertitle4' name='ma_options[mantra_slidertitle4]' size='50' type='text' value='<?php echo esc_attr( $mantra_options['mantra_slidertitle4'] ) ?>'  />                              
<h5> <?php _e("Text","mantra");?> </h5>
<textarea id='mantra_slidertext4' name='ma_options[mantra_slidertext4]' rows='3' cols='50' type='textarea' ><?php echo esc_attr($mantra_options['mantra_slidertext4']) ?></textarea>
<h5> <?php _e("Link","mantra");?> </h5>
<input id='mantra_sliderlink4' name='ma_options[mantra_sliderlink4]' size='50' type='text' value='<?php echo esc_url( $mantra_options['mantra_sliderlink4'] ) ?>'  />            
</div>
</div>

<div class="slidebox"> 
<h4 class="slidetitle" > <?php _e("Slide 5","mantra");?></h4>
<div class="slidercontent">
<h5><?php _e("Image","mantra");?></h5>
<input type="text" value="<?php echo  esc_url($mantra_options['mantra_sliderimg5']); ?>" name="ma_options[mantra_sliderimg5]" id="mantra_sliderimg5" class="slideimages" />
<span class="description"><a href="#" class="upload_image_button"><?php _e( 'Upload or select image from gallery', 'mantra' );?></a> </span>
<h5> <?php _e("Title","mantra");?> </h5>
<input id='mantra_slidertitle5' name='ma_options[mantra_slidertitle5]' size='50' type='text' value='<?php echo esc_attr( $mantra_options['mantra_slidertitle5'] ) ?>'  />                                 
<h5> <?php _e("Text","mantra");?> </h5>
<textarea id='mantra_slidertext5' name='ma_options[mantra_slidertext5]' rows='3' cols='50' type='textarea' ><?php echo esc_attr($mantra_options['mantra_slidertext5']) ?></textarea>
<h5> <?php _e("Link","mantra");?> </h5>
<input id='mantra_sliderlink5' name='ma_options[mantra_sliderlink5]' size='50' type='text' value='<?php echo esc_url( $mantra_options['mantra_sliderlink5'] ) ?>'  />            
</div>
</div>
<?php	echo "<small>".__("Your slides' content. Only the image is required, all other fields are optional. Only the slides with an image selected will become acitve and visible in the live slider.","mantra")."</small>"; 
?>
</div> <!-- customSlides -->
<?php
}

//CHECKBOX - Name: ma_options[frontcolumns]
function cryout_setting_frontcolumns_fn() {
	global $mantra_options;

echo "<div class='slmini'><b>".__("Number of columns:","mantra")."</b> ";
	$items = array ("0" ,"1", "2" , "3" , "4");
	echo "<select id='mantra_nrcolumns'  name='ma_options[mantra_nrcolumns]'>";
foreach($items as $item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_nrcolumns'],$item);
	echo ">$item</option>";
}
	echo "</select></div>";

echo "<div class='slmini'><b>".__("Image Height:","mantra")."</b> ";
	echo "<input id='mantra_colimageheight' name='ma_options[mantra_colimageheight]' size='4' type='text' value='".esc_attr( $mantra_options['mantra_colimageheight'] )."'  /> px </div>";
?>
<div class='slmini'><b><?php _e("Read more text:","mantra");?></b>  
<input id='mantra_columnreadmore' name='ma_options[mantra_columnreadmore]' size='30' type='text' value='<?php echo esc_attr( $mantra_options['mantra_columnreadmore'] ) ?>'  />                              
<?php
	echo "<small>".__("The linked text that appears at the bottom of all the columns. You can delete all text inside if you don't want it.","mantra")."</small></div>";

?>
<div class="slidebox"> 
<h4 class="slidetitle" > <?php _e("1st Column","mantra");?> </h4>
<div class="slidercontent">
<h5><?php _e("Image","mantra");?></h5>
<input type="text" value="<?php echo esc_url($mantra_options['mantra_columnimg1']); ?>" name="ma_options[mantra_columnimg1]" id="mantra_columnimg1" class="slideimages" />
<span class="description"><a href="#" class="upload_image_button"><?php _e( 'Upload or select image from gallery', 'mantra' );?></a> </span>                                
<h5> <?php _e("Title","mantra");?> </h5>
<input id='mantra_columntitle1' name='ma_options[mantra_columntitle1]' size='50' type='text' value='<?php echo esc_attr( $mantra_options['mantra_columntitle1'] ) ?>'  />            
<h5> <?php _e("Text","mantra");?> </h5>
<textarea id='mantra_columntext1' name='ma_options[mantra_columntext1]' rows='3' cols='50' type='textarea' ><?php echo esc_attr($mantra_options['mantra_columntext1']) ?></textarea>
<h5> <?php _e("Link","mantra");?> </h5>
<input id='mantra_columnlink1' name='ma_options[mantra_columnlink1]' size='50' type='text' value='<?php echo esc_url( $mantra_options['mantra_columnlink1'] ) ?>'  />            
</div>
</div>

<div class="slidebox"> 
<h4 class="slidetitle" >  <?php _e("2nd Column","mantra");?></h4>
<div class="slidercontent">
<h5><?php _e("Image","mantra");?></h5>
<input type="text" value="<?php echo  esc_url($mantra_options['mantra_columnimg2']); ?>" name="ma_options[mantra_columnimg2]" id="mantra_columnimg2" class="slideimages" />
<span class="description"><a href="#" class="upload_image_button"><?php _e( 'Upload or select image from gallery', 'mantra' );?></a> </span>     
<h5> <?php _e("Title","mantra");?> </h5>
<input id='mantra_columntitle2' name='ma_options[mantra_columntitle2]' size='50' type='text' value='<?php echo esc_attr( $mantra_options['mantra_columntitle2'] ) ?>'  />                            
<h5> <?php _e("Text","mantra");?> </h5>
<textarea id='mantra_columntext2' name='ma_options[mantra_columntext2]' rows='3' cols='50' type='textarea' ><?php echo esc_attr($mantra_options['mantra_columntext2']) ?></textarea>
<h5> <?php _e("Link","mantra");?> </h5>
<input id='mantra_columnlink2' name='ma_options[mantra_columnlink2]' size='50' type='text' value='<?php echo esc_url( $mantra_options['mantra_columnlink2'] ) ?>'  />            
</div>
</div>

<div class="slidebox"> 
<h4 class="slidetitle" > <?php _e("3rd Column","mantra");?>  </h4>
<div class="slidercontent">
<h5><?php _e("Image","mantra");?></h5>
<input type="text" value="<?php echo  esc_url($mantra_options['mantra_columnimg3']); ?>" name="ma_options[mantra_columnimg3]" id="mantra_columnimg3" class="slideimages" />
<span class="description"><a href="#" class="upload_image_button"><?php _e( 'Upload or select image from gallery', 'mantra' );?></a> </span>   
<h5> Title </h5>
<input id='mantra_columntitle3' name='ma_options[mantra_columntitle3]' size='50' type='text' value='<?php echo esc_attr( $mantra_options['mantra_columntitle3'] ) ?>'  />                              
<h5> <?php _e("Text","mantra");?> </h5>
<textarea id='mantra_columntext3' name='ma_options[mantra_columntext3]' rows='3' cols='50' type='textarea' ><?php echo esc_attr($mantra_options['mantra_columntext3']) ?></textarea>
<h5> <?php _e("Link","mantra");?> </h5>
<input id='mantra_columnlink3' name='ma_options[mantra_columnlink3]' size='50' type='text' value='<?php echo esc_url( $mantra_options['mantra_columnlink3'] ) ?>'  />            
</div>
</div>

<div class="slidebox"> 
<h4 class="slidetitle" >  <?php _e("4th Column","mantra");?> </h4>
<div class="slidercontent">
<h5><?php _e("Image","mantra");?></h5>
<input type="text" value="<?php echo  esc_url($mantra_options['mantra_columnimg4']); ?>" name="ma_options[mantra_columnimg4]" id="mantra_columnimg4" class="slideimages" />
<span class="description"><a href="#" class="upload_image_button"><?php _e( 'Upload or select image from gallery', 'mantra' );?></a> </span>   
<h5> <?php _e("Title","mantra");?> </h5>
<input id='mantra_columntitle4' name='ma_options[mantra_columntitle4]' size='50' type='text' value='<?php echo esc_attr( $mantra_options['mantra_columntitle4'] ) ?>'  />                              
<h5> <?php _e("Text","mantra");?> </h5>
<textarea id='mantra_columntext4' name='ma_options[mantra_columntext4]' rows='3' cols='50' type='textarea' ><?php echo esc_attr($mantra_options['mantra_columntext4']) ?></textarea>
<h5> <?php _e("Link","mantra");?> </h5>
<input id='mantra_columnlink4' name='ma_options[mantra_columnlink4]' size='50' type='text' value='<?php echo esc_url( $mantra_options['mantra_columnlink4'] ) ?>'  />            
</div>
</div>

<?php
}


//CHECKBOX - Name: ma_options[fronttext]
function cryout_setting_fronttext_fn() {
	global $mantra_options;

echo "<div class='slidebox'><h4 class='slidetitle'> ".__("Extra Text","mantra")." </h4><div  class='slidercontent'><h5>".__("Top Title","mantra")."</h5> ";
	echo "<input id='mantra_fronttext1' name='ma_options[mantra_fronttext1]' size='50' type='text' value='".esc_attr( $mantra_options['mantra_fronttext1'] )."'  />";
echo "<h5>".__("Second Title","mantra")."</h5> ";
	echo "<input id='mantra_fronttext2' name='ma_options[mantra_fronttext2]' size='50' type='text' value='".esc_attr( $mantra_options['mantra_fronttext2'] )."'  />";

echo "<h5>".__("Title color","mantra")."</h5> ";
	echo '<input type="text" id="mantra_fronttitlecolor" name="ma_options[mantra_fronttitlecolor]"  style="width:100px;display:block;float:none;" value="'.esc_attr( $mantra_options['mantra_fronttitlecolor'] ).'"  />';
	echo '<div id="mantra_fronttitlecolor2"></div>';
	echo "<div><small>".__("The titles' color (Default value is 333333).","mantra")."</small></div>";

echo "<h5>".__("Bottom Text 1","mantra")."</h5> ";
	echo "<textarea id='mantra_fronttext3' name='ma_options[mantra_fronttext3]' rows='3' cols='50' type='textarea' >".esc_attr($mantra_options['mantra_fronttext3'])." </textarea>";
echo "<h5>".__("Bottom Text 2","mantra")." </h5> ";
		echo "<textarea id='mantra_fronttext4' name='ma_options[mantra_fronttext4]' rows='3' cols='50' type='textarea' >".esc_attr($mantra_options['mantra_fronttext4'])." </textarea></div></div>";

echo "<div><small>".__("首页显示更多文章。第一标题显示在幻灯片上方。第二标题显示显示在幻灯片和其下方的栏目之间。这些都是可以选择的。如果你不需要，请留空输入框。","mantra")."</small></div>";




echo "<br /><div class='slidebox'><h4 class='slidetitle'>".__("Hide areas","mantra")." </h4><div  class='slidercontent'>";


		$items = array( "FronHeader", "FrontMenu", "FrontWidget" , "FrontFooter","FrontBack");

		$checkedClass0 = ($mantra_options['mantra_fronthideheader']=='1') ? ' checkedClass0' : '';
		$checkedClass1 = ($mantra_options['mantra_fronthidemenu']=='1') ? ' checkedClass1' : '';
		$checkedClass2 = ($mantra_options['mantra_fronthidewidget']=='1') ? ' checkedClass2' : '';
		$checkedClass3 = ($mantra_options['mantra_fronthidefooter']=='1') ? ' checkedClass3' : '';
		$checkedClass4 = ($mantra_options['mantra_fronthideback']=='1') ? ' checkedClass4' : '';

		echo " <label id='$items[0]' for='$items[0]$items[0]' class='hideareas $checkedClass0'><input  ";
		 checked($mantra_options['mantra_fronthideheader'],'1');
	echo "value='1' id='$items[0]$items[0]'  name='ma_options[mantra_fronthideheader]' type='checkbox' /> ".__("Hide the header area (image or background color).","mantra")." </label>";

		echo " <label id='$items[1]' for='$items[1]$items[1]' class='hideareas $checkedClass1'><input  ";
		 checked($mantra_options['mantra_fronthidemenu'],'1');
	echo "value='1' id='$items[1]$items[1]'  name='ma_options[mantra_fronthidemenu]' type='checkbox' /> ".__("Hide the main menu (the top navigation tabs).","mantra")." </label>";

		echo " <label id='$items[2]' for='$items[2]$items[2]' class='hideareas $checkedClass2'><input  ";
		 checked($mantra_options['mantra_fronthidewidget'],'1');
	echo "value='1' id='$items[2]$items[2]'  name='ma_options[mantra_fronthidewidget]' type='checkbox' /> ".__("Hide the footer widgets. ","mantra")." </label>";

		echo " <label id='$items[3]' for='$items[3]$items[3]' class='hideareas $checkedClass3'><input  ";
		 checked($mantra_options['mantra_fronthidefooter'],'1');
	echo "value='1' id='$items[3]$items[3]'  name='ma_options[mantra_fronthidefooter]' type='checkbox' /> ".__("Hide the footer (copyright area).","mantra")." </label>";

	echo " <label id='$items[4]' for='$items[4]$items[4]' class='hideareas $checkedClass4'><input  ";
		 checked($mantra_options['mantra_fronthideback'],'1');
	echo "value='1' id='$items[4]$items[4]'  name='ma_options[mantra_fronthideback]' type='checkbox' /> ".__("Hide the white color. Only the background color remains.","mantra")." </label>";
		

echo "</div></div>";		
		echo "<div><p><small>".__("Choose the areas to hide on the first page.","mantra")."</small></p></div>";

}

////////////////////////////////
//// TEXT SETTINGS /////////////
////////////////////////////////

//SELECT - Name: ma_options[fontsize]
function  cryout_setting_fontsize_fn() {
	global $mantra_options;
	$items =array ("12px", "13px" , "14px" , "15px" , "16px", "17px", "18px");
	echo "<select id='mantra_fontsize' name='ma_options[mantra_fontsize]'>";
		foreach($items as $item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_fontsize'],$item);
	echo ">$item</option>";
}
	echo "</select>";
	echo "<div><small>".__("Select the font size you'll use in your blog. Pages, posts and comments will be affected. Buttons, Headers and Side menus will remain the same.","mantra")."</small></div>";
}


//SELECT - Name: ma_options[fontfamily]
function  cryout_setting_fontfamily_fn() {
	global $mantra_options;
	global $fontSans, $fontSerif, $fontMono, $fontCursive;

	echo "<select id='mantra_fontfamily' name='ma_options[mantra_fontfamily]'>";
	echo "<optgroup label='Sans-Serif'>";
foreach($fontSans as $item) {
	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fontfamily'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";

	echo "<optgroup label='Serif'>";
foreach($fontSerif as $item) {

	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fontfamily'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";

	echo "<optgroup label='MonoSpace'>";
foreach($fontMono as $item) {
	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fontfamily'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";

	echo "<optgroup label='Cursive'>";
foreach($fontCursive as $item) {
	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fontfamily'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";
	echo "</select>";

	echo "<div><small>".__("Select the font family you'll use in your blog. All content text will be affected (including menu buttons). ","mantra")."</small></div>";
	echo "<div><small>".__("Or insert your Google Font below. Please only isert the <strong>name</strong> of the font.<br /> Ex: Marko One. Go to <a href='http://www.google.com/webfonts' > google fonts </a> for some font inspiration.","mantra")."</small></div>";
	echo '<input type="text" size="45" value="'.esc_attr($mantra_options['mantra_googlefont']).'"  name="ma_options[mantra_googlefont]" id="mantra_googlefont" />';

}

//SELECT - Name: ma_options[fonttitle]
function  cryout_setting_fonttitle_fn() {
	global $mantra_options;
	global $fontSans, $fontSerif, $fontMono, $fontCursive;

	echo "<select id='mantra_fonttitle' name='ma_options[mantra_fonttitle]'>";
	echo "<option value='Default'";
	selected($mantra_options['mantra_fonttitle'],'Defaut');
	echo ">Default</option>";
	echo "<optgroup label='Sans-Serif'>";
foreach($fontSans as $item) {
	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fonttitle'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";

	echo "<optgroup label='Serif'>";
foreach($fontSerif as $item) {

	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fonttitle'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";

	echo "<optgroup label='MonoSpace'>";
foreach($fontMono as $item) {
	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fonttitle'],$item);
	echo ">$item";
}
	echo "</optgroup>";

	echo "<optgroup label='Cursive'>";
foreach($fontCursive as $item) {
	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fonttitle'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";
	echo "</select>";
	echo "<div><small>".__("Select the font family you want for your titles. It will affect post titles and page titles. Leave 'Default' and the general font you selected will be used.","mantra")."</small></div>";

	echo "<div><small>".__("Or insert your Google Font below. Please only isert the <strong>name</strong> of the font.<br /> Ex: Marko One. Go to <a href='http://www.google.com/webfonts' > google fonts </a> for some font inspiration.","mantra")."</small></div>";
	echo '<input type="text" size="45" value="'.esc_attr($mantra_options['mantra_googlefonttitle']).'"  name="ma_options[mantra_googlefonttitle]" id="mantra_googlefonttitle" />';



}

//SELECT - Name: ma_options[fontside]
function  cryout_setting_fontside_fn() {
	global $mantra_options;
	global $fontSans, $fontSerif, $fontMono, $fontCursive;

	echo "<select id='mantra_fontside' name='ma_options[mantra_fontside]'>";
	echo "<option value='Default'";
	selected($mantra_options['mantra_fonttitle'],'Defaut');
	echo ">Default</option>";
	echo "<optgroup label='Sans-Serif'>";
foreach($fontSans as $item) {
	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fontside'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";

	echo "<optgroup label='Serif'>";
foreach($fontSerif as $item) {

	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fontside'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";

	echo "<optgroup label='MonoSpace'>";
foreach($fontMono as $item) {
	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fontside'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";

	echo "<optgroup label='Cursive'>";
foreach($fontCursive as $item) {
	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fontside'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";
	echo "</select>";
	echo "<div><small>".__("Select the font family you want your sidebar(s) to have. Text in sidebars will be affected, including any widgets. Leave 'Default' and the general font you selected will be used.","mantra")."</small></div>";

	echo "<div><small>".__("Or insert your Google Font below. Please only isert the <strong>name</strong> of the font.<br /> Ex: Marko One. Go to <a href='http://www.google.com/webfonts' > google fonts </a> for some font inspiration.","mantra")."</small></div>";
	echo '<input type="text" size="45" value="'.esc_attr($mantra_options['mantra_googlefontside']).'"  name="ma_options[mantra_googlefontside]" id="mantra_googlefontside" />';


}


//SELECT - Name: ma_options[fontsubheader]
function  cryout_setting_fontsubheader_fn() {
	global $mantra_options;
	global $fontSans, $fontSerif, $fontMono, $fontCursive;

	echo "<select id='mantra_fontsubheader' name='ma_options[mantra_fontsubheader]'>";
	echo "<option value='Default'";
	selected($mantra_options['mantra_fonttitle'],'Defaut');
	echo ">Default</option>";
	echo "<optgroup label='Sans-Serif'>";
foreach($fontSans as $item) {
	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fontsubheader'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";

	echo "<optgroup label='Serif'>";
foreach($fontSerif as $item) {

	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fontsubheader'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";

	echo "<optgroup label='MonoSpace'>";
foreach($fontMono as $item) {
	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fontsubheader'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";

	echo "<optgroup label='Cursive'>";
foreach($fontCursive as $item) {
	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fontsubheader'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";
	echo "</select>";
	echo "<div><small>".__("Select the font family you want your subheaders to have (h2 - h6 tags will be affected). Leave 'Default' and the general font you selected will be used.","mantra")."</small></div>";

	echo "<div><small>".__("Or insert your Google Font below. Please only isert the <strong>name</strong> of the font.<br /> Ex: Marko One. Go to <a href='http://www.google.com/webfonts' > google fonts </a> for some font inspiration.","mantra")."</small></div>";
	echo '<input type="text" size="45" value="'.esc_attr($mantra_options['mantra_googlefontsubheader']).'"  name="ma_options[mantra_googlefontsubheader]" id="mantra_googlefontsubheader" />';


}

//SELECT - Name: ma_options[headfontsize]
function  cryout_setting_headfontsize_fn() {
	global $mantra_options;
	$items = array ("Default" , "14px" , "16px" , "18px" , "20px", "22px" , "24px" , "26px" , "28px" , "30px" , "32px" , "34px" , "36px", "38px" , "40px");
	$itemsare = array( __("Default","mantra") ,"14px" , "16px" , "18px" , "20px", "22px" , "24px" , "26px" , "28px" , "30px" , "32px" , "34px" , "36px", "38px" , "40px");
	echo "<select id='mantra_headfontsize' name='ma_options[mantra_headfontsize]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_headfontsize'],$item);
	echo ">$item</option>";
}
	echo "</select>";
	echo "<div><small>".__("Post Header Font size. Leave 'Default' for normal settings (size value will be as set in the CSS).","mantra")."</small></div>";
}

//SELECT - Name: ma_options[sidefontsize]
function  cryout_setting_sidefontsize_fn() {
	global $mantra_options;
	$items = array ("Default" , "8px" , "9px" , "10px" , "11px", "12px" , "13px" , "14px" , "15px" , "16px" , "17px" , "18px");
	$itemsare = array( __("Default","mantra") , "8px" , "9px" , "10px" , "11px", "12px" , "13px" , "14px" , "15px" , "16px" , "17px" , "18px");
	echo "<select id='mantra_sidefontsize' name='ma_options[mantra_sidefontsize]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_sidefontsize'],$item);
	echo ">$item</option>";
}
	echo "</select>";
	echo "<div><small>".__("Sidebar Font size. Leave 'Default' for normal settings (size value will be as set in the CSS).","mantra")."</small></div>";
}

//SELECT - Name: ma_options[textalign]
function  cryout_setting_textalign_fn() {
	global $mantra_options;
	$items = array ("Default" , "Left" , "Right" , "Justify" , "Center");
	$itemsare = array( __("Default","mantra"), __("Left","mantra"), __("Right","mantra"), __("Justify","mantra"), __("Center","mantra"));
	echo "<select id='mantra_textalign' name='ma_options[mantra_textalign]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_textalign'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("This overwrites the text alignment in posts and pages. Leave 'Default' for normal settings (alignment will remain as declared in posts, comments etc.).","mantra")."</small></div>";
}

//SELECT - Name: ma_options[parindent]
function  cryout_setting_parindent_fn() {
	global $mantra_options;
	$items = array ("0px" , "5px" , "10px" , "15px" , "20px");
	echo "<select id='mantra_parindent' name='ma_options[mantra_parindent]'>";
foreach($items as $item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_parindent'],$item);
	echo ">$item</option>";
}
	echo "</select>";
	echo "<div><small>".__("Choose the indent for your paragraphs.","mantra")."</small></div>";
}


//CHECKBOX - Name: ma_options[headerindent]
function cryout_setting_headerindent_fn() {
	global $mantra_options;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","mantra"), __("Disable","mantra"));
	echo "<select id='mantra_headerindent' name='ma_options[mantra_headerindent]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_headerindent'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Disable the default header and title indent (left margin).","mantra")."</small></div>";
}

//SELECT - Name: ma_options[lineheight]
function  cryout_setting_lineheight_fn() {
	global $mantra_options;
	$items = array ("Default" ,"0.8em" , "0.9em", "1.0em" , "1.1em" , "1.2em" , "1.3em", "1.4em" , "1.5em" , "1.6em" , "1.7em" , "1.8em" , "1.9em" , "2.0em");
	$itemsare = array( __("Default","mantra"),"0.8em" , "0.9em", "1.0em" , "1.1em" , "1.2em" , "1.3em", "1.4em" , "1.5em" , "1.6em" , "1.7em" , "1.8em" , "1.9em" , "2.0em");
	echo "<select id='mantra_lineheight' name='ma_options[mantra_lineheight]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_lineheight'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Text line height. The height between 2 rows of text. Leave 'Default' for normal settings (size value will be as set in the CSS).","mantra")."</small></div>";
}

//SELECT - Name: ma_options[wordspace]
function  cryout_setting_wordspace_fn() {
	global $mantra_options;
	$items = array ("Default" ,"-3px" , "-2px", "-1px" , "0px" , "1px" , "2px", "3px" , "4px" , "5px" , "10px");
	$itemsare = array( __("Default","mantra"),"-3px" , "-2px", "-1px" , "0px" , "1px" , "2px", "3px" , "4px" , "5px" , "10px");
	echo "<select id='mantra_wordspace' name='ma_options[mantra_wordspace]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_wordspace'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("The space between <i>words</i>. Leave 'Default' for normal settings (size value will be as set in the CSS).","mantra")."</small></div>";
}

//SELECT - Name: ma_options[letterspace]
function  cryout_setting_letterspace_fn() {
	global $mantra_options;
	$items = array ("Default" ,"-0.05em" , "-0.04em", "-0.03em" , "-0.02em" , "-0.01em" , "0.01em", "0.02em" , "0.03em" , "0.04em" , "0.05em");
	$itemsare = array( __("Default","mantra"),"-0.05em" , "-0.04em", "-0.03em" , "-0.02em" , "-0.01em" , "0.01em", "0.02em" , "0.03em" , "0.04em" , "0.05em");
	echo "<select id='mantra_letterspace' name='ma_options[mantra_letterspace]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_letterspace'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("The space between <i>letters</i>. Leave 'Default' for normal settings (size value will be as set in the CSS).","mantra")."</small></div>";
}



//CHECKBOX - Name: ma_options[textshadow]
function cryout_setting_textshadow_fn() {
	global $mantra_options;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","mantra"), __("Disable","mantra"));
	echo "<select id='mantra_textshadow' name='ma_options[mantra_textshadow]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_textshadow'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Disable the default text shadow on headers and titles.","mantra")."</small></div>";
}

////////////////////////////////
//// APPEREANCE SETTINGS ///////
////////////////////////////////

//TEXT - Name: ma_options[backcolor]
function  cryout_setting_backcolor_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_backcolor" name="ma_options[mantra_backcolor]" value="'.esc_attr( $mantra_options['mantra_backcolor'] ).'"  />';
    echo '<div id="mantra_backcolor2"></div>';
	echo "<div><small>".__("Background color (Default value is 444444).","mantra")."</small></div>";
}

//TEXT - Name: ma_options[headercolor]
function  cryout_setting_headercolor_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_headercolor" name="ma_options[mantra_headercolor]" value="'.esc_attr( $mantra_options['mantra_headercolor'] ).'"  />';
	echo '<div id="mantra_headercolor2"></div>';
	echo "<div><small>".__("Header background color (Default value is 333333). You can delete all inside text for no background color.","mantra")."</small></div>";
}

function  cryout_setting_contentbg_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_contentbg" name="ma_options[mantra_contentbg]" value="'.esc_attr( $mantra_options['mantra_contentbg'] ).'"  />';
	echo '<div id="mantra_contentbg2"></div>';
	echo "<div><small>".__("Content background color (Default value is FFFFFF). Works best with really light colors.","mantra")."</small></div>";
}

function  cryout_setting_menubg_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_menubg" name="ma_options[mantra_menubg]" value="'.esc_attr( $mantra_options['mantra_menubg'] ).'"  />';
	echo '<div id="mantra_menubg2"></div>';
	echo "<div><small>".__("Main menu background color (Default value is FAFAFA). Should be the same color as the content bg or something just as light.","mantra")."</small></div>";
}

function  cryout_setting_first_sidebar_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_s1bg" name="ma_options[mantra_s1bg]" value="'.esc_attr( $mantra_options['mantra_s1bg'] ).'"  />';
	echo '<div id="mantra_s1bg2"></div>';
	echo "<div><small>".__("First sidebar background color (Default value is FFFFFF).","mantra")."</small></div>";
}

function  cryout_setting_second_sidebar_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_s2bg" name="ma_options[mantra_s2bg]" value="'.esc_attr( $mantra_options['mantra_s2bg'] ).'"  />';
	echo '<div id="mantra_s2bg2"></div>';
	echo "<div><small>".__("First sidebar background color (Default value is FFFFFF).","mantra")."</small></div>";
}

//TEXT - Name: ma_options[prefootercolor]
function  cryout_setting_prefootercolor_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_prefootercolor" name="ma_options[mantra_prefootercolor]" value="'.esc_attr( $mantra_options['mantra_prefootercolor'] ).'"  />';
	echo '<div id="mantra_prefootercolor2"></div>';
	echo "<div><small>".__("Footer widget-area background color. (Default value is 171717).","mantra")."</small></div>";
}

//TEXT - Name: ma_options[footercolor]
function  cryout_setting_footercolor_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_footercolor" name="ma_options[mantra_footercolor]" value="'.esc_attr( $mantra_options['mantra_footercolor'] ).'"  />';
	echo '<div id="mantra_footercolor2"></div>';
	echo "<div><small>".__("Footer background color (Default value is 222222).","mantra")."</small></div>";
}

//TEXT - Name: ma_options[titlecolor]
function  cryout_setting_titlecolor_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_titlecolor" name="ma_options[mantra_titlecolor]" value="'.esc_attr( $mantra_options['mantra_titlecolor'] ).'"  />';
	echo '<div id="mantra_titlecolor2"></div>';
	echo "<div><small>".__("Your blog's title color (Default value is 0D85CC).","mantra")."</small></div>";
}

//TEXT - Name: ma_options[descriptioncolor]
function  cryout_setting_descriptioncolor_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_descriptioncolor" name="ma_options[mantra_descriptioncolor]" value="'.esc_attr( $mantra_options['mantra_descriptioncolor'] ).'"  />';
	echo '<div id="mantra_descriptioncolor2"></div>';
	echo "<div><small>".__("Your blog's description color(Default value is 222222).","mantra")."</small></div>";
}

//TEXT - Name: ma_options[contentcolor]
function  cryout_setting_contentcolor_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_contentcolor" name="ma_options[mantra_contentcolor]" value="'.esc_attr( $mantra_options['mantra_contentcolor'] ).'"  />';
	echo '<div id="mantra_contentcolor2"></div>';
	echo "<div><small>".__("Content Text Color (Default value is 333333).","mantra")."</small></div>";
}

//TEXT - Name: ma_options[linkscolor]
function  cryout_setting_linkscolor_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_linkscolor" name="ma_options[mantra_linkscolor]" value="'.esc_attr( $mantra_options['mantra_linkscolor'] ).'"  />';
	echo '<div id="mantra_linkscolor2"></div>';
	echo "<div><small>".__("Links color (Default value is 0D85CC).","mantra")."</small></div>";
}

//TEXT - Name: ma_options[hovercolor]
function  cryout_setting_hovercolor_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_hovercolor" name="ma_options[mantra_hovercolor]" value="'.esc_attr( $mantra_options['mantra_hovercolor'] ).'"  />';
	echo '<div id="mantra_hovercolor2"></div>';
	echo "<div><small>".__("Links color on mouse over (Default value is 333333).","mantra")."</small></div>";
}

//TEXT - Name: ma_options[headtextcolor]
function  cryout_setting_headtextcolor_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_headtextcolor" name="ma_options[mantra_headtextcolor]" value="'.esc_attr( $mantra_options['mantra_headtextcolor'] ).'"  />';
	echo '<div id="mantra_headtextcolor2"></div>';
	echo "<div><small>".__("Post Header Text Color (Default value is 333333).","mantra")."</small></div>";
}

//TEXT - Name: ma_options[headtexthover]
function  cryout_setting_headtexthover_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_headtexthover" name="ma_options[mantra_headtexthover]" value="'.esc_attr( $mantra_options['mantra_headtexthover'] ).'"  />';
	echo '<div id="mantra_headtexthover2"></div>';
	echo "<div><small>".__("Post Header Text Color on Mouse over (Default value is 000000).","mantra")."</small></div>";
}

//TEXT - Name: ma_options[sideheadbackcolor]
function  cryout_setting_sideheadbackcolor_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_sideheadbackcolor" name="ma_options[mantra_sideheadbackcolor]" value="'.esc_attr( $mantra_options['mantra_sideheadbackcolor'] ).'"  />';
	echo '<div id="mantra_sideheadbackcolor2"></div>';
	echo "<div><small>".__("Sidebar Header Background color (Default value is 444444).","mantra")."</small></div>";

}

//TEXT - Name: ma_options[sideheadtextcolor]
function  cryout_setting_sideheadtextcolor_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_sideheadtextcolor" name="ma_options[mantra_sideheadtextcolor]" value="'.esc_attr( $mantra_options['mantra_sideheadtextcolor'] ).'"  />';
	echo '<div id="mantra_sideheadtextcolor2"></div>';
	echo "<div><small>".__("Sidebar Header Text Color(Default value is 2EA5FD).","mantra")."</small></div>";
}

//TEXT - Name: ma_options[footerheader]
function  cryout_setting_footerheader_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_footerheader" name="ma_options[mantra_footerheader]" value="'.esc_attr( $mantra_options['mantra_footerheader'] ).'"  />';
	echo '<div id="mantra_footerheader2"></div>';
	echo "<div><small>".__("Footer Widget Text Color (Default value is 0D85CC).","mantra")."</small></div>";
}

//TEXT - Name: ma_options[footertext]
function  cryout_setting_footertext_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_footertext" name="ma_options[mantra_footertext]" value="'.esc_attr( $mantra_options['mantra_footertext'] ).'"  />';
	echo '<div id="mantra_footertext2"></div>';
	echo "<div><small>".__("Footer Widget Link Color (Default value is 666666).","mantra")."</small></div>";
}

//TEXT - Name: ma_options[footerhover]
function  cryout_setting_footerhover_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_footerhover" name="ma_options[mantra_footerhover]" value="'.esc_attr( $mantra_options['mantra_footerhover'] ).'"  />';
	echo '<div id="mantra_footerhover2"></div>';
	echo "<div><small>".__("Footer Widget Link Color on Mouse Over (Default value is 888888).","mantra")."</small></div>";
}


////////////////////////////////
//// GRAPHICS SETTINGS /////////
////////////////////////////////

//SELECT - Name: ma_options[caption]
function  cryout_setting_caption_fn() {
global $mantra_options;
	$items = array ("White" , "Light" , "Light Gray" , "Gray" , "Dark Gray" , "Black");
	$itemsare = array( __("White","mantra"), __("Light","mantra"), __("Light Gray","mantra"), __("Gray","mantra"), __("Dark Gray","mantra"), __("Black","mantra"));
	echo "<select id='mantra_caption' name='ma_options[mantra_caption]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_caption'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("This setting changes the look of your captions. Images that are not inserted through captions will not be affected.","mantra")."</small></div>";
}

// RADIO-BUTTON - Name: ma_options[image]
function cryout_setting_image_fn() {
	global $mantra_options;
	$items = array("None", "One", "Two", "Three" , "Four", "Five", "Six", "Seven");
	foreach($items as $item) {
		
		$checkedClass = ($mantra_options['mantra_image']==$item) ? ' checkedClass' : '';
	
		echo " <label id='$item' for='$item$item' class='images $checkedClass'><input  ";
		 checked($mantra_options['mantra_image'],$item);
	echo "value='$item' id='$item$item' onClick=\"changeBorder('$item','images');\" name='ma_options[mantra_image]' type='radio' /><img id='image$item'  src='".get_template_directory_uri()."/admin/images/testimg.png'/></label>";
	}
		
		echo "<div><br /><p><small>".__("The border around your inserted images. ","mantra")."</small></p></div>";
}

// RADIO-BUTTON - Name: ma_options[pin]
function cryout_setting_pin_fn() {
global $mantra_options;
	$items = array("mantra_dot", "Pin1", "Pin2", "Pin3" , "Pin4", "Pin5");
	foreach($items as $item) {
		$none='';
		if ($item == 'mantra_dot') { $none='无'; }
		$checkedClass = ($mantra_options['mantra_pin']==$item) ? ' checkedClass' : '';
		echo "<label id='$item' class='pins  $checkedClass'><input ";
		checked($mantra_options['mantra_pin'],$item);
		echo " value='$item' onClick=\"changeBorder('$item','pins');\" name='ma_options[mantra_pin]' type='radio' />$none<img style='margin-left:10px;margin-right:10px;' src='".get_template_directory_uri()."/images/pins/".$item.".png'/></label>";
	}
		echo "<div><small>".__("The image on top of your captions. ","mantra")."</small></div>";
}

// RADIO-BUTTON - Name: ma_options[sidebullet]
function cryout_setting_sidebullet_fn() {
	global $mantra_options;
	$items = array("mantra_dot2", "arrow_black", "arrow_white", "bullet_dark" , "bullet_gray", "bullet_light", "square_dark", "square_white", "triangle_dark" , "triangle_gray", "triangle_white");
	foreach($items as $item) {
		$none='';
		if ($item == 'mantra_dot2') { $none='无'; }
		$checkedClass = ($mantra_options['mantra_sidebullet']==$item) ? ' checkedClass' : '';
		echo "<label id='$item' class='sidebullets  $checkedClass'><input ";
		checked($mantra_options['mantra_sidebullet'],$item);
		echo " value='$item' onClick=\"changeBorder('$item','sidebullets');\" name='ma_options[mantra_sidebullet]' type='radio' />$none<img style='margin-left:10px;margin-right:10px;' src='".get_template_directory_uri()."/images/bullets/".$item.".png'/></label>";
	}
	echo "<div><small>".__("The sidebar list bullets. ","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[metaback]
function cryout_setting_metaback_fn() {
	global $mantra_options;
	$items = array ("Gray" , "White", "None");
	$itemsare = array( __("Gray","mantra"), __("White","mantra"), __("None","mantra"));
	echo "<select id='mantra_metaback' name='ma_options[mantra_metaback]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_metaback'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("The background for your post-metas area (under your post tiltes). Gray by default.<","mantra")."</small></div>";

}

//CHECKBOX - Name: ma_options[postseparator]
function cryout_setting_postseparator_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_postseparator' name='ma_options[mantra_postseparator]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_postseparator'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide or show a horizontal rule to separate posts.","mantra")."</small></div>";

}

//CHECKBOX - Name: ma_options[contentlist]
function cryout_setting_contentlist_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_contentlist' name='ma_options[mantra_contentlist]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_contentlist'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide or show  bullets next to lists that are in your content area (posts, pages etc.).","mantra")."</small></div>";

}


//CHECKBOX - Name: ma_options[title]
function cryout_setting_title_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_title' name='ma_options[mantra_title]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_title'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide or show your blog's Title and Description in the header (recommended if you have a custom header image with text).","mantra")."</small></div>";

}
//CHECKBOX - Name: ma_options[pagetitle]
function cryout_setting_pagetitle_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_pagetitle' name='ma_options[mantra_pagetitle]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_pagetitle'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide or show Page titles on any <i>created</i> pages. ","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[categtitle]
function cryout_setting_categtitle_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_categtitle' name='ma_options[mantra_categtitle]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_categtitle'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide or show Page titles on <i>Category</i> Pages. ","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[tables]
function cryout_setting_tables_fn() {
	global $mantra_options;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","mantra"), __("Disable","mantra"));
	echo "<select id='mantra_tables' name='ma_options[mantra_tables]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_tables'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide table borders and background color.","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[comtext]
function cryout_setting_comtext_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_comtext' name='ma_options[mantra_comtext]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_comtext'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide the explanatory text under the comments form. (starts with  <i>You may use these HTML tags and attributes:...</i>).","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[comclosed]
function cryout_setting_comclosed_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide in posts", "Hide in pages", "Hide everywhere");
	$itemsare = array( __("Show","mantra"), __("Hide in posts","mantra"), __("Hide in pages","mantra"), __("Hide everywhere","mantra"));
	echo "<select id='mantra_comclosed' name='ma_options[mantra_comclosed]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_comclosed'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide the  <b>Comments are closed</b> text that by default shows up on pages or posts with the comments disabled.","mantra")."</small></div>";
}


//CHECKBOX - Name: ma_options[comoff]
function cryout_setting_comoff_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_comoff' name='ma_options[mantra_comoff]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_comoff'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide the <b>Comments off</b> text next to posts that have comments disabled.","mantra")."</small></div>";
}


//CHECKBOX - Name: ma_options[backtop]
function cryout_setting_backtop_fn() {
	global $mantra_options;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","mantra"), __("Disable","mantra"));
	echo "<select id='mantra_backtop' name='ma_options[mantra_backtop]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_backtop'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Enable the Back to Top button. The button appears after scrolling the page down.","mantra")."</small></div>";
}

// TEXTBOX - Name: ma_options[copyright]
function cryout_setting_copyright_fn() {
	global $mantra_options;
	echo "<textarea id='mantra_copyright' name='ma_options[mantra_copyright]' rows='3' cols='40' type='textarea' >".esc_textarea($mantra_options['mantra_copyright'])." </textarea>";
	echo "<div><small>".__("Insert custom text or HTML code that will appear last in you footer. <br /> You can use HTML to insert links, images and special characters like &copy .","mantra")."</small></div>";
}


////////////////////////////////
//// POST SETTINGS /////////////
////////////////////////////////

//CHECKBOX - Name: ma_options[postdate]
function cryout_setting_postcomlink_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_postcomlink' name='ma_options[mantra_postcomlink]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_postcomlink'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide or show the <strong>Leave a comment</strong> or <strong>x Comments</strong> next to posts or post excerpts.","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[postdate]
function cryout_setting_postdate_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_postdate' name='ma_options[mantra_postdate]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_postdate'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide or show the post date.","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[posttime]
function cryout_setting_posttime_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_posttime' name='ma_options[mantra_posttime]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_posttime'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Show the post time with the date. Time will not be visible if the Post Date is hidden.","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[postauthor]
function cryout_setting_postauthor_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_postauthor' name='ma_options[mantra_postauthor]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_postauthor'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide or show the post author.","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[postcateg]
function cryout_setting_postcateg_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_postcateg' name='ma_options[mantra_postcateg]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_postcateg'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide the post category.","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[posttag]
function cryout_setting_posttag_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_posttag' name='ma_options[mantra_posttag]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_posttag'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide the post tags.","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[postbook]
function cryout_setting_postbook_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_postbook' name='ma_options[mantra_postbook]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_postbook'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide the 'Bookmark permalink'.","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[postmetas]
function cryout_setting_postmetas_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_postmetas' name='ma_options[mantra_postmetas]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_postmetas'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide all the post metas. All meta info and meta areas will be hidden.","mantra")."</small></div>";
}


////////////////////////////////
//// EXCERPT SETTINGS /////////////
////////////////////////////////


//CHECKBOX - Name: ma_options[excerpthome]
function cryout_setting_excerpthome_fn() {
	global $mantra_options;
	$items = array ("Excerpt" , "Full Post");
	$itemsare = array( __("Excerpt","mantra"), __("Full Post","mantra"));
	echo "<select id='mantra_excerpthome' name='ma_options[mantra_excerpthome]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_excerpthome'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Excerpts on the main page. Only standard posts will be affected. All other post formats (aside, image, chat, quote etc.) have their specific formating.","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[excerptsticky]
function cryout_setting_excerptsticky_fn() {
	global $mantra_options;
	$items = array ("Excerpt" , "Full Post");
	$itemsare = array( __("Excerpt","mantra"), __("Full Post","mantra"));
	echo "<select id='mantra_excerptsticky' name='ma_options[mantra_excerptsticky]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_excerptsticky'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Choose if you want the sticky posts on your home page to be visible in full or just the excerpts. ","mantra")."</small></div>";
}


//CHECKBOX - Name: ma_options[excerptarchive]
function cryout_setting_excerptarchive_fn() {
	global $mantra_options;
	$items = array ("Excerpt" , "Full Post");
	$itemsare = array( __("Excerpt","mantra"), __("Full Post","mantra"));
	echo "<select id='mantra_excerptarchive' name='ma_options[mantra_excerptarchive]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_excerptarchive'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Excerpts on archive, categroy and search pages. Same as above, only standard posts will be affected.","mantra")."</small></div>";
}


// TEXTBOX - Name: ma_options[excerptwords]
function cryout_setting_excerptwords_fn() {
	global $mantra_options;
	echo "<input id='mantra_excerptwords' name='ma_options[mantra_excerptwords]' size='6' type='text' value='".esc_attr( $mantra_options['mantra_excerptwords'] )."'  />";
	echo "<div><small>".__("The number of words an excerpt will have. When that number is reached the post will be interrupted by a <i>Continue reading</i> link that
							will take the reader to the full post page.","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[magazinelayout]
function cryout_setting_magazinelayout_fn() {
	global $mantra_options;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","mantra"), __("Disable","mantra"));
	echo "<select id='mantra_magazinelayout' name='ma_options[mantra_magazinelayout]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_magazinelayout'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Enable the Magazine Layout. This layout applies to pages with posts and shows 2 posts per row.","mantra")."</small></div>";
}

// TEXTBOX - Name: ma_options[excerptdots]
function cryout_setting_excerptdots_fn() {
	global $mantra_options;
	echo "<input id='mantra_excerptdots' name='ma_options[mantra_excerptdots]' size='40' type='text' value='".esc_attr( $mantra_options['mantra_excerptdots'] )."'  />";
	echo "<div><small>".__("Replaces the three dots ('[...])' that are appended automatically to excerpts.","mantra")."</small></div>";
}

// TEXTBOX - Name: ma_options[excerptcont]
function cryout_setting_excerptcont_fn() {
	global $mantra_options;
	echo "<input id='mantra_excerptcont' name='ma_options[mantra_excerptcont]' size='40' type='text' value='".esc_attr( $mantra_options['mantra_excerptcont'] )."'  />";
	echo "<div><small>".__("Edit the 'Continue Reading' link added to your post excerpts.","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[excerpttags]
function cryout_setting_excerpttags_fn() {
	global $mantra_options;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","mantra"), __("Disable","mantra"));
	echo "<select id='mantra_excerpttags' name='ma_options[mantra_excerpttags]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_excerpttags'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("在默认情况下，wordpress摘要会移除所有的HTML标签，包括了(".htmlspecialchars('<pre>, <a>, <b>')." 和其他所有) 。摘要中只留有文本。允许这个选项，允许摘要中保留HTML标签，默认的所有的格式都会保留。<br /> <b>警告: </b>如果保留HTML标签，请确定他们都已经关闭。因此，如果的文章中有一个开放的HTML标签，但摘要在标签关闭前已经结束，剩下的网站的所有内容将会包在那个HTML标签中。-- 如果你不确定，请保留“禁用” -- ","mantra")."</small></div>";
}


////////////////////////////////
/// FEATURED IMAGE SETTINGS ////
////////////////////////////////


//CHECKBOX - Name: ma_options[fpost]
function cryout_setting_fpost_fn() {
	global $mantra_options;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","mantra"), __("Disable","mantra"));
	echo "<select id='mantra_fpost' name='ma_options[mantra_fpost]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_fpost'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	$checkedClass = ($mantra_options['mantra_fpostlink']=='1') ? ' checkedClass' : '';


		echo " <label style='border:none;margin-left:10px;' id='$items[0]' for='$items[0]$items[0]' class='socialsdisplay $checkedClass'><input type='hidden' name='ma_options[mantra_fpostlink]' value='0' /><input  ";
		 checked($mantra_options['mantra_fpostlink'],'1');
	echo "value='1' id='$items[0]$items[0]'  name='ma_options[mantra_fpostlink]' type='checkbox' /> 链接缩略图到文章</label>";


	echo "<div><small>".__("Show featured images as thumbnails on posts. The images must be selected for each post in the Featured Image section.","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[fauto]
function cryout_setting_fauto_fn() {
	global $mantra_options;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","mantra"), __("Disable","mantra"));
	echo "<select id='mantra_fauto' name='ma_options[mantra_fauto]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_fauto'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Show the first image that you inserted in a post as a thumbnail. If you enable this option, the first image in your post will be used even if you selected a Featured Image in you post.","mantra")."</small></div>";
}


//CHECKBOX - Name: ma_options[falign]
function cryout_setting_falign_fn() {
	global $mantra_options;
	$items = array ("Left" , "Center", "Right");
	$itemsare = array( __("Left","mantra"), __("Center","mantra"), __("Right","mantra"));
	echo "<select id='mantra_falign' name='ma_options[mantra_falign]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_falign'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Thumbnail alignment.","mantra")."</small></div>";
}


// TEXTBOX - Name: ma_options[fwidth]
function cryout_setting_fsize_fn() {
	global $mantra_options;
	echo "<input id='mantra_fwidth' name='ma_options[mantra_fwidth]' size='4' type='text' value='".esc_attr( $mantra_options['mantra_fwidth'] )."'  />px (宽) <b>X</b> ";
	echo "<input id='mantra_fheight' name='ma_options[mantra_fheight]' size='4' type='text' value='".esc_attr( $mantra_options['mantra_fheight'] )."'  />px (高)";
	
	$checkedClass = ($mantra_options['mantra_fcrop']=='1') ? ' checkedClass' : '';

		echo " <label id='fcrop' for='mantra_fcrop' class='socialsdisplay $checkedClass'><input  ";
		 checked($mantra_options['mantra_fcrop'],'1');
	echo "value='1' id='mantra_fcrop'  name='ma_options[mantra_fcrop]' type='checkbox' /> 裁切图片到确切大小. </label>";
	
	
	echo "<div><small>".__("The size you want the thumbnails to have (in pixels). By default imges will be scaled with aspect ratio kept. Choose to crop the images if you want the exact size.","mantra")."</small></div>";
}


//CHECKBOX - Name: ma_options[fheader]
function cryout_setting_fheader_fn() {
	global $mantra_options;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","mantra"), __("Disable","mantra"));
	echo "<select id='mantra_fheader' name='ma_options[mantra_fheader]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_fheader'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("在顶部显示特色图片。顶部会被你选择的特色图片所取代。图片的尺寸不能小于现在顶部尺寸。","mantra")."</small></div>";
}


////////////////////////
/// SOCIAL SETTINGS ////
////////////////////////

// TEXTBOX - Name: ma_options[social1]
function cryout_setting_socials1_fn() {
	global $mantra_options, $socialNetworks;
	echo "<select id='mantra_social1' name='ma_options[mantra_social1]'>";
foreach($socialNetworks as $item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_social1'],$item);
	echo ">$item</option>";
}
	echo "</select><span class='address_span'> &raquo; </span>";

	echo "<input id='mantra_social2' name='ma_options[mantra_social2]' size='32' type='text'  value='".esc_url( $mantra_options['mantra_social2'] )."'  />";
	echo "<div><small>".__("Select your desired Social network from the left dropdown menu and insert your corresponding address in the right input field. (ex: <i>http://www.facebook.com/yourname</i> )","mantra")."</small></div>";
}

// TEXTBOX - Name: ma_options[social2]
function cryout_setting_socials2_fn() {
	global $mantra_options, $socialNetworks;
	echo "<select id='mantra_social3' name='ma_options[mantra_social3]'>";
foreach($socialNetworks as $item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_social3'],$item);
	echo ">$item</option>";
}
	echo "</select><span class='address_span'> &raquo; </span>";
	echo "<input id='mantra_tweeter' name='ma_options[mantra_social4]' size='32' type='text'  value='".esc_url( $mantra_options['mantra_social4'] )."'  />";
	echo "<div><small>".__("You can insert up to 5 different social sites and addresses.","mantra")."</small></div> ";
}

// TEXTBOX - Name: ma_options[social3]
function cryout_setting_socials3_fn() {
	global $mantra_options, $socialNetworks;
	echo "<select id='mantra_social5' name='ma_options[mantra_social5]'>";
	foreach($socialNetworks as $item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_social5'],$item);
	echo ">$item</option>";
}
	echo "</select><span class='address_span'> &raquo; </span>";
	echo "<input id='mantra_rss' name='ma_options[mantra_social6]' size='32' type='text'  value='".esc_url( $mantra_options['mantra_social6'] )."'  />";
	echo "<div><small>".__("There are a total of 27 social networks to choose from. ","mantra")."</small></div>";
}

// TEXTBOX - Name: ma_options[social4]
function cryout_setting_socials4_fn() {
	global $mantra_options, $socialNetworks;
	echo "<select id='mantra_social7' name='ma_options[mantra_social7]'>";
	foreach($socialNetworks as $item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_social7'],$item);
	echo ">$item</option>";
}
	echo "</select><span class='address_span'> &raquo; </span>";
	echo "<input id='mantra_rss' name='ma_options[mantra_social8]' size='32' type='text'  value='".esc_url( $mantra_options['mantra_social8'] )."'  />";
	echo "<div><small>".__("You can leave any number of inputs empty. ","mantra")."</small></div>";
}

// TEXTBOX - Name: ma_options[social5]
function cryout_setting_socials5_fn() {
	global $mantra_options, $socialNetworks;
	echo "<select id='mantra_social9' name='ma_options[mantra_social9]'>";
	foreach($socialNetworks as $item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_social9'],$item);
	echo ">$item</option>";
}
	echo "</select><span class='address_span'> &raquo; </span>";
	echo "<input id='mantra_rss' name='ma_options[mantra_social10]' size='32' type='text'  value='".esc_url( $mantra_options['mantra_social10'] )."'  />";
	echo "<div><small>".__("You can choose the same social media any number of times.  ","mantra")."</small></div>";
}

// TEXTBOX - Name: ma_options[socialsdisplay]
function cryout_setting_socialsdisplay_fn() {
global $mantra_options;
		$items = array( "Header", "CLeft", "CRight" , "Footer");

		$checkedClass0 = ($mantra_options['mantra_socialsdisplay0']=='1') ? ' checkedClass0' : '';
		$checkedClass1 = ($mantra_options['mantra_socialsdisplay1']=='1') ? ' checkedClass1' : '';
		$checkedClass2 = ($mantra_options['mantra_socialsdisplay2']=='1') ? ' checkedClass2' : '';
		$checkedClass3 = ($mantra_options['mantra_socialsdisplay3']=='1') ? ' checkedClass3' : '';

		echo " <label id='$items[0]' for='$items[0]$items[0]' class='socialsdisplay $checkedClass0'><input  ";
		 checked($mantra_options['mantra_socialsdisplay0'],'1');
	echo "value='1' id='$items[0]$items[0]'  name='ma_options[mantra_socialsdisplay0]' type='checkbox' /> 顶部右上角</label>";

		echo " <label id='$items[1]' for='$items[1]$items[1]' class='socialsdisplay $checkedClass1'><input  ";
		 checked($mantra_options['mantra_socialsdisplay1'],'1');
	echo "value='1' id='$items[1]$items[1]'  name='ma_options[mantra_socialsdisplay1]' type='checkbox' /> 主菜单下方——左边</label>";

		echo " <label id='$items[2]' for='$items[2]$items[2]' class='socialsdisplay $checkedClass2'><input  ";
		 checked($mantra_options['mantra_socialsdisplay2'],'1');
	echo "value='1' id='$items[2]$items[2]'  name='ma_options[mantra_socialsdisplay2]' type='checkbox' /> 主菜单下方——右边</label>";

		echo " <label id='$items[3]' for='$items[3]$items[3]' class='socialsdisplay $checkedClass3'><input  ";
		 checked($mantra_options['mantra_socialsdisplay3'],'1');
	echo "value='1' id='$items[3]$items[3]'  name='ma_options[mantra_socialsdisplay3]' type='checkbox' />底部 (较小的 icon图标) </label>";
		

		
		echo "<div><p><small>".__("Choose the <b>areas</b> where to display the social icons.","mantra")."</small></p></div>";
}


////////////////////////
/// MISC SETTINGS ////
////////////////////////


//CHECKBOX - Name: ma_options[linkheader]
function cryout_setting_linkheader_fn() {
	global $mantra_options;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","mantra"), __("Disable","mantra"));
	echo "<select id='mantra_linkheader' name='ma_options[mantra_linkheader]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_linkheader'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Make the site header into a clickable link that links to your index page.","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[breadcrumbs]
function cryout_setting_breadcrumbs_fn() {
	global $mantra_options;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","mantra"), __("Disable","mantra"));
	echo "<select id='mantra_breadcrumbs' name='ma_options[mantra_breadcrumbs]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_breadcrumbs'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Show breadcrumbs at the top of the content area. Breadcrumbs are a form of navigation that keeps track of your location withtin the site.","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[pagination]
function cryout_setting_pagination_fn() {
	global $mantra_options;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","mantra"), __("Disable","mantra"));
	echo "<select id='mantra_pagination' name='ma_options[mantra_pagination]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_pagination'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Show numbered pagination. Where there is more than one page, instead of the bottom <b>Older Posts</b> and <b>Newer posts</b> links you have a numbered pagination. ","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[mobile]
function cryout_setting_mobile_fn() {
	global $mantra_options;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","mantra"), __("Disable","mantra"));
	echo "<select id='mantra_mobile' name='ma_options[mantra_mobile]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_mobile'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Enable the mobile view and make Mantra responsive. The layout and look of your blog will change depending on what device and what resolution it is viewed in. ","mantra")."</small></div>";
}

// TEXTBOX - Name: ma_options[favicon]
function cryout_setting_favicon_fn() {
	global $mantra_options;
	echo '<div>';
?>
 <img src='<?php echo  esc_url($mantra_options['mantra_favicon']); ?>' class="imagebox" width="64" height="64"/>
<input type="text" size="60" value="<?php echo  esc_url($mantra_options['mantra_favicon']); ?>" name="ma_options[mantra_favicon]" id="mantra_favicon" class="slideimages" />
<span class="description"><a href="#" class="upload_image_button"><br /><?php _e( 'Upload or select favicon from gallery', 'mantra' );?></a> </span> 
</div>

<?php
echo "<div><small>".__("Limitations: It has to be an image. It should be max 64x64 pixels in dimensions. Recommended file extensions .ico and .png . ","mantra")."</small></div>";

}

// TEXTBOX - Name: ma_options[customcss]
function cryout_setting_customcss_fn() {
	global $mantra_options;
	echo "<textarea id='mantra_customcss' name='ma_options[mantra_customcss]' rows='8' cols='70' type='textarea' >".esc_textarea($mantra_options['mantra_customcss'])." </textarea>";
	echo "<div><small>".__("Insert your custom CSS here. Any CSS declarations made here will overwrite Mantra's (even the custom options specified right here in the Mantra Settings page). <br /> Your custom CSS will be preserved when updating the theme.","mantra")."</small></div>";
}

// TEXTBOX - Name: ma_options[customjs]
function cryout_setting_customjs_fn() {
	global $mantra_options;
	echo "<textarea id='mantra_customjs' name='ma_options[mantra_customjs]' rows='8' cols='70' type='textarea' >".esc_textarea($mantra_options['mantra_customjs'])." </textarea>";
	echo "<div><small>".__("Insert your custom Javascript code here. (Google Analytics and any other forms of Analytic software).","mantra")."</small></div>";
}
function cryout_setting_seo_fn() {
	global $mantra_options;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","mantra"), __("Disable","mantra"));
	echo "<select id='mantra_seo' name='ma_options[mantra_seo]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_seo'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Enable Mantra's Search Engine Optimization. This is enabled by default and should only be disabled if you are using a SEO plugin.","mantra")."</small></div>";
	echo "<br><small> 所有的标题标签都会由Mantra自动来处理。</small>";
	
	echo "<div class='slmini'>";
		echo "<b>首页Meta描述</b>";
		echo "<textarea id='mantra_seo_home_desc' name='ma_options[mantra_seo_home_desc]' rows='2' cols=50' type='textarea' >{$mantra_options['mantra_seo_home_desc']}  </textarea>";
		echo "<small> 这个是独一无二，你应该要填写。尽你最大的能力来描述你的网站。建议不要超过160个词。 </small>";
	echo "</div>";
	
	echo "<div class='slmini'>";
		echo "<b> 其他所有页面的meta描述信息: </b>";
		$moreitems = array ("Auto" , "Manual");
		$moreitemsare = array( __("Auto","mantra"), __("Manual","mantra"));
		echo "<select id='mantra_seo_gen_desc' name='ma_options[mantra_seo_gen_desc]'>";
		foreach($moreitems as $id=>$item) {
			echo "<option value='$item'";
			selected($mantra_options['mantra_seo_gen_desc'],$item);
			echo ">$moreitemsare[$id]</option>";
				}
		echo "</select>";
		echo "<small>  <u>自动</u> - Mantra 会自动为页面和文章添加摘要和meta描述。<br>
					   <u>手动</u> - 你需要在文章/页面的管理员出添加新的自定义栏目（路径：编辑文章，右上角“显示选项”，自定义栏目。通过那里，你能够为每一篇文章和页面输入精确的描述。</small>";
	echo "</div>";

	echo "<small>对于分类页面，将使用实际分类描述。设置路径：文章> 分类目录，你可以对每一个分类目录进行详细描述。</small>";
	
	echo "<div class='slmini'>";
		echo "<b>文章作者</b>";
	$authors=wp_list_authors (array("echo"=>false,"html"=> false));
	$authors_array = explode ("," , $authors);
	array_unshift($authors_array,"不显示");
	echo "<select id='mantra_seo_author' name='ma_options[mantra_seo_author]'>";
		foreach($authors_array as $item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_seo_author'],$item);
	echo ">$item</option>";
}
	echo "</select>";
	
	
		echo "<small>如果你想在meta标签中显示作者</small>";
	echo "</div>";
	
}
?>