<?php

if ( ! defined( 'ABSPATH' ) ) die( 'No direct access!' );

add_action("wp_ajax_wprefers_keyword_generator_xhr_action" , "wprefers_keyword_generator_xhr_action");
add_action("wp_ajax_nopriv_wprefers_keyword_generator_xhr_action" , "wprefers_keyword_generator_xhr_action");

if ( ! function_exists('wprefers_keyword_generator_xhr_action') ) :

    function wprefers_keyword_generator_xhr_action () {
        check_ajax_referer( 'wprefers-keyword-generator-xhr-nonce', 'security' );

        $keyword = sanitize_text_field($_POST['keyword']);
        $language = sanitize_text_field($_POST['language']);
        $country = sanitize_text_field($_POST['country']);

        wp_send_json(
            wprefers_keyword_generator_resolve_data(
                $keyword,
                $language,
                $country
            )
        );
        wp_die();
    }

endif;

function wprefers_keyword_generator_resolve_data ($keyword, $lang, $country) {
    $args = array(
        'user-agent'  => ''
    );

    $response = wp_remote_request(
        'http://suggestqueries.google.com/complete/search?output=firefox&client=psy-ab&gs_rn=64o&hl='.$lang.'&gl='.$country.'&q='.urlencode($keyword),
        $args
    );

    $data = $response['body'];
    $responseCode = $response['response']['code'];
    if (!empty($responseCode) && $responseCode !== 200){
        wp_send_json("Something went wrong!");
        wp_die();
    }

    $data = htmlentities($data, ENT_NOQUOTES, "ISO-8859-1");

    if (($data = json_decode($data, true)) !== null) {
        $keywords = $data[1];
        $keywordsArray = [];

        foreach ($keywords as $key => $keywordResults){
            $keywordsArray[$key] = sanitize_text_field($keywordResults[0]);
        }

    } else {
        $keywordsArray[] = 'No Keywords!';
    }
    return array(
        'html' => wprefers_keyword_generator_resolve_html_data($keywordsArray),
        'total' => count($keywordsArray)
    );
}

function wprefers_keyword_generator_resolve_html_data ($keywords) {
    $html = '';
    foreach ($keywords as $keyword) :
        $html .= '<li data-keyword="'.$keyword.'">'.$keyword.'</li>';
    endforeach;

    return $html;
}