# Contexte du projet WP-B2

## Informations générales

**Projet**: WP-B2 - Thème WordPress classique éducatif
**Type**: Thème WordPress classic (non-block)
**Objectif**: Formation/cours pour étudiants débutants (3h)
**Localisation**: `/Users/alexis/Websites/WP-B2/wp-content/themes/wp-b2`

## État actuel du projet

### ✅ Complété

#### 1. Architecture de base
- Structure complète du thème WordPress classique
- Tous les fichiers de templates (index, single, page, archive, 404, etc.)
- Template parts dans `template-parts/`
- Fichiers inc/ modulaires (template-tags, template-functions, acf-config, debug-helpers)

#### 2. SCSS moderne - Architecture 7-1
**Syntaxe**: `@use` et `@forward` (PAS `@import`)

**Structure abstracts** avec design tokens:
- `_colors.scss` - Palette de couleurs
- `_spacing.scss` - Échelle d'espacements
- `_typography.scss` - Typographie (familles, tailles, poids, line-heights)
- `_layout.scss` - Containers, breakpoints, grid
- `_components.scss` - Border-radius, box-shadows, transitions, z-indexes
- `_functions.scss` - Fonctions utilitaires (rem, z)
- `_mixins.scss` - Mixins (media queries, layouts, utilities)
- `_index.scss` - Point d'export avec `@forward`

**Système de design tokens**:
- Chaque module expose des maps Sass
- Génération automatique de CSS custom properties via `@each`
- Accès UNIQUEMENT via fonctions helper (pas de variables directes)
- Exemple: `color('primary')`, `spacing('md')`, `font-size('h1')`

**Modules Sass natifs utilisés**:
- `@use 'sass:map'` pour `map.has-key()`, `map.get()`
- `@use 'sass:math'` pour `math.is-unitless()`
- Toutes les fonctions globales dépréciées ont été remplacées

**Fichiers SCSS organisés**:
- `base/` - Reset, typography, helpers
- `layout/` - Header, footer, sidebar, navigation, grid
- `components/` - Buttons, forms, cards, widgets, comments
- `pages/` - Home, single, archive
- `vendors/` - Normalize.css
- `main.scss` - Point d'entrée avec `@use`

**Build**:
- Compilation: `npm run build`
- Watch: `npm run watch`
- Output: `assets/css/main.css` (fichier compilé, ne JAMAIS éditer)

#### 3. Standards WordPress

**Préfixage**: Toutes les fonctions PHP globales préfixées avec `wp_b2_`

**Constantes**:
```php
WP_B2_VERSION = '1.0.0'
WP_B2_THEME_DIR = get_template_directory()
WP_B2_THEME_URI = get_template_directory_uri()
```

**Enqueue des styles**:
- `style.css` - Header WordPress uniquement (pas de styles)
- `assets/css/main.css` - Styles compilés depuis SCSS

**Debug helpers** (chargés uniquement si WP_DEBUG):
- `dump()` - Dump avec style violet
- `dd()` - Dump & die avec style rose
- `dump_query()` - Debug WP_Query avec style pastel
- `dump_wp()` - Info WordPress avec style orange

#### 4. Tooling - Packages WordPress officiels

**Package.json** - Dépendances:
- `@wordpress/stylelint-config@^23.0.0`
- `stylelint@^16.25.0`
- `stylelint-scss@^6.4.0`
- `@wordpress/eslint-plugin@^17.0.0`
- `eslint@^8.50.0`
- `sass@^1.69.0`
- `npm-run-all@^4.1.5`
- `postcss-scss@^4.0.9`
- `prettier@^3.0.3`

**Scripts disponibles**:
```bash
npm run build          # Build SCSS
npm run watch          # Watch SCSS
npm run lint           # Lint tout (SCSS, JS, PHP)
npm run lint:scss      # Lint SCSS
npm run lint:js        # Lint JS
npm run lint:php       # Lint PHP (via Composer)
npm run format         # Format tout
npm run format:scss    # Format SCSS
npm run format:js      # Format JS
npm run format:php     # Format PHP (via Composer)
```

**Configuration linting**:
- `.stylelintrc.json` - Extend `@wordpress/stylelint-config/scss`
- `.eslintrc.json` - Utilise `@wordpress/eslint-plugin`
- `phpcs.xml` - WordPress-Core, WordPress-Extra, WordPress-Docs

#### 5. ACF
- Configuration JSON sync dans `inc/acf-config.php`
- Dossier `acf-json/` pour versioning des field groups
- Prêt à l'utilisation

#### 6. Documentation
- `README.md` - Documentation complète du thème
- `QUICKSTART.md` - Guide de démarrage rapide pour étudiants
- `CHANGELOG.md` - Historique des versions
- `.github/copilot-instructions.md` - Guide complet pour GitHub Copilot
- `assets/scss/abstracts/README.md` - Documentation des design tokens
- `assets/css/README.md` - Avertissement sur les fichiers compilés

## Architecture technique

### Design Tokens - Règles strictes

**❌ INTERDIT**:
```scss
.element {
    color: $color-primary;  // JAMAIS !
    margin: $spacing-md;    // JAMAIS !
}
```

**✅ OBLIGATOIRE**:
```scss
.element {
    color: color('primary');
    margin: spacing('md');
    font-size: font-size('h3');
    border-radius: border-radius('sm');
}
```

### API des fonctions helper

**Couleurs**: `color($name)`
- primary, secondary, text, text-light, bg, bg-alt, white, black, link, link-hover, border, success, error, warning, info

**Espacements**: `spacing($name)`
- xs (4px), sm (8px), md (16px), lg (24px), xl (32px), xxl (48px)

**Typographie**:
- `font-family($name)` - primary, secondary, code
- `font-size($name)` - small, base, large, h1, h2, h3, h4, h5, h6
- `font-weight($name)` - light, normal, medium, semibold, bold
- `line-height($name)` - base, heading

**Layout**:
- `container($name)` - max-width, padding
- `breakpoint($name)` - xs (480px), sm (768px), md (1024px), lg (1280px), xl (1440px)
- `grid($name)` - columns, gutter

**Composants**:
- `border-radius($name)` - sm, base (défaut), lg
- `box-shadow($name)` - sm, base (défaut), lg
- `transition($name)` - speed, timing
- `z-index($name)` ou `z($name)` - dropdown, sticky, fixed, modal-backdrop, modal, popover, tooltip

### Mixins disponibles

**Media queries**:
```scss
@include media-breakpoint-up(md) { /* >= 1024px */ }
@include media-breakpoint-down(lg) { /* < 1280px */ }
```

**Layout**:
```scss
@include container;
@include flex-center;
@include flex-between;
```

**Utilities**:
```scss
@include transition(color, background-color);
@include focus-outline;
@include visually-hidden;
@include button-reset;
@include link-reset;
@include clearfix;
```

## Statut de migration

### ✅ Migrations complétées

1. **SCSS moderne**:
   - ✅ Conversion de `@import` vers `@use`/`@forward`
   - ✅ Création du système de design tokens
   - ✅ Remplacement de 141 variables par fonctions helper
   - ✅ Migration vers modules Sass natifs (`sass:map`, `sass:math`)

2. **WordPress tooling**:
   - ✅ Migration vers `@wordpress/stylelint-config@^23.0.0`
   - ✅ Ajout de `stylelint-scss@^6.4.0`
   - ✅ Configuration compatible stylelint 16

3. **Qualité du code**:
   - ✅ Tous les lints SCSS passent
   - ✅ Tous les lints JS passent
   - ✅ Build SCSS fonctionne
   - ✅ Auto-fix PHP configuré

### 📝 Fichiers modifiés dans la dernière session

**Configuration**:
- `package.json` - Mise à jour des dépendances
- `.stylelintrc.json` - Configuration WordPress

**SCSS - Ajout modules Sass natifs**:
- `abstracts/_colors.scss` - `@use 'sass:map'`
- `abstracts/_spacing.scss` - `@use 'sass:map'`
- `abstracts/_typography.scss` - `@use 'sass:map'`
- `abstracts/_layout.scss` - `@use 'sass:map'`
- `abstracts/_components.scss` - `@use 'sass:map'`
- `abstracts/_functions.scss` - `@use 'sass:math'`
- `abstracts/_mixins.scss` - Utilisation de `breakpoint()` dans media queries

**SCSS - Conversion variables → fonctions** (141 remplacements):
- `base/_reset.scss`
- `base/_typography.scss`
- `base/_helpers.scss`
- `layout/_header.scss`
- `layout/_footer.scss`
- `layout/_sidebar.scss`
- `layout/_navigation.scss`
- `layout/_grid.scss`
- `components/_buttons.scss`
- `components/_forms.scss`
- `components/_cards.scss`
- `components/_widgets.scss`
- `components/_comments.scss`
- `pages/_single.scss`
- `pages/_archive.scss`

## Points d'attention

### ⚠️ Éducation / Cours de 3h

**Statut**: En réflexion par l'utilisateur

**Problématique identifiée**:
- Le thème actuel est très complet (architecture avancée)
- Public cible: étudiants débutants
- Durée: seulement 3 heures
- Risque: trop de concepts pour le temps disponible

**Options envisagées**:
1. Simplifier drastiquement le thème actuel
2. Créer une version "starter" minimale en parallèle
3. Approche progressive (commencer minimal, complexifier)

**En attente**: Décision de l'utilisateur sur la stratégie pédagogique

### 🔒 Règles de développement

**DO ✅**:
- Utiliser `@use`/`@forward` pour SCSS
- Utiliser les fonctions helper pour tous les design tokens
- Préfixer toutes les fonctions PHP avec `wp_b2_`
- Échapper toutes les sorties PHP
- Utiliser les modules Sass natifs (`sass:map`, `sass:math`)

**DON'T ❌**:
- Ne jamais utiliser `@import`
- Ne jamais accéder directement aux variables Sass
- Ne jamais éditer `assets/css/main.css` (fichier compilé)
- Ne jamais créer de fonctions PHP globales non-préfixées
- Ne jamais utiliser les fonctions Sass globales dépréciées

## Prochaines étapes possibles

1. **Simplification pour le cours**:
   - Définir les concepts clés à enseigner
   - Adapter la structure en conséquence
   - Créer des exercices progressifs

2. **Améliorations potentielles**:
   - Ajouter plus de composants
   - Créer des variations de templates
   - Étendre les design tokens
   - Ajouter des animations

3. **Documentation pédagogique**:
   - Guide pas-à-pas pour étudiants
   - Exercices pratiques
   - Cheatsheet des fonctions helper
   - Exemples commentés

## Références

- WordPress Coding Standards: https://developer.wordpress.org/coding-standards/
- Sass Modules: https://sass-lang.com/documentation/at-rules/use
- 7-1 Pattern: https://sass-guidelin.es/#the-7-1-pattern
- WordPress Theme Handbook: https://developer.wordpress.org/themes/

---

*Dernière mise à jour: Session de migration stylelint vers packages WordPress officiels*
