<?php
if (!defined('ABSPATH')) {
    exit;
}

function meditations_pl_shortcode()
{
    global $wpdb;

    $table = $wpdb->prefix . 'dmnapl_language';

    $lang = $wpdb->get_row(
	$wpdb->prepare(
		"SELECT * FROM {$table} WHERE jezyk = %s",
		'pl'
	)
);
    


    $table = $wpdb->prefix . 'dmnapl_meditations_pl';
    $date  = current_time('m-d');

    $row = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT * FROM {$table} WHERE date=%s LIMIT 1",
            $date
        )
    );

    if (!$row) {
        return '<div class="dm-error">' . esc_html( $lang->error ) . '</div>';
    }

    ob_start();

   
    ?>

    <div class="daily-meditation">

        <div class="med-date">
           <?php echo esc_html(date_i18n('d.m.Y', current_time('timestamp'))); ?>
        </div>

        <div class="med-title">

            <h1><?php echo esc_html($row->med_title); ?></h1>

            

        </div>

        <div class="meditation">
            <?php echo wpautop(wp_kses_post($row->meditation)); ?>
        </div>

        <div class="today-note">

            

            <?php 
            
            echo '<h3>' . esc_html( $lang->just_for_day ) . '</h3>';
            
            echo wpautop(wp_kses_post($row->today_note)); ?>

        </div>

        

    </div>

    <?php
    require DMNA_PLUGIN_DIR . 'includes/admin/footer.php';
    return ob_get_clean();
}

add_shortcode('meditations_pl', 'meditations_pl_shortcode');