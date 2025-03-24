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
                <span class="post-author">By <?php the_author(); ?></span>
            </div>
            <div class="blog-excerpt">
                <?php the_excerpt(); ?>
            </div>
            <a href="<?php the_permalink(); ?>" class="read-more">Read More →</a>
        </div>
    </article>
    <?php endwhile; ?>
</div>


<?php get_header(); ?>

<style>
.blog-header {
    text-align: center;
    margin-bottom: 40px;
    padding: 20px 0;
    background: #f8f9fa;
}

.blog-title {
    font-size: 2.5rem;
    color: #2c3e50;
    margin-bottom: 10px;
}

.blog-description {
    color: #7f8c8d;
    font-size: 1.1rem;
}

.blog-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
    gap: 30px;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.blog-card {
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.blog-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.blog-image {
    height: 220px;
    overflow: hidden;
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
}

.blog-post-title a {
    color: #2c3e50;
    text-decoration: none;
}

.blog-post-title a:hover {
    color: #3498db;
}

.blog-meta {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
    color: #7f8c8d;
    font-size: 0.9rem;
}

.blog-excerpt {
    color: #34495e;
    line-height: 1.6;
    margin-bottom: 15px;
}

.read-more {
    display: inline-block;
    color: #3498db;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.3s ease;
}

.read-more:hover {
    color: #2980b9;
}

@media (max-width: 768px) {
    .blog-container {
        grid-template-columns: 1fr;
    }
}
</style>

<?php get_footer(); ?>