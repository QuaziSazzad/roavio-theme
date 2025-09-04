<?php

namespace RoavioTheme\Classes;

defined('ABSPATH') || exit;

/**
 * Load Theme Assets
 */
class Roavio_Assets
{

	protected static $instance = null;

	public static function instance()
	{
		if (null === self::$instance) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function __construct()
	{
		add_action('wp_enqueue_scripts', [$this, 'register_scripts']);
		add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
		add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
		add_action('wp_enqueue_scripts', [$this, 'global_root_css']);

		add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);

		add_action('wp_head', [$this, 'custom_header_scripts']);
		add_action('wp_footer', [$this, 'custom_footer_scripts']);
	}

	public function google_font_url()
	{
		$fonts_url     = '';
		$font_families = [];

		$primary_font   = Roavio_Helper::get_option('primary_font', ['font-family' => '']);
		$secondary_font = Roavio_Helper::get_option('secondary_font', ['font-family' => '']);

		if ('' === $primary_font || (is_array($primary_font) && empty($primary_font['font-family']))) {
			if ('off' !== _x('on', 'Inter', 'roavio')) {
				$font_families[] = 'Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900';
			}
		}

		if ('' === $secondary_font || (is_array($secondary_font) && empty($secondary_font['font-family']))) {
			if ('off' !== _x('on', 'Hanken Grotesk', 'roavio')) {
				$font_families[] = 'Hanken Grotesk:ital,wght@0,100..900;1,100..900';
			}
		}

		if (!empty($font_families)) {
			// Build Google Fonts /css2 URL
			$query_args = array_map(function ($family) {
				return 'family=' . urlencode($family);
			}, $font_families);

			$query_args[] = 'display=swap';

			$fonts_url = 'https://fonts.googleapis.com/css2?' . implode('&', $query_args);
		}

		return esc_url_raw($fonts_url);
	}

	public function admin_google_font_url()
	{
		$font_families = [];
		$subsets       = 'latin';

		if ('off' !== _x('on', 'Inter', 'roavio')) {
			$font_families[] = 'Inter:300,400,500,600';
		}

		$fonts_url = add_query_arg([
			'family' => urlencode(implode('|', $font_families)),
			'subset' => urlencode($subsets),
		], 'https://fonts.googleapis.com/css');

		return esc_url_raw($fonts_url);
	}

	public function register_scripts()
	{
		wp_register_style('bootstrap', ROAVIO_VENDOR . '/bootstrap/bootstrap.min.css', [], '1.1.0');
		wp_register_script('bootstrap', ROAVIO_VENDOR . '/bootstrap/bootstrap.min.js', ['jquery'], '1.1.0', true);
	}

	public function enqueue_styles()
	{
		wp_enqueue_style('roavio-fonts', $this->google_font_url(), [], null);
		wp_enqueue_style('bootstrap');
		wp_enqueue_style('fontawesome', ROAVIO_VENDOR . '/fontawesome/all.min.css', [], '5.14');
		wp_enqueue_style('roavio-theme', ROAVIO_ASSETS . '/css/style.css', [], ROAVIO_VERSION);
		wp_enqueue_style('roavio-style', get_stylesheet_uri(), [], ROAVIO_VERSION);
	}

	/**
	 * Inline CSS
	 *
	 * @return void
	 */
	public function global_root_css()
	{
		$boxed_width     = Roavio_Helper::get_option('boxed_width', []);
		$global_colors   = Roavio_Helper::get_global_colors();
		$page_colors   = Roavio_Helper::get_page_colors();
		$global_fonts    = Roavio_Helper::get_global_fonts();
		$page_fonts    = Roavio_Helper::get_page_fonts();
		$inline_css      = [];


		if (! empty($boxed_width)) {
			$inline_css[] = '--roavio-boxed-width: ' . $boxed_width['width'] . 'px';
		} else {
			$inline_css[] = '--roavio-boxed-width: 1530px';
		}



		foreach ($global_colors as $key => $color) {
			$inline_css[] = '--' . $color['slug'] . ':' . $color['value'];
		}

		foreach ($global_fonts as $font) {
			$inline_css[] = '--' . $font['slug'] . ':' . $font['font-family'] . ', ' . $font['backup-font-family'];
		}

		if (is_page()) :
			foreach ($page_colors as $key => $color) {
				$inline_css[] = '--' . $color['slug'] . ':' . $color['value'];
			}

			foreach ($page_fonts as $font) {
				$inline_css[] = '--' . $font['slug'] . ':' . $font['font-family'] . ', ' . $font['backup-font-family'];
			}
		endif;


		$output = '
        :root {
            ' . esc_attr(implode('; ', $inline_css)) . '
        }
        ';

		wp_add_inline_style('roavio-style', $output);
	}

	/**
	 * Enqueue Theme Scripts
	 *
	 * @return void
	 */
	public function enqueue_scripts()
	{
		wp_enqueue_script('bootstrap');
		wp_enqueue_script('roavio-theme', ROAVIO_ASSETS . '/js/theme.js', ['jquery'], ROAVIO_VERSION, true);


		if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
	}

	/**
	 * Admin CSS
	 */
	public function enqueue_admin_scripts()
	{
		wp_enqueue_style('roavio-admin-fonts', $this->admin_google_font_url(), [], null);
		wp_enqueue_style('roavio-admin', ROAVIO_ASSETS . '/css/admin.min.css', [], time(), 'all');
		wp_enqueue_script('roavio-admin', ROAVIO_ASSETS . '/js/admin.min.js', ['jquery'], time(), true);

		wp_localize_script(
			'roavio-admin',
			'roavioAdminLocalize',
			[
				'ajax_url' => admin_url('admin-ajax.php'),
			]
		);
	}

	/**
	 * Custom Header Scripts
	 */
	public function custom_header_scripts()
	{
		if ('' !== Roavio_Helper::get_option('custom_header_scripts')): ?>
			<script>
				<?php echo Roavio_Helper::get_option('custom_header_scripts'); ?>
			</script>
		<?php endif;
	}

	/**
	 * Custom Scripts
	 */
	public function custom_footer_scripts()
	{
		if ('' !== Roavio_Helper::get_option('custom_footer_scripts')): ?>
			<script>
				<?php echo Roavio_Helper::get_option('custom_footer_scripts'); ?>
			</script>
<?php endif;
	}
}

Roavio_Assets::instance();
