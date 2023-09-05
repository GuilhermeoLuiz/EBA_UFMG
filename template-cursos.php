<?php
echo '<h1 class="titulo">Cursos</h1><br>';
$tipos_cursos = array(
    'graduacao' => 'Graduação',
    'posgraduacao' => 'Pós-graduação',
    'extensao' => 'Extensão',
    'pesquisa' => 'Pesquisa'
);

foreach ($tipos_cursos as $tipo => $tipo_display) {
    echo '<h2 class="titulo_cursos">' . $tipo_display . '</h2><br>';
    $args = array(
        'post_type' => 'curso',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'curso_tipo',
                'value' => $tipo,
                'compare' => '='
            )
        )
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        echo '<div class="curso-section">';
        echo '<ul class="curso-list">';
        while ($query->have_posts()) {
            $query->the_post();
            echo '<li class="curso-item">';
            echo '<h3>' . get_the_title() . '</h3>';

            if (has_post_thumbnail()) {
                the_post_thumbnail('thumbnail', array('class' => 'curso-image'));
            }
        }
        echo '</ul>';
        echo '</div>';
        wp_reset_postdata();
    } else {
        echo '<p>Nenhum curso de ' . $tipo_display . ' disponível.</p>';
    }
}