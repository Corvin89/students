<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<title><?php bloginfo( 'name' ) ?> > <?php $this->the_subject('mail subject'); ?> > {{toemail}}</title>
<?php $this->get_stylesheet(); ?>
	</head>