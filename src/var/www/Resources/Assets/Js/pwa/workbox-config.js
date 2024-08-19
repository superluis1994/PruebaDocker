module.exports = {
	globDirectory: '.',
	globPatterns: [
		'**/*.{php,sql,json,lock,md,css,png,jpg,gif,ico,svg,webp,js,txt,ts,yml,yaml,dist}'
	],
	swDest: 'sw.js',
	ignoreURLParametersMatching: [
		/^utm_/,
		/^fbclid$/
	]
};