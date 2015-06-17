var fs = require('fs'),
	page = new WebPage(),
	address, output, size;

page.settings.userAgent = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36';
page.settings.javascriptEnabled = false;
 
if (phantom.args.length < 2 || phantom.args.length > 3) {
	console.log('Usage: rasterize.js URL filename');
	phantom.exit();
} else {
	address = phantom.args[0];
	output = phantom.args[1];
	page.viewportSize = { width: 1400, height: 800 };
	page.onConsoleMessage = function(msg) { console.log(msg); };
	page.open(address, function (status) {
		if (status !== 'success') {
			console.log('Unable to load the address!');
			phantom.exit(1);
		} else {
			window.setTimeout(function () {
				page.render(output);
				phantom.exit();
			}, 350);
		}
	});
}
