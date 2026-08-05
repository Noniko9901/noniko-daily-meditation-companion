<?php
/**
 * Frontend footer.
 *
 * @package NDMC
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="ndmc-footer">

	<p>
		<strong>
			<?php esc_html_e( 'Noniko Daily Meditation Companion  | 🇵🇱 ', 'noniko-daily-meditation-companion' ); ?>
		</strong>
	</p>

	<p>
		<?php
		echo esc_html(
			sprintf(
				/* translators: %s: plugin version */
				__( 'Version: %s', 'noniko-daily-meditation-companion' ),
				NDMC_VERSION
			)
		);
		?>
	</p>


	<p>
		<a 
			href="https://github.com/Noniko9901/noniko-daily-meditation-companion"
			target="_blank"
			rel="noopener noreferrer">
			<?php esc_html_e( 'GitHub', 'noniko-daily-meditation-companion' ); ?>
		</a>

		&nbsp;•&nbsp;

		<a href="mailto:noniko9901@gmail.com">
			<?php esc_html_e( 'Contact', 'noniko-daily-meditation-companion' ); ?>
		</a>
	</p>

</div>