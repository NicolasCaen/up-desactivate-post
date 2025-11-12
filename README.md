# Désactivation des Posts

**Version :** 1.1  
**Auteur :** Nicolas Gehin  
**Compatibilité :** WordPress 6.x+

## Description
Ce module supprime l’interface d’administration des articles (`post`) de WordPress :
- Retire le menu « Articles » du tableau de bord.
- Masque l’option « Nouvel article » dans la barre d’administration.
- Empêche l’accès aux écrans liés aux articles classiques.
- Retourne une erreur 404 pour l’archive des articles et la page d’accueil blog.

> ⚠️ Les pages (`page`) et tout autre Custom Post Type restent accessibles.

## Installation
1. Copier le dossier `up-desactivate-post` dans `wp-content/plugins/` ou installer via votre outil de déploiement.
2. Activer le module depuis **Extensions → Extensions installées**.
3. Aucune configuration supplémentaire n’est requise.

## Mise à jour 1.1
- Limitation de la redirection automatique aux contenus de type `post` pour permettre l’édition des pages.

## Support
Toute demande d’assistance peut être envoyée à l’équipe interne ; merci de préciser la version du plugin ainsi que votre version de WordPress.
