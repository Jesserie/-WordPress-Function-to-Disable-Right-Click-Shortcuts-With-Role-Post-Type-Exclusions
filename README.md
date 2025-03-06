🛡️ Disable Right-Click & Keyboard Shortcuts in WordPress (with Role & Post Type Exclusions)
This WordPress function prevents users from right-clicking and using common keyboard shortcuts (such as Ctrl+U, Ctrl+C, Ctrl+V, and F12) to enhance content protection. However, it allows specific user roles (e.g., administrators, editors) and post types to bypass these restrictions.

🚀 Features
✅ Disables right-click and common shortcuts (copy, paste, inspect element, view source, print, etc.)
✅ Excludes specific user roles (e.g., administrators, editors) from restrictions
✅ Allows post type exclusions to keep certain content unrestricted
✅ Lightweight and easy to implement – no extra plugins required
✅ Does not affect the WordPress admin area

📌 Installation
Copy the function below and paste it into your theme’s functions.php file or a custom plugin.

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
    </script>'; } add_action('wp_footer', 'disable_right_click_and_shortcuts');


Modify the $allowed_roles array to include the user roles that should be able to right-click and use shortcuts.
Adjust the $excluded_post_types array if you want to exclude certain post types from the restriction.
Save the changes and test your website!

🔧 Customization
Allow More User Roles: Add additional roles to the $allowed_roles array.
Exclude More Post Types: Add more post types to the $excluded_post_types array.
Modify Restricted Shortcuts: Edit the JavaScript keydown event listener to customize which shortcuts are blocked.

📝 Notes
This script runs only on the frontend and does not affect the WordPress admin panel.
Cached pages might need to be cleared for the changes to take effect.

💡 License
This project is open-source and available under the MIT License. Feel free to use and modify it!
