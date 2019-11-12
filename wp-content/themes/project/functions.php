<?php

if ( ! defined( 'DEVELOPER_LINK' ) ) {
	// Ссылка на сайт производителя (разработчика сайта/темы).
	define( 'DEVELOPER_LINK', '//seo18.ru' );
}

if ( ! defined( 'DEVELOPER_NAME' ) ) {
	// Название производителя (разработчика).
	define( 'DEVELOPER_NAME', 'SEO18' );
}

if ( ! defined( 'DEVELOPER_TESTMAIL' ) ) {
	// Название производителя (разработчика).
	define( 'DEVELOPER_TESTMAIL', 'trashmailsizh@yandex.ru' );
}

if ( ! defined( 'DEVELOPMENT_IP' ) ) {
	// IP тестового сервера.
	define( 'DEVELOPMENT_IP', '88.212.237.4' );
}

if ( ! defined( 'THEME' ) ) {
	// Путь на сервере до папки шаблона (с завершающим слэшем).
	define( 'THEME', get_template_directory() . DIRECTORY_SEPARATOR );
}

if ( ! defined( 'TPL' ) ) {
	// Ссылка на страницу папки шаблона.
	define( 'TPL', get_template_directory_uri() . '/' );
}

require 'inc/class/theme.php';

$theme = new Theme( $require = array(
	'class' => array(
		'/inc/class/sms.ru.php',
		'/inc/class/sms-provider.php',
	),
	'custom' => array(
		'/inc/assets.php',     // * Дополнительные ресурсы (Скрипты, стили..)
		'/inc/widgets.php',    // * Сайдбар панели (Виджеты)
		'/inc/post-types.php', // * Функции добавления типа записи slide
		'/inc/shortcodes.php', // * Функции добавления шорткода
	),
	'woocommerce' => array(
		'/woocommerce/functions.php',          // * Функции магазина
		'/woocommerce/template-functions.php', // * Функции и фильтры шаблона магазина
		'/woocommerce/filters.php',            // * Объявление основных функций магазина
	),
) );

// Подключить скрипты и стили указанные в файле ./inc/assets.php
add_action( 'wp_enqueue_scripts', 'enqueue_assets', 997 );
// Подлкючить скрипты и стили используемые шаблоном (на всем сайте)
add_action( 'wp_enqueue_scripts', 'enqueue_template_assets', 998 );
// Подлкючить скрипты и стили на данной (сейчас открытой) странице
add_action( 'wp_enqueue_scripts', 'enqueue_page_assets', 999 );

// Зарегистрировать виджеты из файла ./inc/widgets.php
add_action( 'widgets_init', 'theme_widgets' );

// Регистрируем тип записи слайдер "slide" (для примера)
add_action( 'init', 'register_type__slide' );
// Регистрируем таксономию slider
add_action( 'init', 'register_tax__slider' );
// Меняем местами ссылки на таксономию (Эта ссылка нужна первой) и тип записи
add_action( 'admin_menu', 'sort_menu_slider', 99 );

// Показываем принадлежащий слайдеру код вызова
add_filter( 'slider_row_actions', 'show_slider_shortcode', 10, 2 );
// Регистрируем шорткод для вывода элементов типа записи с помощью квадратных скобок [slider]
add_shortcode( 'slider', 'slider_shortcode' );

/**
 * Development server attention
 */
add_action( 'wp_footer', function () {
	if ( function_exists( 'is_local' ) && is_local() ) {
		echo '<h3 id="development" style="position:fixed;bottom:32px;background-color:red;margin:0;padding:8px;">Это локальный сервер</h3>',
		'<script type="text/javascript">setTimeout(function(){document.getElementById("development").style.display="none"},10000);</script>';
	}
} );

// change default wordpress to custom authentication
remove_filter( 'authenticate', 'wp_authenticate_username_password', 20 );
add_filter( 'authenticate', 'wp_authenticate_username_phone_password', 20, 3 );
