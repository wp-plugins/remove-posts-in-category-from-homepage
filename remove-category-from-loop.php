<?php
/*
Plugin Name: Remove Posts in Category From Homepage
Plugin URI: http://davidwalsh.name/category-loop
Description: Allows the blogger to prevent posts within a given category from displaying in the main loop
Author: David Walsh
Version: 1.01
Author URI: http://davidwalsh.name
*/
?><?php 

	$RCFH_LOOP_LABEL = 'Remove from main loop';
	$RCFH_LOOP_DESCRIPTION = 'Check this box if you would like posts in this category to be prevented from displaying within the main loop.';
	$RCFH_LOOP_OPTION_KEY = 'remove-loop-cats';

	// Add the extra field to the EDIT category page
	add_action('category_edit_form_fields', 'rcfh_loop_field_edit');
	function rcfh_loop_field_edit($term) {
		global $RCFH_LOOP_LABEL, $RCFH_LOOP_DESCRIPTION, $RCFH_LOOP_OPTION_KEY;

		$value = get_option($RCFH_LOOP_OPTION_KEY);
		if(!$value) {
			$value = array();
		}

		$checked = in_array($term->term_id, $value);
 ?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="removeMainLoop"><?php _e($RCFH_LOOP_LABEL); ?></label></th>
		<td>
			<label for="removeMainLoop">
				&nbsp;&nbsp;<input type="checkbox" name="remove-loop" id="removeMainLoop"<?php echo $checked ? ' checked="checked"' : ''; ?> value="1" style="width:auto;" />
				<span class="description"><?php _e($RCFH_LOOP_DESCRIPTION); ?></span>
			</label>
		</td>
	</tr>
<?php } 

	// Add the extra field to the ADD category page
	add_action('category_add_form_fields', 'rcfh_loop_field_create');
	function rcfh_loop_field_create() { 
		global $RCFH_LOOP_LABEL, $RCFH_LOOP_DESCRIPTION;
?>
	<div class="form-field">
		<label for="removeMainLoop">
			<?php _e($RCFH_LOOP_LABEL); ?><br />
		<p>
			<input type="checkbox" name="remove-loop" id="removeMainLoop" value="1" style="width:auto;" />
			<span style="display: inline-block;"><?php _e($RCFH_LOOP_DESCRIPTION); ?></span>
		</p>
		</label>
	</div>
<?php }

	// Add action for saving extra category information
	add_action('edit_category', 'rcfh_save_loop_value');
	add_action('create_category', 'rcfh_save_loop_value');
	function rcfh_save_loop_value($id) {
		global $RCFH_LOOP_OPTION_KEY;

		$value = get_option($RCFH_LOOP_OPTION_KEY);
		if(!$value) {
			$value = array();
		}

		// Add or remove the value
		if(isset($_POST['remove-loop'])) {
			array_push($value, $id);
		}
		else {
			$value = array_diff($value, array($id));
		}

		// Ensure no duplicates, just for cleanliness
		$value = array_unique(array_values($value));

		// Save
		update_option($RCFH_LOOP_OPTION_KEY, $value);
	}

	// Filter for removing said category posts from main loop
	add_action('pre_get_posts', 'rcfh_prevent_posts');
	function rcfh_prevent_posts($query) {
		global $RCFH_LOOP_OPTION_KEY;

		// Only remove categories if it's the main query/homepage
		if($query->is_home() && $query->is_main_query()) {
			$value = get_option($RCFH_LOOP_OPTION_KEY);

			// Modify query to remove posts which shouldn't be shown
			if(count($value)) {
				$query->set('cat', '-'.implode(',-', $value));
			}
		}
	}
?>