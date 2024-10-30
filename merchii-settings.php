<div class="wrap">
	<?php if ($_GET['settings-updated']) { ?>
		<div id="message" class="updated fade" style="margin: 15px 0 10px;"><p>Your settings have been <strong>saved</strong>.</p></div>
	<?php } ?>

	 <h2> Merchii Plugin</h2>

   <form method="post" action="options.php" id="merchii-setting-form">
    <?php settings_fields( 'merchii-group' ); ?>
    <?php do_settings_sections( 'merchii-group' ); ?>
  
   
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><b>Your Merchii Site ID :</b></th>
        <td><input type="text" id="merchii-input" name="merchii_id" value="<?php echo (get_option('merchii_id')); ?>" style="width:150px;"/></td>
        </tr>
    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>

    <!-- <?php submit_button(); ?> -->

   </form>
</div>


