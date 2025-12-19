const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');

module.exports = (env, argv) => {
    const isProduction = argv.mode === 'production';

    return {
        entry: {
            app: './assets/js/app.js',
            style: './assets/scss/style.scss',
        },

        output: {
            filename: isProduction ? '[name].min.js' : '[name].js',
            path: path.resolve(__dirname, 'dist'),
        },

        module: {
            rules: [
                {
                    test: /\.s[ac]ss$/i,
                    use: [
                        MiniCssExtractPlugin.loader,
                        {
                            loader: 'css-loader',
                            options: {
                                esModule: false,
                                importLoaders: 2,
                                sourceMap: !isProduction,
                                url: false,
                            },
                        },
                        {
                            loader: 'postcss-loader',
                            options: {
                                sourceMap: !isProduction,
                                postcssOptions: {
                                    plugins: [
                                        require('autoprefixer'),
                                    ],
                                },
                            },
                        },
                        {
                            loader: 'sass-loader',
                            options: {
                                sourceMap: !isProduction,
                            },
                        },
                    ],
                },
            ],
        },

        plugins: [
            new CleanWebpackPlugin(),
            new MiniCssExtractPlugin({
                filename: isProduction ? '[name].min.css' : '[name].css',
            }),
        ],

        mode: isProduction ? 'production' : 'development',
        devtool: isProduction ? false : 'source-map',

        optimization: {
            minimize: isProduction,
            minimizer: [
                new TerserPlugin({
                    extractComments: false,
                    terserOptions: {
                        format: { comments: false },
                        compress: {
                            drop_console: true,
                            drop_debugger: true,
                        },
                    },
                }),
                new CssMinimizerPlugin(),
            ],
        },

        watch: !isProduction,

        // Uncomment if watch misses changes in Docker
        // watchOptions: {
        // 	ignored: /node_modules/,
        // 	poll: 1000,
        // },

        stats: 'minimal',
    };
};
