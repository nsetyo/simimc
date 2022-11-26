const colors = require('tailwindcss/colors')

module.exports = {
    content: [
        './vendor/filament/**/*.css',
        './vendor/filament/**/*.blade.php',
        './resources/**/*.blade.php',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            danger: colors.rose,
            primary: colors.blue,
            success: colors.green,
            warning: colors.yellow,
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
}