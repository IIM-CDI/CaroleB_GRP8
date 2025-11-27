<?php

get_header();

?>

<main id="main-content" class="site-main">
    <h1 class="h1"><?php the_title(); ?> </h1>

    <nav class="galerie-nav">
        <?php
        $subpages = get_pages([
            'child_of' => get_the_ID(),
            'sort_column' => 'menu_order'
        ]);

        if ($subpages) {
            echo '<ul class="nav-list">';
            foreach ($subpages as $page) {
                echo '<li class="list-individual">
                <a class="list-a" href="' . get_permalink($page->ID) . '">' . $page->post_title . '</a>
                </li>';
            }
            echo '</ul>';
        }
        ?>
    </nav>

    <section class="galerie-wrapper">
    </section>

    <!-- <nav class="container"></nav> -->
</main><!-- #main-content -->



<?php
get_footer();
