(function($){
	$(function() {
		FastClick.attach(document.body)

		var $window = $(window)
		var $html = $('html')
		var $body = $('body')

		var History = window.History

		// set toggle menu action
		$('.control-toggle, .icon-toggle').on('click', function(){
			$body.toggleClass('open-menu')
		})

		$body.addClass('loaded')

		// sort list elements
		var setSorted = function(){
			var inverse = false
			$(document).on('click', '[data-sort]', function(){
				var handle = $(this).data('sort')
				var $container = $('.list .container')
				var $articles = []
				var $objs = $.map($('.list article'), function(val){
					var name = $(val).find('[data-'+handle+']').data('time') || $.trim($(val).find('[data-'+handle+']').text())
					$articles.push({ article: val, name: name })
					return name
				})
				$objs.sort()
				if(inverse) $objs.reverse()
				$('.list article').remove()
				$.each($objs, function(i,b){
					$.each($articles, function(k,a){
						if(a && a.name && a.name===b) {
							$container.append(a.article)
							$articles.splice(k, 1)
						}
					})
				})
				inverse = !inverse
			})
		}
		setSorted()

		// init allery prompt
		var setPost = function(){

			var $th
			$('#media-text img').each(function(){
				$th = $(this)
				if(!$th.parents('a').length){
					$th.wrap('<a href="'+$th.attr('src')+'" target="_blank"></a>')
				}
			})

			$('#media-text a img, a.main-img').each(function(){
				$(this).parents('a').addClass('gallery')
			})

			var $plus = $('.plus-sign')

			$('a.gallery').mouseenter(function(e){
				$plus.show()
			}).mouseleave(function(e){
				$plus.hide()
			}).mousemove(function(e){
				$plus.css({ top:e.pageY, left:e.pageX })
			})

			$('#media-text iframe').each(function(){
				$(this).wrap('<div class="iframe-wrap"></div>')
			})

			$('a.gallery').magnificPopup({
				type: 'image',
				tLoading: '',
				closeBtnInside: false,
				closeOnBgClick: true,
				overflowY: 'scroll',
				mainClass: 'mfp-fade',
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1],
					arrowMarkup: '<div class="mfp-arrow mfp-arrow-%dir%"></div>',
					tPrev: '', // title for left button
					tNext: '', // title for right button
					tCounter: '' // '<span class="mfp-counter">%curr% / %total%</span>'
				},
				image: {
					tError: '<a href="%url%">image #%curr%</a> could not be loaded.',
					titleSrc: 'caption'
				}
			})
		}
		setPost()

		// ajax add to cart action
		var addToCart = function($form){
			$form.addClass('loading')
			$.ajax ({
				url: themeAjax.ajax_url,
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'add_to_cart_single',
					nonce: themeAjax.nonce,
					product_id: $form.data('product_id'),
					variation_id: $('input[name="variation_id"]').val(),
					quantity: $('input[name="quantity"]').val(),
				},
				success:function(data) {
					$form.removeClass('loading')
					$('.cart-count').html(data.html)
					$('.added-msg, .single_checkout_button').show()
					$('#basket-link').toggleClass('has-prds', data.count)
					setTimeout(function () {
						$('.added-msg').hide()
					}, 3000)
				}
			})
		}

		// set single product actions
		var setProduct = function(){
			$(document).on('click', '.single_add_to_cart_button', function(e) {
				e.preventDefault()
				addToCart($(this).parents('form'))
			})
			$('.product form.cart').submit(function(e) {
				e.preventDefault()
				addToCart($(this))
			})
		}
		setProduct()

		// ajax add to change quantity
		var changeQuantity = function(key, qnt){
			$.ajax ({
				url: themeAjax.ajax_url,
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'change_quantity',
					nonce: themeAjax.nonce,
					cart_item_key: key,
					quantity: qnt,
				},
				success:function(data) {
					if(!data.count){
						window.location.href = $('a.invisible-link').attr('href')
						return
					}
					$('.cart-count').html(data.html)
					$('#basket-link').toggleClass('has-prds', data.count)
					$body.trigger('update_checkout')
				}
			})
		}

		// set checkout actions
		var setCheckout = function(){
			$(document).on('click', '.actions .plus', function(e) {
				var $btn = $(this).parents('.btns')
				changeQuantity($btn.data('id'), ($btn.data('qnt')|0)+1)
			})
			$(document).on('click', '.actions .minus', function(e) {
				var $btn = $(this).parents('.btns')
				changeQuantity($btn.data('id'), ($btn.data('qnt')|0)-1)
			})
			$(document).on('click', '.actions .dlt', function(e) {
				changeQuantity($(this).data('id'), 0)
			})
		}
		setCheckout()

		return
		// Check to see if History.js is enabled for our Browser
		if (!History.enabled ) return false

		// IE fix
		if (!window.location.origin) {
			window.location.origin = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port: '')
		}

		var root_url = window.location.origin,
			content_selector = '#ajax-content',
			$content = $(content_selector),
			content_node = $content.get(0)

		// Ensure Content
		if ( $content.length === 0 ) $content = $body;

		// Internal Helper
		$.expr[':'].internal = function(obj, index, meta, stack){
			// Prepare
			var
				$this = $(obj),
				url = $this.attr('href')||'',
				isInternalLink
			// Check link
			isInternalLink = url.substring(0,root_url.length) === root_url || url.indexOf(':') === -1
			// Ignore or Keep
			return isInternalLink
		}

		// HTML Helper
		var documentHtml = function(html){
			// Prepare
			var result = String(html).replace(/<\!DOCTYPE[^>]*>/i, '')
									 .replace(/<(html|head|body|title|script)([\s\>])/gi,'<div id="document-$1"$2')
									 .replace(/<\/(html|head|body|title|script)\>/gi,'</div>');
			// Return
			return result;
		};

		// Ajaxify Helper
		$.fn.ajaxify = function(){
			// Prepare
			var $this = $(this)

			// Ajaxify
			$this.find('a:internal:not(.no-ajax,[href^="#"],[href*="wp-login"],[href*="wp-admin"])').on('click', function(event){
				// Prepare
				var
					$this	= $(this),
					url		= $this.attr('href'),
					title 	= $this.attr('title') || null

				// Continue as normal for cmd clicks etc
				if ( event.which == 2 || event.metaKey ) return true

				// Ajaxify this link
				History.pushState(null,title,url)
				event.preventDefault()
				return false
			})
			// Chain
			return $this
		}

		// Ajaxify our Internal Links
		$body.ajaxify()


		// Hook into State Changes
		$(window).bind('statechange',function(){
			// Prepare Variables
			var
			State 		= History.getState(),
			url			= State.url,
			relativeUrl = url.replace(root_url,'');

			// Set Loading
			$body.addClass('loading');

			// Ajax Request the Traditional Page
			$.ajax({
				url: url,
				success: function(data, textStatus, jqXHR){
					// Prepare
					var
						$data 			= $(documentHtml(data)),
						$dataBody		= $data.find('#document-body:first ' + content_selector),
						bodyClasses 	= $data.find('#document-body:first').attr('class'),
						contentHtml, $scripts;

					console.log($dataBody);


					// var $menu_list = $data.find('.' + aws_data['mcdc']);

					// //Add classes to body
					// jQuery('body').attr('class', bodyClasses);

					// // Fetch the scripts
					// $scripts = $dataBody.find('#document-script');
					// if ( $scripts.length ) $scripts.detach();

					// // Fetch the content
					// contentHtml = $dataBody.html()||$data.html();

					// if ( !contentHtml ) {
					// 	document.location.href = url;
					// 	return false;
					// }

					// // Update the content
					// $content.stop(true,true);
					// $content.html(contentHtml)
					// 		.ajaxify()
					// 		.css('text-align', '')
					// 		.animate({opacity: 1, visibility: "visible"});

					// //Scroll to the top of ajax container
					// if ( '' != aws_data['scrollTop'] ) {
					// 	jQuery('html, body').animate({
					// 				scrollTop: jQuery(content_selector).offset().top
					// 				}, 1000);
					// }

					// $body.ajaxify();

					// // Update the title
					// document.title = $data.find('#document-title:first').text();
					// try {
					// 	document.getElementsByTagName('title')[0].innerHTML = document.title.replace('<','&lt;')
					// 																		.replace('>','&gt;')
					// 																		.replace(' & ',' &amp; ');
					// }
					// catch ( Exception ) { }

					// // Add the scripts
					// $scripts.each(function(){
					// 	var scriptText = $(this).html();

					// 	if ( '' != scriptText ) {
					// 		scriptNode = document.createElement('script');
					// 		scriptNode.appendChild(document.createTextNode(scriptText));
					// 		content_node.appendChild(scriptNode);
					// 	} else {
					// 		$.getScript( $(this).attr('src') );
					// 	}
					// });

					// $body.removeClass('loading');

					// // Inform Google Analytics of the change
					// if ( typeof window.pageTracker !== 'undefined' ) window.pageTracker._trackPageview(relativeUrl);
				},
				error: function(jqXHR, textStatus, errorThrown){
					document.location.href = url;
					return false;
				}

			}); // end ajax

		}); // end onStateChange

	})
})(jQuery)