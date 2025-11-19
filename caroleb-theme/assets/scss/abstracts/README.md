# Abstracts Directory

This directory contains all SCSS variables, functions, and mixins organized into logical modules.

## Structure

### Variable Modules

All variables are organized by category and automatically generate CSS custom properties (CSS variables) at `:root` level.

#### `_colors.scss`
Contains all color definitions in a map format:
- Primary and secondary colors
- Neutral colors (black, white, grays)
- Semantic colors (success, warning, danger, info)
- Text colors
- Background colors
- Border colors

**Usage:**
```scss
@use '../abstracts' as *;

.element {
    color: color('primary');
    background: color('bg-alt');
    border-color: color('border');
}
```

**Generated CSS Variables:**
```css
:root {
    --color-primary: #0073aa;
    --color-secondary: #23282d;
    /* ... etc */
}
```

#### `_spacing.scss`
Contains spacing scale based on a spacing unit (1rem):
- xs: 4px
- sm: 8px
- md: 16px
- lg: 24px
- xl: 32px
- xxl: 48px

**Usage:**
```scss
.element {
    padding: spacing('md');
    margin-top: spacing('lg');
    gap: spacing('sm');
}
```

#### `_typography.scss`
Contains typography-related settings:
- Font families (primary, secondary, code)
- Font sizes (small, base, large, h1-h6)
- Font weights (light, normal, medium, semibold, bold)
- Line heights (base, heading)

**Usage:**
```scss
.element {
    font-family: font-family('primary');
    font-size: font-size('h3');
    font-weight: font-weight('bold');
    line-height: line-height('base');
}
```

#### `_layout.scss`
Contains layout-related settings:
- Container settings (max-width, padding)
- Breakpoints (xs, sm, md, lg, xl)
- Grid settings (columns, gutter)

**Usage:**
```scss
.element {
    max-width: container('max-width');
    padding: container('padding');
}

// Breakpoints are used in mixins
@include media-breakpoint-up(md) {
    // styles for medium screens and up
}
```

#### `_components.scss`
Contains component-related settings:
- Border radius (sm, base, lg)
- Box shadows (sm, base, lg)
- Transitions (speed, timing)
- Z-index layers (dropdown, sticky, fixed, modal, etc.)

**Usage:**
```scss
.element {
    border-radius: border-radius();
    box-shadow: box-shadow('lg');
    transition: all transition('speed') transition('timing');
    z-index: z-index('modal');
}
```

### Utility Modules

#### `_functions.scss`
Custom Sass functions:
- `rem($pixels, $context)` - Convert px to rem
- `z($layer)` - Get z-index value by name

**Usage:**
```scss
.element {
    padding: rem(20px);  // Converts to rem
    z-index: z('modal'); // Gets z-index for modal layer
}
```

#### `_mixins.scss`
Reusable mixins:
- `media-breakpoint-up($breakpoint)` - Min-width media query
- `media-breakpoint-down($breakpoint)` - Max-width media query
- `clearfix` - Clear floats
- `visually-hidden` - Hide visually but keep accessible
- `container` - Container styles
- `flex-center` - Center with flexbox
- `flex-between` - Space between with flexbox
- `transition($properties...)` - Transition shorthand
- `focus-outline` - Consistent focus styles
- `button-reset` - Reset button styles
- `link-reset` - Reset link styles

**Usage:**
```scss
.element {
    @include container;
    @include transition(all);

    @include media-breakpoint-up(md) {
        @include flex-between;
    }
}
```

### `_index.scss`
Forward file that exports all abstracts for easy importing.

## How It Works

1. **Variable modules** define maps and generate CSS custom properties
2. **Each module** provides helper functions for accessing values
3. **Backward compatibility** variables use the helper functions
4. **The index file** forwards everything using `@forward`

## Benefits

- **CSS Custom Properties**: All values are available as CSS variables for runtime theming
- **Type Safety**: Organized by category makes it easier to find what you need
- **Maintainability**: Easy to update values in one place
- **Flexibility**: Can override CSS variables in specific contexts
- **JavaScript Access**: CSS variables can be read/modified via JavaScript

## Adding New Values

### Add a Color
```scss
// In _colors.scss
$colors: (
    // ... existing colors
    'accent': #ff6b6b,  // Add new color
);
```

### Add a Spacing Value
```scss
// In _spacing.scss
$spacing: (
    // ... existing spacing
    'xxxl': $spacing-unit * 4,  // Add new spacing
);
```

### Add a Breakpoint
```scss
// In _layout.scss
$breakpoints: (
    // ... existing breakpoints
    'xxl': 1600px,  // Add new breakpoint
);

// Don't forget to update the mixin in _mixins.scss
@mixin media-breakpoint-up($breakpoint) {
    // ... existing conditions
    @else if $breakpoint == xxl {
        @media (min-width: $breakpoint-xxl) {
            @content;
        }
    }
}
```

## Best Practices

1. **Always use the abstracts**: `@use '../abstracts' as *;`
2. **Use helper functions**: `color('primary')`, `spacing('md')`, `font-size('h3')`
3. **Leverage CSS variables**: They can be changed at runtime and cascade
4. **Follow the naming convention**: Use the map keys consistently
5. **Never hard-code values**: Always use the design token functions
