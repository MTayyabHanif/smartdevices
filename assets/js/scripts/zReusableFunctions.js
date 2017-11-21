//FUNCTIONS

$.fn.hasAttr = function(name) {
	return this.attr(name) !== undefined;
};

$.fn.inView = function(){
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



function isMobile() {
	var check = false;
	(function(a){if(/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
	return check;
}




function getIcon(target){
	var caret = target.find('span.icon');
	if (caret.length) {
		return target.find('span.icon');
	}
	return false;
}



// Notes
function infoNotes(el) {
	if ($(el).length !== 0) {
		$(el).find('.close').on('click', function(e) {
			e.preventDefault();
			$(this).parent('.info-note').fadeOut('400', function() {
				$(this).addClass('disp-none');
			});
		});
	}
	return;
}



function disableBodyScroll(){
	var $html = $('html');
	var windowWidth = window.innerWidth;

	if (!windowWidth)
	{
		var documentElementRect = document.documentElement.getBoundingClientRect();
		windowWidth = documentElementRect.right - Math.abs(documentElementRect.left);
	}

	var isOverflowing = document.body.clientWidth < windowWidth;


    	// measuring Scrollbar
    	var $body = $('body');
    	var scrollDiv = document.createElement('div');
    	scrollDiv.className = 'scrollbar-measure';

    	$body.append(scrollDiv);
    	var scrollbarWidth = scrollDiv.offsetWidth - scrollDiv.clientWidth;
    	$body[0].removeChild(scrollDiv);


	// disabling BodyScroll
	$html.css('overflow', 'hidden');
	$body.css('overflow', 'hidden');
	if (isOverflowing) {$html.css('padding-right', scrollbarWidth);$body.css('padding-right', scrollbarWidth);}
}



function enableBodyScroll () {
	// enabling BodyScroll
	$('html').css({ 'overflow': '', 'padding-right': '' });
	$('body').css({ 'overflow': '', 'padding-right': '' });
}



/**
 *
 * DROPDOWN
 *
 */
 var dropdownOpened = false;
 function dropdown (el) {
 	if ($(el).length !== 0) {
 		$(el).click(function (e) {
 			e.preventDefault();

 			var target = $(this),
 			caret = getIcon(target),
 			targetID = target.attr('data-target'),
 			element = $('body').find(targetID);
 			var coords, navFix;

 			if(!$(target).hasAttr('data-target') || target.attr('data-target') == "" ) {
				//target didn't have DATA-TARGET attribute or it is EMPTY, so i'm doing nothing!
				return;
			}

			function stoplistener() {
				$(window).off('scroll.dropdown');
				$(document).off('keyup.dropdown');
				$(element).off('clickoutside.dropdown');
			}

			function closeDropdown() {
				caret.removeClass('ti-angle-up').addClass('ti-angle-down');
				element.hide();
				dropdownOpened = false;
				stoplistener();
			}

			function dropdownCSS() {

				navFix = (target.closest('.position-fix').length !== 0);

				if (navFix) {
					element.css({position: 'fixed', zIndex: '550' });
					coords = target.position();
				}else{
					element.css({position: 'absolute' });
					coords = target.offset();
				}


				var left, pageWidth = $('body').width();
				if (e.pageX > pageWidth/2) {
					left = (e.pageX - element.outerWidth()+20);
					element.find('.dropdown-content').addClass('edge');
				}else{
					element.find('.dropdown-content').removeClass('edge');
					left = coords.left;
				}
				var top = coords.top + target.outerHeight() + 4;
				element.css({top: top + 'px', left: left + 'px' });
			}


			if (dropdownOpened) {
				closeDropdown();
			}else{
				caret.removeClass('ti-angle-down').addClass('ti-angle-up');
				element.show();
				dropdownCSS();


				// in another js file, far, far away
				$(window).on('scroll', function() {
					dropdownCSS();
				});

				dropdownOpened = true;
			}

			$(document).on('keyup.dropdown', function() {
				if (e.keyCode === 27) {
					closeDropdown();
				}
			});

			$(element).bind('clickoutside', function () {
				closeDropdown();
			});

			e.stopPropagation();
		});
 	}
 	return;
 }








/**
 *
 * stickyHeader
 *
 */
 function stickyHeader(selector) {
 	if ($(selector).length !== 0) {
 		var element = $(selector),
 		offsetTop = element.offset().top;
 		$(window).scroll(function() {
 			if ($(window).scrollTop() > offsetTop){
 				element.css('top', '0');
 				element.addClass('position-fix');
 			}else{
 				element.css('top', offsetTop+'px');
 				element.removeClass('position-fix');
 			}
 		});
 	}
 	return;
 }








/**
 *
 * modal
 *
 */
 function modal(selector) {
 	if ($(selector).length !== 0) {
 		$(selector).click(function (e) {
 			e.preventDefault();
 			if(!$(this).hasAttr('data-target') || $(this).attr('data-target') == "" ) {
				//target didn't have DATA-TARGET attribute or it is EMPTY, so i'm doing nothing!
				return;
			}

			var overlay = $('#modal-overlay'), modalWrapper, targetID, target, modal, header, close, body;
			if (overlay.length == 0)
			{
				overlay = $('<div id="modal-overlay"></div>').addClass('display-none');
				$('body').prepend(overlay);
			}
			overlay.addClass('overlay');
			targetID = $(this).attr('data-target');
			target = $('body').find(targetID);

			modal = target.find('.modal');
			header = target.find('.modal-header');
			close = target.find('.close');
			body = target.find('.modal-body');
			modalWrapper = target.find('.modal-wrapper>div');

			overlay.fadeIn('fast');
			target.removeClass('display-none');
			target.addClass('modal-opened');
			disableBodyScroll();




			function modalCSS () {
				if ($(window).width() > 868) {
					modal.css({
						'width' : '738px ',
						'maxWidth': ' 46.13rem'
					});
				}else{
					modal.css({
						'width' : '90%'
					});
				}
				modal.css({
					'marginTop': '3%',
					'marginBottom': '3%'
				});
				modal.addClass('opening');
			}
			modalCSS();


			$(window).resize(function () {
				modalCSS();
			});

			function stoplistener() {
				close.off('click.modal');
				$(document).off('keyup.modal');
				target.off('click.modal');
				$(window).off('resize.modal');
			}

			function modalClose() {
				if (target.hasClass('modal-opened')) {
					modal.addClass('closing');
					overlay.fadeOut('300');
					enableBodyScroll();
					stoplistener();
					setTimeout(function() {
						modal.removeClass('opening');
						target.removeClass('modal-opened');
						target.addClass('display-none');
						modal.removeClass('closing');
					}, 600);
				}
			}

			close.on('click.modal', function (e) {
				e.preventDefault();
				modalClose();
			});

			$(document).on('keyup.modal', function (e) {
				if (e.keyCode === 27) {
					modalClose();
				}
			});

			$(modalWrapper).click(function (e) {
				if (e.target.className === "" && e.target.nodeName === "DIV") {
					modalClose();
				}
			});

		});
 	}
 	return;
 }






 function tooltip(selector) {
 	if ($(selector).length !== 0) {
 		var tooltip_container = $('#tooltip_container');
 		if (tooltip_container.length == 0)
 		{
 			tooltip_container = $('<div id="tooltip_container"></div>').addClass('display-none');
 			$('body').prepend(tooltip_container);
 		}

 		$(selector).mouseover(function (e) {

 			tooltip_container.html( $(this).attr('data-tip-text') );

 			tooltip_container.fadeIn('400');
 			var tooltipWidth = tooltip_container.outerWidth(),
 			tooltipHeight = tooltip_container.outerHeight();

 			var pageWidth = $('body').width();



 			if (e.pageX > pageWidth/2) {
 				tooltip_container.css('left',  (e.pageX - tooltipWidth+25)+'px' );
 			}else{
 				tooltip_container.css('left', (e.pageX-25) + 'px');
 			}

 			var coords = $(this).offset();

 			if (e.pageY > 200	) {
 				tooltip_container.css('top', (coords.top-(tooltipHeight+15)) + 'px');
 			}else{
 				tooltip_container.css('top', (coords.top+28) + 'px');
 			}

 		}).mouseout(function () {
 			tooltip_container.fadeOut('400');
 		});
 	}
 	return;
 }






 function tabs (selector) {
 	if ($(selector).length !== 0) {
 		var presenter, tabsContainer = $(selector);
 		var tabName = tabsContainer.find('.tab-name');

 		function HTMLpresenter() {
 			if (tabsContainer.find('.tab-text').length) {
 				presenter = tabsContainer.find('.tab-text');
 			}else{
 				$(selector).append("<div class='tab-text'>");
 				presenter = tabsContainer.find('.tab-text');
 			}
 		}

 		HTMLpresenter();

 		tabsContainer.find('.tab-content').hide();
 		tabName.first().addClass('active');

 		presenter.html(tabName.nextAll(".tab-content").first().html());

 		tabName.click(function(e) {

 			tabName.removeClass('active');
 			$(this).addClass('active');
 			e.preventDefault();

 			var tabContent = $(this).nextAll(".tab-content").first().html();
 			presenter.html(tabContent);

 		});
 	}
 	return;
 }






 function togglebox(selector) {
 	if ($(selector).length !== 0) {
 		var toggler = $(selector).find('.collapse-toggle');
 		var hider =  $(selector).find(".collapse-box");
 		hider.hide();

 		toggler.click(function(e) {
 			e.preventDefault();
 			var caret =  getIcon(toggler);

 			var collapsebox =  $(this).nextAll(".collapse-box").first();
 			collapsebox.slideToggle('fast', function() {
 				if (caret) {
 					if($(this).is(':hidden')) {
 						caret.removeClass('ti-angle-up').addClass('ti-angle-down');
 					}
 					else {
 						caret.removeClass('ti-angle-down').addClass('ti-angle-up');
 					}
 				}
 			});
 		});
 	}
 	return;
 }
