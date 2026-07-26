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
    ?>
    <div class="wrap">

        <h1>Daily Meditation NA - Polish</h1>

        <h1>Informacje</h1>

        <p>
            Ta wtyczka wyświetla codzienną medytację
            z programu Narcotics Anonymous w języku polskim
            oraz Modlitwę o Pogodę Ducha.
        </p>

        <hr><br>

        <h1>Konfiguracja</h1>

        <ol>
            <li>Zainstaluj i aktywuj wtyczkę.</li>
            <li>Podczas aktywacji zostanie automatycznie utworzona baza danych z medytacjami.</li>
            <li>Wstaw shortcode na dowolnej stronie lub we wpisie.</li>
        </ol>


        <h2>Shortcode - medytacja</h2>

        <p>Użyj poniższego shortcode:</p>

        <input
            type="text"
            class="regular-text code"
            readonly
            value="[DMNAPL_meditations_pl]"
            onclick="this.select();">

        <p>lub</p>

        <pre><code>[DMNAPL_meditations_pl]</code></pre>


        <h2>Shortcode - Modlitwa o Pogodę Ducha</h2>

        <p>Użyj poniższego shortcode:</p>

        <input
            type="text"
            class="regular-text code"
            readonly
            value="[DMNAPL_prayer_pl]"
            onclick="this.select();">

        <p>lub</p>

        <pre><code>[DMNAPL_prayer_pl]</code></pre>


        <hr>

        <h2>Opis</h2>

        <p>
            Wtyczka automatycznie wyświetla medytację odpowiadającą
            bieżącej dacie. Dane pobierane są z tabeli
            <code>DMNAPL_meditations_pl</code>.
        </p>

        <p>
            Dodatkowo dostępna jest Modlitwa o Pogodę Ducha,
            którą można wyświetlić na stronie za pomocą osobnego shortcode.
        </p>

        <hr>

        <h2>Wsparcie</h2>

        <p>
            Jeśli napotkasz problem z działaniem wtyczki,
            sprawdź czy wtyczka została poprawnie aktywowana
            oraz czy tabela bazy danych została utworzona.
        </p>

    </div>
    <?php
}