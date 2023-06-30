<?php
function mytheme_enqueue_styles() {
    wp_enqueue_style( 'mytheme-style', get_stylesheet_directory_uri() . 'style.css' );
}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_styles' );


function register_my_menus() {
  register_nav_menus( array(
    'menu-principal' => 'menu-principal'
  ) );
}
add_action( 'after_setup_theme', 'register_my_menus' );

function custom_menu_order($menu_order) {
  if (!$menu_order) return true;

  return array(
    'Home',
    'Teste',
    'TI',
    'Tutoriais',
    'Contato'
  );
}
add_filter('custom_menu_order', '__return_true');
add_filter('menu_order', 'custom_menu_order');

function adicionar_titulo_site($title, $sep) {
    if (is_front_page() && is_home()) {
        $title = get_bloginfo('name');
    } elseif (is_singular()) {
        $title = single_post_title('', false);
    }
    return $title . ' ' . $sep . ' ' . get_bloginfo('description');
}
add_filter('wp_title', 'adicionar_titulo_site', 10, 2);
function theme_register_sidebar() {
  register_sidebar(array(
    'name'          => __('Barra Lateral', 'theme-domain'),
    'id'            => 'sidebar-1',
    'description'   => __('Esta é a barra lateral principal.', 'theme-domain'),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ));
}
add_action('widgets_init', 'theme_register_sidebar');


?>
