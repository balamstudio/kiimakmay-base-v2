<?php

//enqueues our external font awesome stylesheet
function enqueue_our_required_stylesheets(){
    // Load the main stylesheet
    wp_enqueue_style( 'Divi', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style('font-awesome', 'https://cdn.jsdelivr.net/fontawesome/4.7.0/css/font-awesome.min.css');
   // wp_enqueue_style( 'icons', get_stylesheet_directory_uri() . '/style-icons.css', array( 'Divi' ) );
}
add_action('wp_enqueue_scripts','enqueue_our_required_stylesheets');

// fontawesome in admin
function fontawesome_dashboard() {
    wp_enqueue_style('fontawesome', 'https://cdn.jsdelivr.net/fontawesome/4.7.0/css/font-awesome.min.css', '', '4.7.0', 'all');
}
add_action('admin_init', 'fontawesome_dashboard');



// footer admin
function modify_footer_admin () {
  echo 'Powered by Totalplay';
}
add_filter('admin_footer_text', 'modify_footer_admin');

//custom login css
function custom_login() {
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/login/custom-style.css" />';
}
add_action('login_head', 'custom_login');

// enable bootstrap
function my_scripts_enqueue() {
    // wp_enqueue_style( 'splidecss', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.1/dist/css/splide.min.css' );
    // wp_register_script( 'splidejs', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.1/dist/js/splide.min.js', array(), NULL, true );
    wp_register_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), NULL, true );
    wp_register_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/bootstrap/3.3.7/css/bootstrap.min.css', false, NULL, 'all' );
    // wp_enqueue_script( 'splidejs' );
    // wp_enqueue_style( 'splidecss' );
    wp_enqueue_script( 'bootstrap-js' );
    wp_enqueue_style( 'bootstrap-css' );
}
add_action( 'wp_enqueue_scripts', 'my_scripts_enqueue' );

function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


add_filter('wp_handle_upload_prefilter', 'custom_upload_filter' );
function custom_upload_filter( $file ){
    $file['name'] = sanitizeTxt($file['name']);
    return $file;
}

function sanitizeTxt($cadena, $alowed = '-._', $txtCase = 'samecase', $charset = 'utf-8') { //lowercase/uppercase/samecase

// Remove multiple spac
// es
    $clean = preg_replace('/\s+/', ' ', trim(strip_tags($cadena)));
    //echo '<br />clean='.$clean;
// Remove special chars
    $lower_search = array("á", "à", "â", "ǎ", "ă", "ã", "ả", "ȧ", "ạ", "ä", "å", "ḁ", "ā", "ą", "ⱥ", "ȁ", "ấ", "ầ", "ẫ", "ẩ", "ậ", "ắ", "ằ", "ẵ", "ẳ", "ặ", "ǻ", "ǡ", "ǟ", "ǟ", "ȃ", "ɑ", "æ", "ǽ", "ǣ", "œ",
        "ḃ", "ḅ", "ḇ", "ƀ", "ɓ", "ƃ", "ᵬ",
        "ć", "ĉ", "č", "ċ", "ç", "ḉ", "ȼ", "ƈ",
        "ḋ", "ḑ", "ḍ", "ḓ", "ḏ", "đ", "ɖ", "ƌ",
        "é", "è", "ê", "ḙ", "ě", "ĕ", "ẽ", "ḛ", "ẻ", "ė", "ë", "ē", "ȩ", "ę", "ɇ", "ȅ", "ế", "ề", "ễ", "ể", "ḝ", "ḗ", "ḕ", "ȇ", "ẹ", "ệ",
        "ḟ", "ƒ",
        "ǵ", "ğ", "ĝ", "ǧ", "ġ", "ģ", "ḡ", "ǥ", "ɠ",
        "ĥ", "ȟ", "ḧ", "ḣ", "ḩ", "ḥ", "ḫ", "ħ", "ⱨ",
        "ì", "í", "ĭ", "î", "ǐ", "ï", "ḯ", "ĩ", "į", "ī", "ỉ", "ȉ", "ị", "ḭ", "ɨ",
        "ĵ", "ɉ",
        "ḱ", "ǩ", "ķ", "ḳ", "ḵ", "ƙ", "ⱪ",
        "ĺ", "ļ", "ḷ", "ḹ", "ḽ", "ḻ", "ł", "ŀ", "ƚ", "ⱡ", "ɫ",
        "ḿ", "ṁ", "ṃ",
        "ń", "ǹ", "ň", "ñ", "ṅ", "ņ", "ṇ", "ṋ", "ṉ", "ɲ", "ƞ", "ŋ",
        "ó", "ò", "ŏ", "ô", "ố", "ồ", "ỗ", "ổ", "ǒ", "ö", "ȫ", "ő", "õ", "ṍ", "ṏ", "ȭ", "ȯ", "ȱ", "ø", "ǿ", "ǫ", "ǭ", "ō", "ṓ", "ṑ", "ỏ", "ȍ", "ȏ", "ơ", "ớ", "ờ", "ỡ", "ở", "ợ", "ọ", "ộ", "ɵ", "ɔ",
        "ṕ", "ṗ", "ᵽ", "ƥ",
        "ɋ", "ƣ",
        "ŕ", "ř", "ṙ", "ŗ", "ȑ", "ȓ", "ṛ", "ṝ", "ṟ", "ɍ", "ɽ",
        "ś", "ṥ", "ŝ", "š", "ṧ", "ş", "ṣ", "ṩ", "ș", "s",
        "ť", "ṫ", "ţ", "ṭ", "ț", "ṱ", "ṯ", "ŧ", "ⱦ", "ƭ", "ʈ",
        "ú", "ù", "ŭ", "û", "ǔ", "ů", "ü", "ǘ", "ǜ", "ǚ", "ǖ", "ű", "ũ", "ṹ", "ų", "ū", "ṻ", "ủ", "ȕ", "ȗ", "ư", "ứ", "ừ", "ữ", "ử", "ự", "ụ", "ṳ", "ṷ", "ṵ", "ʉ",
        "ṽ", "ṿ", "ʋ",
        "ẃ", "ẁ", "ŵ", "ẅ", "ẇ", "ẉ", "ⱳ",
        "ẍ", "ẋ",
        "ý", "ỳ", "ŷ", "ÿ", "ỹ", "ẏ", "ȳ", "ỷ", "ỵ", "ɏ", "ƴ",
        "ź", "ẑ", "ž", "ż", "ẓ", "ẕ", "ƶ", "ȥ", "ⱬ"
    );


    $lower_replace = array("a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "ae", "ae", "ae", "oe",
        "b", "b", "b", "b", "b", "b", "b",
        "c", "c", "c", "c", "c", "c", "c", "c",
        "d", "d", "d", "d", "d", "d", "d", "d",
        "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e",
        "f", "f",
        "g", "g", "g", "g", "g", "g", "g", "g", "g",
        "h", "h", "h", "h", "h", "h", "h", "h", "h",
        "i", "i", "i", "i", "i", "i", "i", "i", "i", "i", "i", "i", "i", "i", "i",
        "j", "j",
        "k", "k", "k", "k", "k", "k", "k",
        "l", "l", "l", "l", "l", "l", "l", "l", "l", "l", "l",
        "m", "m", "m",
        "n", "n", "n", "n", "n", "n", "n", "n", "n", "n", "n", "n",
        "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o",
        "p", "p", "p", "p",
        "q", "q",
        "r", "r", "r", "r", "r", "r", "r", "r", "r", "r", "r",
        "s", "s", "s", "s", "s", "s", "s", "s", "s", "s",
        "t", "t", "t", "t", "t", "t", "t", "t", "t", "t", "t",
        "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u",
        "v", "v", "v",
        "w", "w", "w", "w", "w", "w", "w",
        "x", "x",
        "y", "y", "y", "y", "y", "y", "y", "y", "y", "y", "y",
        "z", "z", "z", "z", "z", "z", "z", "z", "z"
    );

    $lower_search_plus = array("ɗ", "ᵭ", "ᶁ", "ᶑ", "ȡ", "ȡ", "ᶒ", "ᵮ", "ᶂ", "ᶃ", "ᵫ", "Ȋ", "ǰ", "ʝ", "ɟ", "ʄ", "ᶄ", "ɬ", "ᶅ", "ᵯ", "ᶆ", "ɱ", "ᵰ", "ᶇ", "ɳ", "ȵ", "ᵱ", "ᶈ", "ʠ", "ᵲ", "ᶉ", "ɼ", "ɾ", "ᵳ", "ẛ", "ᵴ", "ᶊ", "ʂ", "ȿ", "ṡ", "ẗ", "ᵵ", "ƫ", "ȶ", "ᵾ", "ᶙ", "ᶌ", "ⱱ", "ⱴ", "ẘ", "ᶍ", "ʏ", "ẙ", "ᵶ", "ᶎ", "ʐ", "ʑ", "ɀ"
    );
    $lower_replace_plus = array("d", "d", "d", "d", "d", "d", "e", "f", "f", "g", "ue", "i", "j", "j", "j", "j", "k", "l", "l", "m", "m", "m", "n", "n", "n", "n", "p", "p", "q", "r", "r", "r", "r", "r", "r", "s", "s", "s", "s", "s", "t", "t", "t", "t", "u", "u", "v", "v", "v", "w", "x", "y", "y", "z", "z", "z", "z", "z"
    );

    $upper_search = array("Á", "À", "Â", "Ǎ", "Ă", "Ã", "Ả", "Ȧ", "Ạ", "Ä", "Å", "Ḁ", "Ā", "Ą", "Ⱥ", "Ȁ", "Ấ", "Ầ", "Ẫ", "Ẩ", "Ậ", "Ắ", "Ằ", "Ẵ", "Ẳ", "Ặ", "Ǻ", "Ǡ", "Ǟ", "Ȁ", "Ȃ", "Ɑ", "Æ", "Ǽ", "Ǣ", "Œ",
        "Ḃ", "Ḅ", "Ḇ", "Ƀ", "Ɓ", "Ƃ", "ß",
        "Ć", "Ĉ", "Č", "Ċ", "Ç", "Ḉ", "Ȼ", "Ƈ",
        "Ḋ", "Ḑ", "Ḍ", "Ḓ", "Ḏ", "Ð", "Ɗ", "Ƌ",
        "É", "È", "Ê", "Ḙ", "Ě", "Ĕ", "Ẽ", "Ḛ", "Ẻ", "Ė", "Ë", "Ē", "Ȩ", "Ę", "Ɇ", "Ȅ", "Ế", "Ề", "Ễ", "Ể", "Ḝ", "Ḗ", "Ḕ", "Ȇ", "Ẹ", "Ệ",
        "Ḟ", "Ƒ",
        "Ǵ", "Ğ", "Ĝ", "Ǧ", "Ġ", "Ģ", "Ḡ", "Ǥ", "Ɠ",
        "Ĥ", "Ȟ", "Ḧ", "Ḣ", "Ḩ", "Ḥ", "Ḫ", "Ħ", "Ⱨ",
        "Ì", "Í", "Ĭ", "Î", "Ǐ", "Ï", "Ḯ", "Ĩ", "Į", "Ī", "Ỉ", "Ȉ", "Ị", "Ḭ", "Ɨ",
        "Ĵ", "Ɉ",
        "Ḱ", "Ǩ", "Ķ", "Ḳ", "Ḵ", "Ƙ", "Ⱪ",
        "Ĺ", "Ļ", "Ḷ", "Ḹ", "Ḽ", "Ḻ", "Ł", "Ŀ", "Ƚ", "Ⱡ", "Ɫ",
        "Ḿ", "Ṁ", "Ṃ",
        "Ń", "Ǹ", "Ň", "Ñ", "Ṅ", "Ņ", "Ṇ", "Ṋ", "Ṉ", "Ɲ", "Ƞ", "Ŋ",
        "Ó", "Ò", "Ŏ", "Ô", "Ố", "Ồ", "Ỗ", "Ổ", "Ǒ", "Ö", "Ȫ", "Ő", "Õ", "Ṍ", "Ṏ", "Ȭ", "Ȯ", "Ȱ", "Ø", "Ǿ", "Ǫ", "Ǭ", "Ō", "Ṓ", "Ṑ", "Ỏ", "Ȍ", "Ȏ", "Ơ", "Ớ", "Ờ", "Ỡ", "Ở", "Ợ", "Ọ", "Ộ", "Ɵ", "Ɔ",
        "Ṕ", "Ṗ", "Ᵽ", "Ƥ",
        "Ɋ", "Ƣ",
        "Ŕ", "Ř", "Ṙ", "Ŗ", "Ȑ", "Ȓ", "Ṛ", "Ṝ", "Ṟ", "Ɍ", "Ɽ",
        "Ś", "Ṥ", "Ŝ", "Š", "Ṧ", "Ş", "Ṣ", "Ṩ", "Ș", "S",
        "Ť", "Ṫ", "Ţ", "Ṭ", "Ț", "Ṱ", "Ṯ", "Ŧ", "Ⱦ", "Ƭ", "Ʈ",
        "Ú", "Ù", "Ŭ", "Û", "Ǔ", "Ů", "Ü", "Ǘ", "Ǜ", "Ǚ", "Ǖ", "Ű", "Ũ", "Ṹ", "Ų", "Ū", "Ṻ", "Ủ", "Ȕ", "Ȗ", "Ư", "Ứ", "Ừ", "Ữ", "Ử", "Ự", "Ụ", "Ṳ", "Ṷ", "Ṵ", "Ʉ",
        "Ṽ", "Ṿ", "Ʋ",
        "Ẃ", "Ẁ", "Ŵ", "Ẅ", "Ẇ", "Ẉ", "Ⱳ",
        "Ẍ", "Ẋ",
        "Ý", "Ỳ", "Ŷ", "Ÿ", "Ỹ", "Ẏ", "Ȳ", "Ỷ", "Ỵ", "Ɏ", "Ƴ",
        "Ź", "Ẑ", "Ž", "Ż", "Ẓ", "Ẕ", "Ƶ", "Ȥ", "Ⱬ"
    );
    $upper_replace = array("A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "AE", "AE", "AE", "AE",
        "B", "B", "B", "B", "B", "B", "B",
        "C", "C", "C", "C", "C", "C", "C", "C",
        "D", "D", "D", "D", "D", "D", "D", "D",
        "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E",
        "F", "F",
        "G", "G", "G", "G", "G", "G", "G", "G", "G",
        "H", "H", "H", "H", "H", "H", "H", "H", "H",
        "I", "I", "I", "I", "I", "I", "I", "I", "I", "I", "I", "I", "I", "I", "I",
        "J", "J",
        "K", "K", "K", "K", "K", "K", "K",
        "L", "L", "L", "L", "L", "L", "L", "L", "L", "L", "L",
        "M", "M", "M",
        "N", "N", "N", "N", "N", "N", "N", "N", "N", "N", "N", "N",
        "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O",
        "P", "P", "P", "P",
        "Q", "Q",
        "R", "R", "R", "R", "R", "R", "R", "R", "R", "R", "R",
        "S", "S", "S", "S", "S", "S", "S", "S", "S", "S",
        "T", "T", "T", "T", "T", "T", "T", "T", "T", "T", "T",
        "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U",
        "V", "V", "V",
        "W", "W", "W", "W", "W", "W", "W",
        "X", "X",
        "Y", "Y", "Y", "Y", "Y", "Y", "Y", "Y", "Y", "Y", "Y",
        "Z", "Z", "Z", "Z", "Z", "Z", "Z", "Z", "Z"
    );


    switch ($txtCase) {
        case 'lowercase':
            // echo '<br />lowercase';
            $clean = str_replace($upper_search, $lower_search, $clean);
            //echo '<br />caseLow ='.$clean;
            $clean = str_replace($lower_search, $lower_replace, $clean);
            //echo '<br />clean low normal ='.$clean;
            $clean = str_replace($lower_search_plus, $lower_replace_plus, $clean);
            //echo '<br />clean low plus ='.$clean;
            $clean = strtolower($clean);
            //echo '<br />clean all low ='.$clean;

            break;

        case 'uppercase':

            $clean = str_replace($lower_search, $upper_search, $clean);
            //echo '<br />caseUp ='.$clean;
            $clean = str_replace($upper_search, $upper_replace, $clean);
            //echo '<br />clean up normal ='.$clean;
            $clean = strtoupper($clean);
            //echo '<br />clean all up ='.$clean;

            break;

        case 'samecase':

            $clean = str_replace($lower_search, $lower_replace, $clean);
            //echo '<br />clean low normal ='.$clean;
            $clean = str_replace($lower_search_plus, $lower_replace_plus, $clean);
            //echo '<br />clean low plus ='.$clean;
            $clean = str_replace($upper_search, $upper_replace, $clean);
            //echo '<br />clean up normal ='.$clean;

            break;
    }

// IMPORTANT set and cofigure setlocale(LC_ALL, $zit_lang.'_'.strtoupper($zit_lang).'.UTF8');
    // $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $clean);
    //echo '<br />clean iconv='.$clean;
// Replace spaces
    $clean = preg_replace('/\s/', '-', $clean);
    //echo '<br />clean='.$clean;
// Remove other characters
    // challet : I modified the replacement to follow former rules used to generate slugs in SFR JT
    // it was [^0-9a-z-_] , replacing by ''

    switch ($txtCase) {
        case 'lowercase':
            $clean = preg_replace('`[^0-9a-z' . $alowed . ']`', '', $clean);
            break;
        case 'uppercase':
            $clean = preg_replace('`[^0-9A-Z' . $alowed . ']`', '', $clean);
            break;
        default:
            $clean = preg_replace('`[^0-9a-zA-Z' . $alowed . ']`', '', $clean);
            break;
    }
    //echo '<br />'.$txtCase.' ->title_nochars='.$clean;
// Remove double --
    $clean = preg_replace('`(--)+`', '-', $clean);
    //echo '<br />clean double -- ='.$clean;
// Remove double __
    $clean = preg_replace('`(__)+`', '_', $clean);
    //echo '<br />clean double __ ='.$clean;
    //echo '<br />final_nochange ='.$clean;

    return $clean;
}

// include Divi Builder in all post type
function my_et_builder_post_types( $post_types ) {

$post_types = get_post_types();

	if ( $post_types ) { // If there are any custom public post types.
	 
	 	foreach ( $post_types as $post_type ) {
		 $post_types[] ='$post_type';
		
		return $post_types;
		}
	}
}
add_filter( 'et_builder_post_types', 'my_et_builder_post_types' );


//remove original Divi footer credits
function et_get_original_footer_credits() {
    $dsdate = date("Y");
    return sprintf( __( '%2$s© %1$s | Todos los derechos reservados.', 'Divi' ), get_bloginfo('name'), $dsdate );
}


// ADMIN MENU

add_action('admin_head', 'custom_admin_css');

function custom_admin_css() {
    echo '<link rel="stylesheet" href="/wp-content/themes/Totalplay/admin_style.css" type="text/css" media="all" />';
}

/*

//  Woocommerce

*/






/* --------------------------------------*/
//Show total discount in cart

function zonait_wc_discount_total() {

    global $woocommerce;

    // Get cart contents

    $cart_subtotal = $woocommerce->cart->cart_contents;

    // Set discount variable to 0 so it is available outside the loop
    $discount_total = 0;

    // Loop through the cart contents to get the product IDs
    foreach ($woocommerce->cart->cart_contents as $product_data) {
//        var_dump($product_data);
        // Check if the product in the basket is a variation if it is set the variation ID for product content else get the simple product ID

        if ($product_data['variation_id'] > 0) {
            $product = wc_get_product( $product_data['variation_id'] );
        } else {
            $product = wc_get_product( $product_data['product_id'] );
        }

        // Now we have the data we need calculate the discount price minus the sale price from the regular and times it by its quantity, and add it to the discount total
        // Added "if" to only run this when there is a discount @ RMelogli_LEnev_12May2016
        // Added "isset" to include sale prices == 0 @ RMelogli_2Nov2016

        if ( isset($product->sale_price) && $product->sale_price > 0 ) {
            $discount = ($product->regular_price - $product->sale_price) * $product_data['quantity'];
            $discount_total += $discount;
        }


    }

    // Display our discount on the frontend as a formatted number and get the woocommerce base currency
    // Added "if" to only display this when there is a discount @ RMelogli_LEnev_12May2016
    // Added also coupon amount @ RMelogli_24May2016

    if ( $discount_total > 0 ) {
        echo '<tr class="cart-discount">
    <th>'. __( 'You Saved', 'woocommerce' ) .'</th>
    <td data-title=" '. __( 'You Saved', 'woocommerce' ) .' ">'
            . wc_price($discount_total+$woocommerce->cart->discount_cart) .'</td>
    </tr>';
    }

}

// Hook our values to the Basket and Checkout pages
add_action( 'woocommerce_cart_totals_after_order_total', 'zonait_wc_discount_total');
add_action( 'woocommerce_review_order_after_order_total', 'zonait_wc_discount_total');

/*
function sww_add_seals_to_checkout() {
    echo '<div class="aligncenter" style="text-align: center;">
    <span id="siteseal"><img class="details-image" src="https://promos.naturvital.ie/wp-content/uploads/2020/10/paymentbanner_2.jpg" draggable="false" alt="100% SECURE PAYMENTS"></span>
    </div>';
}
add_action( 'woocommerce_checkout_order_review', 'sww_add_seals_to_checkout' );
add_action( 'woocommerce_proceed_to_checkout', 'sww_add_seals_to_checkout', 30 );
*/


// Remove Additional Information Tab WooCommerce
/*
add_filter( 'woocommerce_product_tabs', 'remove_info_tab', 98);
function remove_info_tab($tabs) {

    unset($tabs['additional_information']);

    return $tabs;
}
*/

// Remove Reviews Tab WooCommerce
/*
add_filter( 'woocommerce_product_tabs', 'remove_reviews_tab', 98);
function remove_reviews_tab($tabs) {

    unset($tabs['reviews']);

    return $tabs;
}
*/

//force meta description in the pag for SEO
add_filter( 'wpseo_metadesc', 'sm_divi_builder_content_wpseo_metadesc', 10, 1 );
function sm_divi_builder_content_wpseo_metadesc( $desc ) {
    // Get $post if you're inside a function
    global $post;
    $post_type = get_post_type( $post );
    if ($post_type == "page") {
        //get_meta_description
        $desc = get_post_meta($post->ID, '_yoast_wpseo_metadesc', true);
        if($desc=="")
        {
            if ( has_excerpt( $post->ID ) ) {
                // This post has excerpt
                $desc = $post->post_excerpt;
            } else {
                // This post has no excerpt
                $desc = trim(strip_tags(preg_replace('/\[\/?et_pb.*?\]/', '', $post->post_content)));
                $desc = substr($desc,0,155);
            }
        }
    }
    return $desc;
}


function custom_login_logo() {
    echo '<style type ="text/css">.login h1 a { background-image:url('.get_stylesheet_directory_uri().'/images/logo-totalplay.png);height:70px;width:300px;background-size:auto;background-position:center bottom; }</style>';
}

add_action('login_head', 'custom_login_logo');

add_filter('admin_title', 'my_admin_title', 10, 2);

function my_admin_title($admin_title, $title)
{
    return get_bloginfo('name').' &bull; '.$title;
}


add_filter('display_post_states', '__return_false');



if ( ! function_exists( 'et_show_cart_total' ) ) {
	function et_show_cart_total( $args = array() ) {
		if ( ! class_exists( 'woocommerce' ) || ! WC()->cart ) {
			return;
		}

		$defaults = array(
			'no_text' => false,
		);

		$args = wp_parse_args( $args, $defaults );

		$items_number = WC()->cart->get_cart_contents_count();

		$url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : WC()->cart->get_cart_url();

		printf(
			'<a href="%1$s" class="et-cart-info">
				<span>%2$s</span>
			</a>',
			esc_url( $url ),
			( ! $args['no_text']
				? esc_html( sprintf(
					_nx( '%1$s Elemento', '%1$s Elementos', $items_number, 'WooCommerce items number', 'Divi' ),
					number_format_i18n( $items_number )
				) )
				: ''
			)
		);
		
	}
}

// Actualiza mini carrito
function es_fresh_cart_fragments($fragments)
{
    ob_start();
    et_show_cart_total();
    $cart_total_html = ob_get_clean();
 
    $fragments['.et-cart-info'] = $cart_total_html;
 
    return $fragments;
}
 
add_filter('woocommerce_add_to_cart_fragments', 'es_fresh_cart_fragments', 10, 1);


