<?php get_header(); ?>

<div class="blog-header">
    <h1 class="blog-title">Latest Blogs</h1>
    <p class="blog-description">Discover insightful articles from our contributors</p>
</div>

<div class="blog-container">
    <?php while (have_posts()):
        the_post(); ?>
        <article class="blog-card">
            <div class="blog-image">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()): ?>
                        <?php the_post_thumbnail('medium', ['class' => 'featured-image']); ?>
                    <?php else: ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/default-image.jpg" alt="Default blog image"
                            class="featured-image">
                    <?php endif; ?>
                </a>
            </div>
            <div class="blog-content">
                <h2 class="blog-post-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <div class="blog-meta">
                    <span class="post-date"><?php echo get_the_date(); ?></span>
                </div>
                <div class="blog-excerpt">
                    <?php the_excerpt(); ?>
                </div>
                <a href="<?php the_permalink(); ?>" class="read-more">Read More →</a>
            </div>
        </article>
    <?php endwhile; ?>
</div>

<style>
    .blog-header {
        text-align: center;
        padding: 30px 0;
        color: white;
        background: rgb(78, 15, 71);
    }

    .blog-title {
        font-size: 2.5rem;
        color: white;
        margin-bottom: 10px;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

    }

    .blog-description {
        color: #e0e0e0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;

    }

    .blog-container {
        display: grid;
        background: #4E0F47;
        grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
        grid-template-rows: repeat(2, auto);
        /* 2 rows */
        gap: 30px;
        max-width: 100%;

        padding: 20px;
    }

    .blog-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid #eee;
    }

    .blog-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(107, 46, 131, 0.2);
        /* Purple tinted shadow */
    }

    .blog-image {
        height: 220px;
        overflow: hidden;
        border-bottom: 3px solid #4E0F47;
        /* Green accent border */
    }

    .featured-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .blog-card:hover .featured-image {
        transform: scale(1.05);
    }

    .blog-content {
        padding: 20px;
    }

    .blog-post-title {
        margin: 0 0 10px 0;
        font-size: 1.5rem;
        line-height: 1.3;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

    }

    .blog-post-title a {
        color: #4E0F47;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

        /* Dark purple */
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .blog-post-title a:hover {
        color: #4E0F47;
        /* Lighter purple */
    }

    .blog-meta {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
        color: #666;
        font-size: 0.9rem;
    }

    .blog-excerpt {
        color: #333;
        line-height: 1.6;
        margin-bottom: 15px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

    }

    .read-more {
        display: inline-block;
        color: #4E0F47;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

        /* Green */
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .read-more:hover {
        color: rgb(156, 39, 142);
        /* Darker green */
        transform: translateX(5px);
    }

    @media (max-width: 768px) {
        .blog-container {
            grid-template-columns: 1fr;
            padding: 10px;
        }

        .blog-header {
            padding: 20px 10px;
        }

        .blog-title {
            font-size: 2rem;
        }
    }
</style>

<?php get_footer(); ?>