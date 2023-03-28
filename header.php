<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<span role="navigation" aria-label="Skip to content">
		<a class="skip-to-content"  href="#main">
		  Skip to content
		</a>
	</span>
	<header class="section">
	<div class="section header__top width--full">
    <div class="block header__top__inner width--default">
        <div class="contact">
            <a>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20 22.621l-3.521-6.795c-.008.004-1.974.97-2.064 1.011-2.24 1.086-6.799-7.82-4.609-8.994l2.083-1.026-3.493-6.817-2.106 1.039c-7.202 3.755 4.233 25.982 11.6 22.615.121-.055 2.102-1.029 2.11-1.033z"/></svg>
                <span>01234 567890</span>
            </a>
            <a>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 12.713l-11.985-9.713h23.97l-11.985 9.713zm0 2.574l-12-9.725v15.438h24v-15.438l-12 9.725z"/></svg>
                <span>email@email.com</span>
            </a>
        </div>
    </div>	
</div>
<div class="section header__main width--full">
    <div class="block header__main__inner width--default">
        <?php the_custom_logo(); ?>
        
        <div class="header__menu">
            <button href="#menu-main-menu" title="Open Main Menu" class="header__burger">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 6 6">
                    <path id="burger" d="M 0 3 L 6 3 M 0 1 L 6 1 M 0 5 L 6 5 "/>
                </svg>
            </button>
            <nav> 
                <?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>

            </nav>
        </div>
    </div>
</div>
	</header>

