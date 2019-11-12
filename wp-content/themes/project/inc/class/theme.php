<?php

class Theme {

	/**
	 * @param string $path path to required file
	 *
	 * @return void
	 */
	function require_path( $path ) {
		require THEME . trailingslashit( $path );
	}

	public function __construct( $includes = array() ) {
		$includes = wp_parse_args( $includes, array(
			'class'       => array(),
			'custom'      => array(),
			'woocommerce' => array(),
			'system'      => array(
				'/inc/system/setup.php',         // *
				'/inc/system/utilites.php',      // * Вспомогательные функции
				'/inc/system/admin.php',         // * Фильтры и функции административной части WP
				'/inc/system/tpl.php',           // * Основные функции вывода информации в шаблон
				'/inc/system/navigation.php',    // * Навигация
				'/inc/system/gallery.php',       // * Шаблон встроенной галереи wordpress
				'/inc/system/customizer.php',    // * Дополнительные функии в настройки внешнего вида
				'/inc/system/notifications.php', // * Дополнение к отправке уведомлений
			),
		) );

		$this->include_classes( $includes['class'] );
		$this->include_customs( $includes['custom'] );
		$this->include_woocommerce( $includes['woocommerce'] );
		$this->include_system( $includes['system'] );
	}

	/**
	 * Inlcude adittional classes
	 */
	private function include_classes( $_required ) {
		$required = array_merge( $_required, array(
			'inc/class/wp-bootstrap-navwalker.php',
		) );

		array_map( array( $this, 'require_path' ), $required );
	}

	private function include_customs( $required ) {
		array_map( array( $this, 'require_path' ), $required );
	}

	private function include_woocommerce( $_required ) {
		$required = array_merge( $_required, array(
			'inc/system/woocommerce.php',   // *
			'inc/system/wc-customizer.php', // *
		) );

		array_map( array( $this, 'require_path' ), $required );
	}

	private function include_system( $_required ) {
		$required = array_merge( $_required, array(
			'/inc/class/wp-bootstrap-navwalker.php',
		) );

		array_map( array( $this, 'require_path' ), $required );
	}
}
