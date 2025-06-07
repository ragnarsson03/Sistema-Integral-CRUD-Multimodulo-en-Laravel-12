const mix = require('laravel-mix');



mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
      require('tailwindcss'),
      require('autoprefixer'),
   ])
   .copy('node_modules/admin-lte/dist/js/pages/dashboard.js', 'public/dist/js/pages')
   .copy('node_modules/jquery-ui-dist/jquery-ui.min.js', 'public/plugins/jquery-ui')

   .copy('node_modules/admin-lte/dist/css/adminlte.min.css', 'public/dist/css')
   .copy('node_modules/admin-lte/dist/js/adminlte.js', 'public/dist/js')
   .copy('node_modules/admin-lte/dist/js/demo.js', 'public/dist/js')
   .copy('node_modules/jquery/dist/jquery.min.js', 'public/plugins/jquery')
   .copy('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', 'public/plugins/bootstrap/js')
   .copy('node_modules/popper.js/dist/umd/popper.min.js', 'public/plugins/popper')
   .version();
   