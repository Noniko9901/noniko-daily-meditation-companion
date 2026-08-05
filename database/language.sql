-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2026 at 03:27 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12


INSERT INTO `{table}` (`id`, `jezyk`, `title`, `info_title`, `info`, `configuration_title`, `configuration`, `shortcode_title`, `shortcode_meditation`, `description_title`, `description`, `support_title`, `support`, `error`, `just_for_day`) VALUES
(1, 'PL', 'Noniko Daily Meditation Companion', 'Informacje', 'Ta wtyczka wyświetla codzienną medytację w języku polskim.', 'Konfiguracja', '1. Zainstaluj i aktywuj wtyczkę.\r\n2. Podczas aktywacji zostanie automatycznie utworzona baza danych z medytacjami.\r\n3. Wstaw shortcode na dowolnej stronie lub we wpisie.', 'Użyj poniższego shortcode:', '[ndmc_meditations_pl]', 'Opis', 'Wtyczka automatycznie wyświetla medytację odpowiadającą bieżącej dacie. Dane pobierane są z tabeli DMNAPL_meditations_pl.', 'Wsparcie', 'Jeśli napotkasz problem z działaniem wtyczki, sprawdź czy wtyczka została poprawnie aktywowana oraz czy tabela bazy danych została utworzona.', 'Brak medytacji na dzisiaj.', 'Właśnie dzisiaj')

