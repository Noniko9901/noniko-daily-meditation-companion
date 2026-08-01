<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Shortcode: [na_prayer]
 */
function dmna_prayer_shortcode()
{
    ob_start();
    ?>

    <div class="daily-meditation">

        <div class="med-title">

            <h1>
                <?php echo esc_html__('Modlitwa o Pogodę Ducha', 'noniko-daily-meditation-companion'); ?>
            </h1>

        </div>

        <div class="meditation">

            <p><center>
                Boże, użycz mi pogody ducha,<br>
                abym godził się z tym, czego nie mogę zmienić,<br>
                odwagi, abym zmieniał to, co mogę zmienić,<br>
                i mądrości, abym odróżniał jedno od drugiego.
            </center></p>

        </div>


    </div>

    <?php
     require DMNA_PLUGIN_DIR . 'includes/admin/footer.php';

    return ob_get_clean();
}

add_shortcode(
    'dmnapl_prayer_pl',
    'dmna_prayer_shortcode'
);


