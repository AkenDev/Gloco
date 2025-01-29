import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    logLevel: 'info', // Options: 'info', 'warn', 'error', 'silent'
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/authapp.css',
                'resources/js/vendor.js',
                'resources/js/app.js',
                'resources/js/login.js',
                'resources/js/logout.js',
                'resources/js/custom.js',
                'resources/js/InventariosFactura.js',
                'resources/js/getLotesForInventario.js',
                'resources/js/LotesSelection.js',
                //'resources/js/jquery.min.js',
                //'resources/js/popper.min.js',
                //'resources/js/bootstrap.min.js',
                
                //'resources/js/waypoints.min.js',
                //'resources/js/select2.min.js',
                //'resources/js/jquery.magnific-popup.min.js',
                //'resources/js/smooth-scrollbar.js',
                //'resources/js/core.js',
                //'resources/js/charts.js',
                //'resources/js/morris.js',
            ],
            refresh: true,
        }),
    ],
});
