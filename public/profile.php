<?php
$placeholder = require 'includes/init_page.php';

if(isset($_POST['save'])) {
    if(DEMO) {
        $placeholder['message']['error'] = 'In der Demo Version darf das Profil nicht bearbeitet werden!';
    } else {
        $profile_filter_post_input = include 'modules/filter_post_input.php';
        $profile_update = new Models\Profile($_SESSION['id_user'], $profile_filter_post_input());

        if(Tables\Users::update_profile($database_pdo, $profile_update))
            $placeholder['message']['success'] = 'Deine Benutzerdaten wurden gespeichert.';
        else
            $placeholder['message']['error'] = 'Deine Benutzerdaten konnten nicht gespeichert werden!';
    }
}

$placeholder['profile'] = Tables\Users::select_profile($database_pdo, $_SESSION['id_user']);
echo App\Templates\Page::render($placeholder);