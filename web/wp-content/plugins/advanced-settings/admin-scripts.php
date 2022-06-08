<?php defined('ABSPATH') or exit; ?>

<div class="wrap">

	<?php advset_powered(); ?>

	<div id="icon-options-general" class="icon32"><br></div>
	<h2><?php _e('Advanced Settings &rsaquo; Scripts'); ?></h2>

	<?php if ($notice = get_option('advset_notice')) { ?>
		<div class="notice notice-<?php echo $notice['class'] ?> is-dismissible">
			<p><b><?php echo $notice['size'] ?> <?php _e( $notice['text'] ); ?></b><?php echo $notice['files'] ?></p>
		</div>
	<?php delete_option('advset_notice') ?>
	<?php } ?>

	<form action="options.php" method="post">

		<input type="hidden" name="advset_group" value="scripts" />

		<?php settings_fields( 'advanced-settings' ); ?>

		<table class="form-table">

			<tr valign="top">
				<th scope="row"><?php _e('Options'); ?></th>
				<td>
					<label for="jquery_remove_migrate">
						<input name="jquery_remove_migrate" type="checkbox" id="jquery_remove_migrate" value="1" <?php advset_check_if('jquery_remove_migrate') ?> />
						<?php _e('Remove unnecessary jQuery migrate script (jquery-migrate.min.js)') ?>
					</label>

					<br />
					<label for="jquery_cnd">
						<input name="jquery_cnd" type="checkbox" id="jquery_cnd" value="1" <?php advset_check_if('jquery_cnd') ?> />
						<?php _e('Include jQuery Google CDN instead local script (version 1.11.0)') ?>
					</label>

					<br />
					<label for="remove_script_type">
						<input name="remove_script_type" type="checkbox" id="remove_script_type" value="1" <?php advset_check_if('remove_script_type') ?> />
						<?php _e('Remove <i>type="text/javascript"</i> attribute from &lt;script&gt; tag') ?>
					</label>
				</td>
			</tr>

			<tr valign="top">
				<th scope="row"><?php _e('Track'); ?></th>
				<td>
					<p>
						<label for="track_enqueued_scripts">
							<input name="track_enqueued_scripts" type="checkbox" id="track_enqueued_scripts" value="1" <?php advset_check_if('track_enqueued_scripts') ?> />
							<?php _e('Track enqueued scripts') ?>
							</label>
					</p>
					<p>
						<label for="track_merge_removed_scripts">
							<input name="track_merge_removed_scripts" type="checkbox" id="track_merge_removed_scripts" value="1" <?php advset_check_if('track_merge_removed_scripts') ?> />
							<?php _e('Merge and include removed scripts') ?>
							</label>
					</p>
					<p>
						<label for="track_merged_scripts_footer">
							<input name="track_merged_scripts_footer" type="checkbox" id="track_merged_scripts_footer" value="1" <?php advset_check_if('track_merged_scripts_footer') ?> />
							<?php _e('Load merged removed scripts in footer') ?>
							</label>
					</p>
				</td>
			</tr>

			<tr valign="top">
				<th scope="row"><?php _e('Tracked Scripts <br /> <i style="color:#999">Check to remove scripts</i>'); ?></th>
				<td>
					<?php $tracked = get_option('advset_tracked_scripts');
					if ($tracked) {
						echo '<fieldset>';
						foreach ($tracked as $script) {
							// print_r($script);
							if (!$script->ver) {
								$script->ver = '0';
							}

							$check_name = 'remove_enqueued_script_'.$script->handle;
							$cheked = advset_check_if($check_name, false);

							echo "<label style='width:100%; display:inline-block;' for='$check_name'> <input id='$check_name' name='$check_name' type='checkbox' style='float:left; margin-top:0' value='$script->handle' $cheked /> ";
							echo "<div style='overflow:auto'><b>$script->handle</b> ($script->ver)";
							if ($script->src) {
								echo "<br /><small>$script->src</small>";
							}
							if ($script->deps) {
								echo '<br /> <small style="color:#888">dependency: '.implode(', ', $script->deps).'</small>';
							}
							echo '</div></label>';
						}
						echo '</fieldset>';
					}
					else {
						echo '<i>No tracked scripts yet. Try browsing your website.</i>';
					} ?>
				</td>
			</tr>

		</table>

		<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="<?php _e('Save changes') ?>"></p>
	</form>
</div>
