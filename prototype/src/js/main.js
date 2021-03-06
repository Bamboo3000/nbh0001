'use strict';

(function($) {
	$.each(['show', 'hide'], function(i, ev) {
		var el = $.fn[ev];
		$.fn[ev] = function() {
			this.trigger(ev);
			return el.apply(this, arguments);
		};
	});
})(jQuery);

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
}

var freezeVp = function(e) {
    e.preventDefault();
};

function stopBodyScrolling (bool) {
    if (bool === true) {
        document.body.addEventListener("touchmove", freezeVp, false);
    } else {
        document.body.removeEventListener("touchmove", freezeVp, false);
    }
}

/**
 * Parse url
 */
function urlParser($url)
{	
	var parser = document.createElement('a');
	parser.href = $url;

	var $result = parser.hostname;

	return $result;
}

function slideTo(el)
{
	$('html, body').animate({
		scrollTop: $(el).offset().top-60
	}, 500);
}

function menuScroll()
{
	var $nav = $('.main-navigation');
	var $scroll = $(window).scrollTop();
	if($scroll >= 200) {
		if(!$nav.hasClass('scrolled')) {
			$nav.addClass('scrolled');
		}
	} else {
		if($nav.hasClass('scrolled')) {
			$nav.removeClass('scrolled');
		}
	}
}

function menuOpen(el)
{
	if($(el).hasClass('opened')) {
		$('.main-menu-container').removeClass('opened');
		$(el).removeClass('opened');
		$(el).find('i').removeClass().addClass('fas fa-bars');
		$('#wrapper').removeClass('menuOpened');
	} else {
		$(el).find('i').removeClass().addClass('fas fa-times');
		$(el).addClass('opened');
		$('.main-menu-container').addClass('opened');
		$('#wrapper').addClass('menuOpened');
	}
}

function lazyImages()
{

	$('.lazyset').each(function() {
		if($(this).visible( true ) && !$(this).hasClass('loaded-set')) {
			$(this).attr('srcset', $(this).data('srcset')).removeAttr('data-srcset').addClass('loaded-set');
		}
	});
	$('.lazy').each(function() {
		if($(this).visible( true ) && !$(this).hasClass('loaded')) {
			$(this).attr('src', $(this).data('src')).removeAttr('data-src').addClass('loaded');
		}	
	});
	
	$(window).on('scroll', function() {
	
		$('.lazyset').each(function() {
			if($(this).visible( true ) && !$(this).hasClass('loaded-set')) {
				$(this).attr('srcset', $(this).data('srcset')).removeAttr('data-srcset').addClass('loaded-set');
			}
		});
		$('.lazy').each(function() {
			if($(this).visible( true ) && !$(this).hasClass('loaded')) {
				$(this).attr('src', $(this).data('src')).removeAttr('data-src').addClass('loaded');
			}	
		});

	});

}

function plusOne($el)
{
	var $input = $($el).parent().find('input[type="number"]');
	var maxVal = $input.attr('max');
	var newVal = parseInt($input.val(), 10) + 1;
	if(newVal <= maxVal) {
		$input.val(newVal);
	}
}

function minusOne($el)
{
	var $input = $($el).parent().find('input[type="number"]');
	var newVal = parseInt($input.val(), 10) - 1;
	if(newVal > 0) {
		$input.val(newVal);
	}
}

function selectChange()
{
	if($(document).find('.select > select').prop('selectedIndex') > 0){
		$(document).find('.select > select').prev('label').css({'top' : '-1.75em', 'left' : 0});
	}
	$(document).on('change', '.select > select', function() {
		if($(this).prop('selectedIndex') > 0) {
			$(this).prev('label').css({'top' : '-1.75em', 'left' : 0});
		} else {
			$(this).prev('label').css({'top' : '8px', 'left' : '22px'})
		}
		if($(document).find('input[name="quantity"]').attr('max') == 1) {
			$(document).find('input[name="quantity"]').parent().parent().css({'display' : 'none'});
		} else {
			$(document).find('input[name="quantity"]').parent().parent().css({'display' : 'block'});
		}
	});
}

function hideQty() 
{
	if($(document).find('input[name="quantity"]').attr('max') == 1) {
		$(document).find('input[name="quantity"]').parent().parent().css({'display' : 'none'});
	}
	$(document).on('change', 'input[name="quantity"]', function() {
		if($(this).attr('max') == 1) {
			$(this).parent().parent().css({'display' : 'none'});
		} else {
			$(this).parent().parent().css({'display' : 'block'});
		}
	});
}

// function zoomImage(el)
// {
// 	$('.products__single-modal').find('.modal-body').empty().html('<img src="'+$(el).data("zoom")+'" class="bg-cover"/>');
// }

function centerZoom()
{
	var $img;
	$('.products__single-modal').on('show.bs.modal', function(el) {
		$img = ($(el['relatedTarget']).data('zoom'));
		$('.products__single-modal').find('.modal-body[data-zoom="'+$img+'"]').addClass('visible');
	});
	$('.products__single-modal').on('hidden.bs.modal', function(el) {
		$('.products__single-modal').find('.modal-body[data-zoom="'+$img+'"]').removeClass('visible');
	});
	$('.products__single-modal').on('shown.bs.modal', function() {
		$(this).find('.modal-body').animate({
			scrollTop: ($(this).find('img').height() - $(this).find('.modal-body').height()) / 2,
			scrollLeft: ($(this).find('img').width() - $(this).find('.modal-body').width()) / 2
		}, 200);
		$(window).on('resize', function() {
			$('.products__single-modal').find('.modal-body').animate({
				scrollTop: ($('.products__single-modal').find('img').height() - $('.products__single-modal').find('.modal-body').height()) / 2,
				scrollLeft: ($('.products__single-modal').find('img').width() - $('.products__single-modal').find('.modal-body').width()) / 2
			}, 200);
		});
	});
}

function searchOpen()
{
	$('.searchOpen').on('click', function(e) {
		e.preventDefault();
		$(this).css({'display' : 'none'});
		$('.loginLink').css({'display' : 'none'});
		$('.main-navigation__search').css({'display' : 'block'}).find('input.dgwt-wcas-search-input').focus();
	});
	// $('input.dgwt-wcas-search-input').on('focusout blur', function() {
	// 	$('.loginLink').css({'display' : 'block'});
	// 	$('.main-navigation__search').css({'display' : 'none'});
	// 	$('.searchOpen').css({'display' : 'block'});
	// });
}

$(document).ready(function() {

	if($('.products__single-modal')) {
		centerZoom();
	}
	selectChange();
	hideQty();
	searchOpen();
	menuScroll();
	
	$('#wrapper').on('click', function() {
		if($('#wrapper').hasClass('menuOpened')) {
			menuOpen('#menuOpen');
		}
	});

	jQuery( document.body ).on( 'updated_checkout', function(){
		//console.log('cos');
		$('.form-row.mailchimp-newsletter').addClass('pretty p-default p-thick p-pulse').find('label').wrap('<div class="state p-warning-o"></div>');
	});

	if( !getCookie('newsletter-coupon') ) {
		if( getUrlParameter('already') ) {
			setCookie('newsletter-coupon', getUrlParameter('already'), 365);
			$('#already-modal-newsletter').modal('show');
		} else if( getUrlParameter('code') ) {
			setCookie('newsletter-coupon', getUrlParameter('code'), 365);
			$('#code-modal-newsletter').modal('show');
		} else {
			setTimeout(function() {
				$('#open-modal-newsletter').modal('show');
				setCookie('newsletter-coupon', 'showed', 1);
			}, 5000);
		}
	}

});

$(window).on('load', function() {

	lazyImages();

	$('.form-row.mailchimp-newsletter').addClass('pretty p-default p-thick p-pulse').find('label').wrap('<div class="state p-warning-o"></div>');

	setTimeout(function() {
		window.fbAsyncInit = function() {
			FB.init({
				xfbml            : true,
				version          : 'v6.0'
			});
		};
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = 'https://connect.facebook.net/pl_PL/sdk/xfbml.customerchat.js';
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	}, 5000);

});

$(window).on('scroll', function() {
	menuScroll();
});

// $(window).on('load resize', function() {

// 	if($(window).width() <= 767) {
// 		var $width = $('tr.cart-subtotal').find('td').outerWidth();
// 		$('tr.woocommerce-shipping-totals.shipping').css({'margin-right' : '-'+$width});
// 	}

// });