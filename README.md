# Figment

Figment is a Wordpress website for writers.
This website is meant to be a demonstration of various techniques used in WordPress development.
On the website, writers can sign up and create stories via markdown in the client and upload them to WordPress.

## Points covered:

- Users can sign up as authors
- Admin has to approve users before they can post stories
- Loading a JavaScript Markdown editor with `wp_enqueue_scripts`
- User registration with the plugin 'User Registration by WP Everest'
- Submitting the story with a WP REST API post request and Fetch
- Users can select genre of story
- Authenticating the request with WP Nonces and `wp_localize_script`
- Users can view a list of their own stories (with `template_part`)
- Users can see list their published stories on their profile

## In Progress:

- Users can edit their stories in the front-end
- Web shop selling books by the writers that contribute to the site
- Products have author field on them so we know which author wrote the ebook
- The writer profile page has their basic details (name, email, their ebooks for sale and their stories)
- Writers can upload books (later feature)

## Environment

- Remove `define('JETPACK_DEV_DEBUG', true);` in `wp-config.php` in production.
