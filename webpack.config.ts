const path = require("path");
const webpack = require("webpack");
require('dotenv').config();

module.exports = (env: any = {
    app: "training"
}) => {

    if (!env || !env.app) {
        throw "Please provide an app name";
    }

    const {app} = env;

    let publicPath = `${process.env.APP_URL}/assets/${app}/`;
    let src = path.resolve(__dirname, `resources/assets/${app}/`);

    return {
        entry: [
            path.resolve(src, "index.ts"),
            `!file-loader?name=index.css!extract-loader!css-loader!sass-loader!${path.resolve(src, "index.scss")}`
        ],
        output: {
            path: path.resolve(__dirname, `./public/assets/${app}/`),
            publicPath: publicPath
        },
        optimization: {
            runtimeChunk: "single",
            splitChunks: {
                cacheGroups: {
                    vendor: {
                        test: /node_modules/,
                        name: "vendor",
                        enforce: true,
                        chunks: "initial"
                    }
                }
            }
        },
        module: {
            rules: [
                {
                    test: /\.ts(x)?$/,
                    use: [
                        {
                            loader: "ts-loader",
                            options: {
                                transpileOnly: true,
                                experimentalWatchApi: true
                            }
                        }
                    ]
                },
                {
                    test: /\.(svg|jpg|png|jpeg|gif|eot|woff|ttf)/,
                    use: "file-loader"
                }
            ]
        },
        resolve: {
            extensions: ['.js', '.ts', '.tsx']
        },
        externals: {
            "jquery": "jQuery",
        }
    }
}
