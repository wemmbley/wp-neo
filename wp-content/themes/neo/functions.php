<?php

// C o m p o s e r
require_once 'vendor/autoload.php';

// Load framework
$bootstrap = new \Neo\Bootstrap();
$bootstrap->boot();

(new \Neo\Framework\AuthNeoStyle());

add_filter('wp_die_handler', function($default_handler) {
	return function($message, $title, $args) {
		// Собственный HTML для страницы ошибки
		$custom_css = "
            <style>
                  body {
                  margin: 0;
                    position: relative;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    height: 100vh;
                }
            body::before {
            content: '';
                     position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
            	background-image: url(" . get_bloginfo( 'template_directory' ) . "/framework/Resources/img/palms.png);
            	     background-position: center center;
                    background-attachment: fixed;
                    background-repeat: no-repeat;
                    background-size: cover;
                    filter: blur(3px) brightness(90%);
                    z-index: -1;
            }
                #wp-die-message {
                color: rgb(54,54,54);
                font-family:  Roboto, Arial, sans-serif;
                
                font-size: 18px;
                display: flex;
                align-items: center;
                justify-content: center;
                	min-height: 120px;
                	min-width: 50vw;
                          backdrop-filter: blur(10px);
                    background: rgba(255, 255, 255, 0.2); /* Белый с прозрачностью */
                    border: 1px solid rgba(255, 255, 255, 0.3); /* Легкая граница */
                    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.09);
                    border-radius: 4px;
                }
            </style>
        ";

		// Формируем вывод страницы ошибки
		$html = "<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>$title</title>
    $custom_css
</head>
<body>
    <div id='wp-die-message'>$message</div>
</body>
</html>";

		// Выводим страницу и завершаем выполнение
		die($html);
	};
});

//
//
//
// test 3
//
//
//
class Replace_WP_Dashboard {

	protected $capability = 'read';

	protected $title;

	final public function __construct() {
		if( is_admin() ) {
			add_action( 'init', array( $this, 'init' ) );
		}
	}

	final public function init() {
		if( current_user_can( $this->capability ) ) {
			$this->set_title();
			add_filter( 'admin_title', array( $this, 'admin_title' ), 10, 2 );
			add_action( 'admin_menu', array( $this, 'admin_menu' ) );
			add_action( 'current_screen', array( $this, 'current_screen' ) );
		}
	}

	/**
	 * Sets the page title for your custom dashboard
	 */
	function set_title() {
		if( ! isset( $this->title ) ) {
			$this->title = __( 'Dashboard' );
		}
	}

	/**
	 * Output the content for your custom dashboard
	 */
	function page_content() {
		$content = __( 'Welcome to your new dashboard!' );
		echo <<<HTML
<div class="wrap">
    <h2>{$this->title}</h2>
    <p>{$content}</p>
</div>
HTML;
	}

	/**
	 * Fixes the page title in the browser.
	 *
	 * @param string $admin_title
	 * @param string $title
	 * @return string $admin_title
	 */
	final public function admin_title( $admin_title, $title ) {
		global $pagenow;
		if( 'admin.php' == $pagenow && isset( $_GET['page'] ) && 'custom-page' == $_GET['page'] ) {
			$admin_title = $this->title . $admin_title;
		}
		return $admin_title;
	}

	final public function admin_menu() {

		/**
		 * Adds a custom page to WordPress
		 */
		add_menu_page( $this->title, '', $this->capability, 'custom-page', array( $this, 'page_content' ) );

		/**
		 * Remove the custom page from the admin menu
		 */
		remove_menu_page('custom-page');

		/**
		 * Make dashboard menu item the active item
		 */
		global $parent_file, $submenu_file;
		$parent_file = 'index.php';
		$submenu_file = 'index.php';

		/**
		 * Rename the dashboard menu item
		 */
		global $menu;
		$menu[2][0] = $this->title;

		/**
		 * Rename the dashboard submenu item
		 */
		global $submenu;
		$submenu['index.php'][0][0] = $this->title;

	}

	/**
	 * Redirect users from the normal dashboard to your custom dashboard
	 */
	final public function current_screen( $screen ) {
		if( 'dashboard' == $screen->id ) {
			wp_safe_redirect( admin_url('admin.php?page=custom-page') );
			exit;
		}
	}

}

//new Replace_WP_Dashboard();


//
//
//
// tests
//
//
//
function show_submitted_forms() {
	$forms = get_option('submitted_forms', []);
	?>
	<table>
		<thead>
		<tr>
			<th>Имя</th>
			<th>Номер мобильного</th>
			<th>Текст</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($forms as $form): ?>
			<tr>
				<td><?php echo esc_html($form['name']); ?></td>
				<td><?php echo esc_html($form['number']); ?></td>
				<td><?php echo esc_html($form['text']); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<?php
}
add_action('admin_menu', function() {
	add_menu_page('Формы', 'Формы', 'manage_options', 'form-submissions', 'show_submitted_forms');
});

//
//
//
// test2
//
//
//
add_action('admin_menu', function() {
	add_menu_page(
		'Настройки сайта',   // Заголовок страницы
		'Настройки',        // Название в меню
		'manage_options',   // Роль доступа
		'neo-settings',     // Слаг страницы
		'neo_settings_page',// Коллбек-функция для рендера страницы
		'dashicons-admin-generic', // Иконка в админке
		2                   // Позиция в меню
	);
});
function neo_settings_page() {
	?>
	<div class="wrap">
		<h1>Настройки сайта</h1>
		<form method="post" action="options.php">
			<?php
			settings_fields('neo_settings_group');
			do_settings_sections('neo-settings');
			submit_button();
			?>
		</form>
	</div>
	<?php
}
add_action('admin_init', function() {
	// Регистрируем секцию
	add_settings_section('neo_main_section', 'Основные настройки', null, 'neo-settings');

	// Поле для колор пикера
	add_settings_field('neo_site_color', 'Цвет сайта', 'neo_color_field', 'neo-settings', 'neo_main_section');
	register_setting('neo_settings_group', 'neo_site_color');

	// Поле для загрузки логотипа
	add_settings_field('neo_site_logo', 'Логотип', 'neo_logo_field', 'neo-settings', 'neo_main_section');
	register_setting('neo_settings_group', 'neo_site_logo');
});
function neo_color_field() {
	$color = get_option('neo_site_color', '#ffffff');
	?>
	<input type="text" name="neo_site_color" value="<?php echo esc_attr($color); ?>" class="neo-color-field">
	<script>
        jQuery(document).ready(function($){
            $('.neo-color-field').wpColorPicker();
        });
	</script>
	<?php
}

function neo_logo_field() {
	$logo = get_option('neo_site_logo');
	?>
	<input type="hidden" id="neo_logo_input" name="neo_site_logo" value="<?php echo esc_attr($logo); ?>">
	<button class="button neo-upload-button">Выбрать изображение</button>
	<div>
		<img id="neo_logo_preview" src="<?php echo esc_url($logo); ?>" style="max-width: 200px; margin-top: 10px;">
	</div>

	<script>
        jQuery(document).ready(function($) {
            $('.neo-upload-button').click(function(e) {
                e.preventDefault();
                var mediaUploader = wp.media({
                    title: 'Выберите изображение',
                    button: {
                        text: 'Использовать это изображение'
                    },
                    multiple: false
                }).on('select', function() {
                    var attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#neo_logo_input').val(attachment.url);
                    $('#neo_logo_preview').attr('src', attachment.url);
                }).open();
            });
        });
	</script>
	<?php
}
add_action('admin_enqueue_scripts', function() {
	wp_enqueue_style('wp-color-picker');
	wp_enqueue_media(); // Для загрузчика медиа
});

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title'    => 'Настройки сайта',
		'menu_title'    => 'Настройки ACF',
		'menu_slug'     => 'acf-site-settings',
		'capability'    => 'edit_posts',
		'redirect'      => false
	));
}
add_action('admin_enqueue_scripts', function() {
	wp_enqueue_style('wp-color-picker'); // Подключаем стили
	wp_enqueue_script('wp-color-picker'); // Подключаем сам скрипт
	wp_enqueue_script('jquery'); // Убедись, что jQuery тоже подключен
});

// SASS COMPIlER
// use ScssPhp\ScssPhp\Compiler;
//
//$compiler = new Compiler();
//
//echo $compiler->compileString('
//  $color: #abc;
//  div { color: lighten($color, 20%); }
//')->getCss();