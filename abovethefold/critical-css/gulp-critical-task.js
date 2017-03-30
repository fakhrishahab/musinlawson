/**
 * WordPress Gulp.js Critical CSS Task Package
 *
 * This file contains a task to create critical path CSS.
 *
 * @package    abovethefold
 * @subpackage abovethefold/modules/critical-css-build-tool
 * @author     PageSpeed.pro <info@pagespeed.pro>
 */
module.exports = function (gulp, plugins, critical) {
    return function (cb) {

    	var taskname = "critical-css";
    	var taskpath = taskname + '/';

    	// check if html file exists in package
    	if (!plugins.fs.existsSync(taskpath + 'page.html')) {
    		throw new Error('page.html does not exist in package');
            return false;
        }

    	// check if full css file exists in package
    	if (!plugins.fs.existsSync(taskpath + 'full.css')) {
    		throw new Error('full.css does not exist in package');
            return false;
        }

        var extraCSS = false;

    	// check if extra css file exists in package
    	if (plugins.fs.existsSync(taskpath + 'extra.css')) {
    		extraCSS = true;
        }


        // optimization tasks
        var TASKS = {};

        // Clean output directory
        TASKS['clean'] = function() {
        	return new Promise(function(resolve, reject) {

				console.log('\nCleaning output directory', plugins.util.colors.red.bold('/'+taskpath+'output/'),'...');

				gulp.src([taskpath + 'output'], { read: false })
        			.pipe(plugins.clean())
					.on('error', reject)
					.on('data', function () {}) 
					.on('end', resolve);

			});
        };

        // create citical CSS
        TASKS['critical'] = function() {

        	console.log('\n' + plugins.util.colors.yellow.bold('Creating Critical Path CSS...'));

			/**
	    	 * Perform critical CSS generation
	    	 * @link https://github.com/addyosmani/critical
	    	 */
	    	return critical.generate({
		        inline: false, // generate
		        base: taskpath ,
		        src: 'page.html',
		        dest: 'output/critical.css',
		        minify: false,
				css: [
    taskpath + "\/css\/1-fonts-googleapis-com-css",
    taskpath + "\/css\/2-cdnjs-cloudflare-com-swiper.min.css",
    taskpath + "\/css\/3-maxcdn-bootstrapcdn-com-font-awesome.min.css",
    taskpath + "\/css\/4-musinlawson-co-id-dashicons.min.css",
    taskpath + "\/css\/5-musinlawson-co-id-display-structure.css",
    taskpath + "\/css\/6-224b8ea0bab74e7c394daa8d9795c09a.css",
    taskpath + "\/css\/7-f0b3715213ee5b24a0d73bfdb8a7c6eb.css",
    taskpath + "\/css\/8-03a4e9c4c270e914769f7ee2b3837019.css",
    taskpath + "\/css\/9-8122dbd39e54e4740ef924a3adbd4e6e.css"
],
				extract: false,
				width: 1300,
				height: 900,
				pathPrefix: '../../../../', // wordpress root from /themes/THEME-NAME/abovethefold/
				timeout: 120000
		    });
        };

        // concatenate extra.css
        TASKS['concat'] = function() {
			return new Promise(function(resolve, reject) {

				if (!extraCSS) {
					resolve();
					return;
				}

				console.log(plugins.util.colors.white.bold(' ➤ Append extra.css to critical.css...'));

				// append extra.css
				gulp.src([taskpath + 'output/critical.css', taskpath + 'extra.css'])
				    .pipe(plugins.concat('critical+extra.css'))
			        .pipe(gulp.dest(taskpath + 'output'))
	    			.on('error', reject)
			        .on('end', resolve);

			});
        };

        // minify
        TASKS['minify'] = function() {
        	return new Promise(function(resolve, reject) {

				console.log(plugins.util.colors.white.bold(' ➤ Minify critical CSS...'));

				// append extra.css
				gulp.src(['!*.min.css',taskpath + 'output/*.css'])
					.pipe(plugins.cssmin({
			            "keepSpecialComments": false,
			            "advanced": true,
			            "aggressiveMerging": true,
			            "showLog": true
					}))    				.pipe(plugins.rename({ suffix: '.min' }))
			        .pipe(gulp.dest(taskpath + 'output/'))
	    			.on('error', reject)
			        .on('end', resolve);
			})
        };

        // copy critical-css to storage location
        TASKS['copy'] = function() {
			return new Promise(function(resolve, reject) {

resolve();			});

        };

        // print size
        TASKS['size'] = function() {
        	return new Promise(function(resolve, reject) {

				console.log('\nCritical CSS processor completed successfully. The critical CSS files are located in /critical-css/output/');

				gulp.src(taskpath + 'output/*')
	    			.pipe(plugins.size( { showFiles: true } ))
	    			.on('error', reject)
			        .on('end', resolve)
			        .pipe(gulp.dest('output', { overwrite: false } ));
			});
        };

        // process optimization tasks
        TASKS['clean']()
        	.then(function() {
	        	return TASKS['critical']()
	        }).then(function() {
	        	return TASKS['concat']()
	        }).then(function() {
	        	return TASKS['minify']()
			}).then(function() {
	        	return TASKS['copy']()
			}).then(function() {
	        	return TASKS['size']()
			}).then(
        		function() {
					cb();
				}
        	);

    };
};
