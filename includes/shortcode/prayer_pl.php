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
                <?php echo esc_html__('Modlitwa o Pogodę Ducha', 'daily-meditation-na-polish'); ?>
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

        <div class="dm-footer">

            <p>
                Daily Meditation NA – Polish
            </p>

            <p>

                <a href="https://github.com/noniko99/DailyMeditationNA-Polish-wp-plugin" target="_blank" rel="noopener">
                    GitHub
                </a>

                •

                <a href="mailto:noniko9901@gmail.com">
                    Kontakt
                </a>

            </p>

        </div>

    </div>

    <?php

    return ob_get_clean();
}

add_shortcode(
    'DMNAPL_prayer_pl',
    'dmna_prayer_shortcode'
);