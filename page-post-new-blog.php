<?php get_header(); ?>

<div class="elegant-post-form">
    <div class="form-header">
        <h2>Create New Post</h2>
        <p class="subtitle">Share your thoughts with the world</p>
    </div>

    <?php if (isset($_GET['success']) && $_GET['success'] == '1'): ?>
        <div class="form-notice success">
            <span class="notice-icon">✓</span>
            Post published successfully!
        </div>
    <?php endif; ?>

    <form id="post-form" method="post" enctype="multipart/form-data">
        <div class="form-row title-row">
            <div class="title-label">Post Title</div>
            <input type="text" name="post_title" class="title-input" required placeholder="Enter your post title">
        </div>

        <div class="form-row content-row">
            <div class="content-label">Post Content</div>
            <textarea name="post_content" class="content-input" required placeholder="Write your post content here..."
                rows="8"></textarea>
        </div>

        <div class="form-row image-upload">
            <label class="upload-label">
                <span class="upload-icon">+</span>
                <span class="upload-text">Add Featured Image</span>
                <input type="file" name="featured_image" accept="image/*">
                <div class="preview-container"></div>
            </label>
        </div>

        <div class="form-actions">
            <button type="submit" name="submit_post" class="submit-btn">
                <span class="btn-text">Publish</span>
                <span class="btn-icon">→</span>
            </button>
            <?php wp_nonce_field('new_post_nonce', 'post_nonce_field'); ?>
            <input type="hidden" name="action" value="process_new_post">
        </div>
    </form>
</div>

<style>
    .elegant-post-form {
        max-width: 650px;
        margin: 2rem auto;
        padding: 2rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .form-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .form-header h2 {
        color: #2c3e50;
        font-size: 1.8rem;
        margin: 0 0 0.5rem;
        font-weight: 600;
    }

    .subtitle {
        color: #7f8c8d;
        font-size: 0.95rem;
        margin: 0;
    }

    .form-notice {
        padding: 0.8rem 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        font-size: 0.95rem;
    }

    .success {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .notice-icon {
        margin-right: 0.7rem;
        font-weight: bold;
    }

    .form-row {
        margin-bottom: 1.5rem;
    }


    .title-row {
        margin-bottom: 1.5rem;
    }

    .title-label {
        font-size: 1rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        display: block;
    }

    .title-input {
        width: 100%;
        padding: 0.8rem 1rem;
        font-size: 1rem;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        transition: all 0.2s ease;
        background-color: #f8f9fa;
    }


    .content-row {
        margin-bottom: 1.5rem;
    }

    .content-label {
        font-size: 1rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        display: block;
    }

    .content-input {
        width: 100%;
        padding: 0.8rem 1rem;
        font-size: 1rem;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        transition: all 0.2s ease;
        background-color: #f8f9fa;
        min-height: 200px;
        resize: vertical;
        font-family: inherit;
    }


    .title-input:focus,
    .content-input:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        background-color: white;
    }

    .title-input::placeholder,
    .content-input::placeholder {
        color: #95a5a6;
        opacity: 1;
    }


    .image-upload {
        position: relative;
    }

    .upload-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
        border: 2px dashed #e0e0e0;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
    }

    .upload-label:hover {
        border-color: #bdc3c7;
        background: #f8f9fa;
    }

    .upload-icon {
        font-size: 1.5rem;
        color: #3498db;
        margin-bottom: 0.5rem;
    }

    .upload-text {
        color: #7f8c8d;
        font-size: 0.95rem;
    }

    .upload-label input {
        display: none;
    }

    .preview-container {
        margin-top: 1rem;
        max-width: 100%;
        display: none;
    }

    .preview-container img {
        max-width: 100%;
        max-height: 200px;
        border-radius: 6px;
    }


    .form-actions {
        display: flex;
        justify-content: flex-end;
    }

    .submit-btn {
        display: inline-flex;
        align-items: center;
        padding: 0.7rem 1.5rem;
        background: #3498db;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.2s;
    }

    .submit-btn:hover {
        background: #2980b9;
        transform: translateY(-1px);
    }

    .btn-icon {
        margin-left: 0.5rem;
        transition: transform 0.2s;
    }

    .submit-btn:hover .btn-icon {
        transform: translateX(2px);
    }

    @media (max-width: 768px) {
        .elegant-post-form {
            padding: 1.5rem;
            margin: 1rem;
        }
    }
</style>

<script>
    jQuery(document).ready(function ($) {

        $('input[name="featured_image"]').change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                var preview = $(this).siblings('.preview-container');

                reader.onload = function (e) {
                    preview.html('<img src="' + e.target.result + '">').show();
                }

                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>

<?php

if (isset($_POST['action']) && $_POST['action'] == 'process_new_post' && isset($_POST['post_nonce_field']) && wp_verify_nonce($_POST['post_nonce_field'], 'new_post_nonce')) {

    $post_title = sanitize_text_field($_POST['post_title']);
    $post_content = wp_kses_post($_POST['post_content']);


    $new_post = array(
        'post_title' => $post_title,
        'post_content' => $post_content,
        'post_status' => 'publish',
        'post_type' => 'post'
    );


    $post_id = wp_insert_post($new_post);


    if (!empty($_FILES['featured_image']['name'])) {
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');

        $attachment_id = media_handle_upload('featured_image', $post_id);

        if (!is_wp_error($attachment_id)) {
            set_post_thumbnail($post_id, $attachment_id);
        }
    }


    wp_redirect(add_query_arg('success', '1', wp_get_referer()));
    exit;
}
?>

<?php get_footer(); ?>