

jQuery(document).ready(function ($) {
	
	// fade out when clicks on external link - smooth animation :)
	$('a.external').click(function(e) {
		e.preventDefault();
		var link = $(this).attr('href');
		$('body').fadeOut('50', function() {
			window.location.href = link;
		});
	});
	
	
	/**
	*
	* Header SCRIPTING
	*
	*/
	$('ul.menu li.menu-item-has-children>a').append('<span class="ti-angle-down"></span>');
	
	//sticky header
	$(window).on('scroll load', function () {
		if ($(document).scrollTop() == $('.header-wrapper')[0].getBoundingClientRect().top){
			$('.header-wrapper').removeClass('sticky-header');
		}else{
			$('.header-wrapper').addClass('sticky-header');
		}
	});

	//mobile menu
	$('a.toggle-menu').click(function(e) {
		e.preventDefault();
		$(this).find('span').toggleClass('ti-menu ti-close');
		$('.mobile-navigation').toggleClass('active');
		$('.mobile-menu-backdrop').toggle();
	});
	
	//mobile menu
	$('.mobile-menu-backdrop').click(function(e) {
		$('a.toggle-menu').find('span').toggleClass('ti-menu ti-close');
		$('.mobile-navigation').toggleClass('active');
		$('.mobile-menu-backdrop').toggle();
	});
	
	
	
	
	
	/**
	*
	* Fonts Loading using FONTFACEOBSERVER
	*
	*/
	var baseFont = new FontFaceObserver('ProximaNova', {
		weight: 200
	});
	var baseFont2 = new FontFaceObserver('ProximaNova', {
		weight: 300,
		style: "italic"
	});
	var baseFont3 = new FontFaceObserver('ProximaNova', {
		weight: 400
	});
	var baseFont4 = new FontFaceObserver('ProximaNova', {
		weight: 500
	});
	var baseFont5 = new FontFaceObserver('ProximaNova', {
		weight: 600
	});
	Promise.all([baseFont.load(), baseFont2.load(), baseFont3.load(), baseFont4.load(), baseFont5.load()]).then(function () {
		document.documentElement.className += " fonts-loaded";
	});
	
	
});
















// // LOCAL STORAGE SCRIPT
// // load css files
// console.log('Local storage started!');
// var styles = [{
// 	url: '/css/styles.css'
// }];

// // load js files
// var js = [{
// 	url: '/js/scripts/jquery.js'
// }];
// // IF loading JS files then in LOADER.LOAD.APPLY use styles.concat(js) not just styles

// // UNCOMMENT to turn on loading cached files from Local Storage (performance boost √)
// loader.textInjection = true;

// if (loader.has('/css/styles.css')) {
// 	loader.load.apply(loader, styles.concat(js)).then(function() {
// 		// initiliaze your app?
// 		console.log("It has! loaded from storage!");
// 	});
// }else{
// 	loader.load.apply(loader, styles.concat(js)).then(function() {
// 		// initiliaze your app?
// 		console.log("Nope, loading from file :/");
// 	});
// }
