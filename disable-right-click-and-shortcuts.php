function disable_right_click_and_shortcuts() {
    if (is_admin()) return; // Don't apply in admin area
    
    // Get current user role
    $user = wp_get_current_user();
    $allowed_roles = array('administrator', 'editor'); // Roles that can use right-click and shortcuts
    
    // Get current post type
    global $post;
    $excluded_post_types = array('custom_post_type'); // Add post types to exclude from restriction
    
    if (array_intersect($allowed_roles, $user->roles) || (isset($post->post_type) && in_array($post->post_type, $excluded_post_types))) {
        return; // Allow right-click and shortcuts for specified roles or post types
    }
    
    echo '<script>
        document.addEventListener("contextmenu", function(event) {
            event.preventDefault();
        });
        
        document.addEventListener("keydown", function(event) {
            if (
                event.ctrlKey && (event.key === "u" || event.key === "s" || event.key === "c" || event.key === "v" || event.key === "p") ||
                event.metaKey && (event.key === "u" || event.key === "s" || event.key === "c" || event.key === "v" || event.key === "p") ||
                event.keyCode === 123 // F12 key
            ) {
                event.preventDefault();
            }
        });
    </script>';
}
add_action('wp_footer', 'disable_right_click_and_shortcuts');

