<?php
/*
Plugin Name: Désactivation des Posts
Description: Désactive les posts standards de WordPress
Version: 1.0
Author: GEHIN Nicolas
*/

// Désactive l'interface des posts dans l'admin
function desactiver_posts() {
    // Retire le menu "Articles" du tableau de bord
    remove_menu_page('edit.php');
}

function desactiver_posts_admin_bar() {
    global $wp_admin_bar;
    if ($wp_admin_bar) {
        $wp_admin_bar->remove_node('new-post');
    }
}

add_action('admin_menu', 'desactiver_posts');
add_action('admin_bar_menu', 'desactiver_posts_admin_bar', 999);

// Redirige les utilisateurs qui essaient d'accéder aux pages de posts
function bloquer_acces_posts() {
    global $pagenow;
    $array_pages = array('edit.php', 'post-new.php', 'post.php');
    
    if (in_array($pagenow, $array_pages) && !isset($_GET['post_type'])) {
        wp_redirect(admin_url());
        exit;
    }
}
add_action('admin_init', 'bloquer_acces_posts');

// Désactive la page d'archive des posts et les flux RSS
function desactiver_flux_posts() {
    if (is_post_type_archive('post') || is_home()) {
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
    }
}
add_action('template_redirect', 'desactiver_flux_posts');
