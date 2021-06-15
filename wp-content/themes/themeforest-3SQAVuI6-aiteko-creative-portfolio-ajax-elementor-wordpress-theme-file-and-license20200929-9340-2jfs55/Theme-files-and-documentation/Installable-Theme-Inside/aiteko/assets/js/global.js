/*jshint esversion: 6 */
window.aiteko = window.aiteko || {};

jQuery.cachedScript = function( url, successCallback, options ) {
  "use strict";
  options = jQuery.extend( options || {}, {
    dataType: "script",
    cache: true,
    url: url,
    success: ( typeof successCallback === 'function' ? successCallback : '' )
  });
  return jQuery.ajax( options );
};

(function(a){(jQuery.browser=jQuery.browser||{}).mobile=/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))})(navigator.userAgent||navigator.vendor||window.opera);

if (!String.prototype.includes) {
    String.prototype.includes = function(search, start) {
      if (typeof start !== 'number') {
        start = 0;
      }

      if (start + search.length > this.length) {
        return false;
      } else {
        return this.indexOf(search, start) !== -1;
      }
    };
}
  
function _instanceof(left, right) { if (right != null && typeof Symbol !== "undefined" && right[Symbol.hasInstance]) { return right[Symbol.hasInstance](left); } else { return left instanceof right; } }

function _classCallCheck(instance, Constructor) { if (!_instanceof(instance, Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var Pixishowanimation =
/*#__PURE__*/
function () {
  function Pixishowanimation(el) {
    "use strict";

    _classCallCheck(this, Pixishowanimation);

    this.el = el;
    this.ID = el.id;
    this.buildCanvas();
  }

  _createClass(Pixishowanimation, [{
    key: "buildCanvas",
    value: function buildCanvas() {
      var that = this,
          imgURL = jQuery(that.el).find('img').data('render'),
          idCaller = 'aiteko' + that.ID;
      PIXI.utils.skipHello();

      if (this.renderer) {
        this.renderer.destroy(true);
      }

      this.renderer = new PIXI.autoDetectRenderer(jQuery(that.el).find('.portfolio-thumbnail-link').width(), jQuery(that.el).find('.portfolio-thumbnail-link').height(), {
        transparent: true,
        autoResize: true
      });

      if (_instanceof(this.renderer, PIXI.WebGLRenderer)) {
        this.renderer.reset();
      }

      jQuery(that.el).find('img').css({
        opacity: 0
      });
      this.stage = new PIXI.Container();
      this.slidesContainer = new PIXI.Container();
      this.displacementSprite = new PIXI.Sprite.fromImage(imgURL);
      this.displacementFilter = new PIXI.filters.DisplacementFilter(that.displacementSprite);
      jQuery(that.el).find('.portfolio-thumbnail-link').append(that.renderer.view);
      this.stage.addChild(that.slidesContainer);
      this.stage.interactive = true;
      this.renderer.view.style.position = 'absolute';
      this.renderer.view.style.maxWidth = '100%';
      this.renderer.view.style.width = '100%';
      this.renderer.view.style.height = '100%';
      this.renderer.view.style.zIndex = '-1';
      this.renderer.view.style.top = '50%';
      this.renderer.view.style.left = '50%';
      this.renderer.view.style.webkitTransform = 'translate( -50%, -50% )';
      this.renderer.view.style.transform = 'translate( -50%, -50% )';
      this.displacementSprite.texture.baseTexture.wrapMode = PIXI.WRAP_MODES.REPEAT;
      this.stage.filters = [that.displacementFilter];
      this.displacementSprite.scale.x = 5;
      this.displacementSprite.scale.y = 5;
      this.stage.addChild(that.displacementSprite);
      this.itexture = new PIXI.Texture.fromImage(jQuery(that.el).find('img').attr('src'));
      this.nimage = new PIXI.Sprite(that.itexture);
      this.nimage.width = this.renderer.width;
      this.nimage.height = this.renderer.height; //hide

      this.slidesContainer.alpha = 0;
      this.displacementFilter.scale.alpha = 0;
      this.displacementFilter.scale.x = 900;
      this.displacementFilter.scale.y = 450;
      this.slidesContainer.addChild(that.nimage);
      this.iRender = new PIXI.ticker.Ticker();
      this.iRender.autoStart = true;
      this.iRender.add(function (delta) {
        if (that.renderer) {
          that.renderer.render(that.stage);
        }
      });
      this.status = 'ready';
      that.showit();
    }
  }, {
    key: "showit",
    value: function showit() {
      var that = this;
      this.baseTimeline = new anime.timeline({
        loop: false,
        autoplay: true,
        complete: function complete() {
          that.status = 'done';
          setTimeout(function () {
            that.displacementFilter.scale.alpha = 0;
            that.slidesContainer.alpha = 0;
            that.stage.filters = null;

            that.__destroy();

            jQuery(that.el).find('canvas').remove();
            jQuery(that.el).find('img').css({
              opacity: 1
            });
          }, 50);
        }
      });
      this.status = 'will animate';
      this.baseTimeline.add({
        targets: that.displacementFilter.scale,
        duration: 1000,
        alpha: 1,
        x: 0,
        y: 0,
        easing: 'easeInOutCirc'
      }).add({
        targets: that.slidesContainer,
        duration: 1000,
        alpha: 1,
        offset: '-=1000',
        easing: 'easeInOutCirc'
      });
    }
  }, {
    key: "__destroy",
    value: function __destroy() {
      this.iRender.remove();
      this.baseTimeline = this.slidesContainer = this.displacementSprite = this.displacementFilter = this.itexture = this.nimage = null;
      this.renderer.destroy(true);
    }
  }]);

  return Pixishowanimation;
}();

window.aiteko = function($) {
	"use strict";
	var z = {
		$win: $(window),
		$doc: $(document),
		$body: $('body'),
		onAjaxProgress: false,
		ajaxEnabled: true,
		version: '1.3.0',
		init: function() {
			var t=this, container = document.getElementById('aiteko-master');
			t.masonpost = false;
			t.masonproject = false;
			t.blogShowUp = false;
			t.projectShowUp = false;
			t.popStateProcess = false;
			t.hashChange = false;
			t.initialLoaded = true;
			t.nextElemInit = false;

			// Version 1.1.0
			// Checking ajax feature
			t.ajaxEnabled = $('html').hasClass('aiteko-ajax-enabled') ? true : false;

			t.origSideWidth = $('.aiteko-main').offset().left-($('.aiteko-side-handler').width()+1);
			t.lRotated = false;

			requestAnimationFrame(function() {
				t.smoothIt();
			});

			t.$doc.ready(function() {
				if (t.ajaxEnabled) {
					t.initialLoadHistory();
				}
				t.convertPaginations();
				t.mediaPlayerSkin();
				t.simplifyMenu();
			});

			t.ajaxEnabled && window.addEventListener('popstate', function(e){
				var evo = e;

				if ( evo.state === null || t.hashChange ) {
					e.preventDefault();
					// reset
					t.hashChange = false;
					return false;
				}
				t.popStateProcess = requestAnimationFrame( function() {
					t.popStateHandler(evo);
					if ( typeof ga === 'function' ) {
						ga('send','pageview',window.location.pathname);
					}
				});
			});

			t.$win.on('load', function() {
				t.showHideSide();
				t.searchHandle();
				t.socialBtn();
				t.simplifyMenu();

				$(document).on('click', 'a', function(e){
					var z=this;

					/** Version 1.2.2 - fix Elementor lightbox */
					if ( $(z).data('elementor-open-lightbox') === 'yes' || $(z).data('elementor-open-lightbox') === 'default' ) {
						window.setTimeout(function(){
							$('.swiper-container').each(function() {
								var nss = this.swiper;
								if ( typeof nss !== 'undefined' ) {
									nss.update();
								}
							});
						},500);
					}

					if ( z.href.indexOf('#') !== -1 ) {
						var ccid = z.hash.substring(1),
							realURL = z.href.substr(0,z.href.indexOf('#'));

						if ( ! ccid && ( z.pathname === window.location.pathname ) ) {
							return;
						}

						// Process haschange
						if (ccid && ( z.pathname === window.location.pathname ) ) {
							e.preventDefault();
							t.hashChangeHandler(z);
							return false;
						}
					}

					var new_tab = e.ctrlKey || e.metaKey;
					if ( $(z).attr('target') === '_blank' ) {
						new_tab = true;
					}

					if ( new_tab ) {
						return;
					}

					if ( t.ajaxEnabled && t.linkisLocal(z) ) {

						if ( t.onAjaxProgress ) {
							return false;
						}
						if ( $(z).parent('li').hasClass('menu-item') ) {
							$('.current-menu-item').removeClass('current-menu-item');
							$(z).parent('li').addClass('current-menu-item');
						}
						t.initialLoaded = false;
						t.elclick(e);
					}
				});
			});

			t.$win.on('aitekoDoneLoad', function() {
				t.endLoading();
			});

			t.$win.on('aitekoFinishLoad', function() {
				$('#aiteko-site-loader').detach();
				requestAnimationFrame( function(){
					t.menuShowUp();
					t.initAnim();
				});
			});

			t.$win.on('aitekoFinishBCP', function(){
				setTimeout( function() {
					requestAnimationFrame( function() {
						t.parallaxInit();
					});
				},100);
			});

			t.$win.on('aitekoAnimationLoaded', function() {
				var elem = document.querySelector('.aiteko-content-container'),
					wh = t.$win.height();

				$('.aiteko-content-container').scrollTop(0);
				t.onAjaxProgress = false;

				if ( t.popStateProcess ) {
					cancelAnimationFrame(t.popStateProcess);
					t.popStateProcess = !t.popStateProcess;
				}

				t.parallaxInit();
				t.setActiveMenu();
				t.commentBeauty();
				t.overflowDoit();

				setTimeout( function() {
					requestAnimationFrame( function(){
						t.updateParalax();
						t.elementorElems(0, wh);
						t.autoloadPosts(0, wh);
						t.miscFunctions();
						$('.aiteko-site-footer').css({opacity: 1});
					});
				},700);

				$('.aiteko-content-container').focus();

				if ( typeof wpcf7 !== 'undefined' ) {
					if ( typeof wpcf7.initForm !== 'function' ) {
						t.wpcf7Reinit();
					}
				}

				if ( t.initialLoaded && ! window.elementorFrontend ) {
					t.nextElemInit = true;
				}

				if( t.initialLoaded === false && window.elementorFrontend && $('.elementor').length ) {
					if ( typeof $.fn.slick !== 'undefined' ) {
						$('.elementor-image-carousel').each(function(){
							if ( $(this).hasClass('slick-initialized') ) {
								$(this).slick('unslick');
							}
						});
					}
					
					window.setTimeout(function(){
						t.$win.trigger( 'elementor/frontend/init' );
						window.elementorFrontend.init();	
					}, 25);
				}

				/** version 1.1.8 - hash check */
				if ( window.location.hash ) {
					var nh = window.location.hash.substring(1);

					// reset
					$(window).scrollTop(0);
					$('html, body').scrollTop(0);

					if ( nh !== "" && $('#'+nh).length > 0 ) {
						$('html, body').animate({ scrollTop : Math.round($('#'+nh).offset().top)-100 }, 600 );
					}
				}

				if ( $(window).scrollTop() > 0 ) {
					$(window).trigger('scroll');
				}

			});

			t.$win.on('resize', function() {
				t.origSideWidth = $('.aiteko-main').offset().left-($('.aiteko-side-handler').width()+1);
				
				if ( t.lRotated ) {
					$('.aiteko-side .brand').removeAttr('style');
					t.rotateLogo();
				}
			});

			t.$win.on('ElemPortoAdded', function() {
				t.elProjectGrids();
			});
		},

		/**
		 * @since 1.3.0
		 * Experimental
		 */
		wipeElementor: function() {
			var t=this;

			if ( typeof elementorFrontend !== 'undefined' ) {	
				for(var key in elementorFrontend) {
					delete elementorFrontend[key];
				}

				delete window.elementorFrontend;
			}
		},

		hashChangeHandler: function( el ) {
			var t=this,
				elem = document.querySelector('.aiteko-content-container');

			var ccid = el.hash.substring(1);
			if ( ccid !== "" ) {
				var btn=$('.aiteko-hamburger__menu');

				if ( btn.hasClass('is-active') ) {
					btn.trigger( 'click' );
					window.setTimeout(function() {
						$('html, body').animate({ scrollTop : Math.round($('#'+ccid).offset().top)-100 }, 600, function() {
							window.location.hash = '#'+ccid;
						});
					}, 1500);
				} else {
					//window.scrollTo(0, Math.round($('#'+ccid).offset().top)-100 );
					$('html, body').animate({ scrollTop : Math.round($('#'+ccid).offset().top)-100 }, 600 );
				}
			}
		},

		popStateHandler: function(e) {
			var t=this, elementorFrontendDetected = false, cT = 0;

			t.popStateProcess = true;
			$('title').html( e.state.doc_title );
		
			if ( $('html').hasClass('side-bind') ) {
				$('.aiteko-hamburger__menu').trigger('click');
			}

			$('.animated').removeClass('animated');	
			t.preChangePage(cT);
			window.setTimeout(function(){
				t.beforeChangePage(cT);
			}, 800);

			$(window).one('aitekoDoneBCP', function(){
				$(window).scrollTop(0);
				if ( typeof e.state.elementor_css !== 'undefined' ) {
					var _css = e.state.elementor_css;
					$('link[id*="elementor-post"]').remove();
					for (var _id in _css) {
						if (_css.hasOwnProperty(_id)) {
							if ( $('#'+_id).length < 1 ) {
								$('head').append($('<link rel="stylesheet" type="text/css" media="all" id="'+_id+'" href="'+_css[_id]+'" />'));
							}
						}
					}
				}

				$('.aitekoJsInlineCSS').detach();
				$('style').detach();
				if ( typeof e.state.inline_css !== 'undefined' ) {
					var c = document.createDocumentFragment(),
						sty = document.createElement('style');

					c.appendChild(sty);
					sty.className = 'aitekoJsInlineCSS';
					sty.innerHTML = e.state.inline_css;
					document.head.appendChild(c);
				}

				$('#main').find('iframe').remove();
				$('.elementor-lightbox').detach().remove();
				$('#elementor-device-mode').detach().remove();
				$('body').attr('class', e.state.body_classes );
				$('#main').removeAttr('style').html(e.state.main_content);
				$(document).add('*').off();

				t.convertPaginations();

				if ( typeof e.state.embeded_scripts !== 'undefined' ) {
					var _js = e.state.embeded_scripts, scriptDiv = $("<div id='aiteko-mo-script' />");
					
					if ( $('#aiteko-mo-script').length < 1 ) {
						$('body').append($(scriptDiv));
						$('#aiteko-mo-script').css({width:0,height:0,overflow:'hidden'});
					} else {
						$('#aiteko-mo-script').html('');
					}

					/**$('script[type="text/javascript"]').each(function() {
						var js__src = ( typeof $(this).attr('src') !== 'undefined' ? $(this).attr('src') : '' );
						if ( js__src.includes('/js/jquery/jquery.js') === false && js__src.includes('/js/jquery/jquery-migrate.min.js') === false &&  js__src.includes('/aiteko/assets/js/anime.min.js') === false &&  js__src.includes('/aiteko/assets/js/global.js') === false && js__src.includes('pace.min.js') === false && js__src.includes('slick.min.js') === false && js__src.includes('/elementor/assets/js/frontend.min.js') === true && js__src.includes('/elementor/assets/js/frontend-modules.min.js') === true ) {
							$(this).remove();
						}
					});*/

					for( var _jsidcheck in _js ) {
						if ( _js.hasOwnProperty(_jsidcheck) && _jsidcheck.includes('content_') === false ) {
							if ( $('script[src="'+_js[_jsidcheck]+'"]').length < 1 ) {
								if ( _js[_jsidcheck].includes('elementor/assets/js/frontend.min.js') === true || _js[_jsidcheck].includes('elementor-pro/assets/js/frontend.min.js') === true ) {
									elementorFrontendDetected = true;
								}
							}
						}
					}

					for( var _jsid in _js ) {
						if (_js.hasOwnProperty(_jsid)) {
							if ( _jsid.includes('content_') !== false ) {
								if ( _js[_jsid].includes('aitekoRender') === false ) {
									var jscontent = _js[_jsid];
									jscontent = $.trim(jscontent);
									jscontent = jscontent.replace('jQuery(document).ready', 'jQuery(window).load');
									jscontent = jscontent.replace('$(document).ready', 'jQuery(window).load');
									var x = '<script type="text/javascript">'+jscontent+'</script>';
									$('#aiteko-mo-script').append( $(x) );
								}
							} else {
								if ( $('script[src="'+_js[_jsid]+'"]').length < 1 ) {
									
									if ( _js[_jsid].includes('/elementor-pro/assets/js/frontend.min.js') ) {
										
										if ( typeof elementorProFrontend !== 'undefined' ) {	
											for(var key in elementorProFrontend) {
												delete elementorProFrontend[key];
											}

											delete window.elementorProFrontend;
										}
										$.cachedScript( _js[_jsid] );

									} else {
										$.cachedScript( _js[_jsid] );
									}
								}
							}
						}
					}
				}

				if ( elementorFrontendDetected ) {
					jQuery(window).off('elementor/frontend/init');
				}

				window.setTimeout(function() {
					t.initialLoaded = false;
					$(window).trigger("aitekoFinishBCP");
					$(window).trigger("load");
					requestAnimationFrame( function() { t.initAnim(); });
				}, 10);
				
			});
		},

		linkisLocal: function(el) {
			var t=this;
			if( window.location.hostname === el.hostname || !el.hostname.length ) {
				if ( t.linkDeniedUseAjax(el) ) {
					return false;
				}
				return true;
			}

			return false;
		},

		linkDeniedUseAjax: function(el) {
			var t=this, eid = (typeof el.id !== 'undefined' ? el.id : ''), cname = el.className, target = el.getAttribute('target'), customonclick = el.getAttribute('onclick');
			el = el.href;

			if ( el.indexOf('replytocom') !== -1 || el.indexOf('wp-admin') !== -1 || el.indexOf('wp-login') !== -1 || el.indexOf('mailto:') !== -1 || el.indexOf('tel:') !== -1 || cname.indexOf('mejs') !== -1 ) {
				return true;
			}

			if ( eid.indexOf('cancel-comment-reply-link') !== -1 ) {
				return true;
			}

			if ( "_blank" === target ) {
				return true;
			}

			if ( customonclick !== null ) {
				return true;
			}

			el = el.split('?')[0];
			var parts = el.split('.'),
				extension = parts[parts.length-1],
				fileTypes = ['jpg','jpeg','tiff','png','gif','bmp','mp4','mp3','mov','pdf'];

			if( fileTypes.indexOf(extension) !== -1 ) {
				return true;
			}

			return false;
		},

		initialLoadHistory: function() {
			var t=this, data={};
			data['doc_title'] = $('title').html(),
			data['main_content'] = $('#main').html(),
			data['body_classes'] = $('body').attr('class');

			var elementorCSS = $('link[rel*="stylesheet"]');
			var dynamicScripts = $('script[type="text/javascript"]');
			var inline_css = $('style[media!="print"]');

			if ( $(elementorCSS).length ) {
				var cssLinks = {};
				$(elementorCSS).each( function() {
					var _cssid = $(this).attr('id'),
						_csshref = $(this).attr('href');
					cssLinks[_cssid] = _csshref;
				});
				data['elementor_css'] = cssLinks;
			}

			if ( $(dynamicScripts).length ) {
				var scriptLinks = {};
				$(dynamicScripts).each( function(i) {
					var _scriptcontent = ( typeof $(this).attr('src') !== 'undefined' ? $(this).attr('src') : $(this).html() ),
						_scriptid = ( typeof $(this).attr('src') !== 'undefined' ? 'src_'+i : 'content_'+i );
					scriptLinks[_scriptid] = _scriptcontent;
				});
				data['embeded_scripts'] = scriptLinks;
			}

			/** version 1.1.0 - grab any inline css script */
			if ( $(inline_css).length ) {
				var inliner = '';
				$(inline_css).each(function() {
					inliner += $(this).html();
				});
				data['inline_css'] = inliner;
			}

			history.replaceState(data, data['doc_title'], '');	
		},

		elclick: function(e) {
			var t=this, elem = document.querySelector('.aiteko-content-container');
			
			var nTarget = e.currentTarget.pathname + e.currentTarget.search;
			if ( nTarget !== (window.location.pathname + window.location.search) ) {
				e.preventDefault();

				t.onAjaxProgress = true;
				var cT = $('.aiteko-content-container').scrollTop();

				$('.animated').removeClass('animated');
				t.elemProURL = null;

				if ( $('html').hasClass('side-bind') ) {
					t.closeBprocess( function() {
						t.callPage( e.currentTarget.href, cT );
					});
				} else {
					t.callPage( e.currentTarget.href, cT );
				}
			}
			e.preventDefault();
			return false;
		},

		callPage: function( dest_url, cT ) {
			var t=this, data={};
			if ( typeof dest_url === 'undefined' ) {
				return false;
			}

			$('body').css({cursor: 'progress', pointerEvents: 'none'});

			t.preChangePage(cT);
			jQuery(window).off('elementor/frontend/init');

			$.ajax({
				url : dest_url,
				type: 'GET',
				error: function(httpRequest, textStatus, errorThrown) {

					if ( httpRequest.status == '404' ) {
						var d = httpRequest.responseText;

						var parser = new DOMParser(),
							doc = parser.parseFromString(d, "text/html"),
							$wholePage = $("<div>").html(d),
							elementorCSS = false;

							data['doc_title'] = $wholePage.find('title').html();
							data['main_content'] = $wholePage.find('#main').html();
							data['body_classes'] = doc.body.getAttribute('class');

							elementorCSS = $wholePage.find('link[rel*="stylesheet"]');
							
							// load dynamic css if any
							if ( $(elementorCSS).length ) {
								var cssLinks = {};
								$(elementorCSS).each( function() {
									var _cssid = $(this).attr('id'),
										_csshref = $(this).attr('href');
									cssLinks[_cssid] = _csshref;
								});
								data['elementor_css'] = cssLinks;
							}

							var dynamicScripts = $wholePage.find('script[type="text/javascript"]');

							// dynamic js
							if ( $(dynamicScripts).length ) {
								var scriptLinks = {};
								$(dynamicScripts).each( function(i) {
									var _scriptcontent = ( typeof $(this).attr('src') !== 'undefined' ? $(this).attr('src') : $(this).html() ),
										_scriptid = ( typeof $(this).attr('src') !== 'undefined' ? 'src_'+i : 'content_'+i );
									scriptLinks[_scriptid] = _scriptcontent;
								});
								data['embeded_scripts'] = scriptLinks;
							}

							//inline css
							var inline_css = $wholePage.find('style[media!="print"]');
							/** version 1.1.0 - grab any inline css script */
							if ( $(inline_css).length ) {
								var inliner = '';
								$(inline_css).each(function() {
									inliner += $(this).html();
								});
								data['inline_css'] = inliner;
							}

							$('title').html( data.doc_title );
							history.pushState(data, data.doc_title, dest_url );
				
							requestAnimationFrame( function() { t.beforeChangePage(); });
							window.setTimeout(function(){
								t.injectStyles( elementorCSS );
								$('.aitekoJsInlineCSS').detach();
								$('style').detach();
								if ( data.hasOwnProperty('inline_css') ) {
									var c = document.createDocumentFragment(),
										sty = document.createElement('style');

									c.appendChild(sty);
									sty.className = 'aitekoJsInlineCSS';
									sty.innerHTML = data.inline_css;
									document.head.appendChild(c);
									c = sty = null;
								}
							},700);
							$(window).one('aitekoDoneBCP', function(){
								$('body').css({cursor: '', pointerEvents: ''});
								$('#main').find('iframe').remove();
								$('.elementor-lightbox').detach().remove();
								$('#elementor-device-mode').detach().remove();

								$('#main').removeAttr('style').html(data.main_content);
								$('body').attr('class', data.body_classes );
								$(document).add('*').off();

								t.convertPaginations();
								
								t.injectSscripts( data.embeded_scripts );

								if ( typeof ga === 'function' ) {
									ga('send','pageview',window.location.pathname);
								}
								//window.dispatchEvent( new Event("load") );
								$(window).trigger('load');
								parser = doc = $wholePage = null;
							});
					} else {
						alert( 'Something wrong! We got ' + httpRequest.status + ' - ('+ textStatus +') from server. Please try again later!' );
						window.location.reload(false);
						return false;
					}
				},
				success: function(d) {
					var parser = new DOMParser(),
						doc = parser.parseFromString(d, "text/html"),
						$wholePage = $("<div>").html(d),
						elementorCSS = false;

						data['doc_title'] = $wholePage.find('title').html();
						data['main_content'] = $wholePage.find('#main').html();
						data['body_classes'] = doc.body.getAttribute('class');

						elementorCSS = $wholePage.find('link[rel*="stylesheet"]');
						
						// load dynamic css if any
						if ( $(elementorCSS).length ) {
							var cssLinks = {};
							$(elementorCSS).each( function() {
								var _cssid = $(this).attr('id'),
									_csshref = $(this).attr('href');
								cssLinks[_cssid] = _csshref;
							});
							data['elementor_css'] = cssLinks;
						}

						var dynamicScripts = $wholePage.find('script[type="text/javascript"]');

						// dynamic js
						if ( $(dynamicScripts).length ) {
							var scriptLinks = {};
							$(dynamicScripts).each( function(i) {
								var _scriptcontent = ( typeof $(this).attr('src') !== 'undefined' ? $(this).attr('src') : $(this).html() ),
									_scriptid = ( typeof $(this).attr('src') !== 'undefined' ? 'src_'+i : 'content_'+i );
								scriptLinks[_scriptid] = _scriptcontent;
							});
							data['embeded_scripts'] = scriptLinks;
						}

						//inline css
						var inline_css = $wholePage.find('style[media!="print"]');
						/** version 1.1.0 - grab any inline css script */
						if ( $(inline_css).length ) {
							var inliner = '';
							$(inline_css).each(function() {
								inliner += $(this).html();
							});
							data['inline_css'] = inliner;
						}

						$('title').html( data.doc_title );
						history.pushState(data, data.doc_title, dest_url );

						requestAnimationFrame( function() { t.beforeChangePage(); });
						window.setTimeout(function(){
							t.injectStyles( elementorCSS );
							$('.aitekoJsInlineCSS').detach();
							$('style').detach();
							if ( data.hasOwnProperty('inline_css') ) {
								var c = document.createDocumentFragment(),
									sty = document.createElement('style');

								c.appendChild(sty);
								sty.className = 'aitekoJsInlineCSS';
								sty.innerHTML = data.inline_css;
								document.head.appendChild(c);
								c = sty = null;
							}
						},700);
						$(window).one('aitekoDoneBCP', function(){
							$('body').css({cursor: '', pointerEvents: ''});
							$('#main').find('iframe').remove();
							$('.elementor-lightbox').detach().remove();
							$('#elementor-device-mode').detach().remove();
							$('#main').removeAttr('style').html(data.main_content);
							$('body').attr('class', data.body_classes );
							$(document).add('*').off();

							t.convertPaginations();
							
							t.injectSscripts( data.embeded_scripts );

							if ( typeof ga === 'function' ) {
								ga('send','pageview',window.location.pathname);
							}

							$(window).trigger('load');
							parser = doc = $wholePage = null;
						});
				}
			});
		},

		// Dynamic script attachment.
		injectSscripts: function( scripts ) {
			var t=this, elementorFrontendDetected = false;

			if( typeof scripts !== 'undefined' ) {
				var scriptDiv = $("<div id='aiteko-mo-script' />");

				if ( $('#aiteko-mo-script').length < 1 ) {
					$('body').append($(scriptDiv));
					$('#aiteko-mo-script').css({width:0,height:0,overflow:'hidden'});
				} else {
					$('#aiteko-mo-script').html('');
				}

				/**$('script[type="text/javascript"]').each(function() {
					var js__src = ( typeof $(this).attr('src') !== 'undefined' ? $(this).attr('src') : '' );
					if ( js__src.includes('/js/jquery/jquery.js') === false && js__src.includes('/js/jquery/jquery-migrate.min.js') === false &&  js__src.includes('/aiteko/assets/js/anime.min.js') === false &&  js__src.includes('/aiteko/assets/js/global.js') === false && js__src.includes('pace.min.js') === false && js__src.includes('slick.min.js') === false && js__src.includes('/elementor/') === false  ) {
						$(this).remove();
					}
				});*/

				for( var _jsidcheck in scripts ) {
					if ( scripts.hasOwnProperty(_jsidcheck) && _jsidcheck.includes('content_') === false ) {
						if ( $('script[src="'+scripts[_jsidcheck]+'"]').length < 1 ) {
							if ( scripts[_jsidcheck].includes('elementor/assets/js/frontend.min.js') === true ||  scripts[_jsidcheck].includes('elementor-pro/assets/js/frontend.min.js') === true ) {
								elementorFrontendDetected = true;
							}
						}
					}
				}

				var chc = [];
				for( var _jsid in scripts ) {
					if (scripts.hasOwnProperty(_jsid)) {
						if ( _jsid.includes('content_') !== false ) {
							if ( scripts[_jsid].includes('aitekoRender') === false ) {
								var jscontent = scripts[_jsid];
								jscontent = $.trim(jscontent);
								jscontent = jscontent.replace('jQuery(document).ready', 'jQuery(window).load');
								jscontent = jscontent.replace('$(document).ready', 'jQuery(window).load');
								var x = '<script type="text/javascript">'+jscontent+'</script>';
								$('#aiteko-mo-script').append( $(x) );
							}
						} else {
							if ( $('script[src="'+scripts[_jsid]+'"]').length < 1 ) {
								//chc.push( scripts[_jsid] );
								if ( scripts[_jsid].includes('/elementor-pro/assets/js/frontend.min.js') ) {
									
									if ( typeof elementorProFrontend !== 'undefined' ) {	
										for(var key in elementorProFrontend) {
											delete elementorProFrontend[key];
										}

										delete window.elementorProFrontend;
									}
									$.cachedScript( scripts[_jsid] );

								} else {
									$.cachedScript( scripts[_jsid] );
								}
							}
						}
					}
				}

				if ( elementorFrontendDetected ) {
					jQuery(window).off('elementor/frontend/init');
				}
				
				// window.dispatchEvent( new Event("aitekoFinishBCP") );
				if ( elementorFrontendDetected && t.nextElemInit ) {
					window.location.reload(false);
				} else {

					$(window).trigger('aitekoFinishBCP');
					requestAnimationFrame( function() { t.initAnim(); });
				}
			}
		},

		onebyone: function( scripts, elementorFrontendDetected, callback ) {
			var d=this, tot = scripts.length;


			if ( d.counterScript === tot-1 ) {
				if ( typeof callback === 'function' ) {
					callback();
				}
				return false;
			}

			var caller = $.cachedScript( scripts[d.counterScript] ).done( function( script, textStatus ){
				d.counterScript++;
				return d.onebyone( scripts, elementorFrontendDetected, callback );
			});
		},

		injectStyles: function( styles ) {
			var t=this;

			if( typeof styles !== 'undefined' ) {
				$('link[id*="elementor-post"]').remove();
				$(styles).each(function() {
					var x=this, _id = $(this).attr('id');
					if ( $('#'+_id).length < 1 ) {
						$('head').append($(x));
					}
				});
			}
		},

		preChangePage: function(cT) {
			var t=this, men;

			men = anime.timeline({
				loop: false,
				autoplay: true,
			});

			men.add({
				targets: '#aiteko--ptpre',
				height: '100%',
				duration: 700,
				elasticity: 100,
				easing: 'easeInOutExpo',
				complete: function() {
					$('body').css({pointerEvents: ''});
					$(window).scrollTop(0);
				}
			});
		},

		beforeChangePage: function(cT) {
			var t=this, men;

			men = anime.timeline({
				loop: false,
				autoplay: true,
				complete: function( ) {
					$('.aiteko-content-container').removeAttr('style');
					$('#aiteko--pt0, #aiteko--pt1, #aiteko--ptpre').removeAttr('style');
					//window.dispatchEvent( new Event("aitekoDoneBCP") );
					$(window).trigger('aitekoDoneBCP');
				}
			});
			
			men.add({
				targets: '#aiteko--pt0',
				height: '100%',
				duration: 700,
				elasticity: 100,
				easing: 'easeInOutExpo'
			}).add({
				targets: '#aiteko--pt1',
				width: [0, $('#aiteko--pt0').width()],
				duration: 700,
				elasticity: 100,
				delay: 150,
				easing: 'easeInOutExpo'
			});
		},

		smoothIt: function() {
			var t=this;

			var body = document.body,
				html = document.documentElement;
			$(window).on( 'scroll', function() {
				var scrollY = window.pageYOffset || html.scrollTop || body.scrollTop || 0;
				var listener = {'offset':{'top': scrollY, 'y': scrollY}};
				t.aitekoWayPoints( listener );
			});
		},

		aitekoWayPoints: function(status) {
			var t=this, pos=status.offset, wh= $(window).height();
			
			aiteko.elementorElems(pos, wh);
			//aiteko.updateParalax(pos);
			aiteko.nicerPageTitle(pos);
			aiteko.autoloadPosts(pos, wh);
		},

		autoloadPosts: function(pos, wh) {
			var t=this, mark=$('#autoload-pagination'), elem = document.querySelector('.aiteko-content-container');

			if ( mark.length ) {
				
				if ( mark.hasClass('onloadajax') ) {
					return false;
				}

				var main=mark.parent(),
					curPage = parseInt( mark.data('currentpage') ),
					maxPage = parseInt( mark.data('maxpage') ),
					divclassname = mark.data('divclassname');

				if ( curPage < 1 ) {
					curPage = 1;
				}
				// if no more page, remove.
				if ( curPage == maxPage ) {
					mark.remove();
					return false;
				}

				var mp = mark.position();
				var bounding = mark[0].getBoundingClientRect();

				if ( bounding.top >= 0 && bounding.top <= wh ) {
					mark.addClass('onloadajax');

					$.ajax({
						url : window.location.href,
						data : {
							paged : curPage+1
						},
						type: 'get',
						complete: function() {
							curPage = curPage+1;
							if ( curPage === maxPage ) {
								mark.remove();
								return false;
							}
							setTimeout( function() {
								mark.data('currentpage', curPage );
								mark.removeClass('onloadajax');
							}, 1000 );
						},
						success: function( data ) {
							var $newblocks =  $("<div>").html(data).find( '.'+divclassname ), scrollbar;

							if ( divclassname === 'post-grid' ) {
								var $masonpost = t.masonpost;
								$newblocks =  $("<div>").html(data).find( '.'+divclassname+':not(.post-grids-spacer)' );
								$newblocks.find('.ui-post-wrap').css({opacity: 0});
								$masonpost.append( $newblocks ).masonry( 'appended', $newblocks );
								t.initBlogAnimate();
								$masonpost.imagesLoaded().progress( function() {
									$masonpost.masonry('layout');
									setTimeout(function(){
										$('.ui-post-wrap').css({opacity: 1});
										t.blogShowUp.play();
									},500);
								});
							} else if ( divclassname === 'portfolio-grid' ) {
								var $masonproject = t.masonproject;
								$newblocks =  $("<div>").html(data).find( '.'+divclassname+':not(.portfolio-grids-spacer)' );
								$newblocks.find('.portfolio-inner').css({opacity: 0});
								$masonproject.append( $newblocks ).masonry( 'appended', $newblocks );
								t.initProjectAnimate();
								$masonproject.imagesLoaded().progress( function() {
									$masonproject.masonry('layout');
									setTimeout(function(){
										$('.portfolio-inner').css({opacity: 1});
										t.projectShowUp.play();
									},500);
								});
							} else {
								var ptp = false;
								if ( divclassname === 'portfolio-default' ) {
									ptp = true;
									$('.ptp-go').removeClass('ptp-go');
									$($newblocks).addClass('ptp-go');
								}
								$( $newblocks ).insertBefore( mark );
								if ( ptp ) {
									anime({
										targets : '.ptp-go',
										translateY : [75, 0],
										opacity: [0, 1],
										easing: 'easeInOutSine',
										duration: 700,
										elasticity: 100
									});		
								}
							}
						}
					});

				}
			}
		},
		updateParalax: function(scrollpos) {
			var t=this, wh= $(window).height(), els=$('.jarallax');

			if (els.length<1) {
				return;
			}

			if ( typeof scrollpos === 'undefined' ) {
				scrollpos = {};
				scrollpos.y = 0;
			}

			els.each(function() {
				var el=this, h=$(el).outerHeight(), ps=$(el).position(),ah=$(el).height();

				if ( parseInt( $(el).css('opacity') ) === 0 ) {
					anime({
						targets : el,
						opacity: [0, 1],
						scale: [0.95, 1],
						easing: 'easeInOutSine',
						duration: 500,
						elasticity: 100,
						complete: function() {
							t.updateParalax();
						}
					});
				}
				var bounding = el.getBoundingClientRect();
				
				if ( bounding.top >= -ah && bounding.top <= wh+ah ) {
					var identifier = 0.25;
					$(el).find('.jarallax-img').css({
						webkitTransform: 'translate3d(0, '+ ( bounding.top - (wh-ah) )*identifier +'px, 0)',
						transform: 'translate3d(0, '+ ( bounding.top - (wh-ah) )*identifier +'px, 0)',
					});
				}
			});
		},
		nicerPageTitle: function(pos) {
			var t=this, wh= $(window).height(), els=$('.entry-page-header');

			if ( els.length < 1 ) {
				return false;
			}

			if ( els.is(':hidden')) {
				return false;
			}

			if ( typeof pos.y === 'undefined') {
				return false;
			}

			if ( pos.y > 10 && pos.y <= wh ) {
				var prct = Math.round(pos.y)/wh;
				
				els[0].style.backgroundColor = 'rgba(0,0,0, '+ prct +')';
				els[0].style.paddingTop = pos.y+'px';
				$('.scroll-notice')[0].style.opacity = 1-prct;

				if ( $('.header-featured-background').length ) {
					$('.header-featured-background')[0].style.opacity = 1-prct;
				}

				if ( ! $('.aiteko-the-content').hasClass('animeDone') ) {
					var bounding = $('.aiteko-the-content')[0].getBoundingClientRect();
					if ( bounding.top < (wh-150) ) {
						$('.aiteko-the-content').addClass('animeDone');
						anime({
							targets : '.aiteko-the-content',
							translateY : [75, 0],
							opacity: [0, 1],
							easing: 'easeInOutSine',
							duration: 700,
							elasticity: 100,
							complete: function() {
								$('.aiteko-the-content').css({
									webkitTransform: '',
									transform: '',
								});
							}
						});						
					}
				}

			} else if ( pos.y <= 10 ) {
				els[0].style.backgroundColor = 'rgba(0,0,0, 0)';
				els[0].style.paddingTop = '0';
				$('.scroll-notice')[0].style.opacity = 1;
				if ( $('.header-featured-background').length ) {
					$('.header-featured-background')[0].style.opacity = 1;
				}
			} else {
				els[0].style.backgroundColor = 'rgba(0,0,0, 1)';
				if ( ! $('.aiteko-the-content').hasClass('animeDone') ) {
					var bounding = $('.aiteko-the-content')[0].getBoundingClientRect();
					if ( bounding.top < (wh-150) ) {
						$('.aiteko-the-content').addClass('animeDone');
						anime({
							targets : '.aiteko-the-content',
							translateY : [75, 0],
							opacity: [0, 1],
							easing: 'easeInOutSine',
							duration: 700,
							elasticity: 100,
							complete: function() {
								$('.aiteko-the-content').css({
									webkitTransform: '',
									transform: '',
								});
							}
						});						
					}
				}
			}
		},
		getElementorElemSettings: function(el, setting) {
			var t=this,
				elementSettings = $(el).data('settings') || {};

			return t.getItems(elementSettings, setting);
		},
		elementorElems: function(pos, wh) {
			var t=this, dh = $('#main').height();

			var pds = $('.portfolio-default');
			if ( pds.length ) {
				pds.each( function() {
					var el=this, ps=$(el).offset();

					if ( $(el).hasClass('ptp-go') ) {
						$(el).removeClass('ptp-go');
						return;
					}

					var bounding = el.getBoundingClientRect();

					if ( typeof pos.y === 'undefined') {
						if ( ! $(el).hasClass('el-anim-done') && ( bounding.top >= 0 && bounding.top <= wh-($(el).height()/2) ) ) {
							$(el).find('header').css({ 'transform' : 'translate3D(0px,'+ ps.top*-0.05 +'px,0px)' });
							$(el).addClass('el-anim-done');
							anime({
								targets : ['#'+el.id+' header h3', '#'+el.id+' header .year-info'],
								translateY : [30, 0],
								opacity: [0, 1],
								easing: 'easeInOutSine',
								duration: 300,
								delay: function(e, i, l) { return i * 50; },
								elasticity: 100
							});

							t.pixiShowAction(el);
						}
					} else {
						
						var checker = ( bounding.top >= 0 && bounding.top <= wh-($(el).height()/2) );

						if ( checker ) {
							$(el).find('header').css({ 'transform' : 'matrix(1,0,0,1,0,'+ ((pos.y+wh)-ps.top)*-0.05 +')' });
							$(el).find('.portfolio-thumbnail-link').css({ 'transform' : 'matrix(1, 0, 0, 1, 0, '+ ((pos.y+wh)-ps.top)*-0.05 +')' });

							if ( ! $(el).hasClass('el-anim-done') ) {
								$(el).addClass('el-anim-done');
								anime({
									targets : ['#'+el.id+' header h3', '#'+el.id+' header .year-info'],
									translateY : [30, 0],
									opacity: [0, 1],
									easing: 'easeInOutSine',
									duration: 300,
									delay: function(e, i, l) { return i * 50; },
									elasticity: 100
								});

								t.pixiShowAction(el);
								
							}
						}
					}
				});
			}

			var pgs = $('.portfolio-grids');
			if ( pgs.length && ! pgs.hasClass('already-initialized') ) {
				var bounding = pgs[0].getBoundingClientRect();
				
				if ( ( ( bounding.top >= 0 && bounding.top <= wh ) || bounding.bottom >= 0 ) && pgs.find('.p__tt_splash_i').length ) {
					t.elProjectGrids();
				}
			}

			var naviPostnavi = $('.navigation.post-navigation');
			if ( naviPostnavi.length ) {
				if ( pos.y+wh > naviPostnavi.offset().top && !naviPostnavi.hasClass('alshown') ) {
					naviPostnavi.addClass('alshown');
					anime({
						targets: '.navigation.post-navigation',
						opacity: [0,1],
						translateY: [50,0],
						duration: 500,
						elasticity: 300,
						delay: 300,
						easing: 'easeInOutCirc'
					});
				}
			}
		},
		pixiShowAction: function(el) {
			var t=this, ol={};
			
			$(el).imagesLoaded().progress( function() {
				ol[el.id] = new Pixishowanimation(el);
			});
		},
		numberGoes: function(el) {
			var $number = $(el),
			    data = $number.data();

			var decimalDigits = data.toValue.toString().match(/\.(.*)/);

			if (decimalDigits) {
				data.rounding = decimalDigits[1].length;
			}
			$number.addClass('el-anim-done').numerator(data);
		},
		rotateLogo: function() {
			var t=this, brand = $('.aiteko-side .brand');

			if ( $('html').hasClass('side-bind') ) {
				t.lRotated = false;
				return false;
			}

			brand.css({
				display: 'block',
				position:'absolute',
				width:'auto',
				padding: 0,
				textAlign: 'center',
				height:$('.aiteko-side').width()+'px',
				lineHeight:($('.aiteko-side').width()-4)+'px'
			});
			brand.find('img').css({
				width: 'auto',
				height: 'auto',
				maxWidth: 'none',
				maxHeight: ($('.aiteko-side').width()-20)+'px'
			});

			if ( ! t.lRotated ) {
				brand.css({opacity: 0});
			} else {
				brand.css({opacity: 1});
			}

			var bw = brand.width(),
				bh = brand.height();

			brand.css({
				position: 'absolute',
				top: '50%',
				left: '0',
				marginTop: (bh/2)*-1+'px',
				marginLeft: (bw-bh)/-2+'px',
				'-webkit-transform': 'rotate(-90deg)',
				transform: 'rotate(-90deg)',
				transformOrigin: 'center center'
			});		
		},
		menuShowUp: function() {
			var t=this, men;

			men = anime.timeline({
				loop: false,
				autoplay: true,
				complete: function() {
					$('.aiteko-side-handler .aiteko-social-follow').css({'transform':''});
				}
			});

			t.rotateLogo();
			t.lRotated = true;

			men.add({
				targets: ['.aiteko-side', '.aiteko-side-handler'],
				height: [0, '100%'],
				duration: 1000,
				delay: function(el, i, l) { return i * 200; },
				elasticity: 300,
				easing: 'easeInOutCirc'
			}).add({
				targets: '.aiteko-side .brand',
				opacity: [0, 1],
				duration: 500,
				elasticity: 300,
				offset: '-=100',
				easing: 'easeInSine'
			}).add({
				targets: '.aiteko-side-handler .aiteko-search-button',
				translateY: [-50, 0],
				opacity: [0, 1],
				duration: 500,
				elasticity: 300,
				offset: '-=300',
				easing: 'easeOutSine'
			}).add({
				targets: '.aiteko-side-handler .aiteko-social-follow',
				translateY: [50, 0],
				opacity: [0, 1],
				duration: 500,
				elasticity: 300,
				offset: '-=600',
				easing: 'easeOutSine'
			}).add({
				targets: '.aiteko-side-handler .aiteko-hamburger__menu',
				scale: [0, 1],
				opacity: [0, 1],
				duration: 500,
				elasticity: 300,
				offset: '-=600',
				easing: 'easeOutBack'
			});
		},
		initAnim: function() {
			var t=this, b=$('body'), section;
			
			/**if ( b.hasClass('single-post') || b.hasClass('single-attachment') ) {
				section = 'single-blog';
			} else if ( b.hasClass('single-portfolio') ) {
				section = 'single-portfolio';
			} else if ( b.hasClass('page') || b.hasClass('single-elementor_library') ) {
				section = 'page';
			} else if ( $('.post-grids').length ) {
				section = 'blog-archive';
			} else if ( $('.portfolio-default').length ) {
				section = 'portfolio-default';
			} else if ( $('.portfolio-grid').length ) {
				section = 'portfolio-grid';
			}  else if ( b.hasClass('error404') ) {
				section = 'errorPage';
			} else if ( b.hasClass('search-results') || b.hasClass('search-no-results') ) {
				section = 'search-results';
			}*/

			if ( b.hasClass('page') || b.hasClass('single-elementor_library') ) {
				section = 'page';
			} else if ( b.hasClass('single-post') || b.hasClass('single-attachment') ) {
				section = 'single-blog';
			} else if ( b.hasClass('search-results') || b.hasClass('search-no-results') ) {
				section = 'search-results';
			} else if ( b.hasClass('single-portfolio') ) {
				section = 'single-portfolio';
			} else if ( b.hasClass('error404') ) {
				section = 'errorPage';
			} else {
				if ( $('.post-grids').length ) {
					section = 'blog-archive';
				} else if ( $('.portfolio-default').length ) {
					section = 'portfolio-default';
				} else if ( $('.portfolio-grid').length ) {
					section = 'portfolio-grid';
				}
			}

			if ( typeof section !== 'undefined' ) {
				t.runAnim( section );
				//window.dispatchEvent( new Event("aitekoAnimationLoaded") );
				$(window).trigger('aitekoAnimationLoaded');
			} else {
				if ( $('.blank.no-posts').length ) {
					anime({
						targets: '.blank.no-posts',
						opacity: [0,1],
						translateY: [100,0],
						easing: 'easeInOutCirc',
						duration: 700
					});
				}
				//window.dispatchEvent( new Event("aitekoAnimationLoaded") );
				$(window).trigger('aitekoAnimationLoaded');
			}
		},
		runAnim: function( section ) {
			var t=this;

			if ( typeof section === 'undefined' ) {
				return false;
			}

			switch( section ) {
				case 'single-blog':
					t.singleBlogAnimate();
				break;
				case 'single-portfolio':
					t.singlePortfolioAnimate();
				break;
				case 'portfolio-default':
					t.portfolioDefault();
				break;
				case 'portfolio-grid':
					t.projectGrids();
				break;
				case 'blog-archive':
					t.postGrids();
				break;
				case 'page':
					t.singlePageAnimate();
				break;
				case 'errorPage':
					t.errorPageAnimate();
				break;
				case 'search-results':
					t.searchResultsAnimate();
				break;
			}
		},
		parallaxInit: function() {
			var t=this, els, $container = $('.aiteko-main');

			if ( jQuery.browser.mobile ) {
				return false;
			}

			if ( $('#main').find('.has-parallax').length ) {
				$('#main').find('.has-parallax').addClass('jarallax');
			}

			/**if ( $('#main').find('.elementor-element').length ) {
				$('#main').find('.elementor-element').each(function(){
					var $x=$(this);

					if( $x.css('background-attachment') === 'fixed' ) {
						if( $x.hasClass('elementor-element-edit-mode') ) {
							$x.css({ backgroundAttachment: 'scroll' });
						} else {
							$x.addClass('jarallax');
						}
					}
				});
			}*/

			els = $('#main').find('.jarallax');

			if ( els.length < 1 )
				return false;


			$('#main').find('.jarallax').css({opacity: 0});

			els.each(function() {
				$(this).jarallax({
					speed: 0.2,
				});
			});
		},
		portfolioDefault: function() {
			var t=this, items = $('.portfolio-default');
			
			if ( items.length ) {
				// if it embeded inside elementor
				if ( $('.aiteko-the-content').length ) {
					$('.portfolio-default').css({opacity: 1});
					
					t.singlePageAnimate();
				} else {
					anime({
						targets : '.portfolio-default',
						translateY : [75, 0],
						opacity: [0, 1],
						easing: 'easeInOutSine',
						duration: 700,
						delay: function(el, i, l) { return i * 50; },
						elasticity: 100
					});

					if ( $('#archive-title').length ) {
						anime({
							targets: '#archive-title',
							opacity: [0,1],
							translateX: [100,0],
							easing: 'easeInOutCirc',
							duration: 700
						});
					}
				}
			}

			if ( $('.blank.no-posts').length ) {
				anime({
					targets: '.blank.no-posts',
					opacity: [0,1],
					translateY: [100,0],
					easing: 'easeInOutCirc',
					duration: 700
				});
			}
		},
		postGrids: function() {
			var t=this, grids = $('.post-grids');
			
			if ( grids.length ) {

				if ( ! t.blogShowUp || typeof t.blogShowUp.play() === 'undefined' ) {
					t.initBlogAnimate();
				}

				if( typeof t.masonpost === 'object' ) {
					t.masonpost.masonry().masonry('destroy');
				}
				
				t.masonpost = grids.masonry({
					itemSelector: '.post-grid',
					columnWidth: '.post-grid-sizer',
					percentPosition: true,
					transitionDuration: '0.3s'
				});

				t.masonpost.imagesLoaded().progress( function() {
					t.masonpost.masonry().masonry('layout');
					t.blogShowUp.play();
				});
				
				if ( grids.find('img').length < 1 ) {
					t.masonpost.masonry().masonry('layout');
					t.blogShowUp.play();
				}
			}
		},
		projectGrids: function() {
			var t=this, grids = $('.portfolio-grids');
			
			if ( grids.length ) {

				if ( $('.aiteko-the-content').length ) {
					t.singlePageAnimate();
				}

				if ( ! t.projectShowUp || typeof t.projectShowUp.play() === 'undefined' ) {
					t.initProjectAnimate();
				}

				if( typeof t.masonproject === 'object' ) {
					t.masonproject.masonry().masonry('destroy');
				}
				
				t.masonproject = grids.masonry({
					itemSelector: '.portfolio-grid',
					columnWidth: '.portfolio-grid-sizer',
					percentPosition: true,
					transitionDuration: '0.3s'
				});

				t.masonproject.imagesLoaded().progress( function() {
					t.masonproject.masonry().masonry('layout');
					grids.addClass('already-initialized');
					$('.portfolio-inner').css({opacity: 1});
					requestAnimationFrame( function() { t.projectShowUp.play() });
				});

				if ( grids.find('img').length < 1 ) {
					t.masonproject.masonry().masonry('layout');
					grids.addClass('already-initialized');
					$('.portfolio-inner').css({opacity: 1});
					requestAnimationFrame( function() { t.projectShowUp.play() });
				}
			}
		},
		elProjectGrids: function() {
			var t=this, grids = $('.portfolio-grids');
			
			if ( grids.length ) {

				if ( ! t.projectShowUp || typeof t.projectShowUp.play() === 'undefined' ) {
					t.initProjectAnimate();
				}

				if( typeof t.masonproject === 'object' ) {
					t.masonproject.masonry().masonry('destroy');
				}
				
				t.masonproject = grids.masonry({
					itemSelector: '.portfolio-grid',
					columnWidth: '.portfolio-grid-sizer',
					percentPosition: true,
					transitionDuration: '0.3s'
				});

				t.masonproject.imagesLoaded().progress( function() {
					t.masonproject.masonry().masonry('layout');
					$('.portfolio-inner').css({opacity: 1});
					requestAnimationFrame( function() { t.projectShowUp.play() });
				});
			
				if ( grids.find('img').length < 1 ) {
					t.masonproject.masonry().masonry('layout');
					$('.portfolio-inner').css({opacity: 1});
					requestAnimationFrame( function() { t.projectShowUp.play() });
				}
			}
		},
		singlePortfolioAnimate: function() {
			var t=this, spa;

			spa = anime.timeline({
				loop: false,
				autoplay: true,
				complete: function() {
					$('.p__tt_splash_o, .p__y_splash_o').remove();
					$('.p__tt_splash_i, .p__y_splash_i').remove();
					$('.aiteko-the-content').css({
						webkitTransform: '',
						transform: '',
					});
				}
			});

			spa.add({
				targets: [ '.p__tt_splash_i', '.p__y_splash_i' ],
				width: ['0%', '100%'],
				duration: 700,
				easing: 'easeInOutCirc'
			}).add({
				targets: [ '.p__tt_splash_o', '.p__y_splash_o' ],
				opacity: [1, 0],
				duration: 700,
				easing: 'easeInOutCirc'
			}).add({
				targets: [ '.p__tt_splash_i', '.p__y_splash_i' ],
				width: ['100%', '0%'],
				left: ['0%', '100%'],
				duration: 500,
				easing: 'easeInOutCirc',
				offset: '-=700'
			}).add({
				targets: '.aiteko-the-content',
				translateY : [75, 0],
				opacity: [0, 1],
				duration: 700,
				easing: 'easeInOutCirc',
				elasticity: 100
			});	
		},
		singlePageAnimate: function() {
			var t=this, targetss=[];

			if ( $('.entry-page-header').length && $('.entry-page-header').is(':hidden') !== true ) {

				if ( ! $('.entry-page-header').find('h1').hasClass('onviewport') ) {
					var element = document.querySelector('.entry-page-title'),
						elList = function(e) {
							if ( e.type === 'animationend' ) {
								$('.entry-page-title').removeClass('onviewport');
							}
						};

					element.addEventListener("animationend", elList, false);
					element.className = 'entry-page-title onviewport';
				}
				$('.entry-page-header').css({opacity:1});
				targetss = ['.entry-page-header .scroll-notice'];
				
			} else {
				targetss.push('.aiteko-the-content');
			}

			if ( $('.portfolio-default').length ) {
				targetss.push('.portfolio-default');
			}

			anime({
				targets : targetss,
				translateY : [75, 0],
				opacity: [0, 1],
				easing: 'easeInOutSine',
				duration: 700,
				delay: function(el, i, l) { return i * 50; },
				elasticity: 100,
				complete: function() {
					$('.aiteko-the-content').css({
						webkitTransform: '',
						transform: '',
					});
				}
			});
		},
		errorPageAnimate: function() {
			var t=this, errAnm;

			errAnm = anime.timeline({
				loop: false,
			});

			errAnm.add({
				targets: ['.aiteko-error-page-heading span:first-child', '.aiteko-error-page-heading span:last-child'],
				opacity: [0,1],
				translateY: [100,0],
				duration: 700,
				easing: 'easeInOutCirc',
				elasticity: 300,
				delay: 500
			}).add({
				targets: '.aiteko-error-page-heading span:not(:first-child):not(:last-child)',
				opacity: [0,1],
				translateY: [-100,0],
				duration: 700,
				easing: 'easeInOutCirc',
				elasticity: 300,
				offset: '-=700'
			}).add({
				targets: ['.aiteko-page--404-content p', '.aiteko-page--404-content a'],
				opacity: [0,1],
				translateY: [50,0],
				duration: 700,
				easing: 'easeInOutCirc',
				elasticity: 300,
				delay: function(el, i, l) { return i * 50; },
			});
		},
		searchResultsAnimate: function() {
			var t=this, srcAnm;

			srcAnm = anime.timeline({
				loop: false,
			});

			srcAnm.add({
				targets: '#archive-title',
				opacity: [0,1],
				translateX: [100,0],
				easing: 'easeInOutCirc',
				duration: 700
			}).add({
				targets: '.search-loop-contain',
				opacity: [0,1],
				translateY: [100,0],
				easing: 'easeInOutCirc',
				duration: 700
			});

			if ( $('.blank.no-posts').length ) {
				srcAnm.add({
					targets: '.blank.no-posts',
					opacity: [0,1],
					translateY: [100,0],
					easing: 'easeInOutCirc',
					duration: 700
				});
			}
		},
		initProjectAnimate: function() {
			var t=this, grids = $('.portfolio-grids'), to=[],ti=[];

			t.projectShowUp = anime.timeline({
				loop: false,
				autoplay: false,
				complete: function() {
					grids.find('.p__t_splash_o, .p__tt_splash_o, .p__y_splash_o').remove();
					grids.find('.p__t_splash_i, .p__tt_splash_i, .p__y_splash_i').remove();
				}
			});

			$('.portfolio-grids').find('.portfolio-grid:not(.a__loaded)').each(function(){
				var gridID = $(this).attr('id');

				if ( typeof gridID === 'undefined' ) {
					return;
				}
				to.push('#'+gridID+' .p__t_splash_o');
				to.push('#'+gridID+' .p__tt_splash_o');
				to.push('#'+gridID+' .p__y_splash_o');

				ti.push('#'+gridID+' .p__t_splash_i');
				ti.push('#'+gridID+' .p__tt_splash_i');
				ti.push('#'+gridID+' .p__y_splash_i');

				$(this).addClass('a__loaded');
			});


			t.projectShowUp.add({
				targets: ti,
				width: ['0%', '100%'],
				duration: 700,
				easing: 'easeInOutCirc'
			}).add({
				targets: to,
				opacity: [1, 0],
				duration: 700,
				easing: 'easeInOutCirc'
			}).add({
				targets: ti,
				width: ['100%', '0%'],
				left: ['0%', '100%'],
				duration: 500,
				easing: 'easeInOutCirc',
				offset: '-=700'
			});
		},
		singleBlogAnimate: function() {
			var t=this, animate;

			animate = anime.timeline({
				loop: false,
				delay: 0,
				easing: 'easeInOutCirc',
				complete: function() {
					$('.aiteko-the-content').css({
						webkitTransform: '',
						transform: '',
					});
				}
			});

			animate.add({
				targets :  '.single-post-featured-image img',
				translateX : [-300, 0],
				opacity: [0, 1],
				duration: 1000,
				elasticity: 300,
			}).add({
				targets :  '.single-entry-headers',
				translateX : [300, 0],
				opacity: [0, 1],
				duration: 1000,
				elasticity: 300,
				offset: '-=900'
			}).add({
				targets :  '.aiteko-the-content',
				translateY : [200, 0],
				opacity: [0, 1],
				duration: 1000,
				elasticity: 300,
				offset: '-=500'
			});
		},
		initBlogAnimate: function() {
			var t=this, grids = $('.post-grids'), preloader=[],eh=[],ed=[];

			t.blogShowUp = anime.timeline({
				loop: false,
				autoplay: false
			});

			$('.post-grids').find('.post-grid:not(.a__loaded)').each(function(){
				var gridID = $(this).attr('id');
				if ( typeof gridID === 'undefined' ) {
					return;
				}
				preloader.push('#'+gridID+' .preloader-block');
				eh.push('#'+gridID+' .entry-header');
				eh.push('#'+gridID+' .entry-footer');
				ed.push('#'+gridID+' .entry-thumbnail .entry-date');
				ed.push('#'+gridID+' .entry-thumbnail .cat-links');
				$(this).addClass('a__loaded');
			});

			if ( $('#archive-title').length ) {
				t.blogShowUp.add({
					targets: '#archive-title',
					opacity: [0,1],
					translateX: [100,0],
					easing: 'easeInOutCirc',
					duration: 700
				});
			}

			t.blogShowUp.add({
				targets: preloader,
				width: 0,
				duration: 900,
				easing: 'easeInOutCirc',
				offset: ( $('#archive-title').length ? '-=700' : 0 ),
			}).add({
				targets: eh,
				opacity: 1,
				translateX: [50, 0],
				translateZ: [0, 0],
				duration: 700,
				elasticity: 100,
				offset: 300,
				easing: 'easeInOutSine'	
			}).add({
				targets: ed,
				opacity: 1,
				translateX: [-50, 0],
				translateZ: [0, 0],
				duration: 700,
				elasticity: 100,
				offset: 300,
				easing: 'easeInOutSine'
			});
		},
		endLoading: function() {
			var t=this, endedTimeline;

			if ( $('#aiteko-site-loader').length ) {
				endedTimeline = anime.timeline({
					complete: function() {
						//window.dispatchEvent( new Event("aitekoFinishLoad") );
						$(window).trigger('aitekoFinishLoad');
					}
				});
				endedTimeline.add({
					targets: '.aiteko-load-line',
					top: '100%',
					opacity: 0,
					elasticity: 100,
					duration: 500,
					easing: 'easeInOutCirc'			
				}).add({
					targets: '.aiteko-load-text',
					scale: 0,
					opacity: 0,
					elasticity: 100,
					duration: 500,
					offset: '-=300',
					easing: 'easeInOutCirc'
				}).add({
					targets: ['#aiteko-site-loader .asl-before', '#aiteko-site-loader .asl-after'],
					width: 0,
					elasticity: 300,
					duration: 700,
					offset: '-=100',
					easing: 'easeInOutCirc'
				});
			} else {
				$(document).ready( function(){
					//window.dispatchEvent( new Event("aitekoFinishLoad") );
					$(window).trigger('aitekoFinishLoad');
				});
			}
		},
		convertPaginations: function() {
			var t=this, pags=$('.navigation.pagination'), $newPags;

			if ( pags.length ) {
				pags.find('.next, .screen-reader-text').remove();
				var max= parseInt( pags.find('.page-numbers:last-child').text() ),
					currentPage = parseInt(pags.find('.page-numbers.current').text()),
					divClassName = '';

				if ( pags.parent().find('.portfolio-default').length ) {
					divClassName = 'portfolio-default';
				} else if ( pags.parent().find('.post-grid').length ) {
					divClassName = 'post-grid';
				} else if ( pags.parent().find('.portfolio-grid').length ) {
					divClassName = 'portfolio-grid';
				} else if ( pags.parent().find('.search-loop').length ) {
					divClassName = 'search-loop';
				}
				
				$newPags = '<div id="autoload-pagination" data-divclassname="'+divClassName+'" data-currentpage="'+currentPage+'" data-maxpage="'+max+'"><span></span><span></span></div>';
				$($newPags).insertAfter(pags);
				pags.remove();
			}
		},
		searchHandle: function() {
			var t=this,
				btn=$('.aiteko-search-button'),
				closebar=$('.aiteko--close-search-form'),
				$form = $('#aiteko-search-form').find('form'),
				s_anim;

			s_anim = anime.timeline({
				autoplay: false
			});

			s_anim.add({
				targets: '#aiteko-search-form',
				width: ['0vw', '100vw'],
				duration: 500,
				elasticity: 300,
				easing: 'easeInOutCirc'
			}).add({
				targets: '#aiteko-search-form .search-form',
				translateY: [50, 0],
				opacity: [0,1],
				duration: 500,
				elasticity: 0,
				easing: 'easeInOutSine',
				offset: '-=100',
			}).add({
				targets: '#aiteko-search-form .aiteko--close-search-form',
				scale: [0, 1],
				opacity: [0,1],
				duration: 500,
				elasticity: 0,
				easing: 'easeInOutSine',
				offset: '-=200',
			});

			btn.unbind().on('click',function(e) {
				e.preventDefault();
				if( s_anim.reversed ) {
					s_anim.reverse();
				}
				s_anim.play();
				$('#aiteko-search-form').find('input[type="search"]').val('').focus();
			});

			closebar.unbind().on('click', function(e) {
				e.preventDefault();
				s_anim.play();
				s_anim.reverse();
			});

			$form.unbind().on('submit', function(e) {
				var act_url = $form.attr('action'),
					param = $(this).serialize(),
					elem = document.querySelector('.aiteko-content-container');

				e.preventDefault();
				closebar.trigger('click');
				if ( act_url.indexOf('=') != -1 ) {
					act_url = act_url+'&'+param;
				} else {
					act_url = act_url+'?'+param;
				}

				t.onAjaxProgress = true;

				if ( $('html').hasClass('side-bind') ) {
					$('.aiteko-hamburger__menu').trigger('click');
				}

				var cT = $('.aiteko-content-container').scrollTop();

				t.callPage( act_url, cT );
			});
		},
		closeBprocess: function( after ) {
			var t=this,
				html=$('html'),
				btn=$('.aiteko-hamburger__menu'),
				side=$('.aiteko-side'),
				sideHandler = $('.aiteko-side-handler'),
				onAnimate = false,
				sideReserveAnim,
				brand = $('.aiteko-side .brand');

			$('.aiteko-side').css({maxWidth: 'none'});
			onAnimate = true;

			sideReserveAnim = anime.timeline({
				complete: function() {
					
					onAnimate = false;

					var mAnim = anime.timeline({
						complete: function() {
							html.removeClass('side-bind');
							//reset
							sideHandler.css({left: ''});
							side.css({width: '', maxWidth: '', paddingLeft: '', paddingRight: '', transform: ''});
							$('.aiteko-side-ui .main-menu-container-wrap').css({transform: ''});
							$('ul#aiteko-nav>li').css({opacity: '', transform: ''});
							
							brand.css({opacity:0}).removeAttr('style').css({opacity:0});
							t.rotateLogo();
							t.lRotated = true;

							anime({
								targets: '.aiteko-side .brand',
								opacity: [0,1],
								elasticity: 300,
								duration: 500,
								easing: 'easeInOutCirc',
							});
						}
					});
					mAnim.add({
						targets: '.aiteko-side',
						width: t.origSideWidth,
						opacity: 1,
						elasticity: 100,
						duration: 500,
						easing: 'easeInOutCirc',
					}).add({
						targets: '.aiteko-side-handler',
						left: t.origSideWidth,
						elasticity: 100,
						duration: 500,
						easing: 'easeInOutCirc',
						offset: '-=500',	
					});

					if ( typeof after !== 'undefined' ) {
						after();
					}
				}
			});

			sideReserveAnim.add({
				targets: ['.aiteko-side .brand', 'ul#aiteko-nav>li', '.aiteko-side .aiteko--header-footer'],
				translateX: 100,
				opacity: 0,
				easing: 'easeInSine',
				elasticity: 100,
				duration: 500,
				delay: function(el, i, l) { return i * 50; },
			}).add({
				targets: '.aiteko-side',
				left: '100vw',
				width: 0,
				paddingLeft: 0,
				paddingRight: 0,
				elasticity: 100,
				duration: 500,
				offset: '-=100',
				easing: 'easeInOutCirc',
			}).add({
				targets: '.aiteko-side',
				left: 0,
				opacity: 0,
				elasticity: 100,
				duration: 100,
				easing: 'easeInOutSine',
			});

			btn.removeClass('is-active');
		},
		showHideSide: function() {
			var t=this,
				html=$('html'),
				btn=$('.aiteko-hamburger__menu'),
				side=$('.aiteko-side'),
				sideHandler = $('.aiteko-side-handler'),
				onAnimate = false,
				sideAnim, sideReserveAnim,
				brand = $('.aiteko-side .brand');

			btn.unbind().on('click',function(e){
				e.preventDefault();
				if ( onAnimate ) {
					return false;
				}

				$('.aiteko-side').css({maxWidth: 'none'});

				if ( btn.hasClass('is-active') ) {
					onAnimate = true;

					t.lRotated = false;
					sideReserveAnim = anime.timeline({
						complete: function() {
							html.removeClass('side-bind');
							onAnimate = false;
							//reset
							sideHandler.css({left: ''});
							side.css({width: '', maxWidth: '', paddingLeft: '', paddingRight: '', transform: ''});
							$('.aiteko-side-ui .main-menu-container-wrap').css({transform: ''});
							$('ul#aiteko-nav>li').css({opacity: '', transform: ''});
							
							brand.css({opacity:0}).removeAttr('style').css({opacity:0});
							t.rotateLogo();
							t.lRotated = true;

							anime({
								targets: '.aiteko-side .brand',
								opacity: [0,1],
								elasticity: 300,
								duration: 500,
								easing: 'easeInOutCirc',
							});
						}
					});

					sideReserveAnim.add({
						targets: ['.aiteko-side .brand', 'ul#aiteko-nav>li', '.aiteko-side .aiteko--header-footer'],
						translateX: 100,
						opacity: 0,
						easing: 'easeInSine',
						elasticity: 100,
						duration: 500,
						delay: function(el, i, l) { return i * 50; },
					}).add({
						targets: '.aiteko-side',
						left: '100vw',
						width: 0,
						paddingLeft: 0,
						paddingRight: 0,
						elasticity: 100,
						duration: 500,
						offset: '-=100',
						easing: 'easeInOutCirc',
					}).add({
						targets: '.aiteko-side',
						left: 0,
						opacity: 0,
						elasticity: 100,
						duration: 100,
						easing: 'easeInOutSine',
					}).add({
						targets: '.aiteko-side',
						width: t.origSideWidth,
						opacity: 1,
						elasticity: 100,
						duration: 500,
						easing: 'easeInOutCirc',
					}).add({
						targets: '.aiteko-side-handler',
						left: t.origSideWidth,
						elasticity: 100,
						duration: 500,
						easing: 'easeInOutCirc',
						offset: '-=500',	
					});

					btn.removeClass('is-active');
				} else {
					//reset the rotate
					brand.css({opacity:0}).removeAttr('style').css({opacity:0});
					t.lRotated = false;
					brand.find('img').removeAttr('style');
					onAnimate = true;
					$('body').css({pointerEvents: 'none'});
					
					sideAnim = anime.timeline({
						complete: function() {
							html.addClass('side-bind');
							onAnimate = false;
							//reset
							sideHandler.css({left: ''});
							side.css({width: '', maxWidth: '', paddingLeft: '', paddingRight: ''});
							$('.aiteko-side-ui .main-menu-container-wrap').css({transform: ''});
							$('ul#aiteko-nav>li').css({opacity: '', transform: ''});
							$('body').css({pointerEvents: ''});

							var menuScroll = window.Scrollbar,
								menuElem = document.querySelector('.main-menu-container-wrap');

							if ( menuScroll.get(menuElem) ) {
								var menuScrollbar = menuScroll.get(menuElem);
								menuScrollbar.update();
							}
						}
					});

					sideAnim.add({
						targets: '.aiteko-side-handler',
						left: [t.origSideWidth, 0],
						elasticity: 300,
						duration: 500,
						easing: 'easeInOutCirc',	
					}).add({
						targets: '.aiteko-side',
						width: [t.origSideWidth, t.$win.width()],
						paddingLeft: [0,$('.aiteko-side-handler').outerWidth()*2+'px'],
						paddingRight: [0, $('.aiteko-side-handler').outerWidth()],
						elasticity: 300,
						duration: 300,
						easing: 'easeInOutExpo',
					}).add({
						targets: '.aiteko-side-ui .main-menu-container-wrap',
						scale: [0,1],
						elasticity: 0,
						duration: 100,
						easing: 'easeInOutCirc'
					}).add({
						targets: ['.aiteko-side .brand', 'ul#aiteko-nav>li', '.aiteko-side .aiteko--header-footer'],
						translateY: [50, 0],
						opacity: [0, 1],
						duration: 500,
						elasticity: 0,
						delay: function(el, i, l) { return i * 100; },
						offset: '-=50',
						easing: 'easeOutSine'
					});

					btn.addClass('is-active');
				}
			});
		},
		simplifyMenu: function() {
			var t=this, master=$('#aiteko-nav'),
				hasChild = master.find('.menu-item-has-children'),
				widgetMenu = $('.widget_nav_menu'),
				wdHasChild = widgetMenu.find('.menu-item-has-children'),
				wdCats = $('.widget_categories, .widget_pages'),
				wdCatsHasChild = wdCats.find('.children'),
				menuElem = document.querySelector('.main-menu-container-wrap');
				
			if ( hasChild.length ) {
				$(hasChild).each(function() {
					var z=this,arrow = '<span class="arrow-yuk-down"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 294.1L383 167c9.4-9.4 24.6-9.4 33.9 0s9.3 24.6 0 34L273 345c-9.1 9.1-23.7 9.3-33.1.7L95 201.1c-4.7-4.7-7-10.9-7-17s2.3-12.3 7-17c9.4-9.4 24.6-9.4 33.9 0l127.1 127z"/></svg></span>';

					if ( $(z).find('>ul').length < 1 ) {
						return;
					}

					$(z).find('>ul').hide();

					if ( $(z).find('>.arrow-yuk-down').length < 1 ) {
						$(arrow).insertAfter( $(z).find('>a') );
					} else {
						if ( $(z).find('>.arrow-yuk-down').hasClass('rtt') ) {
							$(z).find('>ul').attr('style','');
						}
					}
				});
			}

			if ( wdHasChild.length ) {
				$(wdHasChild).each(function() {
					var z=this,arrow = '<span class="arrow-wd-down"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 294.1L383 167c9.4-9.4 24.6-9.4 33.9 0s9.3 24.6 0 34L273 345c-9.1 9.1-23.7 9.3-33.1.7L95 201.1c-4.7-4.7-7-10.9-7-17s2.3-12.3 7-17c9.4-9.4 24.6-9.4 33.9 0l127.1 127z"/></svg></span>';

					if ( $(z).find('>ul').length < 1 ) {
						return;
					}

					$(z).find('>ul').hide();

					if ( $(z).find('>.arrow-wd-down').length < 1 ) {
						$(arrow).insertAfter( $(z).find('>a') );
					} else {
						if ( $(z).find('>.arrow-wd-down').hasClass('rtt') ) {
							$(z).find('>ul').attr('style','');
						}
					}
				});
			}

			if ( wdCatsHasChild.length ) {
				$(wdCatsHasChild).each(function() {
					var z=this,arrow = '<span class="arrow-wd-down"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 294.1L383 167c9.4-9.4 24.6-9.4 33.9 0s9.3 24.6 0 34L273 345c-9.1 9.1-23.7 9.3-33.1.7L95 201.1c-4.7-4.7-7-10.9-7-17s2.3-12.3 7-17c9.4-9.4 24.6-9.4 33.9 0l127.1 127z"/></svg></span>';

					$(z).hide();

					if ( $(z).parent('li').find('>.arrow-wd-down').length < 1 ) {
						$(arrow).insertAfter( $(z).parent('li').find('>a') );
					} else {
						if ( $(z).parent('li').find('>.arrow-wd-down').hasClass('rtt') ) {
							$(z).attr('style','');
						}
					}
				});
			}

			$('.arrow-wd-down').each(function() {
				var ayd = this;
				$(ayd).off().on('click', function(e) {
					e.preventDefault();
					if ( ! $(this).hasClass('rtt') ) {
						$(ayd).parent('li').find('>ul').slideDown(200);
						$(this).addClass('rtt');
					} else {
						$(ayd).parent('li').find('>ul').slideUp(200);
						$(this).removeClass('rtt');
					}
				});
			});

			/**
			 * Version 1.1.0
			 * always use custom scrollbar for menu,
			 * to hide bad scrollbar in IE
			 */
			if ( menuElem ) {
				var menuScroll = window.Scrollbar;
				var menuScrollbar = menuScroll.init(menuElem);

				$('.arrow-yuk-down').each(function() {
					var ayd = this;
					$(ayd).off().on('click', function(e) {
						e.preventDefault();
						if ( ! $(this).hasClass('rtt') ) {
							$(ayd).parent('li').find('>ul').slideDown(200);
							$(this).addClass('rtt');
						} else {
							$(ayd).parent('li').find('>ul').slideUp(200);
							$(this).removeClass('rtt');
						}
						// Version 1.2.3 - Fix the jumping menus
						menuScrollbar.update();
					});
				});
			}
		},
		setActiveMenu: function() {
			var t=this, uri=window.location.href;

			$('ul#aiteko-nav').find('.current-menu-item').removeClass('current-menu-item');
			if ( $('ul#aiteko-nav').find('a[href="'+uri+'"]').length ) {
				var item = $('ul#aiteko-nav').find('a[href="'+uri+'"]');
				$(item).parent('li').addClass('current-menu-item');
			}
		},
		socialBtn: function() {
			var t=this,
				btn=$('.aiteko-social__button'),
				defSvg=btn.html(),
				closeSvg='<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M278.6 256l68.2-68.2c6.2-6.2 6.2-16.4 0-22.6-6.2-6.2-16.4-6.2-22.6 0L256 233.4l-68.2-68.2c-6.2-6.2-16.4-6.2-22.6 0-3.1 3.1-4.7 7.2-4.7 11.3 0 4.1 1.6 8.2 4.7 11.3l68.2 68.2-68.2 68.2c-3.1 3.1-4.7 7.2-4.7 11.3 0 4.1 1.6 8.2 4.7 11.3 6.2 6.2 16.4 6.2 22.6 0l68.2-68.2 68.2 68.2c6.2 6.2 16.4 6.2 22.6 0 6.2-6.2 6.2-16.4 0-22.6L278.6 256z"/></svg>',
				bar=$('.aiteko-social--list-wrap'),
				onAnimate = false;

			btn.unbind().on('click', function(e) {
				e.preventDefault();

				if ( onAnimate ) {
					return false;
				}

				onAnimate = true;
				if ( bar.hasClass('social_show') ) {
					anime({
						targets: '.aiteko-social--list-wrap',
						width: ['100%', '0%'],
						duration: 500,
						elasticity: 50,
						easing: 'easeInOutCirc',
						complete: function() {
							bar.removeClass('social_show');
							onAnimate=false;
							btn.html(defSvg);
						}
					});
				} else {
					anime({
						targets: '.aiteko-social--list-wrap',
						width: ['0%', '100%'],
						duration: 500,
						elasticity: 50,
						easing: 'easeInOutCirc',
						complete: function() {
							bar.addClass('social_show');
							onAnimate=false;
							btn.html(closeSvg);
						}
					});
				}
			});
		},
		commentBeauty: function() {
			var t=this, comm = $('#respond');

			if ( comm.length ) {
				var form = $('form#commentform');
				form.addClass('is_hidden');
				form.find('.comment-form-comment').append('<a id="js-cancel-comment">cancel</a>');
				if ( $('.logged-in-as').length ) {
					$('.logged-in-as').insertAfter( $('.comment-form-comment') );
				}

				form.on('click', function(e) {
					if ( e.target.id === 'js-cancel-comment' ) {
						return false;
					}
					if ( form.hasClass('is_hidden') ) {
						form.stop().animate({height: '486px'}, 200, function(){
							$(this).removeClass('is_hidden');
							$('#js-cancel-comment').show();
							window.setTimeout(function(){
								form.removeAttr('style');
							}, 200);
						});
					}
				});

				form.find('textarea').on('focus', function(){
					if ( form.hasClass('is_hidden') ) {
						form.stop().animate({height: '486px'}, 200, function(){
							$(this).removeAttr('style').removeClass('is_hidden');
							if ( comm.parent('li').length ) {
								$('#js-cancel-comment').hide();
							} else {	
								$('#js-cancel-comment').show();
							}
						});
					}
				});

				$('#js-cancel-comment').on('click', function(e) {
					e.preventDefault();
					if ( ! form.hasClass('is_hidden') ) {
						form.removeAttr('style').addClass('is_hidden');
						$(this).hide();
					}
				});

				$('#cancel-comment-reply-link').on('click', function(e) {
					if ( ! form.hasClass('is_hidden') ) {
						form.removeAttr('style').addClass('is_hidden');
						$('#js-cancel-comment').hide();
					}
				});

				form.on('submit', function(e) {
					e.preventDefault();
					var target = form.attr('action'),
						commentData = form.serialize(),
						commParent = $('#respond').parent(),
						replying = false;

					if ( form.hasClass('comment_loading') ) {
						return false;
					}

					if ( $(commParent).hasClass('comment') ) {
						replying = true;
					}

					$.ajax({
						type : 'POST',
						url : target,
						data : commentData,
						beforeSend: function(xhr) {
							form.addClass('comment_loading');
						},
						error: function (request, status, error) {
							console.log( status );
						},
						success: function( resp ) {
							var $commentLists = $("<div>").html(resp).find( '#comment-contain-container' ),
								$commentTitle = $("<div>").html(resp).find('h3.comments-title'),
								$main_content = $("<div>").html(resp).find('#main'),
								elem = document.querySelector('.aiteko-content-container');


							$('#cancel-comment-reply-link').trigger('click');
							if ( $('#comment-contain-container').length ) {
								$('#comment-contain-container').animate({ opacity: 0 }, 300, function() {
									$('#comment-contain-container').html( $commentLists.html() );
									anime({
										targets: '#comment-contain-container',
										opacity: [0,1],
										duration: 300,
									});
								});
							} else {
								$($commentLists).insertAfter( $('#respond') );
							}

							if ( $('h3.comments-title').length ) {
								$('h3.comments-title').html( $commentTitle.html() );
							} else {
								$($commentTitle).insertBefore( $('#respond') );
							}

							form.removeClass('comment_loading');
							form.find('input[type="text"], input[type="email"], input[type="url"], textarea#comment').val('');

							if ( ! replying ) {
								var lastComment = $('ol.comment-list').find('>li:last-child');

								if ( $(lastComment).length ) {
									var ccid = $(lastComment)[0].id;
									window.scrollTo(0, $(lastComment).offset().top );
								}
							}

							if ( history.state ) {
								if ( typeof history.state.main_content !== 'undefined' ) {
									var stateData = history.state;

									stateData['main_content'] = $main_content.html();

									history.replaceState( stateData, stateData['doc_title'], '');
								}
							}
						}
					});
				});
			}
		},
		mediaPlayerSkin: function() {
			var t=this;

			if ( typeof MediaElementPlayer !== 'undefined' ) {
				var settings = window._wpmejsSettings || {};
				settings.features = settings.features || mejs.MepDefaults.features;
				settings.features.push( 'exampleclass' );
				MediaElementPlayer.prototype.buildexampleclass = function( player ) {
					player.container.addClass( 'aiteko-mejs-container' );
				};
			}
		},
		miscFunctions: function() {
			var t=this, mediaSettings=false;


			if ( typeof MediaElementPlayer !== 'undefined' ) {
				mediaSettings = window._wpmejsSettings || {};
				mediaSettings.features = mediaSettings.features || mejs.MepDefaults.features;
				mediaSettings.features.push( 'exampleclass' );
				MediaElementPlayer.prototype.buildexampleclass = function( player ) {
					$('#'+player.id).addClass( 'aiteko-mejs-container' );
				};
			}

			if ( $('audio').length ) {
				if ( typeof MediaElementPlayer === 'undefined' ) {
					return false;
				}

				$('audio').each( function(i) {
					var pr = $(this).parent();
					if ( pr[0].nodeName.toLowerCase() === 'mediaelementwrapper' ) {
						return;
					}

					$(this).attr('id', 'aiteko-audio'+i );

					$('#aiteko-audio'+i).mediaelementplayer(mediaSettings);
				});
			}

			if ( $('video').length ) {
				if ( typeof MediaElementPlayer === 'undefined' ) {
					return false;
				}

				$('video').each( function(vi) {
					var vpr = $(this).parent();
					if ( vpr[0].nodeName.toLowerCase() === 'mediaelementwrapper' ) {
						return;
					}
					if ( $(this).hasClass('wp-block-cover__video-background') ) {
						return;
					}

					if ( $(this).hasClass('elementor-html5-video') || $(this).hasClass('elementor-video') ) {
						return;
					}

					$(this).attr('id', 'aiteko-video'+vi ).attr('width', '640').attr('height', '362').attr('preload', 'true').css({ width: '100%', height: '100%'});

					$('#aiteko-video'+vi).mediaelementplayer(mediaSettings);
				});
			}

			if ( $('.wp-block-gallery').length ) {
				$('.wp-block-gallery').each(function(z) {
					var f=this,mgin = 'wip-gal-'+z, gal=false;
					if ( $(f).find('a').length ) {
						$(f).find('a').each( function(i, el) {
							var href_value = el.href;
							if (/\.(jpg|jpeg|png|gif)$/.test(href_value)) {
								gal=true;
							}
						});

						if ( gal ) {
							$(f).magnificPopup({
								delegate: 'a',
								type: 'image',
								removalDelay: 300,
								mainClass: 'mfp-fade',
								gallery:{
									enabled:true
								}
							});
						}
					}
				});
			}

			if ( $('.widget_media_gallery').length ) {
				$('.widget_media_gallery').each(function(z) {
					var f=this,mgin = 'wip-gal-'+z, gal=false;
					if ( $(f).find('a').length ) {
						$(f).find('a').each( function(i, el) {
							var href_value = el.href;
							if (/\.(jpg|jpeg|png|gif)$/.test(href_value)) {
								gal=true;
							}
						});

						if ( gal ) {
							$(f).magnificPopup({
								delegate: 'a',
								type: 'image',
								removalDelay: 300,
								mainClass: 'mfp-fade',
								gallery:{
									enabled:true
								}
							});
						}
					}
				});
			}

			if ( $('.elementor-element').length < 1 ) {
				$('a').each( function(i, el) {
					var x=this, href_value = el.href;
					if ( t.checkParentIs(x, 'wp-block-gallery') || t.checkParentIs(x, 'gallery') ) {
						return;
					}
					if (/\.(jpg|jpeg|png|gif)$/.test(href_value)) {
						$(x).magnificPopup({
							type: 'image',
							closeOnContentClick: true,
							removalDelay: 300,
							mainClass: 'mfp-fade',
							image: {
								verticalFit: true
							},
						});
					}
				});		
			}
		},
		checkParentIs: function(el, classname ) {
			var t=this, gotcha=false, deepCheck;

			deepCheck = $(el).parents().map(function(){
				if ( $(this).hasClass( classname ) ) {
					return "yes";
				}
				return "no";
			}).get().join( ", " );

			if ( deepCheck.indexOf("yes") !== -1 ) {
				gotcha = true;
			}

			return gotcha;
		},
		overflowDoit: function() {
			var t=this, xss;

			xss = $('pre, code');
			xss.on( 'touchmove mousewheel wheel', function(e) {
				e.stopPropagation();
			});
		},
		getItems: function (items, itemKey) {
			var t=this;
			if (itemKey) {
				var keyStack = itemKey.split('.'),
				    currentKey = keyStack.splice(0, 1);

				if (!keyStack.length) {
					return items[currentKey];
				}

				if (!items[currentKey]) {
					return;
				}

				return t.getItems(items[currentKey], keyStack.join('.'));
			}

			return items;
		},
		wpcf7Reinit: function() {
			var t=this;

			if ( typeof wpcf7 === 'undefined' || wpcf7 === null ) {
				return;
			}

			wpcf7 = $.extend( {
				cached: 0,
				inputs: []
			}, wpcf7 );
			
			wpcf7.supportHtml5 = ( function() {
				var features = {};
				var input = document.createElement( 'input' );

				features.placeholder = 'placeholder' in input;

				var inputTypes = [ 'email', 'url', 'tel', 'number', 'range', 'date' ];

				$.each( inputTypes, function( index, value ) {
					input.setAttribute( 'type', value );
					features[ value ] = input.type !== 'text';
				} );

				return features;
			} )();

			wpcf7.getId = function( form ) {
				return parseInt( $( 'input[name="_wpcf7"]', form ).val(), 10 );
			};

			wpcf7.initForm = function( form ) {
				var $form = $( form );

				wpcf7.setStatus( $form, 'init' );

				$form.submit( function( event ) {
					if ( ! wpcf7.supportHtml5.placeholder ) {
						$( '[placeholder].placeheld', $form ).each( function( i, n ) {
							$( n ).val( '' ).removeClass( 'placeheld' );
						} );
					}

					if ( typeof window.FormData === 'function' ) {
						wpcf7.submit( $form );
						event.preventDefault();
					}
				} );

				$( '.wpcf7-submit', $form ).after( '<span class="ajax-loader"></span>' );

				wpcf7.toggleSubmit( $form );

				$form.on( 'click', '.wpcf7-acceptance', function() {
					wpcf7.toggleSubmit( $form );
				} );

				// Exclusive Checkbox
				$( '.wpcf7-exclusive-checkbox', $form ).on( 'click', 'input:checkbox', function() {
					var name = $( this ).attr( 'name' );
					$form.find( 'input:checkbox[name="' + name + '"]' ).not( this ).prop( 'checked', false );
				} );

				// Free Text Option for Checkboxes and Radio Buttons
				$( '.wpcf7-list-item.has-free-text', $form ).each( function() {
					var $freetext = $( ':input.wpcf7-free-text', this );
					var $wrap = $( this ).closest( '.wpcf7-form-control' );

					if ( $( ':checkbox, :radio', this ).is( ':checked' ) ) {
						$freetext.prop( 'disabled', false );
					} else {
						$freetext.prop( 'disabled', true );
					}

					$wrap.on( 'change', ':checkbox, :radio', function() {
						var $cb = $( '.has-free-text', $wrap ).find( ':checkbox, :radio' );

						if ( $cb.is( ':checked' ) ) {
							$freetext.prop( 'disabled', false ).focus();
						} else {
							$freetext.prop( 'disabled', true );
						}
					} );
				} );

				// Placeholder Fallback
				if ( ! wpcf7.supportHtml5.placeholder ) {
					$( '[placeholder]', $form ).each( function() {
						$( this ).val( $( this ).attr( 'placeholder' ) );
						$( this ).addClass( 'placeheld' );

						$( this ).focus( function() {
							if ( $( this ).hasClass( 'placeheld' ) ) {
								$( this ).val( '' ).removeClass( 'placeheld' );
							}
						} );

						$( this ).blur( function() {
							if ( '' === $( this ).val() ) {
								$( this ).val( $( this ).attr( 'placeholder' ) );
								$( this ).addClass( 'placeheld' );
							}
						} );
					} );
				}

				if ( wpcf7.jqueryUi && ! wpcf7.supportHtml5.date ) {
					$form.find( 'input.wpcf7-date[type="date"]' ).each( function() {
						$( this ).datepicker( {
							dateFormat: 'yy-mm-dd',
							minDate: new Date( $( this ).attr( 'min' ) ),
							maxDate: new Date( $( this ).attr( 'max' ) )
						} );
					} );
				}

				if ( wpcf7.jqueryUi && ! wpcf7.supportHtml5.number ) {
					$form.find( 'input.wpcf7-number[type="number"]' ).each( function() {
						$( this ).spinner( {
							min: $( this ).attr( 'min' ),
							max: $( this ).attr( 'max' ),
							step: $( this ).attr( 'step' )
						} );
					} );
				}

				// Character Count
				wpcf7.resetCounter( $form );

				// URL Input Correction
				$form.on( 'change', '.wpcf7-validates-as-url', function() {
					var val = $.trim( $( this ).val() );

					if ( val
					&& ! val.match( /^[a-z][a-z0-9.+-]*:/i )
					&& -1 !== val.indexOf( '.' ) ) {
						val = val.replace( /^\/+/, '' );
						val = 'http://' + val;
					}

					$( this ).val( val );
				} );
			};

			wpcf7.submit = function( form ) {
				if ( typeof window.FormData !== 'function' ) {
					return;
				}

				var $form = $( form );

				$( '.ajax-loader', $form ).addClass( 'is-active' );
				wpcf7.clearResponse( $form );

				var formData = new FormData( $form.get( 0 ) );

				var detail = {
					id: $form.closest( 'div.wpcf7' ).attr( 'id' ),
					status: 'init',
					inputs: [],
					formData: formData
				};

				$.each( $form.serializeArray(), function( i, field ) {
					if ( '_wpcf7' == field.name ) {
						detail.contactFormId = field.value;
					} else if ( '_wpcf7_version' == field.name ) {
						detail.pluginVersion = field.value;
					} else if ( '_wpcf7_locale' == field.name ) {
						detail.contactFormLocale = field.value;
					} else if ( '_wpcf7_unit_tag' == field.name ) {
						detail.unitTag = field.value;
					} else if ( '_wpcf7_container_post' == field.name ) {
						detail.containerPostId = field.value;
					} else if ( field.name.match( /^_/ ) ) {
						// do nothing
					} else {
						detail.inputs.push( field );
					}
				} );

				wpcf7.triggerEvent( $form.closest( 'div.wpcf7' ), 'beforesubmit', detail );

				var ajaxSuccess = function( data, status, xhr, $form ) {
					detail.id = $( data.into ).attr( 'id' );
					detail.status = data.status;
					detail.apiResponse = data;

					switch ( data.status ) {
						case 'init':
							wpcf7.setStatus( $form, 'init' );
							break;
						case 'validation_failed':
							$.each( data.invalid_fields, function( i, n ) {
								$( n.into, $form ).each( function() {
									wpcf7.notValidTip( this, n.message );
									$( '.wpcf7-form-control', this ).addClass( 'wpcf7-not-valid' );
									$( '[aria-invalid]', this ).attr( 'aria-invalid', 'true' );
								} );
							} );

							wpcf7.setStatus( $form, 'invalid' );
							wpcf7.triggerEvent( data.into, 'invalid', detail );
							break;
						case 'acceptance_missing':
							wpcf7.setStatus( $form, 'unaccepted' );
							wpcf7.triggerEvent( data.into, 'unaccepted', detail );
							break;
						case 'spam':
							wpcf7.setStatus( $form, 'spam' );
							wpcf7.triggerEvent( data.into, 'spam', detail );
							break;
						case 'aborted':
							wpcf7.setStatus( $form, 'aborted' );
							wpcf7.triggerEvent( data.into, 'aborted', detail );
							break;
						case 'mail_sent':
							wpcf7.setStatus( $form, 'sent' );
							wpcf7.triggerEvent( data.into, 'mailsent', detail );
							break;
						case 'mail_failed':
							wpcf7.setStatus( $form, 'failed' );
							wpcf7.triggerEvent( data.into, 'mailfailed', detail );
							break;
						default:
							wpcf7.setStatus( $form,
								'custom-' + data.status.replace( /[^0-9a-z]+/i, '-' )
							);
					}

					wpcf7.refill( $form, data );

					wpcf7.triggerEvent( data.into, 'submit', detail );

					if ( 'mail_sent' == data.status ) {
						$form.each( function() {
							this.reset();
						} );

						wpcf7.toggleSubmit( $form );
						wpcf7.resetCounter( $form );
					}

					if ( ! wpcf7.supportHtml5.placeholder ) {
						$form.find( '[placeholder].placeheld' ).each( function( i, n ) {
							$( n ).val( $( n ).attr( 'placeholder' ) );
						} );
					}

					$( '.wpcf7-response-output', $form )
						.html( '' ).append( data.message ).slideDown( 'fast' );

					$( '.screen-reader-response', $form.closest( '.wpcf7' ) ).each( function() {
						var $response = $( this );
						$response.html( '' ).append( data.message );

						if ( data.invalid_fields ) {
							var $invalids = $( '<ul></ul>' );

							$.each( data.invalid_fields, function( i, n ) {
								if ( n.idref ) {
									var $li = $( '<li></li>' ).append( $( '<a></a>' ).attr( 'href', '#' + n.idref ).append( n.message ) );
								} else {
									var $li = $( '<li></li>' ).append( n.message );
								}

								$invalids.append( $li );
							} );

							$response.append( $invalids );
						}

						$response.focus();
					} );

					if ( data.posted_data_hash ) {
						$form.find( 'input[name="_wpcf7_posted_data_hash"]' ).first()
							.val( data.posted_data_hash );
					}
				};

				$.ajax( {
					type: 'POST',
					url: wpcf7.apiSettings.getRoute(
						'/contact-forms/' + wpcf7.getId( $form ) + '/feedback' ),
					data: formData,
					dataType: 'json',
					processData: false,
					contentType: false
				} ).done( function( data, status, xhr ) {
					ajaxSuccess( data, status, xhr, $form );
					$( '.ajax-loader', $form ).removeClass( 'is-active' );
				} ).fail( function( xhr, status, error ) {
					var $e = $( '<div class="ajax-error"></div>' ).text( error.message );
					$form.after( $e );
				} );
			};

			wpcf7.triggerEvent = function( target, name, detail ) {
				var event = new CustomEvent( 'wpcf7' + name, {
					bubbles: true,
					detail: detail
				} );

				$( target ).get( 0 ).dispatchEvent( event );
			};

			wpcf7.setStatus = function( form, status ) {
				var $form = $( form );
				var prevStatus = $form.data( 'status' );

				$form.data( 'status', status );
				$form.addClass( status );

				if ( prevStatus && prevStatus !== status ) {
					$form.removeClass( prevStatus );
				}
			}

			wpcf7.toggleSubmit = function( form, state ) {
				var $form = $( form );
				var $submit = $( 'input:submit', $form );

				if ( typeof state !== 'undefined' ) {
					$submit.prop( 'disabled', ! state );
					return;
				}

				if ( $form.hasClass( 'wpcf7-acceptance-as-validation' ) ) {
					return;
				}

				$submit.prop( 'disabled', false );

				$( '.wpcf7-acceptance', $form ).each( function() {
					var $span = $( this );
					var $input = $( 'input:checkbox', $span );

					if ( ! $span.hasClass( 'optional' ) ) {
						if ( $span.hasClass( 'invert' ) && $input.is( ':checked' )
						|| ! $span.hasClass( 'invert' ) && ! $input.is( ':checked' ) ) {
							$submit.prop( 'disabled', true );
							return false;
						}
					}
				} );
			};

			wpcf7.resetCounter = function( form ) {
				var $form = $( form );

				$( '.wpcf7-character-count', $form ).each( function() {
					var $count = $( this );
					var name = $count.attr( 'data-target-name' );
					var down = $count.hasClass( 'down' );
					var starting = parseInt( $count.attr( 'data-starting-value' ), 10 );
					var maximum = parseInt( $count.attr( 'data-maximum-value' ), 10 );
					var minimum = parseInt( $count.attr( 'data-minimum-value' ), 10 );

					var updateCount = function( target ) {
						var $target = $( target );
						var length = $target.val().length;
						var count = down ? starting - length : length;
						$count.attr( 'data-current-value', count );
						$count.text( count );

						if ( maximum && maximum < length ) {
							$count.addClass( 'too-long' );
						} else {
							$count.removeClass( 'too-long' );
						}

						if ( minimum && length < minimum ) {
							$count.addClass( 'too-short' );
						} else {
							$count.removeClass( 'too-short' );
						}
					};

					$( ':input[name="' + name + '"]', $form ).each( function() {
						updateCount( this );

						$( this ).keyup( function() {
							updateCount( this );
						} );
					} );
				} );
			};

			wpcf7.notValidTip = function( target, message ) {
				var $target = $( target );
				$( '.wpcf7-not-valid-tip', $target ).remove();

				$( '<span></span>' ).attr( {
					'class': 'wpcf7-not-valid-tip',
					'role': 'alert',
					'aria-hidden': 'true',
				} ).text( message ).appendTo( $target );

				if ( $target.is( '.use-floating-validation-tip *' ) ) {
					var fadeOut = function( target ) {
						$( target ).not( ':hidden' ).animate( {
							opacity: 0
						}, 'fast', function() {
							$( this ).css( { 'z-index': -100 } );
						} );
					};

					$target.on( 'mouseover', '.wpcf7-not-valid-tip', function() {
						fadeOut( this );
					} );

					$target.on( 'focus', ':input', function() {
						fadeOut( $( '.wpcf7-not-valid-tip', $target ) );
					} );
				}
			};

			wpcf7.refill = function( form, data ) {
				var $form = $( form );

				var refillCaptcha = function( $form, items ) {
					$.each( items, function( i, n ) {
						$form.find( ':input[name="' + i + '"]' ).val( '' );
						$form.find( 'img.wpcf7-captcha-' + i ).attr( 'src', n );
						var match = /([0-9]+)\.(png|gif|jpeg)$/.exec( n );
						$form.find( 'input:hidden[name="_wpcf7_captcha_challenge_' + i + '"]' ).attr( 'value', match[ 1 ] );
					} );
				};

				var refillQuiz = function( $form, items ) {
					$.each( items, function( i, n ) {
						$form.find( ':input[name="' + i + '"]' ).val( '' );
						$form.find( ':input[name="' + i + '"]' ).siblings( 'span.wpcf7-quiz-label' ).text( n[ 0 ] );
						$form.find( 'input:hidden[name="_wpcf7_quiz_answer_' + i + '"]' ).attr( 'value', n[ 1 ] );
					} );
				};

				if ( typeof data === 'undefined' ) {
					$.ajax( {
						type: 'GET',
						url: wpcf7.apiSettings.getRoute(
							'/contact-forms/' + wpcf7.getId( $form ) + '/refill' ),
						beforeSend: function( xhr ) {
							var nonce = $form.find( ':input[name="_wpnonce"]' ).val();

							if ( nonce ) {
								xhr.setRequestHeader( 'X-WP-Nonce', nonce );
							}
						},
						dataType: 'json'
					} ).done( function( data, status, xhr ) {
						if ( data.captcha ) {
							refillCaptcha( $form, data.captcha );
						}

						if ( data.quiz ) {
							refillQuiz( $form, data.quiz );
						}
					} );

				} else {
					if ( data.captcha ) {
						refillCaptcha( $form, data.captcha );
					}

					if ( data.quiz ) {
						refillQuiz( $form, data.quiz );
					}
				}
			};

			wpcf7.clearResponse = function( form ) {
				var $form = $( form );
				$form.siblings( '.screen-reader-response' ).html( '' );

				$( '.wpcf7-not-valid-tip', $form ).remove();
				$( '[aria-invalid]', $form ).attr( 'aria-invalid', 'false' );
				$( '.wpcf7-form-control', $form ).removeClass( 'wpcf7-not-valid' );

				$( '.wpcf7-response-output', $form ).hide().empty();
			};

			wpcf7.apiSettings.getRoute = function( path ) {
				var url = wpcf7.apiSettings.root;

				url = url.replace(
					wpcf7.apiSettings.namespace,
					wpcf7.apiSettings.namespace + path );

				return url;
			};

			if ( typeof wpcf7_recaptcha !== 'undefined' && typeof wpcf7_recaptcha.execute !== 'function' ) {
				wpcf7_recaptcha = wpcf7_recaptcha || {};
				wpcf7_recaptcha.execute = function( action ) {
					grecaptcha.execute(
						wpcf7_recaptcha.sitekey,
						{ action: action }
					).then( function( token ) {
						var event = new CustomEvent( 'wpcf7grecaptchaexecuted', {
							detail: {
								action: action,
								token: token,
							},
						} );

						document.dispatchEvent( event );
					} );
				};
			}

			$( 'div.wpcf7 > form' ).each( function() {
				var $form = $( this );
				wpcf7.initForm( $form );

				if ( wpcf7.cached ) {
					wpcf7.refill( $form );
				}
			} );
		}
	};
	z.init();
	return z;
}(window.jQuery);
