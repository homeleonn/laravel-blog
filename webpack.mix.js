const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.disableNotifications();

mix.options({
    processCssUrls: false
}); 
 
mix.less('../metallodessa.loc/css/style.less', 'assets/style.css');
mix.copy('public/assets/style.css', 'assets/style.css');

 mix.styles([
    '../metallodessa.loc/css/bootstrap-grid.my.min.css',
    '../metallodessa.loc/css/fontello.css',
    '../metallodessa.loc/css/proto-style.css',
    '../metallodessa.loc/css/slider.css',
    '../metallodessa.loc/css/shower.css',
    '../metallodessa.loc/css/woow.css',
    'assets/style.css',
], 'assets/dev.css');

 mix.scripts([
    '../metallodessa.loc/js/js.js',
    '../metallodessa.loc/js/lazy.js',
    '../metallodessa.loc/js/slider.js',
], 'assets/dev.js');

// mix.styles([
    // 'resources/assets/admin/assets/bootstrap/css/bootstrap.min.css',
    // 'resources/assets/admin/assets/font-awesome/4.5.0/css/font-awesome.min.css',
    // 'resources/assets/admin/assets/ionicons/2.0.1/css/ionicons.min.css',
    // 'resources/assets/admin/assets/plugins/iCheck/minimal/_all.css',
    // 'resources/assets/admin/assets/plugins/datepicker/datepicker3.css',
    // 'resources/assets/admin/assets/plugins/select2/select2.min.css',
    // 'resources/assets/admin/assets/plugins/datatables/dataTables.bootstrap.css',
    // 'resources/assets/admin/assets/dist/css/AdminLTE.min.css',
    // 'resources/assets/admin/assets/dist/css/skins/_all-skins.min.css',
// ], 'public/css/admin.css');


// mix.scripts([
    // 'resources/assets/admin/assets/plugins/jQuery/jquery-2.2.3.min.js',
    // 'resources/assets/admin/assets/bootstrap/js/bootstrap.min.js',
    // 'resources/assets/admin/assets/plugins/select2/select2.full.min.js',
    // 'resources/assets/admin/assets/plugins/datepicker/bootstrap-datepicker.js',
    // 'resources/assets/admin/assets/plugins/datatables/jquery.dataTables.min.js',
    // 'resources/assets/admin/assets/plugins/datatables/dataTables.bootstrap.min.js',
    // 'resources/assets/admin/assets/plugins/slimScroll/jquery.slimscroll.min.js',
    // 'resources/assets/admin/assets/plugins/fastclick/fastclick.js',
    // 'resources/assets/admin/assets/plugins/iCheck/icheck.min.js',
    // 'resources/assets/admin/assets/dist/js/app.min.js',
    // 'resources/assets/admin/assets/dist/js/demo.js',
    // 'resources/assets/admin/assets/js.js',
// ], 'public/js/admin.js');

// mix.copy('resources/assets/admin/assets/bootstrap/fonts', 'public/fonts');
// mix.copy('resources/assets/admin/assets/dist/fonts', 'public/fonts');
// mix.copy('resources/assets/admin/assets/dist/img', 'public/img');
// mix.copy('resources/assets/admin/assets/plugins/iCheck/minimal/blue.png', 'public/css');

// mix.styles([
    // 'resources/assets/front/css/bootstrap.min.css',
    // 'resources/assets/front/css/font-awesome.min.css',
    // 'resources/assets/front/css/animate.min.css',
    // 'resources/assets/front/css/owl.carousel.css',
    // 'resources/assets/front/css/owl.theme.css',
    // 'resources/assets/front/css/owl.transitions.css',
    // 'resources/assets/front/css/style.css',
    // 'resources/assets/front/css/responsive.css',
    // 'resources/assets/front/css/bootstrap.min.css',
// ], 'public/css/front.css');

// mix.scripts([
    // 'resources/assets/front/js/jquery-1.11.3.min.js',
    // 'resources/assets/front/js/bootstrap.min.js',
    // 'resources/assets/front/js/owl.carousel.min.js',
    // 'resources/assets/front/js/jquery.stickit.min.js',
    // 'resources/assets/front/js/menu.js',
    // 'resources/assets/front/js/scripts.js',
// ], 'public/js/front.js');


// mix.copy('resources/assets/front/fonts', 'public/fonts');
// mix.copy('resources/assets/front/images', 'public/images');