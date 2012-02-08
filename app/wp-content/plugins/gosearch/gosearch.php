<?php /*
Plugin Name: gosearch
Plugin URI: http://prasanna.freeoda.com/blog/plugins/online-people
Description:Search the site
Author:Prasanna 
Version: 1
Author URI:http://prasanna.freeoda.com/blog/*/

function gosearch_show(){

   $siteurl = get_option('siteurl');
	
	?>
<form method=get target=_blank action="http://www.google.com/search">
<input type="hidden" name="ie" value="UTF-8">
       <input type="hidden" name="oe" value="UTF-8">
<table width="200" border="0" cellpadding="3" cellspacing="3">
  <tr>
    <td> <img src="http://www.google.com/logos/Logo_25gry.gif" border="0" alt="Google"></td>
  </tr>
  <tr>
    <td> <input type="text" name=q size="20" maxlength="255" value=""></td>
  </tr>
  <tr>
    <td> <input type="radio"name="sitesearch" value="">Internet</td>
  </tr>
  <tr>
    <td><input type="radio" name="sitesearch" value="<?php echo $siteurl;?>" checked="checked"><?php echo $siteurl;?></td>
  </tr>
   <tr>
    <td><input type="submit" name="btnG" value="Search">
       <input type="hidden" name="domains" value="<?php echo $siteurl;?>"></td>
  </tr>
</table>
<?php 
}



function gosearch_admin_option() 
{
	//include_once("extra.php");
	echo "<div class='wrap'>";
	echo "<h2>"; 
	echo wp_specialchars( "Search site" ) ; 
	echo "</h2>";
    
	$siteurl = get_option('siteurl');
	
	
	if ($_POST['cd_submit']) 
	{
		$siteurl = stripslashes($_POST['siteurl']);
		
		
		update_option('siteurl', $siteurl );
		
	
	}
	?>

<form name="cd_form" method="post" action="">
  <input name="hiddenid" type="hidden" id="hiddenid" value="<?php echo $edit_id; ?>">
  <input name="process" type="hidden" id="process" value="<?php echo $process; ?>">
  <table width="474" border="0" cellpadding="5" cellspacing="0">
    <tr>
      <td width="295">Please enter your site name to be searched </td>
      <td width="159"><input type="text" name="siteurl" id="siteurl" value="<?php echo $siteurl; ?>" /></td>
    </tr>
    <tr>
      <td colspan="2"><p>for ex:http://www.sitename.com</p>
      <p>if its in directory you have to mention has </p>
      <p>:http://www.sitename.com/directoryname</p></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input name="cd_submit" id="cd_submit" class="button-primary" value="Submit" type="submit" /></td>
    </tr>
  </table>
</form>
<?php
	echo "</div>";
}



function gosearch_install () 
 {

     add_option('siteurl', "http://prasanna.freeoda.com/blog/");
	 
  }

/*function gosearch_deactivation() 
{
	delete_option('siteurl');	
}*/
function gosearch_widget($args) 
{
	extract($args);
	echo $before_widget . $before_title;
	echo "Search site";
	echo $after_title;	
	gosearch_show();
	echo $after_widget;
}


function gosearch_control()
{
	echo '<p>Search site.<br> Goto Search site link.';
	echo ' <a href="options-general.php?page=gosearch/gosearch.php">';
	echo 'click here</a></p>';
}


function gosearch_widget_init() 
{
  	register_sidebar_widget(('Search site'), 'gosearch_widget');   
	
	if(function_exists('register_sidebar_widget')) 	
	{
		register_sidebar_widget('Search site', 'gosearch_widget');
	}
	
	if(function_exists('register_widget_control')) 	
	{
		register_widget_control(array('Search site', 'widgets'), 'gosearch_control');
	} 
}

function gosearch_add_to_menu() 
{
 add_options_page('Search site', 'Search site', 3, __FILE__, 'gosearch_admin_option' );
}

add_action('admin_menu', 'gosearch_add_to_menu');
add_action("plugins_loaded", "gosearch_widget_init");
register_activation_hook(__FILE__, 'gosearch_install');
//register_deactivation_hook(__FILE__, 'gosearch_deactivation');
add_action('init', 'gosearch_widget_init');







?>
