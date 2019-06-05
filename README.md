## Custom WordPress Restful API Plugin
### Custom endpoints for posts, pages and products. 
 A cleaner call back which returns the post ID, title, content, name, image thumbnails (small,medium,large) only.
 
 #### How to use: 
 * eg. your domain/wp-json/api/v1/posts
 * eg. <your domain>wp-json/api/v1/pages
 * eg. <your domain>/wp-json/api/v1/product
 ##### Returns json
  
 ``
 http://<your domain>/wp-json/api/v1/posts
 ``
 
 #### Returns a single post, page or product
 * eg. your domain/wp-json/api/v1/posts/how-to-sell-online
 * eg. your domain>wp-json/api/v1/pages/about-us
 * eg. your domain>/wp-json/api/v1/product/gold-watch
 
 ``
  http://<your domain>/wp-json/api/v1/posts/<slug-name>
  ``
  
