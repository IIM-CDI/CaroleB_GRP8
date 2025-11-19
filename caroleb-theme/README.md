# WP-B2 WordPress Theme

A blank WordPress classic theme designed for learning WordPress theming. Built with modern development practices, SCSS 7-1 architecture, and ACF support.

## Features

- **WordPress Coding Standards** - Follows official WordPress PHP, JavaScript, and CSS coding standards
- **SCSS 7-1 Architecture** - Organized, scalable stylesheet structure
- **Code Quality Tools** - ESLint, Stylelint, and PHP_CodeSniffer configured
- **ACF Ready** - Advanced Custom Fields integration with JSON sync
- **Educational Focus** - Well-commented code and clear naming conventions
- **Modern Tooling** - Sass compilation, auto-formatting, and linting

## Prerequisites

Before you begin, ensure you have the following installed:

- **Node.js** (v18 or higher) - [Download](https://nodejs.org/)
- **npm** (v9 or higher) - Comes with Node.js
- **Composer** - [Download](https://getcomposer.org/)
- **WordPress** (v6.0 or higher)

## Installation

### 1. Install Dependencies

Navigate to the theme directory and install dependencies:

```bash
cd wp-content/themes/wp-b2

# Install Node.js dependencies
npm install

# Install PHP dependencies
composer install
```

### 2. Build Assets

Compile SCSS to CSS:

```bash
# One-time build
npm run build

# Watch for changes (recommended during development)
npm run watch
```

**Important:** The theme uses two CSS files:
- `style.css` - WordPress theme header (required, header only)
- `assets/css/main.css` - Compiled styles from SCSS (actual theme styles)

Both files are enqueued automatically. The `/*!` comment syntax in `main.scss` ensures the header is preserved during compilation.

### 3. Activate Theme

1. Go to **WordPress Admin** → **Appearance** → **Themes**
2. Find **WP-B2** and click **Activate**

## Project Structure

```
wp-b2/
├── assets/
│   ├── scss/              # SCSS source files (7-1 pattern)
│   │   ├── abstracts/     # Variables, functions, mixins
│   │   ├── base/          # Reset, typography, helpers
│   │   ├── components/    # Buttons, forms, cards, etc.
│   │   ├── layout/        # Header, footer, grid, navigation
│   │   ├── pages/         # Page-specific styles
│   │   ├── themes/        # Theme variations (optional)
│   │   ├── vendors/       # Third-party CSS (normalize)
│   │   └── main.scss      # Main SCSS file (imports all)
│   ├── js/                # JavaScript files
│   ├── css/               # Compiled CSS (generated)
│   ├── images/            # Theme images
│   └── fonts/             # Theme fonts
├── inc/                   # PHP includes
│   ├── acf-config.php     # ACF configuration
│   ├── template-tags.php  # Template helper functions
│   └── template-functions.php
├── template-parts/        # Reusable template parts
│   ├── content.php
│   ├── content-single.php
│   ├── content-page.php
│   └── content-none.php
├── acf-json/              # ACF field groups (JSON sync)
├── functions.php          # Theme functions
├── style.css              # Theme stylesheet (header only)
├── index.php              # Main template
├── header.php             # Header template
├── footer.php             # Footer template
├── sidebar.php            # Sidebar template
├── single.php             # Single post template
├── page.php               # Page template
├── archive.php            # Archive template
├── search.php             # Search results template
└── 404.php                # 404 error template
```

## SCSS 7-1 Architecture

The theme uses the popular 7-1 pattern for organizing SCSS with modern `@use` and `@forward` syntax:

1. **abstracts/** - Variables, functions, mixins (no CSS output)
   - **`_colors.scss`** - Color palette map that generates CSS custom properties
   - **`_spacing.scss`** - Spacing scale map with CSS variables
   - **`_typography.scss`** - Font families, sizes, weights, and line heights
   - **`_layout.scss`** - Container, breakpoints, and grid settings
   - **`_components.scss`** - Border radius, shadows, transitions, z-indexes
   - **`_functions.scss`** - Helper functions (rem conversion, z-index lookup)
   - **`_mixins.scss`** - Reusable mixins (media queries, flexbox, etc.)
   - **`_index.scss`** - Forwards all abstracts using `@forward`
2. **vendors/** - Third-party CSS (normalize.css)
3. **base/** - Basic styles, typography, reset
4. **layout/** - Major layout components (header, footer, grid)
5. **components/** - Reusable components (buttons, forms, cards)
6. **pages/** - Page-specific styles
7. **themes/** - Theme variations (optional)

All files are loaded in `main.scss` using `@use` directives. The abstracts are imported with a wildcard namespace (`as *`) for direct access to variables, functions, and mixins throughout the theme.

### CSS Custom Properties

All design tokens (colors, spacing, typography, etc.) are automatically converted to CSS custom properties at the `:root` level. This provides:
- **Runtime theming** - Change values dynamically with JavaScript
- **Cascade control** - Override variables in specific contexts
- **Browser DevTools** - Inspect and modify values in real-time

Example generated CSS:
```css
:root {
    --color-primary: #0073aa;
    --spacing-md: 1rem;
    --font-size-base: 1rem;
    --border-radius-base: 5px;
}
```

## NPM Scripts

### Development

```bash
# Watch for changes and recompile automatically
npm run watch

# Watch SCSS only
npm run watch:scss
```

### Building

```bash
# Build all assets for production (minified)
npm run build

# Build SCSS only
npm run build:scss
```

### Code Quality

```bash
# Run all linters
npm run lint

# Lint SCSS
npm run lint:scss

# Lint JavaScript
npm run lint:js

# Lint PHP
npm run lint:php
# or
composer run-script phpcs
```

### Auto-formatting

```bash
# Auto-fix all code
npm run format

# Format SCSS
npm run format:scss

# Format JavaScript
npm run format:js

# Format PHP
npm run format:php
# or
composer run-script phpcbf
```

## WordPress Coding Standards

This theme follows WordPress Coding Standards:

- **PHP** - WordPress-Core, WordPress-Extra, WordPress-Docs
- **JavaScript** - WordPress ESLint plugin
- **CSS/SCSS** - WordPress Stylelint configuration

### Running Code Standards Checks

```bash
# Check PHP
composer run-script phpcs

# Auto-fix PHP
composer run-script phpcbf

# Check JavaScript
npm run lint:js

# Check SCSS
npm run lint:scss
```

## Working with ACF (Advanced Custom Fields)

### JSON Sync

ACF field groups are automatically saved to `acf-json/` directory for version control.

### Getting ACF Fields in Templates

Use the helper function for safe field retrieval:

```php
<?php
// Get field with fallback
$value = wp_b2_get_field( 'field_name', false, 'Default value' );

// Or use ACF directly
if ( function_exists( 'get_field' ) ) {
    $value = get_field( 'field_name' );
}
?>
```

### Adding Theme Options Page

Uncomment the function in `inc/acf-config.php`:

```php
function wp_b2_acf_add_options_page() {
    // Already implemented, just uncomment
}
add_action( 'acf/init', 'wp_b2_acf_add_options_page' );
```

## Template Hierarchy

WordPress loads templates in this order:

1. **Home Page**: `index.php`
2. **Single Post**: `single.php` → `index.php`
3. **Page**: `page.php` → `index.php`
4. **Archive**: `archive.php` → `index.php`
5. **Search**: `search.php` → `index.php`
6. **404**: `404.php` → `index.php`

## Template Parts

Reusable content templates in `template-parts/`:

- `content.php` - Default post content
- `content-single.php` - Single post content
- `content-page.php` - Page content
- `content-search.php` - Search result content
- `content-none.php` - No content found

Use them with:

```php
get_template_part( 'template-parts/content', get_post_type() );
```

## Customization

### Working with SCSS Modules (@use and @forward)

This theme uses the modern Sass module system with `@use` and `@forward` instead of the deprecated `@import`.

**All design tokens are accessed via helper functions:**

```scss
@use '../abstracts' as *;

// Use helper functions for all design tokens
.my-element {
    color: color('primary');
    padding: spacing('md');
    font-size: font-size('h3');
    border-radius: border-radius();
    @include transition(all);
}
```

**The wildcard namespace (`as *`)** allows direct access to all helper functions and mixins without prefixing.

### Adding New SCSS Files

1. Create a new file in the appropriate directory (e.g., `components/_new-component.scss`)
2. Add `@use '../abstracts' as *;` at the top if you need variables/mixins
3. Load it in `main.scss`:

```scss
@use 'components/new-component';
```

**Example new component file:**

```scss
// components/_new-component.scss
@use '../abstracts' as *;

.new-component {
    background-color: color('primary');
    padding: spacing('lg');
    border-radius: border-radius();

    @include media-breakpoint-up(md) {
        padding: spacing('xl');
    }
}
```

### Adding Navigation Menus

Registered menus:
- **Primary** - Main navigation
- **Footer** - Footer navigation

Register in `functions.php` and display in templates.

### Adding Widget Areas

Two widget areas are registered:
- **Sidebar** - Main sidebar
- **Footer** - Footer widgets

Register more in `functions.php` via `wp_b2_register_sidebars()`.

## Debugging Tools

The theme includes beautiful visual debugging functions (only available when `WP_DEBUG` is enabled):

### `dump(...$vars)`

Dumps one or more variables with visual formatting:

```php
<?php
$data = get_post_meta( get_the_ID() );
dump( $data );

// Dump multiple variables
dump( $post, $data, $custom_field );
?>
```

### `dd(...$vars)`

Dump and die - outputs variables and stops execution:

```php
<?php
$query = new WP_Query( $args );
dd( $query ); // Execution stops here
?>
```

### `dump_query($query = null)`

Debug WordPress queries with formatted output:

```php
<?php
// Dump current query
dump_query();

// Dump custom query
$custom_query = new WP_Query( $args );
dump_query( $custom_query );
?>
```

### `dump_wp()`

Display WordPress environment information:

```php
<?php
// Shows WordPress version, PHP version, theme info, page type, etc.
dump_wp();
?>
```

**Note:** Debug functions are only loaded when `WP_DEBUG` is `true` in `wp-config.php`.

## Learning Resources

### WordPress Development

- [WordPress Theme Handbook](https://developer.wordpress.org/themes/)
- [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/)
- [Template Hierarchy](https://developer.wordpress.org/themes/basics/template-hierarchy/)

### SCSS & 7-1 Pattern

- [Sass Documentation](https://sass-lang.com/documentation)
- [7-1 Pattern](https://sass-guidelin.es/#the-7-1-pattern)

### Advanced Custom Fields

- [ACF Documentation](https://www.advancedcustomfields.com/resources/)
- [ACF JSON Sync](https://www.advancedcustomfields.com/resources/local-json/)

## Common Issues

### SCSS Not Compiling

```bash
# Make sure Sass is installed
npm install

# Try rebuilding
npm run build
```

### PHP Coding Standards Errors

```bash
# Auto-fix most issues
composer run-script phpcbf

# Check remaining issues
composer run-script phpcs
```

### Theme Not Showing

- Check `style.css` has proper theme header
- Verify theme directory name is `wp-b2`
- Clear WordPress cache

## Contributing

This theme is designed for educational purposes. Feel free to:

- Add new features
- Improve documentation
- Fix bugs
- Create custom templates

## License

This theme is licensed under GPL v2 or later.

## Support

For questions or issues while learning:

1. Check WordPress documentation
2. Review the code comments
3. Check coding standards
4. Experiment and learn!

---

**Happy Learning!** 🚀
