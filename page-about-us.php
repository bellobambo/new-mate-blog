<?php get_header(); ?>

<div class="about-page">
    <!-- Latest Post Section -->
    <div class="latest-post-section"
        style="background-color:rgb(69, 88, 105); color: white; padding: 60px 20px; display: flex; align-items: center; justify-content: center; gap: 40px;">
        <h2 style="margin: 0; flex: 1; text-align: center;">Latest Post</h2>

        <?php
        $latest_post = wp_get_recent_posts(array(
            'numberposts' => 1,
            'post_status' => 'publish'
        ));

        if (!empty($latest_post)) {
            $post = $latest_post[0];
            $post_id = $post['ID'];
            $post_title = $post['post_title'];
            $post_content = wp_trim_words($post['post_content'], 40);
            $post_image = get_the_post_thumbnail_url($post_id, 'large');

            if ($post_image) {
                echo '<img src="' . esc_url($post_image) . '" alt="' . esc_attr($post_title) . '" style="max-width: 400px; height: auto; flex: 1; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.2);" />';
            } else {
                echo '<div style="flex: 1; text-align: center;">No featured image</div>';
            }
        }
        ?>
    </div>

    <!-- Post Title and Content Section -->
    <?php if (!empty($latest_post)): ?>
    <div class="post-content-section"
        style="background-color: white; color: #333; padding: 60px 20px; text-align: center;">
        <h3 style="margin-bottom: 20px; color: #1a237e;"><?php echo esc_html($post_title); ?></h3>
        <p style="max-width: 800px; margin: 0 auto 20px; font-size: 1.1em; line-height: 1.6;">
            <?php echo esc_html($post_content); ?>
        </p>
        <a href="<?php echo esc_url(get_permalink($post_id)); ?>"
            style="text-decoration: none; color: #1a237e; font-weight: bold; font-size: 1.1em;">Read more →</a>
    </div>
    <?php endif; ?>

    <!-- About Website Section -->
    <div class="about-website-section"
        style="background-color:rgb(69, 88, 105); color: white; padding: 60px 20px; text-align: center;">
        <h2 style="margin-bottom: 30px;">About Our Website</h2>
        <div style="max-width: 800px; margin: 0 auto; font-size: 1.1em; line-height: 1.6;">
            <p>Welcome to our platform! This website is designed for users to share ideas, thoughts, and creative
                content
                with the community. Whether you're looking to express yourself, learn from others, or engage in
                meaningful
                discussions, this is the perfect place for you.</p>
            <p>We believe in the power of sharing knowledge and experiences to build a stronger, more connected
                community.
                Join us today and be part of the conversation!</p>
        </div>
    </div>

    <!-- Create New Post Button -->
    <div class="create-post-section" style="background-color: white; padding: 60px 20px; text-align: center;">
        <a href="<?php echo esc_url(home_url('/post-new-blog')); ?>"
            style="display: inline-block; padding: 15px 30px; background-color:rgb(69, 88, 105); color: white; text-decoration: none; border-radius: 6px; font-size: 1.1em; font-weight: bold; transition: all 0.3s ease;">
            Create New Post
        </a>
    </div>
</div>

<style>
.latest-post-section,
.post-content-section,
.about-website-section,
</style>

<?php get_footer(); ?>