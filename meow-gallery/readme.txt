=== Meow Gallery ===
Contributors: TigrouMeow
Tags: gallery, masonry, image, block, lightroom
Donate link: https://www.patreon.com/meowapps
Requires at least: 6.0
Tested up to: 7.1
Requires PHP: 8.1
Stable tag: 5.6.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Tired of slow, bloated gallery plugins? Here is the answer! ☺️ Polished, beautiful galleries that are blazing fast. No bloat. Enjoy! 💕

== Description ==

**Meow Gallery is the lightweight, polished gallery solution for WordPress.** Built from scratch for simplicity, appearance, and speed. Features a Gallery Block, shortcode support, or works as an override for the standard WordPress gallery. It's responsive, retina-friendly, with modern layouts, and tightly optimized.

Stop fighting bloated gallery plugins that turn your WordPress into a slower experience! 😘

Meow Gallery focuses on what actually matters: **Beautiful Layouts** and **Performance**. Check out [our official site](https://meowapps.com/meow-gallery/) and see [the layouts in action](https://meowapps.com/meow-gallery/layouts/) to get started.

== Core Features ==

🎨 **Beautiful Layouts**
Choose from Tiles, Masonry, Justified (like Flickr), Square (like Instagram), Cascade, and Horizontal. Pro version adds Carousel and Map layouts.

🚀 **Performance First**
Built from scratch with modern code. No legacy bloat, no unnecessary features. Just clean, fast galleries.

🔌 **WordPress Native**
Works naturally with WordPress and Gutenberg without hacking it. Use the Gallery Block, shortcode, or override the standard WordPress gallery. Switch back anytime—no lock-in.

📱 **Responsive & Retina**
All layouts are fully responsive and retina-ready for crisp images on any device.

[youtube https://youtu.be/N0TM1hUYQjk]

== Compatibility ==

Since Meow Gallery works with WordPress naturally, it's compatible with most plugins and themes:

* **Lightbox**: Use any lightbox you prefer. We recommend [Meow Lightbox](https://wordpress.org/plugins/meow-lightbox/) for the best experience.
* **Lightroom**: Fully compatible with [Photo Engine](https://wordpress.org/plugins/wplr-sync/) for media organization and Lightroom sync.
* **External Links**: Use [Gallery Custom Links](https://wordpress.org/plugins/gallery-custom-links/) to add custom URLs to your images.
* **Audio**: Add audio to images with [Audio Story Images](https://wordpress.org/plugins/audio-story-images/).

SEO-friendly with automatic sitemap integration (works with Yoast SEO and others).

== Pro Features ==

* **Infinite/Lazy Loading**: Faster page loading and smoother experience
* **Carousel Layout**: Dynamic slider/carousel that can also work as a hero
* **Map Layout**: GPS-based photo display for travel galleries
* **Animations**: Bring your galleries to life with smooth animations

You can find more information on [Meow Apps: Meow Gallery](https://meowapps.com/meow-gallery/).

== Changelog ==

= 5.6.1 (2026/11/13) =
* Fix: Square layout now keeps its sizes marker through the image filter, so square tiles load the sharp image.
* Update: Synced the shared Meow Apps library, including the license block and pricing data.

= 5.6.0 (2026/11/10) =
* Fix: Security: SQL injection in the latest photos REST endpoint by casting the limit and offset.
* Fix: Blurry photos in the square layout caused by WordPress adding auto sizes back to the images.

= 5.5.9 (2026/11/08) =
* Fix: Blurry landscape photos in the Square layout, the browser now gets the right image size.

= 5.5.8 (2026/10/30) =
* Fix: Security: Escape the target, rel and class attributes of gallery links.

= 5.5.7 (2026/10/30) =
* Add: The empty gallery message can now be translated, and changed or hidden with the new mgl_empty_gallery_message filter.
* Update: Gallery animations are now marked as Pro in the free block.
* Update: New installs now default to OpenStreetMap for maps; existing map settings are kept.
* Update: Bento collection titles now inherit the theme color.
* Fix: Galleries using both id and ids showed up empty; ids wins again, as in WordPress.
* Fix: OpenStreetMap, Mapbox and MapTiler maps now fit all their pins.

= 5.5.6 (2026/10/03) =
* Update: Gallery data in the HTML now only keeps the image dimensions, no longer the full list of sizes and the EXIF data.
* 🎵 Discuss with others about Meow Gallery on [the Discord](https://discord.gg/bHDGh38).
* 🌴 Keep us motivated with [a little review here](https://wordpress.org/support/plugin/meow-gallery/reviews/). Thank you!
* 🥰 If you want to help us, check our [Patreon](https://www.patreon.com/meowapps). Thank you!

= 5.5.5 (2026/09/17) =
* Fix: Hotfix for an unauthenticated shortcode injection reported by JunHee CHO and Kaan Özbek.
* Fix: Hotfix for a draft post disclosure reported by JunHee CHO and Kaan Özbek.
* Update: The media endpoint is now disabled when infinite scroll is off.

= 5.5.4 (2026/09/14) =
* Add: "See Full Preview" button in the gallery block.
* Add: Uploads from the block are now attached to the post they're added to.
* Fix: Collections with an empty name no longer crash the block.
* Update: License errors now show the actual issue on the Plugins page, and the dashboard has been cleaned up.
* Update: Media data is handled consistently across the block, collections and shortcodes.
* Update: All scripts and styles are now registered in a single place.

= 5.5.3 (2026/08/17) =
* Update: PHP 8.1 is now the minimum required version.
* Add: Reworked dashboard with a plugin board view, AI site analysis and a bounded speed test.
* Add: Border and hover options in the Design Tool.
* Add: Preview mode indicator for gallery blocks in the post editor.
* Fix: The `wp_get_attachment_image_attributes` filter now applies to infinite scroll and collections.

= 5.5.2 (2026/07/30) =
* Add: Real Media Library support for galleries and collections, including as a Dynamic type in the Gallery Manager.
* Fix: Infinite scroll now works on viewports without scrolling, using an IntersectionObserver to track the loading sentinel.
* Fix: Collections with missing thumbnails are now handled gracefully.
* Fix: Empty gallery handling simplified by removing unnecessary attachment retrieval.
* Fix: Tables in the Collection Maker, Managers, and Shortcode Maker now display correctly on mobile viewports.
* 🎵 Discuss with others about Meow Gallery on [the Discord](https://discord.gg/bHDGh38).
* 🌴 Keep us motivated with [a little review here](https://wordpress.org/support/plugin/meow-gallery/reviews/). Thank you!
* 🥰 If you want to help us, check our [Patreon](https://www.patreon.com/meowapps). Thank you!

= 5.5.1 (2026/06/28) =
* Update: Improved handling of image ID attributes in the gallery shortcode.
* Update: Updated the Media Selector.

= 5.5.0 (2026/05/30) =
* Fix: Order handling when using combined "orderby-order" parameter format.
* Update: Improved emoji handling in gallery HTML processing and clearer error messages.
* Add: Support for passing gallery attributes through collection shortcodes using the `gallery_{att}={value}` format.

= 5.4.9 (2026/05/07) =
* Fix: Removed srcset attribute from collection thumbnails when not available.
* Add: Exposed collection helpers for use by external plugins like Cleaner.
* 🎵 Discuss with others about Meow Gallery on [the Discord](https://discord.gg/bHDGh38).
* 🌴 Keep us motivated with [a little review here](https://wordpress.org/support/plugin/meow-gallery/reviews/). Thank you!
* 🥰 If you want to help us, check our [Patreon](https://www.patreon.com/meowapps). Thank you!

= 5.4.8 (2026/04/25) =
* Add: "Design Tool" feature (BETA).
* Update: Removed the "stylish" setting for Tiles layout.
* Update: Better UI/UX.

= 5.4.7 (2026/04/19) =
* Fix: Fixed a warning on missing thumbnails, showing graceful placeholders instead of broken images in both the backend and frontend.

= 5.4.6 (2026/04/15) =
* Add: Dynamic galleries with Tags support, now available in the manager.
* Add: "Order by" option is now always visible in the manager modal for easier sorting.
* Fix: Block styling and properties now render correctly within iframes (Block API v3).
* Fix: GPS coordinates from photo EXIF data are now handled more reliably, including support for float values.
* Update: REST API method for the images endpoint changed from GET to POST—developers using this endpoint will need to update their requests accordingly.
* Update: Internal database checks have been streamlined for improved reliability and cleaner codebase.

= 5.4.5 (2026/02/25) =
* Fix: Validate the gallery sorting order so it only accepts ASC or DESC values.
* Update: Refactor the gallery function to support options for preview.
* Fix: Ensure collections correctly update the lightbox.
* Add: Improve accessibility by adding keyboard shortcuts to jump to the start or end of the focused gallery.
* Fix: Correct the manager’s layout override logic so shortcode and block settings behave as expected.
* Update: Change permission checks to use the can_access_settings capability.
* Fix: Improve menu layout loading behavior and visual consistency.
* Fix: Provide a default map engine and a clear error message when none is configured.
* 🎵 Discuss with others about Meow Gallery on [the Discord](https://discord.gg/bHDGh38).
* 🌴 Keep us motivated with [a little review here](https://wordpress.org/support/plugin/meow-gallery/reviews/). Thank you!
* 🥰 If you want to help us, check our [Patreon](https://www.patreon.com/meowapps). Thank you!

= 5.4.4 (2026/01/27) =
* Add: New rank system to manually organize galleries.
* Add: Bulk delete option to quickly remove multiple galleries.
* Add: Ability to sort galleries by name.
* Update: Preview mode now shows the "order by" setting.
* Add: Truncate count option for galleries on the listing page to shorten long item counts.
* Fix: Load more now registers and works correctly when using the editor.

= 5.4.3 (2026/01/05) =
* Add: Fallback width handling in the gallery height calculation.  
* Add: Truncate option for listing pages to shorten long text.  
* Update: Tutorial links.  
* Add: Caption source selection and improved caption retrieval logic.  
* Add: Expose the `mgl_load_more` function on the global window object (developers can trigger infinite gallery loading from custom scripts).

= 5.4.2 (2025/12/16) =
* Fix: Corrected box spacing (gutters).

= 5.4.1 (2025/12/07) =
* Update: Refined how shortcode ordering options are handled for more predictable display behavior.
* Fix: Reset the plugin’s internal database version when options are reset to ensure a clean configuration state.
* Add: Introduced tabindex support and improved keyboard navigation for better accessibility.
* Fix: Ensured all block-related features safely handle list operations to prevent unexpected errors.

= 5.4.0 (2025/12/04) =
* Update: Better enqueuing.
* Fix: Stop sending htmlPreview data with block content to improve performance.
* Update: Apply the new stylesheet loading method in the WordPress admin area.
* Fix: Ensure the lightbox render is triggered after async loading.
* Fix: Add the base wp-image- class to carousel images.

= 5.3.9 (2025/12/03) =
* Fix: Resolve an issue where a broken gutter setting showed as [object Object].
* Fix: Ensure the "animation" option is correctly included when using the block shortcode.
* Add: Introduce a dedicated enqueue_styles method and refine how plugin scripts are loaded.
* Add: Enable animation controls directly in the block settings.

= 5.3.8 (2025/12/02) =
* Update: Smoother and more modern system.
* Update: Refreshed common libs.
* Fix: Glitch with Meow Lightbox.
* 🎵 Discuss with others about Meow Gallery on [the Discord](https://discord.gg/bHDGh38).
* 🌴 Keep us motivated with [a little review here](https://wordpress.org/support/plugin/meow-gallery/reviews/). Thank you!
* 🥰 If you want to help us, check our [Patreon](https://www.patreon.com/meowapps). Thank you!

= 5.3.7 (2025/11/12) =
* Add: Uploading state and preview feature for blocks.
* Add: orderBy attribute and control to the Gallery block.
* Fix: Drag and drop functionality in blocks.

= 5.3.6 (2025/09/29) =
* Add: Retrieve thumbnail sizes for Map Markers.
* Add: Breakpoint for Square layout to improve responsiveness on tablets.
* Add: Search input feature for Galleries and Collections Manager.
* Fix: Resolved an issue where gallery overlays interfered with editor content by integrating Skeleton for better stability.
* Fix: Implemented MutationObserver to automatically rerender Lightbox when Map Layout finishes loading.

= 5.3.5 (2025/08/27) =
* Add: Density for Justified layout.

= 5.3.4 (2025/08/16) =
* Add: Introduced a global $wpmgl variable (JS API).
* Fix: Corrected ALT Text for images with non-srcset sizes.
* Update: UI improvements.

= 5.3.3 (2025/07/23) =
* Add: Missing Leaflet images to improve content completeness.  
* Fix: Empty rows in collections Bento for a cleaner appearance.  
* Fix: Warning messages resolved to enhance stability.

= 5.3.2 (2025/07/01) =
* Add: Carousel 'Keep Aspect Ratio' now available as a Block and Shortcode attribute.
* Add: Skeleton loading option added for gallery layouts and enabled by default to reduce CLS.
* Fix: Improved pagination in Collections Manager.
* Fix: Improved pagination in Galleries Manager.
* Update: Collections now use the original image for map pin display if no other size is available.

= 5.3.1 (2025/05/06) =
* Fix: Corrected table display issues for Collections.

= 5.3.0 (2025/05/03) =
* Add: Improved Gallery Manager display with more detailed information.
* Add: Introduced new order options in the Gallery Manager.
* Add: Added support for additional "order by" sorting options.

= 5.2.9 (2025/05/02) =
* Add: Order by option to Gallery Manager for enhanced sorting flexibility.
* Fix: Corrected sorting for IDS to ensure accurate display order.

= 5.2.8 (2025/05/01) =
* Fix: Corrected post selector search and allowed saving without selected posts.
* Fix: Resolved a render loop issue and improved gallery rendering stability.
* Fix: Updated SQL query in get_gallery_by_id to use a proper string placeholder.
* Update: Refactored CollectionThumbnails, updated styles and dimensions in ShortcodeMaker, and improved unique ID generation.
* Update: Refined UI by updating the back button SVG and commenting out the loading spinner.
* Add: Introduced lead image selection feature for Collections.
* Update: Replaced generate_uniqid with wp_unique_id and added unique constraints in the database.
* Fix: Sanitized captions to prevent XSS vulnerabilities.
* Update: Replaced NekoInput with PostSelector in the manager for better post selection.
* Fix: Removed incompatible PHP 8 syntax in get_collection_by_id.
* Add: Added a default link option setting.
* Update: Ensured gallery layout respects block settings overrides.

= 5.2.7 (2025/03/13) =
* Update: Reworked the Block to support Manager shortcodes for better integration.
* Add: Added support for the AVIF image format in the MediaSelector component.
* Update: Refactored gallery and collection data retrieval to use core methods for consistency.
* Fix: Resolved block display issues when selecting Gallery/Collection.
* Update: Migrated Galleries and Collections from options to database tables for improved performance.
* Update: Implemented React Query for Galleries and Collections to enhance data handling.
* Fix: Corrected sorting issues in the Gallery Manager.
* Fix: Fixed fetching of galleries data in the Gallery Manager.
* Update: Improved Collections by integrating Neko Shortcode.
* Fix: Addressed multi-page gallery selection issues in the Collection Maker.

= 5.2.5 (2025/02/17) =
* Add: Added wp-video-id class to videos in galleries for better styling and identification.
* Update: Improved video element handling and fixed boolean attributes in XML.
* Fix: Added an attachment fallback when link="file" is empty for videos.
* Fix: Corrected boolean attributes in XML for video elements.
* Update: Refactored ShortcodeMaker to use NekoShortcode for better shortcode management.
* Note: We need some love! If you have a moment, please write a little [review for the Meow Gallery](https://wordpress.org/support/plugin/meow-gallery/reviews/?rate=5#new-post). Thank you! 💕

= 5.2.4 (2025/01/15) =
* Fix: Issue with how the JSON attributes were escaped.
* Update: Enhanced the UI of the blocks.

= 5.2.3 (2025/01/04) =
* Update: Improved escaping related to JSON gallery attributes.
* Fix: Check if the shortcode ID is set and not empty.
* Add: Native horizontal scrolling in Horizontal layout settings.
* Update: Removed max attributes for layouts.
* Add: Galleries and Collections Management now available in the Gallery Block.

= 5.2.2 (2024/12/06) =
* Add: Caption Backgrounds in the Settings.

= 5.2.1 (2024/11/04) =
* Add: "Load More" option for Infinite Scroll.
* Fix: Media Selector limitations.

= 5.2.0 (2024/10/17) =
* Update: PhotoSwipe now works with Infinite Scrolling.
* Fix: Gallery initial state saved in the block.

= 5.1.9 (2024/08/25) =
* Fix: Fixed link attributes for maps.
* Fix: Removed error logs.

= 5.1.8 (2024/08/01) =
* Fix: Make sure data-attr have a layout.
* Fix: Minor issues.

= 5.1.7 (2024/06/15) =
* Update: Code cleaning, libs optimization, etc.
* Fix: Carousel Hero height for non-horizontal images.
* Fix: Resolved issues with the Gallery Manager modal.
* Update: Use Image Alt as Aria Label if there is link attachment by default.

= 5.1.6 (2024/06/05) =
* Add: Hero Mode for Carousel with Latest Posts.
* Add: Re-order feature for Gallery Manager.
* Fix: "Edit" modal functionality in current gallery mode.
* Fix: JS/Picture WebP Rewriting compatibility.
* Fix: Maintained Left to Right layout on Masonry resize.
* Update: Integrated latest NekoUI and common libraries.
* Update: And a few more things here and there.

= 5.1.5 (2024/05/10) =
* Fix: Addressed XSS injection vulnerability via shortcode and updated readme documentation.
* Add: Implemented carousel infinite scroll with lazy loading.
* Update: Enabled Lightbox rendering for lazy-loaded carousel media.
* Update: Prepared gallery rendering within Gutenberg iframe.

= 5.1.3 (2024/04/06) =
* Fix: Order by used in shortcode.

= 5.1.2 (2024/03/16) =
* Add: Hero Carousel for Posts.
* Add: Improved Masonry layout.
* Add: Added support for videos in the Gallery Manager.
* Add: Added a meow attribute to the shortcodes to avoid conflicts with other plugins.
* Fix: Issues related to Infinite Loading, Custom Links and Shortcodes.
* Update: Improve the Media Selector.

= 5.1.1 (2024/01/20) =
* Add: New zoom setting for map layouts and maintenance features including export, import, and reset options.
* Update: Enhanced map functionality with thumbnail selection fix for missing images and corrected src_set values.
* Add: Density labels with image count and captions alignment feature.
* Update: Integrated captions style with WordPress standards and reintroduced resize event for full pages.
* Fix: Issues with collections in WP/LR folders and removed obsolete gallery and collection processes.
* Add: 'mgl_custom_link_classes' filter and collection preview, with collection style moved to pro file.

= 5.1.0 (2023/12/08) =
* Add: Support for collections in the Pro! You can now create collections of galleries, and have them displayed nicely on your pages.
* Add: New option to avoid overring the default WordPress gallery.

= 5.0.9 (2023/11/26)
* Add: Introduced unique IDs for Gallery Manager to enhance functionality
* Add: Initial version of Gallery Manager (Proof of Concept) added.
* Fix: Addressed the issue with missing Leaflet for maps by implementing async loading at mount.
* Update: Changed "Immersive captions" from being the default setting to an optional feature.

= 5.0.7 (2023/11/15) =
* Update: Enhanced Carousel with the addition of a compact design, integrating navigation and captions internally for a more immersive experience.
* Update: Refined Carousel captions style to enhance user immersion and engagement.
* Fix: Resolved CSS typo for improved style consistency.
* Fix: Addressed Carousel and Square component mounting visibility issues, ensuring seamless display across layouts.
* Fix: Corrected nowrap settings for Dots and Thumbnails to enhance navigation.
* Fix: Fixed an issue where carousel captions were not displaying in certain scenarios.
* Fix: Addressed an issue with invisible captions to improve content visibility.
* Fix: Implemented a workaround for initializing map sizes, enhancing layout adaptability.
* Fix: Resolved warning issues in Horizontal layout on mobile devices for better user experience.

= 5.0.6 (2023/10/23) =
* Add: Initial implementation of Thumbnail Navigation for Carousel.
* Add: "Scroll Warning" feature for Horizontal layout.
* Add: "Stylish Style" for the "Tiles" layout.
* Add: Introduced 'mgl_sort_ahead' filter for more flexible infinite loading.
* Update: Improved Carousel behavior with fixes to clone loop handling and clone images in lightbox.
* Update: Enhanced navigation features including dot navigation for large galleries and centering thumbnails.
* Update: Moved Carousel caption above dot navigation for improved visibility.
* Update: Code refinements in Carousel component and corrected overwritten code from previous commit.
* Fix: Addressed issues with "Keep Aspect Ratio" on both mobile and carousel affecting other layouts.
* Fix: Resolved issues with Gallery interfering with other Leaflet maps and improved map centering.
* Fix: Adjusted captions for Horizontal layout and ensured Autoplay functions correctly without arrow navigation.

= 5.0.5 (2023/10/10) =
* Add: Carousel autoplay and better captions.
* Add: Option to keep the images's aspect ratio with Carousel.
* Update: Infinite Scroll now has its own section and loading styles.
* Fix: Display an error message instead of crashing for backtrack limit exhaustion. 

= 5.0.4 (2023/10/28) =
* Fix: Previously generated gallery previews were not showing at all, now handled properly.
* Update: Adjusted infinite scroll images to fit parent div.
* Fix: Initial Map Layout size.

= 5.0.3 (2023/10/19) =
* Update: Back to using the DOM naturally for the images. This will be easier for lightboxes to work with the gallery, and SEO scripts to work with the images.
* Update: Code cleaning, libs optimization, etc.

= 5.0.2 (2023/10/14) =
* Fix: Removed useless data attributes.
* Fix: Images always had links, now it respects the settings.

= 5.0.1 (2023/09/12) =
* Fix: Links from Gallery Custom Links were not supported.
* Fix: Alignment issue (fullwidth, etc).
* Fix: Square Layout was not working with more than 5 columns.
* Fix: Compatibility with PHP 8.4.

= 5.0.0 (2023/09/02) =
* Update: Big rewriting to make the plugin more modern and faster, and allow more features in the future.
* Update: Meow Lightbox and Meow Gallery both need to be version 5.0.0+ to work together.

= 4.3.8 (2023/05/01) =
* Update: Common dashboard.
* Fix: Issues with tiles in the editor.
* Fix: Issues in the carousel.

For older releases, see [changelog.txt](https://plugins.svn.wordpress.org/meow-gallery/trunk/changelog.txt).

== Screenshots ==


1. The Justified layout lines your photos up in even rows and keeps the shape of every image.
2. Tiles mixes big and small photos into a magazine-style grid that adapts to each photo's orientation.
3. Masonry stacks photos in columns, perfect for a mix of portrait and landscape shots.
4. Add the Meow Gallery block, pick a layout, and see the gallery live in the editor.
5. The Galleries manager keeps your galleries in one place, each with its own layout and a shortcode to use anywhere.
6. Set the default look of every layout: gutters, row height, columns and density for desktop, tablet and mobile.

