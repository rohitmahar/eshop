let webpack = require('webpack');
let path = require('path');
let glob = require('glob');
let ExtractTextPlugin = require("extract-text-webpack-plugin");
let isProduction = (process.env.NODE_ENV == 'production');
let PurifyCSSPlugin = require('purifycss-webpack');
let CleanWebpackPlugin = require('clean-webpack-plugin');
let ManifestPlugin = require('webpack-manifest-plugin');
let ProgressBarPlugin = require('progress-bar-webpack-plugin');

/*
    Vendor is used for Everyone !
 */
module.exports = {
    entry: {
        vendor: './resources/assets/vendors/js/vendor.js',
        eshopApp: './resources/assets/frontend/js/app.js',
        voardApp: './resources/assets/backend/js/app.js',
        adminApp: './resources/assets/backend/js/vue/admins.js',
        customerApp: './resources/assets/backend/js/vue/customer.js',
        productApp: './resources/assets/backend/js/vue/product.js',
        sliderApp: './resources/assets/backend/js/vue/slider.js',
        orderApp: './resources/assets/backend/js/vue/orders.js',
        eliveredOrderApp: './resources/assets/backend/js/vue/deliveredOrder.js',
    },

    output: {
        path: path.resolve(__dirname, 'public/build'),
        filename: '[name].[hash].js',
        publicPath: './public'
    },

    // devServer: {
    //     hot: true,
    //     inline: true,
    //     host: "localhost",
    //     port: 8080,
    //     contentBase: path.join(__dirname, "public"),
    //     watchOptions: {
    //         poll: false
    //     }
    // },

    module: {
        rules: [
            {
                test: /\.s[ac]ss/,
                use: ExtractTextPlugin.extract({
                    use: ['css-loader', 'sass-loader'],
                    fallback: "style-loader"
                })
            },
            {
                test: /\.(png|woff|woff2|eot|ttf|svg|gif|jpg)$/,
                exclude: /node_modules/,
                loader: 'url-loader?limit=100000'
            },
            {
                test: /\.css$/,
                exclude: /node_modules/,
                use: ['style-loader', 'css-loader']
            },
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: ['vue-hot-reload-loader', 'babel-loader']
            },
            {
                test: /\.vue$/,
                use: ['vue-hot-reload-loader', 'vue-loader']
            }
        ]
    },

    resolve: {
        alias: {
            'vue$': 'vue/dist/vue.esm.js'
        }
    },

    plugins: [
        /*new webpack.optimize.CommonsChunkPlugin({
            names: ['vendor']
        }),*/

        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
            'window.jQuery': 'jquery'
        }),

        new ExtractTextPlugin('[name].[hash].css'),

        new webpack.LoaderOptionsPlugin({
            minimize: isProduction,
        }),

        new PurifyCSSPlugin({
            paths: glob.sync(path.join(__dirname, 'resources/views/**/*.blade.php')),
            minimize: isProduction,
            moduleExtensions: ['.vue']
        }),

        new ManifestPlugin(),

        new ProgressBarPlugin(),

        // new BrowserSyncPlugin({
        //     host: 'localhost',
        //     port: 3000,
        //     server: { baseDir: ['public'] }
        // }),
        //
        // new webpack.HotModuleReplacementPlugin()
        new CleanWebpackPlugin('public/build')
    ],
};

if(process.env.NODE_ENV == 'production') {
    module.exports.plugins.push(
        new webpack.DefinePlugin({
            'process.env': {
                NODE_ENV: '"production"'
            }
        }),
        new webpack.optimize.UglifyJsPlugin({
            sourcemap: true,
            compress: {
                warnings: false
            }
        })
    );
};