<?php

// Para permitir realizar buscas por título, iremos usar este filtro de Query
add_filter( 'posts_where', 'wp_buscar_por_titulo', 10, 2 );
function wp_buscar_por_titulo ( $where, &$wp_query )
{
	// Invocamos o WPDB
    global $wpdb;

    // Validamos se a Query em questão contém o campo 'wp_buscar_por_titulo'
    if ( $wp_buscar_por_titulo = $wp_query->get( 'wp_buscar_por_titulo' ) ) {
    	// Inserimos no WHERE do código SQL para realizar a busca por título, dando escape no título para evitar vulnerabilidades de banco
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'' . esc_sql( $wpdb->esc_like( $wp_buscar_por_titulo ) ) . '%\'';
    }

    // Retornamos o WHERE para continuar a Query
    return $where;
}

// Nossa função para buscar pessoas por nome
function buscar_pessoa_por_nome ($nome)
{
	// Criamos uma Query do Wordpress
	$pessoa_query = new WP_Query (array(
		// Usaremos este campo 'wp_buscar_por_titulo' para fazer a busca por título
		'wp_buscar_por_titulo' => $nome,

		// Filtramos nossa Query, limitando apenas ao post_type de 'pessoa'
		'post_type' => 'pessoa',

		// Queremos que a Query retorne apenas um resultado
		'posts_per_page' => 1
	));

	// Variável para salvar nosso resultado, padrão é null
	$resultado = null;

	// Se encontrar alguma pessoa...
	if ($pessoa_query->have_posts()) {
		// ... usamos este comando do loop do Wordpress para carregar o post na memória ...
		$pessoa_query->the_post();

		// ... e finalmente setamos o resultado
		$resultado = get_post();
	}

	// Resetamos a Query do Wordpress, assim evitando que a Query sobrescreva o loop principal do post
	wp_reset_query();

	// E finalmente retornamos o resultado
	return $resultado;
}