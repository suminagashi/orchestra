var Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('src/Resources/views/build')
    .setPublicPath('/build')
    .addEntry('app', './src/Resources/assets/js/index.js')
    .enableVueLoader(() => {}, { runtimeCompilerBuild: true})
    .addStyleEntry('css/app', './src/Resources/assets/css/app.less')
    .enableLessLoader()
    .enablePostCssLoader()
;

module.exports = Encore.getWebpackConfig();
