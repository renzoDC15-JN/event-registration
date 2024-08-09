import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',

        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        './resources/css/**/*.css',
    ],
    theme: {
        extend: {
            screens: {
                'xs': '320px', // Add custom breakpoint
            },
        },
    },
}
