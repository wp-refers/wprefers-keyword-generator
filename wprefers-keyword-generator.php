<?php
/*
Plugin Name: Wp Refers Keyword Generator
Plugin URI: https://wprefers.com/plugins/wprefers-keyword-generator
Description: Keyword Generator Tool helps you discover keyword opportunities related to your query input.
Version: 1.0.0
Author: sachinkiranti
Author URI: https://raisachin.com.np
Text Domain: wprefers-kg
Author Email: sachinkiranti@gmail.com
License:

  Copyright 2019  (sachinkiranti@gmail.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program. If not, see <http://www.gnu.org/licenses/>.

*/

defined( 'ABSPATH' ) or die( 'No direct access!' );

if ( ! function_exists('wprefers_keyword_generator_shortcode') ) :

    function wprefers_keyword_generator_shortcode ( $atts ) {
        extract( shortcode_atts(
                array(
                    'Title' => 'WP Refers Keyword Research Planner',
                ), $atts )
        );

        $file_path = dirname(__FILE__) . '/templates/wprefers-keyword-generator-frontend.php';

        ob_start();

        include($file_path);

        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

endif;

add_shortcode( 'wprefers-keyword-generator', 'wprefers_keyword_generator_shortcode' );

include 'libs/keyword-api.php';

// Script
if (! function_exists('wprefers_keyword_generator_enqueue_scripts')) :

    function wprefers_keyword_generator_enqueue_scripts() {
        wp_enqueue_script( 'wprefers-kg-script', plugin_dir_url(__FILE__).'assets/wprefers-kg-script.js', array('jquery'), null, true );
        wp_localize_script('wprefers-kg-script', "wprefers_kg_script_data", array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'action'  => 'wprefers_keyword_generator_xhr_action',
            'security' => wp_create_nonce( "wprefers-keyword-generator-xhr-nonce" )
        ));
    }

endif;
add_action( 'wp_enqueue_scripts', 'wprefers_keyword_generator_enqueue_scripts' );