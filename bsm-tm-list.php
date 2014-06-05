<?php

//function bsmtextmarquee_admin_actions() {
//	add_options_page('BsmTextMarquee', 'BsmTextMarquee', 'manage_options', __file__, 'bsmtextmarquee_admin');
//}

function bsmtextmarquee_list() {
?>
	<div class="wrap">
		<h2>BSM Text Marquee</h2>
		<p>Sebuah plugin untuk text berjalan oleh <a href="http://bsmsite.com">BaseSystem Management</a></p>
		<p><a href="<?php echo admin_url('admin.php?page=bsm-tm-create'); ?>">Add New</a></p>
		<table class="widefat">
			<thead>
				<tr>
					<th>Text Walk</th>
					<th>Action</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Text Walk</th>
					<th>Action</th>
				</tr>
			</tfoot>
			<tbody>
				<?php
					global $wpdb;
					$table_name = $wpdb->prefix . "tbbsmtextmarquee";
					$bsmdatatexts = $wpdb->get_results(
						"
							SELECT id, text_slide
							FROM " . $table_name . "
						"
						);
				?>
				<?php
					foreach ($bsmdatatexts as $bsmdatatext)
					{
				?>
						<tr>
				<?php
						echo "<td>".$bsmdatatext->text_slide."</td>";
						echo "<td><a href='".admin_url('admin.php?page=bsm-tm-update&id='.$bsmdatatext->id)."'>Update</a></td>";
				?>
						</tr>
				<?php
					}
				?>
			</tbody>
	</div>
<?php
}

?>