<?php
// Registro
function register_api_produtos() {
  register_rest_route('api', '/produtos', [
    'methods' => 'GET',
    'callback' => 'api_produtos'
  ]);
}
add_action('rest_api_init', 'register_api_produtos');

// Funcionalidade
function api_produtos($request) {

  $data = get_posts([
    'post_type' => 'post',
    'posts_per_page' => -1,
    'fields' => 'ids',
    'order' => 'ASC'
  ]);
  
  $produtos = [];
  
  foreach ($data as $id) {
    $produtos[] = [
      'nome' => get_the_title($id),
      'preco' => get_field('produto__preco', $id),
      'metrica' => get_field('produto__metrica', $id),
      'img' => get_the_post_thumbnail_url($id, 'large'),
      'thumbnail' => get_the_post_thumbnail_url($id, 'thumbnail'),
      'alt' => get_post_meta(get_post_thumbnail_id($id), '_wp_attachment_image_alt', true)
    ];
  }

  return rest_ensure_response($produtos);
}