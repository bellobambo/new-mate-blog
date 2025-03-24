<?php get_header(); ?>

<main class="single-post-container">
    <?php while (have_posts()):
        the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="post-header">
                <h1 class="post-title"><?php the_title(); ?></h1>

                <div class="post-meta">
                    <span class="post-author">
                        By <?php the_author_posts_link(); ?>
                    </span>
                    <span class="post-date">
                        <?php echo get_the_date('F j, Y'); ?>
                    </span>
                    <span class="post-categories">
                        <?php the_category(', '); ?>
                    </span>
                </div>

                <?php if (has_post_thumbnail()): ?>
                    <div class="featured-image">
                        <?php the_post_thumbnail('large', ['class' => 'post-thumbnail']); ?>
                    </div>
                <?php endif; ?>
            </header>

            <div class="post-content">
                <?php the_content(); ?>

                <?php
                wp_link_pages([
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'textdomain'),
                    'after' => '</div>',
                ]);
                ?>
            </div>

            <footer class="post-footer">
                <div class="post-tags">
                    <?php the_tags('<span class="tags-label">Tags:</span> ', ', ', ''); ?>
                </div>

                <?php if (comments_open() || get_comments_number()): ?>
                    <div class="post-comments">
                        <?php comments_template(); ?>
                    </div>
                <?php endif; ?>
            </footer>
        </article>
    <?php endwhile; ?>
</main>

<style>
    .single-post-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem 1rem;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        color: #333;
    }

    .post-header {
        margin-bottom: 2rem;
        text-align: center;
    }

    .post-title {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: #2c3e50;
        line-height: 1.2;
    }

    .post-meta {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1.5rem;
        color: #7f8c8d;
        font-size: 0.9rem;
    }

    .post-meta a {
        color: #3498db;
        text-decoration: none;
    }

    .post-meta a:hover {
        text-decoration: underline;
    }

    .featured-image {
        margin: 1.5rem 0;
    }

    .post-thumbnail {
        width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .post-content {
        font-size: 1.1rem;
        color: #34495e;
    }

    .post-content p {
        margin-bottom: 1.5rem;
    }

    .post-content img {
        max-width: 100%;
        height: auto;
        border-radius: 4px;
        margin: 1.5rem 0;
    }

    .post-content h2,
    .post-content h3,
    .post-content h4 {
        margin: 2rem 0 1rem;
        color: #2c3e50;
    }

    .post-content h2 {
        font-size: 1.8rem;
    }

    .post-content h3 {
        font-size: 1.5rem;
    }

    .post-content h4 {
        font-size: 1.3rem;
    }

    .post-content blockquote {
        border-left: 4px solid #3498db;
        padding-left: 1.5rem;
        margin: 1.5rem 0;
        font-style: italic;
        color: #7f8c8d;
    }

    .post-content a {
        color: #3498db;
        text-decoration: none;
    }

    .post-content a:hover {
        text-decoration: underline;
    }

    .post-footer {
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid #eee;
    }

    .post-tags {
        margin-bottom: 2rem;
    }

    .tags-label {
        font-weight: bold;
        color: #2c3e50;
    }

    .post-tags a {
        display: inline-block;
        background: #f1f1f1;
        color: #3498db;
        padding: 0.3rem 0.8rem;
        margin: 0.3rem;
        border-radius: 20px;
        font-size: 0.9rem;
        text-decoration: none;
    }

    .post-tags a:hover {
        background: #3498db;
        color: white;
    }

    @media (max-width: 768px) {
        .single-post-container {
            padding: 1rem;
        }

        .post-title {
            font-size: 2rem;
        }

        .post-meta {
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }
    }
</style>

<?php get_footer(); ?>