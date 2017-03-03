<?php
if ( $query->have_posts() ) : ?>
<h1 class="title">Resultados</h1>
<ul class="list-item">
	<?php while( $query->have_posts() ) : $query->the_post(); ?>
    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
	<?php endwhile; ?>
</ul>
<?php endif; ?>