<?php

// Início do loop do Wordpress
if ( have_posts() ) : while ( have_posts() ) : the_post(); 

// Salvar o post atual em uma variável
$post = get_post();

// Pegar o ID do post atual
$post_id = $post->ID;

// Aqui pegamos o nome da pessoa que está no campo personalizado 'pessoa', o true indica que só queremos um resultado
$pessoa_nome = get_post_meta($post_id, 'pessoa', true);

// Chamamos a função que criamos para buscar a pessoa:
$pessoa = buscar_pessoa_por_nome($pessoa_nome);

// Término do loop do Wordpress
endwhile; else :
	echo 'Post não encontrado.';
endif;

// Aqui terminamos o PHP e vamos para a exibição de dados no HTML!!! \õ/
?>
<div>
	<p>
		<strong>Título do Post:</strong>
		<?php echo $post->post_title; ?>
	</p>
	<p>
		<strong>Nome da Pessoa (no post):</strong>
		<?php echo $pessoa_nome; ?>
	</p>
	<p>
		<strong>Nome da Pessoa (encontrada):</strong>
		<?php echo $pessoa->post_title; ?>
	</p>
	<p>
		<strong>Descrição da Pessoa:</strong>
		<?php echo $pessoa->post_content; ?>
	</p>
</div>