<?php

// Endpoints
require_once get_template_directory() . '/endpoints/produtos.php';

// Remover acesso /wp-json/wp/v2/users
add_filter('rest_endpoints', function ($endpoints) {
  unset($endpoints['/wp/v2/users']);
  unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);

  return $endpoints;
});

// Mudar caminho wp-json para json
function mudar_caminho_api() {
  return 'json';
}
add_filter('rest_url_prefix', 'mudar_caminho_api');

// Desabilitar Gutenberg
add_filter('use_block_editor_for_post', '__return_false');

// Adicionar suporte imagem destacada
add_theme_support('post-thumbnails');