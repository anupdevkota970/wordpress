var FPC = FPC || {};

(function ($) {

	// USE STRICT
	"use strict";

	var $window = $(window);
	var $document = $(document);
	var $goToTopEl = $('.js-go-top-el');
	var $overlayBg = $('.js-overlay-bg');

	FPC.header = {

		init: function () {
			FPC.header.ajaxSearch();
			FPC.header.loginForm();
			FPC.header.offCanvasMenu();
			FPC.header.priorityNavInit();
			FPC.header.searchToggle();
			FPC.header.smartAffix.init({
				fixedHeader: '.js-sticky-header',
				headerPlaceHolder: '.js-sticky-header-holder',
			});
		},

		/* ============================================================================
		 * Fix sticky navbar padding when open modal
		 * ==========================================================================*/
		stickyNavbarPadding: function () {
			var oldSSB = $.fn.modal.Constructor.prototype.setScrollbar;
			var $stickyHeader = $('.sticky-header .navigation-bar');

			$.fn.modal.Constructor.prototype.setScrollbar = function () {
				oldSSB.apply(this);
				if (this.bodyIsOverflowing && this.scrollbarWidth) {
					$stickyHeader.css('padding-right', this.scrollbarWidth);
				}
			}

			var oldRSB = $.fn.modal.Constructor.prototype.resetScrollbar;
			$.fn.modal.Constructor.prototype.resetScrollbar = function () {
				oldRSB.apply(this);
				$stickyHeader.css('padding-right', '');
			}
		},

		/* ============================================================================
		 * Header dropdown search
		 * ==========================================================================*/
		searchToggle: function () {
			var $headerSearchDropdown = $('#header-search-dropdown');
			var $searchDropdownToggle = $('.js-search-dropdown-toggle');
			var $mobileHeader = $('#fpc-mobile-header');
			var $stickyHeaderNav = $('#fpc-sticky-header').find('.navigation-bar__inner');
			var $staticHeaderNav = $('.site-header').find('.navigation-bar__inner');
			var $headerSearchDropdownInput = $headerSearchDropdown.find('.search-form__input');

			$headerSearchDropdown.on('click', function (e) {
				e.stopPropagation();
			});

			$searchDropdownToggle.on('click', function (e) {
				e.stopPropagation();
				var $toggleBtn = $(this);
				var position = '';


				if ($toggleBtn.hasClass('mobile-header-btn')) {
					position = 'mobile';
				} else if ($toggleBtn.parents('.sticky-header').length) {
					position = 'sticky';
				} else {
					position = 'navbar';
				}

				if ($headerSearchDropdown.hasClass('is-in-' + position) || !$headerSearchDropdown.hasClass('is-active')) {
					$headerSearchDropdown.toggleClass('is-active');
				}

				switch (position) {
					case 'mobile':
						if (!$headerSearchDropdown.hasClass('is-in-mobile')) {
							$headerSearchDropdown.addClass('is-in-mobile');
							$headerSearchDropdown.removeClass('is-in-sticky');
							$headerSearchDropdown.removeClass('is-in-navbar');
							$headerSearchDropdown.appendTo($mobileHeader);
						}
						break;

					case 'sticky':
						if (!$headerSearchDropdown.hasClass('is-in-sticky')) {
							$headerSearchDropdown.addClass('is-in-sticky');
							$headerSearchDropdown.removeClass('is-in-mobile');
							$headerSearchDropdown.removeClass('is-in-navbar');
							$headerSearchDropdown.insertAfter($stickyHeaderNav);
						}
						break;

					default:
						if (!$headerSearchDropdown.hasClass('is-in-navbar')) {
							$headerSearchDropdown.addClass('is-in-navbar');
							$headerSearchDropdown.removeClass('is-in-sticky');
							$headerSearchDropdown.removeClass('is-in-mobile');
							$headerSearchDropdown.insertAfter($staticHeaderNav);
						}
				}

				if ($headerSearchDropdown.hasClass('is-active')) {
					setTimeout(function () {
						$headerSearchDropdownInput.focus();
					}, 200);
				}
			});

			$document.on('click', function () {
				$headerSearchDropdown.removeClass('is-active');
			});

			$window.on('stickyHeaderHidden', function () {
				if ($headerSearchDropdown.hasClass('is-in-sticky')) {
					$headerSearchDropdown.removeClass('is-active');
				}
			});
		},

		/* ============================================================================
		 * AJAX search
		 * ==========================================================================*/
		ajaxSearch: function () {
			var $results = null;
			var $ajaxSearch = $('.js-ajax-search');
			var ajaxStatus = '';
			var noResultText = '<span class="noresult-text">There is no result.</span>';
			var errorText = '<span class="error-text">There was some error.</span>';

			$ajaxSearch.each(function () {
				var $this = $(this);
				var $searchForm = $this.find('.search-form__input');
				var $resultsContainer = $this.find('.search-results');
				var $resultsInner = $this.find('.search-results__inner');
				var searchTerm = '';
				var lastSearchTerm = '';

				$searchForm.on('input', $.debounce(800, function () {
					searchTerm = $searchForm.val();

					if (searchTerm.length > 0) {
						$resultsContainer.addClass('is-active');

						if ((searchTerm != lastSearchTerm) || (ajaxStatus === 'failed')) {
							$resultsContainer.removeClass('is-error').addClass('is-loading');
							lastSearchTerm = searchTerm;
							ajaxLoad(searchTerm, $resultsContainer, $resultsInner);
						}
					} else {
						$resultsContainer.removeClass('is-active');
					}
				}));
			});

			function ajaxLoad(searchTerm, $resultsContainer, $resultsInner) {
				var ajaxCall = $.ajax({
					url: "inc/ajax-search.html",
					type: 'post',
					dataType: 'html',
					data: {
						searchTerm: searchTerm,
					},
				});

				ajaxCall.done(function (respond) {
					$results = $(respond);
					ajaxStatus = 'success';
					if (!$results.length) {
						$results = noResultText;
					}
					$resultsInner.html($results).css('opacity', 0).animate({ opacity: 1 }, 500);
				});

				ajaxCall.fail(function () {
					ajaxStatus = 'failed';
					$resultsContainer.addClass('is-error');
					$results = errorText;
					$resultsInner.html($results).css('opacity', 0).animate({ opacity: 1 }, 500);
				});

				ajaxCall.always(function () {
					$resultsContainer.removeClass('is-loading');
				});
			}
		},

		/* ============================================================================
		 * Login Form tabs
		 * ==========================================================================*/
		loginForm: function () {
			var $loginFormTabsLinks = $('.js-login-form-tabs').find('a');

			$loginFormTabsLinks.on('click', function (e) {
				e.preventDefault()
				$(this).tab('show');
			});
		},

		/* ============================================================================
		 * Offcanvas Menu
		 * ==========================================================================*/
		offCanvasMenu: function () {
			var $backdrop = $('<div class="fpc-offcanvas-backdrop"></div>');
			var $offCanvas = $('.js-fpc-offcanvas');
			var $offCanvasToggle = $('.js-fpc-offcanvas-toggle');
			var $offCanvasClose = $('.js-fpc-offcanvas-close');
			var $offCanvasMenuHasChildren = $('.navigation--offcanvas').find('li.menu-item-has-children > a');
			//var menuExpander = ('<div class="submenu-toggle"><i class="mdicon mdicon-expand_more"></i></div>');

			$backdrop.on('click', function () {
				$offCanvas.removeClass('is-active');
				$(this).fadeOut(200, function () {
					$(this).detach();
				});
			});

			$offCanvasToggle.on('click', function (e) {
				e.preventDefault();
				var targetID = $(this).attr('href');
				var $target = $(targetID);
				$target.toggleClass('is-active');
				$backdrop.hide().appendTo(document.body).fadeIn(200);
				$("#menu-offcanvas-menu>li:first-child>a").focus();
			});

			$offCanvasClose.on('click', function (e) {
				e.preventDefault();
				var targetID = $(this).attr('href');
				var $target = $(targetID);
				$target.removeClass('is-active');
				$backdrop.fadeOut(200, function () {
					$(this).detach();
				});
				$(".header-logo a")[0].focus();
			});

			$('.submenu-toggle').on('click', function (e) {
				e.preventDefault();
				var $subMenu = $(this).siblings('.sub-menu');

				$subMenu.slideToggle(200);
			});
		},

		/* ============================================================================
		 * Prority+ menu init
		 * ==========================================================================*/
		priorityNavInit: function () {
			var $menus = $('.js-priority-nav');
			$menus.each(function () {
				FPC.priorityNav($(this));
			})
		},

		/* ============================================================================
		 * Smart sticky header
		 * ==========================================================================*/
		smartAffix: {
			//settings
			$headerPlaceHolder: null, //the affix menu (this element will get the mdAffixed)
			$fixedHeader: null, //the menu wrapper / placeholder
			isDestroyed: false,
			isDisabled: false,
			isFixed: false, //the current state of the menu, true if the menu is affix
			isShown: false,
			windowScrollTop: 0,
			lastWindowScrollTop: 0, //last scrollTop position, used to calculate the scroll direction
			offCheckpoint: 0, // distance from top where fixed header will be hidden
			onCheckpoint: 0, // distance from top where fixed header can show up
			breakpoint: 992, // media breakpoint in px that it will be disabled

			init: function init(options) {

				//read the settings
				this.$fixedHeader = $(options.fixedHeader);
				this.$headerPlaceHolder = $(options.headerPlaceHolder);

				// Check if selectors exist.
				if (!this.$fixedHeader.length || !this.$headerPlaceHolder.length) {
					this.isDestroyed = true;
				} else if (!this.$fixedHeader.length || !this.$headerPlaceHolder.length || (FPC.documentOnResize.windowWidth <= FPC.header.smartAffix.breakpoint)) { // Check if device width is smaller than breakpoint.
					this.isDisabled = true;
				}

			},// end init

			compute: function compute() {
				if (FPC.header.smartAffix.isDestroyed || FPC.header.smartAffix.isDisabled) {
					return;
				}

				// Set where from top fixed header starts showing up
				if (this.$headerPlaceHolder) {
					if (!this.$headerPlaceHolder.length) {
						this.offCheckpoint = 400;
					} else {
						this.offCheckpoint = $(this.$headerPlaceHolder).offset().top + 400;
					}
				}

				this.onCheckpoint = this.offCheckpoint + 500;

				// Set menu top offset
				this.windowScrollTop = FPC.documentOnScroll.windowScrollTop;
				if (this.offCheckpoint < this.windowScrollTop) {
					this.isFixed = true;
				}
			},

			updateState: function updateState() {
				//update affixed state
				if (this.isFixed) {
					this.$fixedHeader.addClass('is-fixed');
				} else {

					if (this.$fixedHeader) {
						this.$fixedHeader.removeClass('is-fixed');
					}
					$window.trigger('stickyHeaderHidden');
				}

				if (this.isShown) {
					this.$fixedHeader.addClass('is-shown');
				} else {
					if (this.$fixedHeader) {
						this.$fixedHeader.removeClass('is-shown');
					}
				}
			},

			/**
			 * called by events on scroll
			 */
			eventScroll: function eventScroll(scrollTop) {

				var scrollDirection = '';
				var scrollDelta = 0;

				// check the direction
				if (scrollTop != this.lastWindowScrollTop) { //compute direction only if we have different last scroll top

					// compute the direction of the scroll
					if (scrollTop > this.lastWindowScrollTop) {
						scrollDirection = 'down';
					} else {
						scrollDirection = 'up';
					}

					//calculate the scroll delta
					scrollDelta = Math.abs(scrollTop - this.lastWindowScrollTop);
					this.lastWindowScrollTop = scrollTop;

					// update affix state
					if (this.offCheckpoint < scrollTop) {
						this.isFixed = true;
					} else {
						this.isFixed = false;
					}

					// check affix state
					if (this.isFixed) {
						// We're in affixed state, let's do some check
						if ((scrollDirection === 'down') && (scrollDelta > 14)) {
							if (this.isShown) {
								this.isShown = false; // hide menu
							}
						} else {
							if ((!this.isShown) && (scrollDelta > 14) && (this.onCheckpoint < scrollTop)) {
								this.isShown = true; // show menu
							}
						}
					} else {
						this.isShown = false;
					}

					this.updateState(); // update state
				}
			}, // end eventScroll function

			/**
			* called by events on resize
			*/
			eventResize: function eventResize(windowWidth) {
				// Check if device width is smaller than breakpoint.
				if (FPC.documentOnResize.windowWidth < FPC.header.smartAffix.breakpoint) {
					this.isDisabled = true;
				} else {
					this.isDisabled = false;
					FPC.header.smartAffix.compute();
				}
			}
		},
	};

	FPC.documentOnScroll = {
		ticking: false,
		windowScrollTop: 0, //used to store the scrollTop

		init: function () {
			window.addEventListener('scroll', function (e) {
				if (!FPC.documentOnScroll.ticking) {
					window.requestAnimationFrame(function () {
						FPC.documentOnScroll.windowScrollTop = $window.scrollTop();

						// Functions to call here
						if (!FPC.header.smartAffix.isDisabled && !FPC.header.smartAffix.isDestroyed) {
							FPC.header.smartAffix.eventScroll(FPC.documentOnScroll.windowScrollTop);
						}

						FPC.documentOnScroll.goToTopScroll(FPC.documentOnScroll.windowScrollTop);

						FPC.documentOnScroll.ticking = false;
					});
				}
				FPC.documentOnScroll.ticking = true;
			});
		},

		/* ============================================================================
		 * Go to top scroll event
		 * ==========================================================================*/
		goToTopScroll: function (windowScrollTop) {
			if ($goToTopEl.length) {
				if (windowScrollTop > 800) {
					if (!$goToTopEl.hasClass('is-active')) $goToTopEl.addClass('is-active');
				} else {
					$goToTopEl.removeClass('is-active');
				}
			}
		},
	};

	FPC.documentOnResize = {
		ticking: false,
		windowWidth: $window.width(),

		init: function () {
			window.addEventListener('resize', function (e) {
				if (!FPC.documentOnResize.ticking) {
					window.requestAnimationFrame(function () {
						FPC.documentOnResize.windowWidth = $window.width();

						// Functions to call here
						if (!FPC.header.smartAffix.isDestroyed) {
							FPC.header.smartAffix.eventResize(FPC.documentOnResize.windowWidth);
						}

						FPC.clippedBackground();

						FPC.documentOnResize.ticking = false;
					});
				}
				FPC.documentOnResize.ticking = true;
			});
		},
	};

	FPC.documentOnReady = {

		init: function () {
			FPC.header.init();
			FPC.header.smartAffix.compute();
			FPC.documentOnScroll.init();
			FPC.documentOnReady.ajaxLoadPost();
			FPC.documentOnReady.countdown();
			FPC.documentOnReady.goToTop();
			FPC.documentOnReady.newsTicker();
			FPC.documentOnReady.lightBox();
			FPC.documentOnReady.perfectScrollbarInit();
			FPC.documentOnReady.tooltipInit();
			FPC.documentOnReady.search();
		},

		/* ============================================================================
		 * AJAX load more posts
		 * ==========================================================================*/
		ajaxLoadPost: function () {
			var $loadedPosts = null;
			var $ajaxLoadPost = $('.js-ajax-load-post');

			function ajaxLoad(parameters, $postContainer) {
				var ajaxStatus = '',
					ajaxCall = $.ajax({
						url: "inc/ajax-load-post.html",
						type: 'post',
						dataType: 'html',
						data: {
							// action: 'ajax_load_post',
							offset: parameters.offset,
							postsToLoad: parameters.postsToLoad,
							// other parameters
						},
					});

				ajaxCall.done(function (respond) {
					$loadedPosts = $(respond);
					ajaxStatus = 'success';
					if ($loadedPosts) {
						$loadedPosts.appendTo($postContainer).css('opacity', 0).animate({ opacity: 1 }, 500);
					}
					$('html, body').animate({ scrollTop: $window.scrollTop() + 1 }, 0).animate({ scrollTop: $window.scrollTop() - 1 }, 0); // for recalculating of sticky sidebar
					// do stuff like changing parameters
				});

				ajaxCall.fail(function () {
					ajaxStatus = 'failed';
				});

				ajaxCall.always(function () {
					// do other stuff
				});
			}

			$ajaxLoadPost.each(function () {
				var $this = $(this);
				var $postContainer = $this.find('.posts-list');
				var $triggerBtn = $this.find('.js-ajax-load-post-trigger');
				var parameters = {
					offset: $this.data("offset"),
					postsToLoad: $this.data("posts-to-load"),
					layout: $this.data("layout"),
				};

				$triggerBtn.on('click', function () {
					ajaxLoad(parameters, $postContainer);
				});
			});
		},

		/* ============================================================================
		 * Countdown timer
		 * ==========================================================================*/
		countdown: function () {
			if ($.isFunction($.fn.countdown)) {
				var $countdown = $('.js-countdown');

				$countdown.each(function () {
					var $this = $(this);
					var finalDate = $this.data('countdown');

					$this.countdown(finalDate, function (event) {
						$(this).html(event.strftime(''
							+ '<div class="countdown__section"><span class="countdown__digit">%-D</span><span class="countdown__text meta-font">day%!D</span></div>'
							+ '<div class="countdown__section"><span class="countdown__digit">%H</span><span class="countdown__text meta-font">hr</span></div>'
							+ '<div class="countdown__section"><span class="countdown__digit">%M</span><span class="countdown__text meta-font">min</span></div>'
							+ '<div class="countdown__section"><span class="countdown__digit">%S</span><span class="countdown__text meta-font">sec</span></div>'));
					});
				});
			};
		},

		/* ============================================================================
		 * Scroll top
		 * ==========================================================================*/
		goToTop: function () {
			if ($goToTopEl.length) {
				$goToTopEl.on('click', function () {
					$('html,body').stop(true).animate({ scrollTop: 0 }, 400);
					return false;
				});
			}
		},

		/* ============================================================================
		 * News ticker
		 * ==========================================================================*/
		newsTicker: function () {
			var $tickers = $('.js-fpc-news-ticker');
			$tickers.each(function () {
				var $ticker = $(this);
				var $next = $ticker.siblings('.fpc-news-ticker__control').find('.fpc-news-ticker__next');
				var $prev = $ticker.siblings('.fpc-news-ticker__control').find('.fpc-news-ticker__prev');

				$ticker.addClass('initialized').vTicker('init', {
					speed: 300,
					pause: 3000,
					showItems: 1,
				});

				$next.on('click', function () {
					$ticker.vTicker('next', { animate: true });
				});

				$prev.on('click', function () {
					$ticker.vTicker('prev', { animate: true });
				});
			})
		},

		/* ============================================================================
		 * Lightbox
		 * ==========================================================================*/
		lightBox: function () {
			if ($.isFunction($.fn.magnificPopup)) {
				var $imageLightbox = $('.js-fpc-lightbox-image');
				var $galleryLightbox = $('.js-fpc-lightbox-gallery');

				$imageLightbox.magnificPopup({
					type: 'image',
					mainClass: 'mfp-zoom-in',
					removalDelay: 80,
				});

				$galleryLightbox.each(function () {
					$(this).magnificPopup({
						delegate: '.gallery-icon > a',
						type: 'image',
						gallery: {
							enabled: true,
						},
						mainClass: 'mfp-zoom-in',
						removalDelay: 80,
					});
				});
			}
		},

		/* ============================================================================
		 * Custom scrollbar
		 * ==========================================================================*/
		perfectScrollbarInit: function () {
			if ($.isFunction($.fn.perfectScrollbar)) {
				var $area = $('.js-perfect-scrollbar');

				$area.perfectScrollbar({
					wheelPropagation: true,
				});
			}
		},

		/* ============================================================================
		 * Sticky sidebar
		 * ==========================================================================*/
		stickySidebar: function () {
			setTimeout(function () {
				var $stickySidebar = $('.js-sticky-sidebar');
				var $stickyHeader = $('.js-sticky-header');

				var marginTop = ($stickyHeader.length) ? ($stickyHeader.outerHeight() + 20) : 0; // check if there's sticky header
				if ($.isFunction($.fn.theiaStickySidebar)) {
					$stickySidebar.theiaStickySidebar({
						additionalMarginTop: marginTop,
						additionalMarginBottom: 20,
					});
				}
			}, 250); // wait a bit for precise height;
		},

		/* ============================================================================
		 * Bootstrap tooltip
		 * ==========================================================================*/
		tooltipInit: function () {
			var $element = $('[data-toggle="tooltip"]');

			$element.tooltip();
		},
		search: function () {
			$('.js-search-dropdown-toggle').on('click', function () {
				$('.fpc-search-full').toggleClass('On');
			});
			$('#fpc-search-remove').on('click', function () {
				$('.fpc-search-full').removeClass('On');
			});
		}
	};

	FPC.documentOnLoad = {

		init: function () {
			FPC.clippedBackground();
			FPC.header.smartAffix.compute(); //recompute when all the page + logos are loaded
			FPC.header.smartAffix.updateState(); // update state
			FPC.header.stickyNavbarPadding(); // fix bootstrap modal backdrop causes sticky navbar to shift
			FPC.documentOnReady.stickySidebar();
		}

	};

	/* ============================================================================
	 * Blur background mask
	 * ==========================================================================*/
	FPC.clippedBackground = function () {
		if ($overlayBg.length) {
			$overlayBg.each(function () {
				var $mainArea = $(this).find('.js-overlay-bg-main-area');
				if (!$mainArea.length) {
					$mainArea = $(this);
				}

				var $subArea = $(this).find('.js-overlay-bg-sub-area');
				var $subBg = $(this).find('.js-overlay-bg-sub');

				var leftOffset = $mainArea.offset().left - $subArea.offset().left;
				var topOffset = $mainArea.offset().top - $subArea.offset().top;

				$subBg.css('display', 'block');
				$subBg.css('position', 'absolute');
				$subBg.css('width', $mainArea.outerWidth() + 'px');
				$subBg.css('height', $mainArea.outerHeight() + 'px');
				$subBg.css('left', leftOffset + 'px');
				$subBg.css('top', topOffset + 'px');
			});
		};
	}

	/* ============================================================================
	 * Priority+ menu
	 * ==========================================================================*/
	FPC.priorityNav = function ($menu) {
		var $btn = $menu.find('button');
		var $menuWrap = $menu.find('.navigation');
		var $menuItem = $menuWrap.children('li');
		var hasMore = false;

		if (!$menuWrap.length) {
			return;
		}

		function calcWidth() {
			if ($menuWrap[0].getBoundingClientRect().width === 0)
				return;

			var navWidth = 0;

			$menuItem = $menuWrap.children('li');
			$menuItem.each(function () {
				navWidth += $(this)[0].getBoundingClientRect().width;
			});

			if (hasMore) {
				var $more = $menu.find('.priority-nav__more');
				var moreWidth = $more[0].getBoundingClientRect().width;
				var availableSpace = $menu[0].getBoundingClientRect().width;

				//Remove the padding width (assumming padding are px values)
				availableSpace -= (parseInt($menu.css("padding-left"), 10) + parseInt($menu.css("padding-right"), 10));
				//Remove the border width
				availableSpace -= ($menu.outerWidth(false) - $menu.innerWidth());

				if (navWidth > availableSpace) {
					var $menuItems = $menuWrap.children('li:not(.priority-nav__more)');
					var itemsToHideCount = 1;

					$($menuItems.get().reverse()).each(function (index) {
						navWidth -= $(this)[0].getBoundingClientRect().width;
						if (navWidth > availableSpace) {
							itemsToHideCount++;
						} else {
							return false;
						}
					});

					var $itemsToHide = $menuWrap.children('li:not(.priority-nav__more)').slice(-itemsToHideCount);

					$itemsToHide.each(function (index) {
						$(this).attr('data-width', $(this)[0].getBoundingClientRect().width);
					});

					$itemsToHide.prependTo($more.children('ul'));
				} else {
					var $moreItems = $more.children('ul').children('li');
					var itemsToShowCount = 0;

					if ($moreItems.length === 1) { // if there's only 1 item in "More" dropdown
						if (availableSpace >= (navWidth - moreWidth + $moreItems.first().data('width'))) {
							itemsToShowCount = 1;
						}
					} else {
						$moreItems.each(function (index) {
							navWidth += $(this).data('width');
							if (navWidth <= availableSpace) {
								itemsToShowCount++;
							} else {
								return false;
							}
						});
					}

					if (itemsToShowCount > 0) {
						var $itemsToShow = $moreItems.slice(0, itemsToShowCount);

						$itemsToShow.insertBefore($menuWrap.children('.priority-nav__more'));
						$moreItems = $more.children('ul').children('li');

						if ($moreItems.length <= 0) {
							$more.remove();
							hasMore = false;
						}
					}
				}
			} else {
				var $more = $('<li class="priority-nav__more"><a href="#"><span>More</span><i class="mdicon mdicon-more_vert"></i></a><ul class="sub-menu"></ul></li>');
				var availableSpace = $menu[0].getBoundingClientRect().width;

				//Remove the padding width (assumming padding are px values)
				availableSpace -= (parseInt($menu.css("padding-left"), 10) + parseInt($menu.css("padding-right"), 10));
				//Remove the border width
				availableSpace -= ($menu.outerWidth(false) - $menu.innerWidth());

				if (navWidth > availableSpace) {
					var $menuItems = $menuWrap.children('li');
					var itemsToHideCount = 1;

					$($menuItems.get().reverse()).each(function (index) {
						navWidth -= $(this)[0].getBoundingClientRect().width;
						if (navWidth > availableSpace) {
							itemsToHideCount++;
						} else {
							return false;
						}
					});

					var $itemsToHide = $menuWrap.children('li:not(.priority-nav__more)').slice(-itemsToHideCount);

					$itemsToHide.each(function (index) {
						$(this).attr('data-width', $(this)[0].getBoundingClientRect().width);
					});

					$itemsToHide.prependTo($more.children('ul'));
					$more.appendTo($menuWrap);
					hasMore = true;
				}
			}
		}

		$window.on('load webfontLoaded', calcWidth);
		$window.on('resize', $.throttle(50, calcWidth));
	}

	$document.ready(FPC.documentOnReady.init);
	$window.on('load', FPC.documentOnLoad.init);
	$window.on('resize', FPC.documentOnResize.init);

	/* ============================================================================
	  * Keyboard Navigation
	  * ==========================================================================*/

	// If Tab key pressed focus submenu
	$('.menu-item-has-children').on({
		keyup: function (e) {
			var keyCode = e.keyCode || e.which;
			if (keyCode == 9) {
				$(this).children('ul').addClass('is-focused');
			}
		}
	});

	// If Tab key pressed remove is-focued class to all parent classes
	$('.sub-menu li:last-child').keydown(function (e) {
		if (e.which == 9) {
			$(this).parent().removeClass('is-focused');
		}
	});

	// If Tab key pressed & If tab is pressed faster then remove is-focused class to parents
	$('.navigation--main > .pb-menu-item').keydown(function (e) {
		if (e.which == 9) {
			$(this).prev('.pb-menu-item').children('.sub-menu').removeClass('is-focused');
		}
	});

	// If Tab + Shift key pressed
	$('.pb-menu-item').keydown(function (e) {
		if (e.which == 9) {
			if (e.shiftKey) {
				$(this).children('.sub-menu').removeClass('is-focused');
			}
		}
	});


	// If Escape key pressed, hide search popup
	$(document).keydown(function (e) {
		if (e.key === "Escape") {
			$('.fpc-search-full').removeClass('On');
		}
	});

	// If Enter key pressed ( 13 ) on search icon
	$('.js-search-dropdown-toggle').keydown(function (e) {
		if (e.which == 13) {
			setTimeout(function () {
				$(document).find('#search-popup').focus();
			}, 400);
		}
	});

	/** Mobile Navigation: Keyboard Navigation **/

	// If Tab key pressed on close icon
	$('.js-fpc-offcanvas-close').keydown(function (e) {
		if (e.which == 9) {
			$(document).find(".fpc-offcanvas__title a").focus();
		}
	});

	// Trap focus on search popup
	var input = $("#search-popup");
	var anchor = $("#fpc-search-remove .js-search-kn");
	anchor.on("keydown", function (event) {
		if (event.key === "Tab") {
			event.preventDefault();
			input.focus();
		}
	});

	var dropdownToggle = $(".js-search-dropdown-toggle");
	$("#fpc-search-remove .js-search-kn, #search-popup").on("keydown", function (event) {
		if (event.key === "Escape") {
			event.preventDefault();
			dropdownToggle.focus();
		}
	});

	$("#fpc-search-remove .js-search-kn").on("keydown", function (event) {
		if (event.key === "Enter") {
			event.preventDefault();
			$('.fpc-search-full').removeClass('On');
			dropdownToggle.focus();
		}
	});


	// Slick Slider
	$(".fpc-slider").slick({
		prevArrow: $('.fpc-prev'),
		nextArrow: $('.fpc-next'),
		dots: true,
		fade: true
	});

	/**
	 * Share Icons
	 */
	$('.fpc-single-socials-js a').on('click', function (e) {
		e.preventDefault();
		if ($(this).attr('href') != '#') {
			window.open(this.href, 'targetWindow', 'scrollbars=yes,resizable=yes,width=700,height=500')
		}
	});

})(jQuery);