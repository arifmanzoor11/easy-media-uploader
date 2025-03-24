# Easy Media Uploader

## Plugin Information

**Plugin Name:** Easy Media Uploader  
**Plugin URI:** [http://guitarchordslyrics.com](http://guitarchordslyrics.com)  
**Description:** A WordPress plugin that provides a dynamic media uploader functionality. It allows users to integrate a media uploader easily within the admin panel and provides shortcode support for displaying uploaded media.  
**Version:** 1.0  
**Author:** Arif M.  
**Author URI:** [http://guitarchordslyrics.com](http://guitarchordslyrics.com)  
**License:** GNU GENERAL PUBLIC LICENSE  

---

## Features
- Enqueues custom CSS and JavaScript for the media uploader.
- Registers a custom post type **"Media Uploader"** with REST API support.
- Adds a custom meta box for generating and displaying shortcodes for uploaded media.
- Provides shortcodes for embedding uploaded media in posts or pages.
- Removes the editor from the custom post type to streamline the interface.

---

## Installation
1. **Upload via WordPress Admin:**
   - Go to `Plugins > Add New > Upload Plugin`.
   - Select the `easy-media-uploader.zip` file and click **Install Now**.
   - Activate the plugin from the **Plugins** menu.
   
2. **Upload via FTP:**
   - Extract the `easy-media-uploader.zip` file.
   - Upload the extracted folder to `/wp-content/plugins/` directory.
   - Activate the plugin from **Plugins** in the WordPress admin panel.

---

## Hooks Used
- `admin_init`: Enqueues styles and scripts for the admin panel.
- `init`: Registers the custom post type and removes the editor support.
- `add_meta_boxes_{post_type}`: Adds a custom meta box for the "Media Uploader" post type.

---

## Functions Included
- **`easy_media_uploader_enqueue()`**: Enqueues the plugin's CSS and JavaScript files.
- **`create_easyposttype()`**: Registers the "Media Uploader" custom post type.
- **`adding_custom_meta_boxes()`**: Adds a meta box for shortcode generation.
- **`cpt_form_site_Render()`**: Renders the content of the custom meta box.

---

## Usage
### Shortcode
Use the generated shortcode in your posts or pages to display uploaded media:
```html
[e_img_{post_id}]
```

### PHP Function
Use this PHP function to insert media dynamically in WordPress theme templates:
```php
<?php echo EasyMedia('[e_img_{post_id}]'); ?>
```

---

## Support & Contributions
If you encounter any issues or want to contribute to the development, feel free to open an issue on GitHub or contact me at [http://guitarchordslyrics.com](http://guitarchordslyrics.com).

---

### Thank you for using Easy Media Uploader! 🚀