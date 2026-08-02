<?php

if (!defined('ABSPATH')) {
    exit;
}


function dm_admin_menu() {

    add_menu_page(
        'Daily Meditation',
        'Daily Meditation',
        'manage_options',
        'daily-meditation',
        'dm_dashboard_page',
        'dashicons-book-alt',
        30
    );

}

add_action('admin_menu', 'dm_admin_menu');



function dm_dashboard_page() {

    global $wpdb;


    $language_table = $wpdb->prefix . 'dmnapl_language';



    // Pobieramy wszystkie języki z bazy

    $languages = $wpdb->get_results(
        "SELECT * FROM {$language_table} ORDER BY id ASC"
    );



    // Jeżeli wybrano zakładkę

    $active_tab = isset($_GET['tab'])
        ? sanitize_text_field($_GET['tab'])
        : '';



    // Jeżeli nie wybrano żadnej zakładki,
    // ustawiamy automatycznie język z ID = 1

    if (empty($active_tab)) {

        $active_tab = $wpdb->get_var(
            "SELECT jezyk FROM {$language_table} WHERE id = 1 LIMIT 1"
        );

    }



    // Pobieramy aktywny język

    $lang = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT * FROM {$language_table} WHERE jezyk=%s LIMIT 1",
            $active_tab
        )
    );


    ?>


    <div class="wrap">


        <h1>
            Noniko Daily Meditation Companion
        </h1>



        <h2 class="nav-tab-wrapper">


            <?php foreach ($languages as $language) : ?>


                <a href="?page=daily-meditation&tab=<?php echo esc_attr($language->jezyk); ?>"
                   class="nav-tab <?php echo ($active_tab == $language->jezyk) ? 'nav-tab-active' : ''; ?>">


                    <?php echo esc_html(strtoupper($language->jezyk)); ?>


                </a>


            <?php endforeach; ?>


        </h2>





        <?php if ($lang) : ?>


  

    <hr>


    <h2>
        <?php echo esc_html($lang->info_title); ?>
    </h2>


    <p>
        <?php echo wp_kses_post($lang->info); ?>
    </p>



    <hr>



    <h2>
        <?php echo esc_html($lang->configuration_title); ?>
    </h2>


    <p>
        <?php echo nl2br(
            esc_html($lang->configuration)
        ); ?>
    </p>



    <hr>



    <h2>
        <?php echo esc_html($lang->shortcode_title); ?>
    </h2>


    <input
        type="text"
        class="regular-text code"
        readonly
        value="<?php echo esc_attr($lang->shortcode_meditation); ?>"
        onclick="this.select();"
    >



    <hr>



    <h2>
        <?php echo esc_html($lang->description_title); ?>
    </h2>


    <p>
        <?php echo wp_kses_post($lang->description); ?>
    </p>



    <hr>



    <h2>
        <?php echo esc_html($lang->support_title); ?>
    </h2>


    <p>
        <?php echo wp_kses_post($lang->support); ?>
    </p>



    <hr>




<?php else : ?>


    <div class="notice notice-error">

        <p>
            Brak danych językowych.
        </p>

    </div>


<?php endif; ?>





    </div>



    <?php

    require DMNA_PLUGIN_DIR . 'includes/admin/footer.php';

}