/**
 * Pilpil v1.0.0 - Progressive Image Loading
 * @link https://zafree.github.io/pilpil
 * @copyright 2015-2016 Zafree
 * @license MIT
 */
(function ($) {
	'use strict';


	
	$.fn.hasAttr = function (name) {
		return this.attr(name) !== undefined;
	};

	$.fn.inView = function () {
		// Am I visible?
		// Height and Width are not explicitly necessary in visibility detection, the bottom, right, top and left are the
		// essential checks. If an image is 0x0, it is technically not visible, so it should not be marked as such.
		// That is why either width or height have to be > 0.
		var rect = this[0].getBoundingClientRect();
		return (
			(rect.height > 0 || rect.width > 0) &&
			rect.bottom >= 0 &&
			rect.right >= 0 &&
			rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
			rect.left <= (window.innerWidth || document.documentElement.clientWidth)
		);
	};

	 // set progressive image loading
	 var progressiveMedias = document.querySelectorAll('.progressiveMedia');
	 for (var i = 0; i < progressiveMedias.length; i++) {
	 	loadImage(progressiveMedias[i]);
	 }

	 function loadImage(progressiveMedia) {
		  // calculate aspect ratio
		  // for the aspectRatioPlaceholder-fill
		  // that helps to set a fixed fill for loading images
		  var width = progressiveMedia.dataset.width,
		  height = progressiveMedia.dataset.height,
		  fill = height / width * 100,
		  placeholderFill = progressiveMedia.previousElementSibling;

		  placeholderFill.setAttribute('style', 'padding-bottom:'+fill+'%;');



		  // get thumbnail height wight
		  // make canvas fun part
		  var thumbnail = progressiveMedia.querySelector('.progressiveMedia-thumbnail'),
		  smImageWidth = thumbnail.width,
		  smImageheight = thumbnail.height,

		  canvas = progressiveMedia.querySelector('.progressiveMedia-canvas'),
		  context = canvas.getContext('2d');

		  canvas.height = smImageheight;
		  canvas.width = smImageWidth;

		  var img = new Image();
		  img.src = thumbnail.src;

		  img.onload = function () {
			// context.drawImage(img, 0, 0);
			// draw canvas
			var canvasImage = new CanvasImage(canvas, img);
			canvasImage.blur(2);

			// load canvas visible
			progressiveMedia.classList.add('is-canvasLoaded');
		};
	}


	$(window).on('scroll load resize',function(){
		$(".progressiveMedia-image").each(function(){
			var $self = $(this),
			$selfOffset = $self.offset(),
			$notLoadedYet = $self.attr("src");
			if ($notLoadedYet == undefined || $notLoadedYet == "") {
				var img = new Image();
				img.src = $self.attr("data-src");

				img.onload = function () {
					if($self.inView()) {
						$self.attr('src',$self.attr('data-src'));
						// load image visible
						$self.parent().addClass('is-imageLoaded');
					}
				}
			}
		});
	});

})(jQuery);


// canvas blur function
CanvasImage = function (e, t) {
	this.image = t;
	this.element = e;
	e.width = t.width;
	e.height = t.height;
	this.context = e.getContext('2d');
	this.context.drawImage(t, 0, 0);
};

CanvasImage.prototype = {
	blur:function(e) {
		this.context.globalAlpha = 0.5;
		for(var t = -e; t <= e; t += 2) {
			for(var n = -e; n <= e; n += 2) {
				this.context.drawImage(this.element, n, t);
				var blob = n >= 0 && t >= 0 && this.context.drawImage(this.element, -(n -1), -(t-1));
			}
		}
	}
};