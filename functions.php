<?php

define('TM_DIR', get_template_directory(__FILE__));
define('TM_URL', get_template_directory_uri(__FILE__));

require_once TM_DIR . '/lib/Parser.php';

function add_style(){
    wp_enqueue_style( 'my-bootstrap-extension', get_template_directory_uri() . '/css/bootstrap.css', array(), '1');
    wp_enqueue_style( 'flipclock', get_template_directory_uri() . '/css/flipclock.css', array('my-bootstrap-extension'), '1');    
    wp_enqueue_style( 'font-ewesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', array('my-bootstrap-extension'), '1');
    wp_enqueue_style( 'my-styles', get_template_directory_uri() . '/css/style.css', array('my-bootstrap-extension'), '1');
    wp_enqueue_style( 'my-sass', get_template_directory_uri() . '/sass/style.css', array('my-bootstrap-extension'), '1');
    wp_enqueue_style( 'fotorama', get_template_directory_uri() . '/css/fotorama.css', array('my-bootstrap-extension'), '1');
    wp_enqueue_style( 'slick-css', '//cdn.jsdelivr.net/jquery.slick/1.5.7/slick.css', array(), '1');
    wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/css/slick-theme.css', array(), '1');
    wp_enqueue_style( 'formstyler-style', get_template_directory_uri() . '/css/jquery.formstyler.css', array(), '1');
}

function add_script(){
    wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery-2.1.3.min.js', array(), '1');
    wp_enqueue_script( 'jq', 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js', array(), '1');
    wp_enqueue_script( 'my-bootstrap-extension', get_template_directory_uri() . '/js/bootstrap.js', array(), '1');
    wp_enqueue_script( 'flipclock_js', get_template_directory_uri() . '/js/flipclock.js', array(), '1', true);
    wp_enqueue_script( 'my-script', get_template_directory_uri() . '/js/script.js', array(), '1');
    wp_enqueue_script( 'fotorama-js', get_template_directory_uri() . '/js/fotorama.js', array(), '1');
    wp_enqueue_script( 'slick-js', '//cdn.jsdelivr.net/jquery.slick/1.5.7/slick.min.js', array(), '1');
    wp_enqueue_script( 'formstyler', get_template_directory_uri() . '/js/jquery.formstyler.js', array(), '1');
    wp_localize_script( 'my-script', 'img',
        array(
            'url' => get_template_directory_uri().'/img/',
            'act' => admin_url('admin-ajax.php')
        )
    );
    wp_localize_script('my-script', 'myajax',
        array(
            'url' => admin_url('admin-ajax.php')
        )
    );
}

function add_admin_script(){
    wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery-2.1.3.min.js', array(), '1');
    wp_enqueue_script('admin',get_template_directory_uri() . '/js/admin.js', array(), '1');
    wp_enqueue_style( 'my-bootstrap-extension-admin', get_template_directory_uri() . '/css/bootstrap.css', array(), '1');
    wp_enqueue_script( 'my-bootstrap-extension', get_template_directory_uri() . '/js/bootstrap.js', array(), '1');
    wp_enqueue_style( 'my-style-admin', get_template_directory_uri() . '/css/admin.css', array(), '1');
}

add_action('admin_enqueue_scripts', 'add_admin_script');
add_action( 'wp_enqueue_scripts', 'add_style' );
add_action( 'wp_enqueue_scripts', 'add_script' );

function prn($content) {
    echo '<pre style="background: lightgray; border: 1px solid black; padding: 2px">';
    print_r ( $content );
    echo '</pre>';
}

function my_pagenavi() {
    global $wp_query;

    $big = 999999999; // уникальное число для замены

    $args = array(
        'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) )
    ,'format' => ''
    ,'current' => max( 1, get_query_var('paged') )
    ,'total' => $wp_query->max_num_pages
    );

    $result = paginate_links( $args );

    // удаляем добавку к пагинации для первой страницы
    $result = str_replace( '/page/1/', '', $result );

    echo $result;
}

function excerpt_readmore($more) {
    return '... <br><a href="'. get_permalink($post->ID) . '" class="readmore">' . 'Читать далее' . '</a>';
}
add_filter('excerpt_more', 'excerpt_readmore');


if ( function_exists( 'add_theme_support' ) )
    add_theme_support( 'post-thumbnails' );

//загружаем марки авто
function selectMark(){
    global $wpdb;
    $html = "";
    $marks = $wpdb->get_results("SELECT * FROM `marks`",ARRAY_A);
    foreach($marks as $mark){
        //prn($mark);
        $html .= "<option value='".$mark[id]."'>".$mark[name]."</option>";
    }
    return $html;
}
//подгружаем Двигатели
add_action('wp_ajax_getVersion', 'getVersion');
add_action('wp_ajax_nopriv_getVersion', 'getVersion');

function getVersion(){
    global $wpdb;
    $html = "<option value='0'>Выберите тип двигателя</option>";
    $idModel = $_POST['idModel'];

    $versions = $wpdb->get_results("SELECT * FROM `versions` WHERE `id_model` = $idModel",ARRAY_A);

    foreach ($versions as $version) {
        $html .= "<option value='".$version['id']."'>".$version['version']."</option>";
    }
    echo $html;
}
//подгружаем двигатели
add_action('wp_ajax_getModel', 'getModel');
add_action('wp_ajax_nopriv_getModel', 'getModel');

function getModel(){
    global $wpdb;
    $html = "<option value='0'>Выберите модель автомобиля</option>";
    $idMark = $_POST['idMark'];

    $models = $wpdb->get_results("SELECT * FROM `models` WHERE `id_mark` = $idMark",ARRAY_A);

    foreach ($models as $model) {
        $html .= "<option value='".$model['id']."'>".$model['name']."</option>";
    }
    echo $html;
}
//подгружаем года
add_action('wp_ajax_getYear', 'getYear');
add_action('wp_ajax_nopriv_getYear', 'getYear');

function getYear(){
    $html = "<option value='0'>Выберите год</option>";

    for($i=1996;$i<2016;$i++){
        $html .= "<option value='".$i."'>".$i."</option>";
    }
    echo $html;
}
//подгружаем информацию
add_action('wp_ajax_getInfo', 'getInfo');
add_action('wp_ajax_nopriv_getInfo', 'getInfo');

function getInfo(){
    global $wpdb;

    $idVersion = $_POST['idVersion'];

    $version= $wpdb->get_results("SELECT * FROM `versions` WHERE `id` = $idVersion",ARRAY_A);
    $versionName = $version[0]['version'];
    $hp = $version[0]['hp'];
    $hpChip = $version[0]['hp_chip'];
    $nm = $version[0]['nm'];
    $nmChip = $version[0]['nm_chip'];
    $hpDiff = $hpChip - $hp;
    $nmDiff = $nmChip - $nm;
    //Марка авто
    $idMark = $version[0]['id_mark'];
    $mark = $wpdb->get_results("SELECT * FROM `marks` WHERE `id` = $idMark",ARRAY_A);
    $mark = $mark[0]['name'];
    //Модель авто
    $idModel = $version[0]['id_model'];
    $model = $wpdb->get_results("SELECT * FROM `models` WHERE `id` = $idModel",ARRAY_A);
    $model = $model[0]['name'];

    $data = array('mark' => $mark,
        'model' => $model,
        'version' => $versionName,
        'hp' => $hp,
        'hpChip' => $hpChip,
        'nm' => $nm,
        'nmChip' => $nmChip,
        'hpDiff' => $hpDiff,
        'nmDiff' => $nmDiff);

    $jsonData = json_encode($data);

    echo $jsonData;
}



