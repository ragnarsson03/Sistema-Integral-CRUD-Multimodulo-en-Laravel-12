require('./bootstrap');

const Alpine = require('alpinejs');
window.Alpine = Alpine;
Alpine.start();

// AdminLTE dependencies
window.$ = window.jQuery = require('jquery');
require('bootstrap');
require('admin-lte');