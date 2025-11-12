<?php
/*
Plugin Name: Désactivation des Posts
Description: Désactive les posts standards de WordPress
Version: 1.1
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
    // Bloque uniquement le post type par défaut "post"
    if ($pagenow === 'edit.php' && !isset($_GET['post_type'])) {
        // Liste des Articles (post type par défaut)
        wp_redirect(admin_url());
        exit;
    }

    if ($pagenow === 'post-new.php') {
        // Nouvel Article si post_type manquant ou explicite "post"
        $pt = isset($_GET['post_type']) ? sanitize_key($_GET['post_type']) : 'post';
        if ($pt === 'post') {
            wp_redirect(admin_url());
            exit;
        }
    }

    if ($pagenow === 'post.php' && isset($_GET['post'])) {
        // Edition: vérifier le type réel du contenu ciblé
        $post_id = (int) $_GET['post'];
        $post_type = get_post_type($post_id);
        if ($post_type === 'post') {
            wp_redirect(admin_url());
            exit;
        }
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