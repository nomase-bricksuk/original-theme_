<?php if( is_home() ): // Home ?>
	<title><?php bloginfo( 'name' ) ?></title>
	<meta property="og:title" content="<?php bloginfo( 'name' ) ?>">
	<meta name="description" content="<?php bloginfo( 'description' ); ?>">
	<meta property="og:description" content="<?php bloginfo( 'description' ); ?>">
	<meta property="og:image" content="<?php echo THEME; ?>/assets/img/ogp.png">
	<meta property="og:url" content="<?php echo home_url(); ?>">
	<meta property="og:type" content="website">


<?php elseif( is_page() ): // Fixed page ?>
	<?php if( get_field( 'title', $post->ID ) ): ?>
		<title><?php the_field( 'title', $post->ID ); ?> | <?php bloginfo( 'name' ); ?></title>
		<meta property="og:title" content="<?php the_field( 'title', $post->ID ); ?> | <?php bloginfo( 'name' ); ?>">
	<?php else: ?>
		<title><?php the_title(); ?> | <?php bloginfo( 'name' ); ?></title>
		<meta property="og:title" content="<?php the_title(); ?> | <?php bloginfo( 'name' ); ?>">
	<?php endif; ?>

	<?php if( get_field( 'description', $post->ID ) ): ?>
		<meta name="description" content="<?php the_field( 'description', $post->ID ); ?>">
		<meta property="og:description" content="<?php the_field( 'description', $post->ID ); ?>">
	<?php else: ?>
		<meta name="description" content="<?php bloginfo( 'description' ); ?>">
		<meta property="og:description" content="<?php bloginfo( 'description' ); ?>">
	<?php endif; ?>

	<?php if( has_post_thumbnail() ): ?>
		<?php $thumbnail_id = get_post_thumbnail_id(); ?>
		<?php $thumbnail = wp_get_attachment_image_src( $thumbnail_id, 'ogp' ); ?>
		<meta property="og:image" content="<?php echo $thumbnail[ 0 ] ?>">
	<?php else: ?>
		<meta property="og:image" content="<?php echo THEME; ?>/assets/img/ogp.png">
	<?php endif; ?>

	<meta property="og:url" content="<?php the_permalink(); ?>">
	<meta property="og:type" content="article">


<?php elseif( is_singular() ): // Single Page ?>
	<?php $postlabel = get_post_type_object( get_post_type() ); ?>

	<title><?php echo $post->post_title; ?> | <?php echo $postlabel->label; ?> | <?php bloginfo( 'name' ) ?></title>
	<meta property="og:title" content="<?php echo $post->post_title; ?> | <?php echo $postlabel->label; ?> | <?php bloginfo( 'name' ) ?>">

	<?php if( get_the_content() ): ?>
		<meta name="description" content="<?php echo text_excerpt( get_the_content(), 100); ?>">
		<meta property="og:description" content="<?php echo text_excerpt( get_the_content(), 100); ?>">
	<?php else: ?>
		<meta name="description" content="<?php bloginfo( 'description' ); ?>">
		<meta property="og:description" content="<?php bloginfo( 'description' ); ?>">
	<?php endif; ?>

	<?php if( has_post_thumbnail() ): ?>
		<?php $thumbnail_id = get_post_thumbnail_id(); ?>
		<?php $thumbnail = wp_get_attachment_image_src( $thumbnail_id, 'ogp' ); ?>
		<meta property="og:image" content="<?php echo $thumbnail[ 0 ] ?>">
	<?php else: ?>
		<meta property="og:image" content="<?php echo THEME ?>/assets/img/ogp.png">
	<?php endif; ?>

	<meta property="og:url" content="<?php the_permalink(); ?>">
	<meta property="og:type" content="article">

<?php elseif( is_tax() ): // Tax Archive ?>
	<title><?php single_term_title(); ?> | <?php echo esc_html(get_post_type_object(get_post_type())->label); ?> | <?php bloginfo( 'name' ) ?></title>
	<meta property="og:title" content="<?php single_term_title(); ?> | <?php echo esc_html(get_post_type_object(get_post_type())->label); ?> | <?php bloginfo( 'name' ) ?>">

	<?php if( term_description() ): ?>
		<meta name="description" content="<?php echo term_description(); ?>">
		<meta property="og:description" content="<?php echo term_description(); ?>">
	<?php else: ?>
		<meta name="description" content="<?php bloginfo( 'description' ); ?>">
		<meta property="og:description" content="<?php bloginfo( 'description' ); ?>">
	<?php endif; ?>

	<meta property="og:image" content="<?php echo THEME ?>/assets/img/ogp.png">
	<meta property="og:url" content="<?php the_permalink(); ?>">
	<meta property="og:type" content="article">


<?php elseif( is_date() ): // Year Archive ?>
	<title><?php echo get_query_var( 'year' ); ?>年 | <?php echo post_type_archive_title(); ?> | <?php bloginfo( 'name' ) ?></title>
	<meta property="og:title" content="<?php echo get_query_var( 'year' ); ?>年 | <?php echo post_type_archive_title(); ?> | <?php bloginfo( 'name' ) ?>">
	<meta name="description" content="<?php bloginfo( 'description' ); ?>">
	<meta property="og:description" content="<?php bloginfo( 'description' ); ?>">
	<meta property="og:image" content="<?php echo THEME ?>/assets/img/ogp.png">
	<meta property="og:url" content="<?php the_permalink(); ?>">
	<meta property="og:type" content="article">

<?php elseif( is_archive() ): // Archive ?>
	<?php $postlabel = get_post_type_object( get_post_type() ); ?>
	<?php if ($postlabel && isset($postlabel->label)) : ?>
		<title><?php echo $postlabel->label; ?> | <?php bloginfo( 'name' ); ?></title>
	<?php else : ?>
		<title><?php bloginfo( 'name' ); ?></title>
	<?php endif; ?>
	<?php if ($postlabel && isset($postlabel->label)) : ?>
		<meta property="og:title" content="<?php echo esc_attr($postlabel->label); ?> | <?php bloginfo( 'name' ); ?>">
	<?php else : ?>
		<meta property="og:title" content="<?php bloginfo( 'name' ); ?>">
	<?php endif; ?>
	<meta name="description" content="<?php bloginfo( 'description' ); ?>">
	<meta property="og:description" content="<?php bloginfo( 'description' ); ?>">
	<meta property="og:image" content="<?php echo THEME ?>/assets/img/ogp.png">
	<meta property="og:url" content="<?php the_permalink(); ?>">
	<meta property="og:type" content="article">


<?php elseif( is_404() ): // 404 ?>
	<title>ページが見つかりませんでした | <?php bloginfo( 'name' ) ?></title>
	<meta property="og:title" content="ページが見つかりませんでした | <?php bloginfo( 'name' ) ?>">
	<meta name="description" content="<?php bloginfo( 'description' ); ?>">
	<meta property="og:description" content="<?php bloginfo( 'description' ); ?>">
	<meta property="og:image" content="<?php echo THEME; ?>/assets/img/ogp.png">
	<meta property="og:url" content="<?php echo THEME; ?>/404/">
	<meta property="og:type" content="article">
	<meta name="robots" content="noindex, nofollow">

<?php elseif( is_search() ): // Search ?>
    <title>検索結果: <?php echo esc_html(get_search_query()); ?> | <?php bloginfo( 'name' ) ?></title>
    <meta property="og:title" content="検索結果: <?php echo esc_html(get_search_query()); ?> | <?php bloginfo( 'name' ) ?>">
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <meta property="og:description" content="<?php bloginfo( 'description' ); ?>">
    <meta property="og:image" content="<?php echo THEME ?>/assets/img/ogp.png">
    <meta property="og:url" content="<?php echo esc_url(home_url('/?s=' . urlencode(get_search_query()))); ?>">
    <meta property="og:type" content="website">
    <meta name="robots" content="noindex, follow">

<?php endif; ?>

<meta property="og:locale" content="ja_JP">
<meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
<meta name="twitter:card" content="summary_large_image">