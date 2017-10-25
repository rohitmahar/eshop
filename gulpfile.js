const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

elixir.config.assetsPath = 'resources/assets/backend';
elixir.config.publicPath =  'public/backend';
elixir((mix) => {
    mix.sass('app.scss');
    // .webpack('app.js')
    // .webpack('vue/admins.js')
    // .webpack('vue/customer.js')
    // .webpack('vue/product.js')
    // .webpack('vue/slider.js')
    // .webpack('vue/orders.js');
});
