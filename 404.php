<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package colelawson
 */
get_header();
?>

<div id="primary" class="content-area header-gap">
    <main id="main" class="site-main" role="main">
            <section class="error-404 not-found">
                <div class="error-wrapper">
                    <div class="v-outer">
                    <div class="v-middle">
                        <div class="v-inner">
                            <div class="container">
                                <hgroup class="error-title">
                                    <h1 class="box-error"><?php esc_html_e('404', 'colelawson'); ?></h1>
                                    <h2><?php esc_html_e('Oops!', 'colelawson'); ?></h2>
                                    <h3><?php esc_html_e('That page can&rsquo;t be found.', 'colelawson'); ?></h3>
                                </hgroup>
                                <p><a class="btn btn-secondary" href="<?php echo esc_url(home_url('/')); ?>">Go to homepage</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </section>


    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
