<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Daily meditation shortcode.
 *
 * @return string
 */
function ndmc_meditations_pl_shortcode() {

	global $wpdb;

	$language_table = $wpdb->prefix . 'ndmc_language';

	$lang = $wpdb->get_row(
		$wpdb->prepare(
			"SELECT * FROM {$language_table} WHERE jezyk = %s LIMIT 1",
			'pl'
		)
	);

	$meditation_table = $wpdb->prefix . 'ndmc_meditations_pl';

	$date = current_time( 'm-d' );

	$row = $wpdb->get_row(
		$wpdb->prepare(
			"SELECT * FROM {$meditation_table} WHERE date = %s LIMIT 1",
			$date
		)
	);

	if ( ! $row ) {
		return '<div class="dm-error">' . esc_html( $lang->error ) . '</div>';
	}

	ob_start();
	?>

	<div class="daily-meditation">

		<div class="med-date">
			<?php echo esc_html( wp_date( 'd.m.Y', current_time( 'timestamp' ) ) ); ?>
		</div>

		<div class="med-title">
			<h1><?php echo esc_html( $row->med_title ); ?></h1>
		</div>

		<div class="meditation">
			<?php echo wpautop( wp_kses_post( $row->meditation ) ); ?>
		</div>

		<div class="today-note">

			<h3>
				<?php echo esc_html( $lang->just_for_day ); ?>
			</h3>

			<?php echo wpautop( wp_kses_post( $row->today_note ) ); ?>

		</div>

	</div>

	<?php

	require NDMC_PLUGIN_DIR . 'includes/admin/footer.php';

	return ob_get_clean();
}

add_shortcode(
	'ndmc_meditations_pl',
	'ndmc_meditations_pl_shortcode'
);