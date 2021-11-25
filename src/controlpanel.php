<?php
function nackasmu_is_setting_enabled($section_id, $setting_id) {
    return get_theme_mod($setting_id);
}

function nackasmu_customize_register_boolean_setting( 
    $wp_customize, 
    $section_id,
    $setting_id,
    $name,
    $default = false
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
    
    nackasmu_customize_register_boolean_setting( $wp_customize, NACKASMU_OPTION_ENTRYMETADATA, 'entrymetadata_author', "Author");
    nackasmu_customize_register_boolean_setting( $wp_customize, NACKASMU_OPTION_ENTRYMETADATA, 'entrymetadata_publishingdate', "Publishing date");
    nackasmu_customize_register_boolean_setting( $wp_customize, NACKASMU_OPTION_ENTRYMETADATA, 'entrymetadata_editlink', "Edit link");
    nackasmu_customize_register_boolean_setting( $wp_customize, NACKASMU_OPTION_ENTRYMETADATA, 'entrymetadata_catsandtags', "Categories and tags");

    nackasmu_customize_register_boolean_setting( $wp_customize, NACKASMU_OPTION_ENTRYUTILITIES, 'entryutilities_printlink', "Print link");
    nackasmu_customize_register_boolean_setting( $wp_customize, NACKASMU_OPTION_ENTRYUTILITIES, 'entryutilities_bookmarkpermalink', "Bookmark permalink");
    nackasmu_customize_register_boolean_setting( $wp_customize, NACKASMU_OPTION_ENTRYUTILITIES, 'entryutilities_commentandpingtrackbacklinks', "Comment and ping/trackback links");
    nackasmu_customize_register_boolean_setting( $wp_customize, NACKASMU_OPTION_ENTRYUTILITIES, 'entryutilities_editlink', "Edit link");
    nackasmu_customize_register_boolean_setting( $wp_customize, NACKASMU_OPTION_ENTRYUTILITIES, 'entryutilities_printcomments', "Include comments when printing");
    nackasmu_customize_register_boolean_setting( $wp_customize, NACKASMU_OPTION_ENTRYUTILITIES, 'entryutilities_breadcrumbs', "Show breadcrumbs on pages", true);
}

add_action( 'customize_register', 'nackasmu_customize_register' );
?>
