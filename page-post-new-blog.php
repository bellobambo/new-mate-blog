<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'process_new_post') {

    if (!isset($_POST['post_nonce_field'])) {
        wp_redirect(add_query_arg('error', 'nonce_failed', wp_get_referer()));
        exit;
    }

    if (!wp_verify_nonce($_POST['post_nonce_field'], 'new_post_nonce')) {
        wp_redirect(add_query_arg('error', 'nonce_failed', wp_get_referer()));
        exit;
    }

    if (!is_user_logged_in() || !current_user_can('edit_posts')) {
        wp_redirect(add_query_arg('error', 'no_permission', wp_get_referer()));
        exit;
    }


    if (empty($_POST['post_title'])) {
        wp_redirect(add_query_arg('error', 'no_title', wp_get_referer()));
        exit;
    }

    if (empty($_POST['post_content'])) {
        wp_redirect(add_query_arg('error', 'no_content', wp_get_referer()));
        exit;
    }


    $post_title = sanitize_text_field($_POST['post_title']);
    $post_content = wp_kses_post($_POST['post_content']);
    $author_id = get_current_user_id();


    $new_post = array(
        'post_title' => $post_title,
        'post_content' => $post_content,
        'post_status' => 'pending',
        'post_author' => $author_id,
        'post_type' => 'post'
    );

    $post_id = wp_insert_post($new_post);

    if (is_wp_error($post_id)) {
        wp_redirect(add_query_arg('error', 'post_failed', wp_get_referer()));
        exit;
    }


    if (!empty($_FILES['featured_image']['name'])) {
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');

        $attachment_id = media_handle_upload('featured_image', $post_id);

        if (is_wp_error($attachment_id)) {
            wp_delete_post($post_id, true);
            wp_redirect(add_query_arg('error', 'upload_failed', wp_get_referer()));
            exit;
        }

        set_post_thumbnail($post_id, $attachment_id);
    }


    $admin_email = get_option('admin_email');
    $post_link = admin_url('post.php?post=' . $post_id . '&action=edit');
    $subject = 'New Post Submission Requires Approval';
    $message = "A new post has been submitted for approval:\n\n";
    $message .= "Title: " . $post_title . "\n";
    $message .= "Author: " . get_the_author_meta('display_name', $author_id) . "\n\n";
    $message .= "Review and approve: " . $post_link;

    wp_mail($admin_email, $subject, $message);

    wp_redirect(add_query_arg('success', '1', wp_get_referer()));
    exit;
}


get_header();
?>

<div class="elegant-post-form">
    <div class="form-header">
        <h2>Create New Post</h2>
        <p class="subtitle">Share your thoughts with the world</p>
    </div>

    <?php if (isset($_GET['success']) && $_GET['success'] == '1'): ?>
        <div class="form-notice success">
            <span class="notice-icon">✓</span>
            Post submitted successfully! It will be published after admin approval.
        </div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="form-notice error">
            <span class="notice-icon">!</span>
            <?php
            switch ($_GET['error']) {
                case 'nonce_failed':
                    echo 'Security verification failed. Please try again.';
                    break;
                case 'no_title':
                    echo 'Please enter a post title.';
                    break;
                case 'no_content':
                    echo 'Please enter post content.';
                    break;
                case 'upload_failed':
                    echo 'Image upload failed. Please try again.';
                    break;
                case 'post_failed':
                    echo 'Post creation failed. Please try again.';
                    break;
                case 'no_permission':
                    echo 'You do not have permission to submit posts.';
                    break;
                default:
                    echo 'An error occurred. Please try again.';
            }
            ?>
        </div>
    <?php endif; ?>

    <?php if (is_user_logged_in() && current_user_can('edit_posts')): ?>
        <form id="post-form" method="post" enctype="multipart/form-data">
            <div class="form-row title-row">
                <div class="title-label">Post Title</div>
                <input type="text" name="post_title" class="title-input" required placeholder="Enter your post title"
                    value="<?php echo isset($_POST['post_title']) ? esc_attr($_POST['post_title']) : ''; ?>">
            </div>

            <div class="form-row content-row">
                <div class="content-label">Post Content</div>
                <?php
                $content = isset($_POST['post_content']) ? wp_kses_post($_POST['post_content']) : '';
                wp_editor($content, 'post_content', array(
                    'textarea_name' => 'post_content',
                    'media_buttons' => false,
                    'textarea_rows' => 8,
                    'teeny' => true,
                    'quicktags' => false
                ));
                ?>
            </div>

            <div class="form-row image-upload">
                <label class="upload-label">
                    <span class="upload-icon">+</span>
                    <span class="upload-text">Add Featured Image</span>
                    <input type="file" name="featured_image" accept="image/*">
                    <div class="preview-container">
                        <?php if (isset($_GET['preview_image'])): ?>
                            <img src="<?php echo esc_url($_GET['preview_image']); ?>">
                        <?php endif; ?>
                    </div>
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" name="submit_post" class="submit-btn">
                    <span class="btn-text">Submit for Review</span>
                    <span class="btn-icon">→</span>
                    <span class="loading-spinner" style="display: none;">
                        <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 3.5A6.5 6.5 0 0 0 3.5 10 .75.75 0 0 1 2 10a8 8 0 1 1 8 8 .75.75 0 0 1 0-1.5 6.5 6.5 0 1 0 0-13z"
                                fill="#fff" />
                        </svg>
                    </span>
                </button>
                <?php wp_nonce_field('new_post_nonce', 'post_nonce_field'); ?>
                <input type="hidden" name="action" value="process_new_post">
            </div>
        </form>
    <?php else: ?>
        <div class="form-notice info">
            <span class="notice-icon">i</span>
            <?php if (!is_user_logged_in()): ?>
                You need to <a href="<?php echo wp_login_url(get_permalink()); ?>">log in</a> to submit posts.
            <?php else: ?>
                Your account doesn't have permission to submit posts.
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<style>
    .elegant-post-form {
        background: #4E0F47;

    }

    .loading-spinner {
        margin-left: 8px;
        animation: spin 1s linear infinite;
    }

    .loading-spinner svg {
        display: block;
        width: 20px;
        height: 20px;
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    .submit-btn.is-loading .btn-text,
    .submit-btn.is-loading .btn-icon {
        visibility: hidden;
    }

    .submit-btn.is-loading .loading-spinner {
        display: inline-block !important;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
    }

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
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

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

    .error {
        background: #ffebee;
        color: #c62828;
    }

    .info {
        background: #e3f2fd;
        color: #1565c0;
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
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

    }

    .title-input {
        width: 100%;
        padding: 0.8rem 1rem;
        font-size: 1rem;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        transition: all 0.2s ease;
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

    }

    .title-input:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        background-color: white;
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
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

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
        min-height: 150px;
    }

    .upload-label:hover {
        border-color: #3498db;
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
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

    }

    .upload-label input {
        display: none;
    }

    .preview-container {
        position: relative;
        margin-top: 1rem;
        max-width: 100%;
        text-align: center;
    }

    .preview-container img {
        max-width: 100%;
        max-height: 300px;
        border-radius: 6px;
        object-fit: contain;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .remove-image {
        position: absolute;
        top: -10px;
        right: -10px;
        width: 28px;
        height: 28px;
        background: #ff4444;
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .remove-image:hover {
        background: #cc0000;
        transform: scale(1.1);
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        margin-top: 2rem;
    }

    .submit-btn {
        display: inline-flex;
        align-items: center;
        padding: 0.8rem 1.8rem;
        background: #4caf50;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 2px 5px rgba(52, 152, 219, 0.2);
    }

    .submit-btn:hover {
        background: rgb(95, 227, 100);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(52, 152, 219, 0.3);
    }

    .btn-icon {
        margin-left: 0.5rem;
        transition: transform 0.2s;
    }

    .submit-btn:hover .btn-icon {
        transform: translateX(3px);
    }

    .loading-text {
        color: #7f8c8d;
        font-style: italic;
        margin-top: 0.5rem;
    }

    @media (max-width: 768px) {
        .elegant-post-form {
            padding: 1.5rem;
            margin: 1rem;
        }

        .preview-container img {
            max-height: 250px;
        }

        .submit-btn {
            padding: 0.7rem 1.5rem;
            width: 100%;
            justify-content: center;
        }
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        if (typeof jQuery !== 'undefined') {
            jQuery(function ($) {

                if (typeof tinymce !== 'undefined' && tinymce.get('post_content')) {
                    var editor = tinymce.get('post_content');


                    if (!editor.getContent()) {
                        editor.setContent('<p class="placeholder-text">Enter description</p>');
                        editor.dom.addClass(editor.getBody(), 'placeholder-active');
                    }

                    // Handle focus/blur events
                    editor.on('focus', function () {
                        if (editor.dom.hasClass(editor.getBody(), 'placeholder-active')) {
                            editor.setContent('');
                            editor.dom.removeClass(editor.getBody(), 'placeholder-active');
                        }
                    });

                    editor.on('blur', function () {
                        if (!editor.getContent()) {
                            editor.setContent('<p class="placeholder-text">Enter description</p>');
                            editor.dom.addClass(editor.getBody(), 'placeholder-active');
                        }
                    });
                }


                $('#post_content').attr('placeholder', 'Enter description');


                $('#post-form').on('submit', function (e) {
                    var $form = $(this);
                    var $submitBtn = $form.find('.submit-btn');

                    if ($submitBtn.hasClass('is-loading')) {
                        e.preventDefault();
                        return false;
                    }

                    $submitBtn.addClass('is-loading')
                        .prop('disabled', true);

                    setTimeout(function () {
                        $form.get(0).submit();
                    }, 150);
                });


                $('input[name="featured_image"]').change(function () {
                    if (this.files && this.files[0]) {
                        var reader = new FileReader();
                        var preview = $(this).siblings('.preview-container');
                        var uploadLabel = $(this).closest('.upload-label');

                        preview.html('<div class="loading-text">Loading image preview...</div>');

                        reader.onload = function (e) {
                            preview.html(
                                '<div class="image-preview-wrapper">' +
                                '<img src="' + e.target.result +
                                '" class="image-preview">' +
                                '<button class="remove-image" title="Remove image" aria-label="Remove image">×</button>' +
                                '</div>'
                            );

                            uploadLabel.css({
                                'border-color': '#3498db',
                                'background-color': '#f8f9fa'
                            });
                        };

                        reader.onerror = function () {
                            preview.html(
                                '<div class="error">Error loading image preview</div>');
                        };

                        reader.readAsDataURL(this.files[0]);
                    }
                });

                // Your existing image removal handler
                $(document).on('click', '.remove-image', function () {
                    var previewContainer = $(this).closest('.preview-container');
                    var uploadLabel = $(this).closest('.upload-label');

                    $('input[name="featured_image"]').val('');

                    uploadLabel.css({
                        'border-color': '#e0e0e0',
                        'background-color': 'transparent'
                    });

                    previewContainer.empty();
                });
            });
        } else {
            console.error('jQuery is not loaded');
        }
    });
</script>


<?php


get_footer();
?>