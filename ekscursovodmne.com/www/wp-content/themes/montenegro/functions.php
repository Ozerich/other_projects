<?php

function theme_setup()
{
    // This theme styles the visual editor with editor-style.css to match the theme style.
    add_editor_style();


    // This theme supports a variety of post formats.
    add_theme_support('post-formats', array('aside', 'image', 'link', 'quote', 'status'));

    // This theme uses wp_nav_menu() in one location.
    register_nav_menu('primary', __('Primary Menu', 'montenegro2'));

    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(301, 220);

    add_image_size('service-thumb', 20, 20);
    add_image_size('tour-video-thumb', 301, 220);
    add_image_size('tour-thumb', 152, 153);
	add_image_size('article-thumb', 301, 220);
	add_image_size('country-thumb', 330, 220);

    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(624, 9999);

    if (class_exists('MultiPostThumbnails')) {

        new MultiPostThumbnails(
            array(
                'label' => 'Видео превью',
                'id' => 'tour-video-thumb',
                'post_type' => 'tour'
            )
        );

        new MultiPostThumbnails(
            array(
                'label' => 'Превью на главной',
                'id' => 'tour-thumb',
                'post_type' => 'tour'
            )
        );
    }
}

add_action('after_setup_theme', 'theme_setup');

function theme_init()
{
   
    register_post_type('tour', array(
        'labels' => array(
            'name' => 'Экскурсии',
            'singular_name' => 'Экскурсия',
            'add_new' => 'Добавить экскурсию',
            'add_new_item' => 'Добавить новую экскурсию',
            'edit_item' => 'Редактировать экскурсию',
            'new_item' => 'Новая экскурсия',
            'all_items' => 'Все экскурсии',
            'view_item' => 'Просмотр экскурсии',
            'search_items' => 'Поиск экскурсии',
            'not_found' => 'Нет экскурсий',
            'not_found_in_trash' => 'Нет экскурсий',
            'menu_name' => __('Экскурсии')
        ),
		'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'excerpt', 'editor'),
		'menu_position' => 2,
    ));
	
		
	register_post_type('photoalbum', array(
        'labels' => array(
            'name' => 'Фотогалереи',
            'singular_name' => 'Фотогалерея',
            'add_new' => 'Добавить фотогалерею',
            'add_new_item' => 'Добавить новую фотогалерею',
            'edit_item' => 'Редактировать фотогалерею',
            'new_item' => 'Новая фотогалерея',
            'all_items' => 'Все фотогалереи',
            'view_item' => 'Просмотр фотогалереи',
            'search_items' => 'Поиск фотогалереи',
            'not_found' => 'Нет фотогалерей',
            'not_found_in_trash' => 'Нет фотогалерей',
            'menu_name' => __('Фотогалереи')
        ),
		'public' => true,
		'has_archive' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'thumbnail', 'editor'),
		'menu_position' => 2,
    ));
	
	register_post_type('country', array(
        'labels' => array(
            'name' => 'Страны',
            'singular_name' => 'Страна',
            'add_new' => 'Добавить страну',
            'add_new_item' => 'Добавить новую страну',
            'edit_item' => 'Редактировать страну',
            'new_item' => 'Новая страна',
            'all_items' => 'Все страны',
            'view_item' => 'Просмотр страны',
            'search_items' => 'Поиск страны',
            'not_found' => 'Нет стран',
            'not_found_in_trash' => 'Нет стран',
            'menu_name' => __('Страны')
        ),
		'public' => true,
		'has_archive' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail'),
		'menu_position' => 2,
    ));
	
	register_post_type('article', array(
        'labels' => array(
            'name' => 'Статьи',
            'singular_name' => 'Статья',
            'add_new' => 'Добавить статью',
            'add_new_item' => 'Добавить новую статью',
            'edit_item' => 'Редактировать статью',
            'new_item' => 'Новая статья',
            'all_items' => 'Все статьи',
            'view_item' => 'Просмотр статьи',
            'search_items' => 'Поиск статьи',
            'not_found' => 'Нет статей',
            'not_found_in_trash' => 'Нет статей',
            'menu_name' => __('Статьи')
        ),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'articles'),
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'excerpt', 'thumbnail', 'editor'),
		'menu_position' => 2,
    ));
	

	
	register_post_type('guest', array(
        'labels' => array(
            'name' => 'Гости',
            'singular_name' => 'Гость',
            'add_new' => 'Добавить гостя',
            'add_new_item' => 'Добавить нового гостя',
            'edit_item' => 'Редактировать гостя',
            'new_item' => 'Новый гость',
            'all_items' => 'Все гости',
            'view_item' => 'Просмотр гостя',
            'search_items' => 'Поиск гостя',
            'not_found' => 'Нет гостей',
            'not_found_in_trash' => 'Нет гостей',
            'menu_name' => __('Гости')
        ),
		'public' => true,
		'has_archive' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
		'menu_position' => 2,
    ));

 register_post_type('service', array(
        'labels' => array(
            'name' => 'Услуги',
            'singular_name' => 'Услуга',
            'add_new' => 'Добавить услугу',
            'add_new_item' => 'Добавить новую услугу',
            'edit_item' => 'Редактировать услугу',
            'new_item' => 'Новая услуга',
            'all_items' => 'Все услуги',
            'view_item' => 'Просмотр услуги',
            'search_items' => 'Поиск услуги',
            'not_found' => 'Нет услуг',
            'not_found_in_trash' => 'Нет услуг',
            'menu_name' => __('Услуги')
        ),
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'thumbnail'),
		'menu_position' => 2,
    ));

}

add_action('init', 'theme_init');


function my_scripts_method() {
	wp_enqueue_script(
		'scripts',
		get_template_directory_uri() . '/js/scripts.js',
		array( 'jquery' )
	);
}

add_action( 'wp_enqueue_scripts', 'my_scripts_method' );


add_filter('the_content', 'filter_images_zoom');
function filter_images_zoom($content)
{
	global $post;
	if(in_array($post->post_type, array('guest', 'page', 'article'))){
		$content = preg_replace('#<a(.*?)href="(.+?)"(.*?)>\s*?<img(.*?)src="(.+?)"(.*?)>(.*?)</a>#sui', '<a\\1onclick="return hs.expand(this);" href="\\2"\\3><img\\4src="\\5"\\6/>\\7</a>', $content);
	}
	

    return $content;
}

add_filter('the_content', 'filter_mp3');
function filter_mp3($content)
{

	$pattern = "/<a ([^=]+=['\"][^\"']+['\"] )*href=['\"](([^\"']+\.mp3))['\"]( [^=]+=['\"][^\"']+['\"])*>([^<]+)<\/a>/i";
	$content = preg_replace( $pattern, '<audio controls preload="none"><source src="\\2" type="audio/mpeg"></audio>', $content );
	
    return $content;
}

			