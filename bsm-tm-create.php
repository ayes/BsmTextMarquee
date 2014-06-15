<?php
function bsm_tm_create() {

	if(isset($_POST['insert'])){
		global $wpdb;
		$table_name = $wpdb->prefix . "tbbsmtextmarquee";

		$wpdb->query( $wpdb->prepare( 
			"
				INSERT INTO $table_name
				( text_slide )
				VALUES ( %s )
			", 
			array(
		        $_POST['intextdata']
		        )
		) );

		$message.="Teks Sudah Ditambahkan";
	}
?>

	<div class="wrap">
<h2>BSM Text Marquee - Add New</h2>
<?php if (isset($message)): ?><div class="updated"><p><?php echo $message;?></p></div><?php endif;?>
	<p>
	<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
	New Text: <input type="text" name="intextdata" />
	<input type="submit" name="insert" value='Save' class='button'>
	</form>
	</p>
<p><a href="<?php echo admin_url('admin.php?page=bsmtextmarquee-list'); ?>">Text List</a></p>
</div>

<?php
}
?>