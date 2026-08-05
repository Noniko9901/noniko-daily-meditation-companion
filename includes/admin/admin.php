<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add admin menu.
 *
 * @return void
 */
function ndmc_admin_menu() {

	add_menu_page(
		'Daily Meditation',
		'Daily Meditation',
		'manage_options',
		'daily-meditation',
		'ndmc_dashboard_page',
		'dashicons-book-alt',
		30
	);
}

add_action(
	'admin_menu',
	'ndmc_admin_menu'
);


/**
 * Display admin dashboard page.
 *
 * @return void
 */
function ndmc_dashboard_page() {

	global $wpdb;

	$language_table = $wpdb->prefix . 'ndmc_language';


	$languages = $wpdb->get_results(
		"SELECT * FROM {$language_table} ORDER BY id ASC"
	);


	$active_tab = isset( $_GET['tab'] )
		? sanitize_text_field( wp_unslash( $_GET['tab'] ) )
		: '';


	if ( empty( $active_tab ) ) {

		$active_tab = $wpdb->get_var(
			"SELECT jezyk FROM {$language_table} WHERE id = 1 LIMIT 1"
		);
	}


	$lang = $wpdb->get_row(
		$wpdb->prepare(
			"SELECT * FROM {$language_table} WHERE jezyk = %s LIMIT 1",
			$active_tab
		)
	);

	?>

	<div class="wrap">

		<h1>
			<?php echo esc_html__( 'Noniko Daily Meditation Companion', 'noniko-daily-meditation-companion' ); ?>
		</h1>


		<h2 class="nav-tab-wrapper">

			<?php foreach ( $languages as $language ) : ?>

				<a href="<?php echo esc_url( admin_url( 'admin.php?page=daily-meditation&tab=' . $language->jezyk ) ); ?>"
					class="nav-tab <?php echo ( $active_tab === $language->jezyk ) ? 'nav-tab-active' : ''; ?>">

					<?php echo esc_html( strtoupper( $language->jezyk ) ); ?>

				</a>

			<?php endforeach; ?>

		</h2>


		<?php if ( $lang ) : ?>


			<hr>

			<h2>
				<?php echo esc_html( $lang->info_title ); ?>
			</h2>

			<p>
				<?php echo wp_kses_post( $lang->info ); ?>
			</p>


			<hr>


			<h2>
				<?php echo esc_html( $lang->configuration_title ); ?>
			</h2>

			<p>
				<?php echo nl2br( esc_html( $lang->configuration ) ); ?>
			</p>


			<hr>


			<h2>
				<?php echo esc_html( $lang->shortcode_title ); ?>
			</h2>

			<input
				type="text"
				class="regular-text code"
				readonly
				value="<?php echo esc_attr( $lang->shortcode_meditation ); ?>"
				onclick="this.select();"
			>


			<hr>


			<h2>
				<?php echo esc_html( $lang->description_title ); ?>
			</h2>

			<p>
				<?php echo wp_kses_post( $lang->description ); ?>
			</p>


			<hr>


			<h2>
				<?php echo esc_html( $lang->support_title ); ?>
			</h2>

			<p>
				<?php echo wp_kses_post( $lang->support ); ?>
			</p>


		<?php else : ?>

			<div class="notice notice-error">

				<p>
					<?php echo esc_html__( 'No language data found.', 'noniko-daily-meditation-companion' ); ?>
				</p>

			</div>

		<?php endif; ?>


	</div>


	<?php

	require NDMC_PLUGIN_DIR . 'includes/admin/footer.php';
}