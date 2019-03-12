var path = require('path');
var webpack = require('webpack');
var UglifyJsPlugin = require('uglifyjs-webpack-plugin');
var TransferWebpackPlugin = require('transfer-webpack-plugin');
var ExtractTextPlugin = require('extract-text-webpack-plugin');

var extractPlugin = new ExtractTextPlugin({
    filename: 'legion.css'
});

module.exports = {
    entry: './src/legion/js/app.js',
    output: {
        path: path.resolve(__dirname, 'dist'),
        filename: 'legion-bundle.js',
        publicPath: '/dist'
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                use: [
                    {
                        loader: 'babel-loader',
                        options: {
                            presets: ['es2015']
                        }
                    }
                ]
            },
            {
                test: /\.scss$/,
                use: extractPlugin.extract({
                    use: ['css-loader', 'sass-loader']
                })
            }
        ]
    },
    plugins: [
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery'
        }),
        extractPlugin
    ]
};