# Quick Start Guide - WP-B2 Theme

This guide will help you get started with the WP-B2 theme in minutes.

## Step 1: Install Dependencies

Open your terminal and navigate to the theme directory:

```bash
cd wp-content/themes/wp-b2
```

Install Node.js packages:

```bash
npm install
```

Install PHP packages:

```bash
composer install
```

## Step 2: Build the Theme

Compile SCSS to CSS:

```bash
npm run build
```

## Step 3: Activate the Theme

1. Go to **WordPress Admin** → **Appearance** → **Themes**
2. Find **WP-B2**
3. Click **Activate**

## Step 4: Start Developing

Start the watch mode to automatically compile your changes:

```bash
npm run watch
```

Now you can edit SCSS files in `assets/scss/` and they will automatically compile to CSS!

## Common Tasks

### Edit Styles

Edit SCSS files in `assets/scss/`:
- **Colors**: `abstracts/_colors.scss`
- **Spacing**: `abstracts/_spacing.scss`
- **Typography**: `abstracts/_typography.scss` and `base/_typography.scss`
- **Header**: `layout/_header.scss`
- **Footer**: `layout/_footer.scss`

**Note:** Don't edit `style.css` (WordPress header only) or `assets/css/main.css` (compiled). Edit SCSS files only!

### Edit Templates

Edit PHP files:
- **Homepage**: `index.php`
- **Header**: `header.php`
- **Footer**: `footer.php`
- **Single Post**: `single.php`
- **Page**: `page.php`

### Edit JavaScript

Edit `assets/js/main.js` for custom JavaScript.

### Check Code Quality

Before committing code, run:

```bash
# Check all code
npm run lint

# Auto-fix issues
npm run format
```

## File Structure Overview

```
wp-b2/
├── assets/
│   ├── scss/          ← Edit your styles here
│   ├── js/            ← Edit your JavaScript here
│   └── css/           ← Compiled CSS (don't edit)
├── inc/               ← PHP helper functions
├── template-parts/    ← Reusable template pieces
├── functions.php      ← Theme setup and features
├── header.php         ← Site header
├── footer.php         ← Site footer
├── index.php          ← Main template
└── style.css          ← Theme info (don't edit CSS here)
```

## Next Steps

1. **Learn SCSS 7-1 Pattern**: Check `assets/scss/main.scss`
2. **Study WordPress Template Hierarchy**: Read `README.md`
3. **Explore ACF Integration**: Check `inc/acf-config.php`
4. **Add Custom Features**: Modify `functions.php`

## Need Help?

- Read the full [README.md](README.md)
- Check [WordPress Theme Handbook](https://developer.wordpress.org/themes/)
- Review code comments in the theme files

---

**Happy Coding!** 🎓
