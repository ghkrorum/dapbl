<?php get_header(); ?>
<?php
$s = isset( $_GET['s'] )?$_GET['s']:'';
?>
                <section class="section-principal  mas-destacados">
                    <div class="container-fluid">
                        <div class="container">
                            <div class="row section section-ultimos destacados-last">

                                <?php echo do_shortcode('[ajax_load_more repeater="template_1" post_type="post" search="'.$s.'" posts_per_page="8" button_label = "Ver más" button_loading_label="Cargando más noticias" scroll="true"]'); ?>

                            </div>
                        </div>
                    </div>
                </section>
<?php get_footer(); ?>