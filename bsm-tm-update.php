<?php
function bsm_tm_update () {
global $wpdb;
$table_name = $wpdb->prefix . "tbbsmtextmarquee";
$id = $_GET["id"];
$text_slide=$_POST["text_slide"];

if(isset($_POST['update'])){	
	$wpdb->update(
		$table_name,
		array('text_slide' => $text_slide),
		array( 'id' => $id ),
		array('%s'),
		array('%d')
	);	
}

else if(isset($_POST['delete'])){	
	$wpdb->query($wpdb->prepare("DELETE FROM " . $table_name . " WHERE id = %d",$id));
}
else{	
	$bsmdatatm = $wpdb->get_results($wpdb->prepare("SELECT id, text_slide from " . $table_name  . " where id=%d",$id));
	foreach ($bsmdatatm as $s ){
		$text_slide=$s->text_slide;
	}
}
?>
<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/BsmTextMarquee/style-admin.css" rel="stylesheet" />
<div class="wrap">
<h2>BSM Text Marquee - Update or Delete</h2>
<br />
<?php if($_POST['delete']){?>
<div class="updated"><p>Data deleted</p></div>
<a href="<?php echo admin_url('admin.php?page=bsmtextmarquee-list')?>">&laquo; Back to data list</a>

<?php } else if($_POST['update']) {?>
<div class="updated"><p>Data updated</p></div>
<a href="<?php echo admin_url('admin.php?page=bsmtextmarquee-list')?>">&laquo; Back to data list</a>

<?php } else {?>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<table class='wp-list-table widefat fixed'>
<tr><th>Text Walk</th><td><input type="text" name="text_slide" value="<?php echo $text_slide;?>"/></td></tr>
</table>
<br />
<input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
<input type='submit' name="delete" value='Delete' class='button' onclick="return confirm('Are you sure want to delete?')">
</form>
<?php }?>

</div>
<?php
}