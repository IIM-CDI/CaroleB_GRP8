# GitHub Copilot Instructions - WP-B2 Theme

## Vue d'ensemble du projet

WP-B2 est un thème WordPress classique (non-block) conçu pour l'apprentissage du développement de thèmes WordPress. Il utilise une architecture SCSS moderne basée sur le pattern 7-1 avec des design tokens et des standards de code WordPress stricts.

## Architecture et Standards

### Structure du thème

```
wp-b2/
├── assets/
│   ├── scss/          # SCSS avec architecture 7-1
│   ├── css/           # CSS compilé (ne jamais éditer)
│   └── js/            # JavaScript
├── inc/               # Fonctions PHP modulaires
├── template-parts/    # Parties de templates réutilisables
├── acf-json/         # Synchronisation ACF
└── *.php             # Templates WordPress
```

### SCSS - Architecture 7-1 moderne

**Important**: Ce projet utilise la syntaxe moderne Sass `@use` et `@forward`, **PAS** `@import`.

#### Structure des abstracts
- Tous les fichiers abstracts sont dans `assets/scss/abstracts/`
- Utilisation de `_index.scss` avec `@forward` pour exporter tous les modules
- Import global via `@use '../abstracts' as *;`

#### Design Tokens (NO VARIABLES DIRECTES)

**Règle cruciale**: Ne JAMAIS utiliser de variables Sass directement. Toujours utiliser les fonctions helper.

**Variables maps** dans les modules abstracts:
- `_colors.scss` → couleurs
- `_spacing.scss` → espacements
- `_typography.scss` → typographie (fonts, tailles, poids, line-heights)
- `_layout.scss` → containers, breakpoints, grid
- `_components.scss` → border-radius, box-shadows, transitions, z-indexes

**Génération automatique de CSS custom properties**:
Chaque map génère des CSS custom properties via `@each`:

```scss
$colors: (
    'primary': #0073aa,
    'text': #333333
);

:root {
    @each $name, $value in $colors {
        --color-#{$name}: #{$value};
    }
}
```

**Fonctions helper obligatoires**:

```scss
// ✅ CORRECT
.button {
    background-color: color('primary');
    padding: spacing('md');
    font-size: font-size('base');
    border-radius: border-radius('sm');
}

// ❌ INCORRECT - Ne jamais faire cela
.button {
    background-color: $color-primary;
    padding: $spacing-md;
}
```

**API complète des fonctions**:
- `color($name)` - Couleurs
- `spacing($name)` - Espacements (xs, sm, md, lg, xl, xxl)
- `font-family($name)` - Familles de police (primary, secondary, code)
- `font-size($name)` - Tailles de police (small, base, large, h1-h6)
- `font-weight($name)` - Poids de police (light, normal, medium, semibold, bold)
- `line-height($name)` - Hauteurs de ligne (base, heading)
- `container($name)` - Paramètres de container (max-width, padding)
- `breakpoint($name)` - Breakpoints (xs, sm, md, lg, xl)
- `grid($name)` - Paramètres de grille (columns, gutter)
- `border-radius($name)` - Rayons de bordure (sm, base, lg)
- `box-shadow($name)` - Ombres (sm, base, lg)
- `transition($name)` - Transitions (speed, timing)
- `z-index($name)` ou `z($name)` - Z-indexes nommés

#### Modules Sass natifs

Toujours utiliser les modules Sass natifs pour les fonctions:

```scss
// ✅ CORRECT
@use 'sass:map';
@use 'sass:math';

@if map.has-key($colors, $name) {
    @return map.get($colors, $name);
}

@if math.is-unitless($pixels) {
    // ...
}

// ❌ INCORRECT - Fonctions globales dépréciées
@if map-has-key($colors, $name) { }
@if unitless($pixels) { }
```

#### Mixins disponibles

```scss
// Media queries
@include media-breakpoint-up(md) { }
@include media-breakpoint-down(lg) { }

// Layout
@include container;
@include flex-center;
@include flex-between;

// Utilities
@include transition(color, background-color);
@include focus-outline;
@include visually-hidden;
@include button-reset;
@include link-reset;
@include clearfix;
```

### WordPress - Standards de code PHP

**Important**: Ce projet suit strictement les WordPress Coding Standards.

#### Naming Conventions

**Toutes les fonctions globales doivent être préfixées** avec `wp_b2_`:

```php
// ✅ CORRECT
function wp_b2_setup() { }
function wp_b2_custom_function() { }

// ❌ INCORRECT
function setup() { }
function custom_function() { }
```

#### Hooks et filtres

```php
// Actions
add_action( 'after_setup_theme', 'wp_b2_setup' );
add_action( 'wp_enqueue_scripts', 'wp_b2_scripts' );

// Filtres
add_filter( 'excerpt_length', 'wp_b2_excerpt_length' );
```

#### Chargement des assets

```php
// CSS
wp_enqueue_style( 'wp-b2-style', get_stylesheet_uri(), array(), WP_B2_VERSION );
wp_enqueue_style( 'wp-b2-main', WP_B2_THEME_URI . '/assets/css/main.css', array(), WP_B2_VERSION );

// JavaScript
wp_enqueue_script( 'wp-b2-main', WP_B2_THEME_URI . '/assets/js/main.js', array(), WP_B2_VERSION, true );
```

#### Organisation des fichiers PHP

```
inc/
├── template-tags.php      # Fonctions d'affichage (wp_b2_posted_on, etc.)
├── template-functions.php # Hooks et filtres du thème
├── acf-config.php        # Configuration ACF
└── debug-helpers.php     # Outils de debug (chargé uniquement si WP_DEBUG)
```

### JavaScript - Standards

Utilisation de `@wordpress/eslint-plugin` pour les standards WordPress.

```javascript
// Utilisation de l'IIFE pattern
( function () {
	'use strict';

	function init() {
		// Code d'initialisation
	}

	// DOMContentLoaded
	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', init );
	} else {
		init();
	}
} )();
```

### Linting et formatage

**Commandes disponibles**:

```bash
# Build
npm run build          # Compile SCSS
npm run watch          # Watch SCSS changes

# Linting
npm run lint           # Lint tout (SCSS, JS, PHP)
npm run lint:scss      # Lint SCSS uniquement
npm run lint:js        # Lint JS uniquement
npm run lint:php       # Lint PHP uniquement

# Auto-fix
npm run format         # Format tout
npm run format:scss    # Format SCSS
npm run format:js      # Format JS
npm run format:php     # Format PHP
```

**Configuration**:
- SCSS: `@wordpress/stylelint-config` v23 + règles custom dans `.stylelintrc.json`
- JS: `@wordpress/eslint-plugin` dans `.eslintrc.json`
- PHP: WordPress-Core, WordPress-Extra, WordPress-Docs dans `phpcs.xml`

### ACF (Advanced Custom Fields)

**Synchronisation JSON activée**:
- Dossier: `acf-json/`
- Les field groups sont automatiquement synchronisés
- Toujours commiter les fichiers JSON ACF

```php
// Configuration dans inc/acf-config.php
add_filter( 'acf/settings/save_json', 'wp_b2_acf_json_save_point' );
add_filter( 'acf/settings/load_json', 'wp_b2_acf_json_load_point' );
```

### Debug helpers

Fonctions visuelles de debug disponibles (uniquement en mode WP_DEBUG):

```php
// Dump et continue
dump( $variable );
dump( $var1, $var2, $var3 );

// Dump et die
dd( $variable );

// Debug WP_Query
dump_query( $query );
dump_query(); // Utilise la query globale

// Info WordPress
dump_wp();
```

## Règles de développement

### DO ✅

1. **SCSS**:
   - Utiliser `@use` et `@forward`, jamais `@import`
   - Utiliser les fonctions helper pour accéder aux design tokens
   - Utiliser les modules Sass natifs (`sass:map`, `sass:math`)
   - Suivre l'architecture 7-1

2. **PHP**:
   - Préfixer toutes les fonctions avec `wp_b2_`
   - Utiliser les constantes `WP_B2_VERSION`, `WP_B2_THEME_DIR`, `WP_B2_THEME_URI`
   - Suivre les WordPress Coding Standards
   - Échapper les sorties avec `esc_html()`, `esc_attr()`, `esc_url()`
   - Traduire les chaînes avec `__()`, `_e()`, `esc_html__()`

3. **JavaScript**:
   - Utiliser le pattern IIFE
   - Vérifier `readyState` avant d'initialiser
   - Suivre les standards WordPress

### DON'T ❌

1. **SCSS**:
   - Ne jamais utiliser `@import`
   - Ne jamais accéder directement aux variables (`$color-primary`)
   - Ne jamais éditer les fichiers dans `assets/css/` (générés automatiquement)
   - Ne jamais utiliser les fonctions globales Sass dépréciées

2. **PHP**:
   - Ne pas créer de fonctions globales non-préfixées
   - Ne pas oublier d'échapper les sorties
   - Ne pas inclure `debug-helpers.php` en production

3. **Général**:
   - Ne jamais commiter `node_modules/` ou `vendor/`
   - Ne jamais commiter `assets/css/main.css` (fichier compilé)

## Exemples de patterns courants

### Créer un nouveau composant SCSS

```scss
// assets/scss/components/_mon-composant.scss
@use '../abstracts' as *;

.mon-composant {
	padding: spacing('md');
	background-color: color('bg-alt');
	border-radius: border-radius();

	&__title {
		font-size: font-size('h3');
		font-weight: font-weight('bold');
		color: color('text');
		margin-bottom: spacing('sm');
	}

	&:hover {
		background-color: color('primary');
		@include transition(background-color);
	}

	@include media-breakpoint-up(md) {
		padding: spacing('lg');
	}
}
```

Puis l'ajouter dans `assets/scss/main.scss`:
```scss
@use 'components/mon-composant';
```

### Créer une fonction de template

```php
// inc/template-tags.php

if ( ! function_exists( 'wp_b2_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function wp_b2_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() )
		);

		echo '<span class="posted-on">' . $time_string . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;
```

### Template WordPress avec ACF

```php
<?php
/**
 * Template part for displaying page content
 *
 * @package WP_B2
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>

	<div class="entry-content">
		<?php
		the_content();

		// ACF field
		if ( function_exists( 'get_field' ) ) {
			$custom_field = get_field( 'mon_champ' );
			if ( $custom_field ) {
				echo '<div class="custom-field">' . esc_html( $custom_field ) . '</div>';
			}
		}
		?>
	</div>
</article>
```

## Contexte éducatif

Ce thème est conçu pour **l'apprentissage**:
- Architecture claire et bien organisée
- Commentaires explicatifs
- Bonnes pratiques WordPress
- Code moderne et maintenable
- Standards stricts pour former de bonnes habitudes

**Objectif**: Enseigner le développement de thèmes WordPress classiques avec des standards professionnels et une architecture SCSS moderne.
