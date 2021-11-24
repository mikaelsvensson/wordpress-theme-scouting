<?php
//Original Framework http://theundersigned.net/2006/06/wordpress-how-to-theme-options/ 
//Updated and added additional options by Jeremy Clark
//http://clark-technet.com
//Updated and added additional options by Mike Pippin -9/11/2009
//http://split-visionz.net/2009/wordpress-theme-options-framework-updated/

$themename = THEME_NAME_PRETTY; //This should be the full name of your theme
$shortname = THEME_NAME; //This should be a shortened version of your theme name
$entry_metadata_optionvalues = array(
        NACKASMU_OPTIONVALUE_ENTRYMETADATA_AUTHOR ,
        NACKASMU_OPTIONVALUE_ENTRYMETADATA_PUBLISHINGDATE ,
        NACKASMU_OPTIONVALUE_ENTRYMETADATA_CATSANDTAGS);
$entry_utilities_optionvalues = array(
		NACKASMU_OPTIONVALUE_ENTRYUTILITIES_PRINTLINK ,
		NACKASMU_OPTIONVALUE_ENTRYUTILITIES_BOOKMARKPERMALINK ,
		NACKASMU_OPTIONVALUE_ENTRYUTILITIES_COMMENTANDPINGTRACKBACKLINKS ,
		NACKASMU_OPTIONVALUE_ENTRYUTILITIES_EDITLINK);

$options_configuration = array (
    array(  "name" => "Include comments when printing",
            "desc" => "",
            "id" => NACKASMU_OPTION_PRINTCOMMENTS,
            "type" => "checkbox",
            "std" => "Yes",
            "options" => array("Yes")
    ),
    array(  "name" => "Entry meta data",
            "desc" => "",
            "id" => NACKASMU_OPTION_ENTRYMETADATA,
            "type" => "checkbox",
            "std" => implode( ',' , $entry_metadata_optionvalues),
            "options" => $entry_metadata_optionvalues
    ),
    array(  "name" => "Entry utilities",
            "desc" => "",
            "id" => NACKASMU_OPTION_ENTRYUTILITIES,
            "type" => "checkbox",
            "std" => implode( ',' , $entry_utilities_optionvalues),
            "options" => $entry_utilities_optionvalues
    ),
/*
    array(  "name" => "Radio Selection Set",
	        "desc" => "This is a descriptions",
            "id" => $shortname."_radio",
            "type" => "radio",
            "std" => "3",
            "options" => array("3", "2", "1")
	),
    array(  "name" => "Text Box",
	        "desc" => "This is a descriptions",
            "id" => $shortname."_text_box",
            "std" => "Some Default Text",
            "type" => "text"
	),
    array(  "name" => "Bigger Text Box",
	        "desc" => "This is a descriptions",
            "id" => $shortname."_bigger_box",
            "std" => "Default Text",
            "type" => "textarea"
	),
    array(  "name" => "Dropdown Selection Menu",
	        "desc" => "This is a descriptions",
            "id" => $shortname."_dropdown_menu",
            "type" => "select",
            "std" => "Default",
            "options" => array("Default", "Option 1", "Option 2")
	),
    array(  "name" => "Checkbox selection set",
	        "desc" => "This is a descriptions",
            "id" => $shortname."_checkbox",
            "type" => "checkbox",
            "std" => "Default",
            "options" => array("Default", "Option 1", "Option 2")
	),
    array(  "name" => "Multiple selection box",
	        "desc" => "This is a descriptions",
            "id" => $shortname."_multi_select",
            "type" => "multiselect",
            "std" => "Default",
            "options" => array("Defaults", "Option 1s", "Option 2s")
	)
	*/
);

function nackasmu_add_options() {
	global $themename, $shortname, $options_configuration;
	foreach ($options_configuration as $value) {
		$key = $value['id'];
		$val = $value['std'];
		if( $existing = get_option($key)){ 	//This is useful if you've used a previous version that added seperate values to wp_options
			$new_options[$key] = $existing; //This will add the value to the array
			delete_option($key); 		//This deletes the old entry and cleans up the wp_option table
		} else {
			$new_options[$key] = $val;
			delete_option($key);
		}
	}
	add_option($shortname.'_options', $new_options );
}

function nackasmu_init_options() {				//This is for theme init
	global $shortname;
	$check = get_option($shortname.'_activation_check');
	if ( $check != "set" ) {
		nackasmu_add_options();			//This runs the theme init fuction specified eariler
   		add_option($shortname.'_activation_check', "set");	// Add marker so it doesn't run in future
  	}
}

$nackasmu_options = NULL;
function nackasmu_get_rawoptionvalues()
{
    global $nackasmu_options, $shortname;
    if ( !isset($nackasmu_options) ) {
        $nackasmu_options = get_option( $shortname . '_options' );
    }
    return $nackasmu_options;
}

function nackasmu_option_is_true( $option_id ) {
    $value = nackasmu_get_option( $option_id );
    if ( is_array( $value ) ) {
        return in_array( "Yes" , $value) ||
                in_array( "yes",  $value) ||
                in_array( "true",  $value);
    } else {
        return $value == true ||
                strtolower($value) == "yes" ||
                strtolower($value) == "true";
    }
}
function nackasmu_multichoiceoption_is_set( $option_id , $option_value ) {
    $values = nackasmu_get_option( $option_id );
    if ( is_array( $values ) ) {
        return in_array( $option_value , $values );
    } else {
        return false;
    }
}
function nackasmu_option_is_multichoice( $option_id ) {
    global $options_configuration;
    foreach ($options_configuration as $value) {
        if ( $value['id'] == $option_id ) {
	        return $value['type'] === "checkbox" || $value['type'] === "multiselect";
        }
    }
    return false;
}

function nackasmu_get_option( $option_id ) {
    $settings = nackasmu_get_rawoptionvalues();
    if( nackasmu_option_is_multichoice( $option_id ) ) {
        return explode( ',' , $settings[$option_id] );
    } else {
        return $settings[$option_id];
    }
}

add_action('wp_head', 'nackasmu_init_options');
add_action('admin_head', 'nackasmu_init_options');

function nackasmu_add_admin() {
    global $themename, $shortname, $options_configuration;
	$settings = get_option($shortname.'_options');
    if ( $_GET['page'] == basename(__FILE__) ) {
        if ( 'save' == $_REQUEST['action'] ) {
			foreach ($options_configuration as $value) {
				if(($value['type'] === "checkbox" or $value['type'] === "multiselect" ) and is_array($_REQUEST[ $value['id'] ])) {
				    $_REQUEST[ $value['id'] ]=implode(',',$_REQUEST[ $value['id'] ]); //This will take from the array and make one string
				}
				$key = $value['id'];
				$val = $_REQUEST[$key];
				$settings[$key] = $val;
			}
			update_option($shortname.'_options', $settings);
			header("Location: themes.php?page=controlpanel.php&saved=true");
            die;
        } else if( 'reset' == $_REQUEST['action'] ) {
			foreach ($options_configuration as $value) {
				$key = $value['id'];
				$std = $value['std'];
				$new_options[$key] = $std;
			}
            update_option($shortname.'_options', $new_options );
            header("Location: themes.php?page=controlpanel.php&reset=true");
            die;
        }
    }
    add_theme_page($themename." Theme Options", $themename." Theme Options", 'edit_themes', basename(__FILE__), 'nackasmu_admin');

}

function nackasmu_is_setting_enabled($section_id, $setting_id) {
    $value = get_theme_mod($setting_id);
    $legacy_value = nackasmu_multichoiceoption_is_set( $section_id, constant('NACKASMU_OPTIONVALUE_'.strtoupper($setting_id)) );
    return $value || $legacy_value;
}

function nackasmu_customize_register_boolean_setting( 
    $wp_customize, 
    $setting_id,
    $section_id,
    $name
) {
    $default = nackasmu_is_setting_enabled($section_id, $setting_id);

    $wp_customize->add_setting( $setting_id , array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'default' => $default,
        'transport' => 'refresh',
        'sanitize_callback' => '',
        'sanitize_js_callback' => '',
      ) );

    $wp_customize->add_control( $setting_id, array(
        'type' => 'checkbox',
        'priority' => 0,
        'section' => $section_id,
        'label' => $name,
        'active_callback' => 'is_front_page',
      ) );
}

function nackasmu_customize_register( $wp_customize ) {

    foreach (array (
        NACKASMU_OPTION_ENTRYMETADATA => 'Post Metadata',
        NACKASMU_OPTION_ENTRYUTILITIES => 'Post Utilities'
    ) as $key => $label) { 
        $wp_customize->add_section( $key, array(
            'title' => __( $label ),
            // 'description' => __( 'Add custom CSS here' ),
            'panel' => '', // Not typically needed.
            'priority' => 100,
            'capability' => 'edit_theme_options',
            'theme_supports' => '', // Rarely needed.
        ) );
    }
    
    nackasmu_customize_register_boolean_setting( $wp_customize, 'entrymetadata_author', NACKASMU_OPTION_ENTRYMETADATA, "Author");
    nackasmu_customize_register_boolean_setting( $wp_customize, 'entrymetadata_publishingdate', NACKASMU_OPTION_ENTRYMETADATA, "Publishing date");
    nackasmu_customize_register_boolean_setting( $wp_customize, 'entrymetadata_editlink', NACKASMU_OPTION_ENTRYMETADATA, "Edit link");
    nackasmu_customize_register_boolean_setting( $wp_customize, 'entrymetadata_catsandtags', NACKASMU_OPTION_ENTRYMETADATA, "Categories and tags");
    nackasmu_customize_register_boolean_setting( $wp_customize, 'entryutilities_printlink', NACKASMU_OPTION_ENTRYUTILITIES, "Print link");
    nackasmu_customize_register_boolean_setting( $wp_customize, 'entryutilities_bookmarkpermalink', NACKASMU_OPTION_ENTRYUTILITIES, "Bookmark permalink");
    nackasmu_customize_register_boolean_setting( $wp_customize, 'entryutilities_commentandpingtrackbacklinks', NACKASMU_OPTION_ENTRYUTILITIES, "Comment and ping/trackback links");
    nackasmu_customize_register_boolean_setting( $wp_customize, 'entryutilities_editlink', NACKASMU_OPTION_ENTRYUTILITIES, "Edit link");
}

add_action( 'customize_register', 'nackasmu_customize_register' );

function nackasmu_admin() {

    global $themename, $shortname, $options_configuration;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p>Settings for theme <strong>'.$themename.' have been saved.</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p>Settings for theme <strong>'.$themename.' have been reset.</strong></p></div>';

?>
<div class="wrap">
<h2>Configuration For Theme <?php echo $themename; ?></h2>
<form method="post">
    <table class="form-table">
        <tbody>
	<?php
	$settings = get_option( $shortname.'_options' );
	foreach ( $options_configuration as $value ) {
		$id = $value['id'];
		$std = $value['std'];

		echo '<tr valign="top">';
		echo '<th scope="row">';
		echo $value['name'];
		echo '</th>';
		echo '<td>';

		if ($value['type'] == "text") { ?>
	        <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( $settings[$id] != "") { echo $settings[$id]; } else { echo $value['std']; } ?>" size="40" />
	<?php } elseif ($value['type'] == "select") { ?>
	            <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
	                <?php foreach ($value['options'] as $option) { ?>
	                <option<?php if ( $settings[$id] == $option) { echo ' selected="selected"'; }?>><?php echo $option; ?></option>
	                <?php } ?>
	            </select>
	<?php } elseif ($value['type'] == "multiselect") { ?>
	            <select  multiple="multiple" size="3" name="<?php echo $value['id']; ?>[]" id="<?php echo $value['id']; ?>" style="height:50px;">
	                <?php $ch_values = explode(',',$settings[$id] ); foreach ($value['options'] as $option) { ?>
	                <option<?php if ( in_array($option,$ch_values)) { echo ' selected="selected"'; }?> value="<?php echo $option; ?>"><?php echo $option; ?></option>
	                <?php } ?>
	            </select>
	<?php } elseif ($value['type'] == "radio") { ?>
            <fieldset>
			<?php foreach ($value['options'] as $option) { ?>
				<label><input name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php echo $option; ?>" <?php if ( $settings[$id] == $option) { echo 'checked'; } ?>/><?php echo $option; ?></label><br />
			<?php } ?>
            </fieldset>
	<?php } elseif ($value['type'] == "textarea") { ?>
	            <textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="40" rows="5"/><?php if ( $settings[$id] != "") { echo $settings[$id]; } else { echo $value['std']; } ?></textarea>
	<?php } elseif ($value['type'] == "checkbox") { ?>
			<?php
			$ch_values = explode(',' , $settings[$id]);
			foreach ($value['options'] as $option) { ?>
			<label><input name="<?php echo $value['id']; ?>[]" type="<?php echo $value['type']; ?>" value="<?php echo $option; ?>" <?php if ( in_array($option,$ch_values)) { echo 'checked'; } ?>/><?php echo $option; ?></label><br />
	<?php }
	    }
        if ( isset($value['desc']) ) {
            echo '<span class="description">'.$value['desc'].'</span>';
        }
        echo '</td>';
        echo '</tr>';
	}//End of foreach loop
	?>
        </tbody>
    </table>
	<p class="submit">
		<input name="save" type="submit" value="Save changes" />
		<input type="hidden" name="action" value="save" />
	</p>
	</form>
	<form method="post">
		<p class="submit">
			<input name="reset" type="submit" value="Reset" />
			<input type="hidden" name="action" value="reset" />
		</p>
	</form>
<h2>Preview (updated when options are saved)</h2>
<iframe src="../?preview=true" width="100%" height="600" ></iframe>
<h4>Theme Option page for <?php echo $themename; ?>&nbsp; | &nbsp; Framework by <a href="http://clark-technet.com/" title="Jeremy Clark">Jeremy Clark</a></h4>
<?php
} 	//End Tag for nackasmu_admin()

add_action('admin_menu', 'nackasmu_add_admin');
?>
