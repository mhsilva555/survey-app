<?php

namespace Survey\App\PostTypes;

class Survey implements \Survey\App\Contracts\CustomPostTypeInterface
{
    public function __construct()
    {
        add_action('init', [$this, 'registerPostType'], 0);
    }

    public function registerPostType()
    {
        $rewrite = array(
            'slug'                  => 'surveys',
            'with_front'            => true,
            'pages'                 => true,
            'feeds'                 => true,
        );
        $args = array(
            'label'                 => __( 'survey', 'survey' ),
            'labels'                => $this->labelsPostType(),
            'supports'              => array( 'title', 'thumbnail', 'custom-fields'),
            'taxonomies'            => array( 'category', 'post_tag' ),
            'hierarchical'          => true,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => $rewrite,
            'capability_type'       => 'post',
        );
        register_post_type( 'servicos', $args );
    }

    public function labelsPostType()
    {
        $labels = array(
            'name'                  => _x( 'surveys', 'Post Type General Name', 'survey' ),
            'singular_name'         => _x( 'survey', 'Post Type Singular Name', 'survey' ),
            'menu_name'             => __( 'Enquetes', 'survey' ),
            'name_admin_bar'        => __( 'Enquetes', 'survey' ),
            'all_items'             => __( 'Todas as Enquetes', 'survey' ),
            'add_new_item'          => __( 'Adicionar Nova Enquete', 'survey' ),
            'add_new'               => __( 'Adicionar Nova', 'survey' ),
            'new_item'              => __( 'Nova Enquete', 'survey' ),
            'edit_item'             => __( 'Editar Enquete', 'survey' ),
            'update_item'           => __( 'Atualizar Enquete', 'survey' ),
            'view_item'             => __( 'Ver Enquete', 'survey' ),
            'view_items'            => __( 'Ver Enquetes', 'survey' ),
            'search_items'          => __( 'Procurar Enquete', 'survey' ),
            'featured_image'        => __( 'Imagem Destacada', 'survey' ),
            'set_featured_image'    => __( 'Definir Imagem Destacada', 'survey' ),
            'remove_featured_image' => __( 'Remover Imagem Destacada', 'survey' ),
            'use_featured_image'    => __( 'Use como imagem em destaque', 'survey' ),
        );

        return $labels;
    }
}