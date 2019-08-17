jQuery(document).ready(function(){
	$("#price-range").ionRangeSlider({
	    min: 0,                        // min value
	    max: 50000000,                       // max value
	    from: 200,                       // overwrite default FROM setting
	    to: 600,                         // overwrite default TO setting
	    type: "double",                 // slider type
	    step: 50,                       // slider step
	    postfix: "VND ",                // postfix text
	    hasGrid: false,                  // enable grid
	    hideMinMax: false,               // hide Min and Max fields
	    hideFromTo: false,               // hide From and To fields
	    prettify: false,                 // separate large numbers with space, eg. 10 000
	    grid: true,
	    onChange: function(obj){        // function-callback, is called on every change
	        console.log(obj);
	    },
	    onFinish: function(obj){        // function-callback, is called once, after slider finished it's work
	        console.log(obj);
	    }
	});    
	var owl_sale = $("#owl-sale-product");
	owl_sale.owlCarousel({
		autoPlay: 5000,
		pagination: false,
		navigation: false,
		navigationText: false,
		itemsCustom : [
			[0, 1],
			[450, 1],
			[768, 2],
			[992, 1]
		],
		autoHeight: true
	});
	$(".sale_product .next").click(function(){
		owl_sale.trigger('owl.next');
	})
	$(".sale_product .prev").click(function(){
		owl_sale.trigger('owl.prev');
	})
	var owl = $("#owl-news-blog");
	owl.owlCarousel({
		autoPlay: 5000,
		pagination: false,
		navigation: false,
		navigationText: false,
		singleItem: true,
		autoHeight: true
	});
	$(".blog_news .next").click(function(){
		owl.trigger('owl.next');
	})
	$(".blog_news .prev").click(function(){
		owl.trigger('owl.prev');
	})
});

jQuery(document).ready(function()
					   {
	"use strict";
	/* Phone Menu */
	jQuery(".toggle").on("click", function()
						 {
		return jQuery(".submenu").is(":hidden") ? jQuery(".submenu").slideDown("fast") : jQuery(".submenu").slideUp("fast"), !1
	}), jQuery(".topnav").accordion(
		{
			accordion: !1,
			speed: 300,
			closedSign: "+",
			openedSign: "-"
		}), jQuery("#nav > li").hover(function()
									  {
		var e = jQuery(this).find(".level0-wrapper");
		e.hide(), e.css("left", "0"), e.stop(true, true).delay(150).fadeIn(300, "easeOutCubic")
	}, function()
									  {
		jQuery(this).find(".level0-wrapper").stop(true, true).delay(300).fadeOut(300, "easeInCubic")
	});
	/* Navbar */
	jQuery("#nav li.level0.drop-menu").mouseover(function()
												 {
		return jQuery(window).width() >= 740 && jQuery(this).children("ul.level1").fadeIn(100), !1
	}).mouseleave(function()
				  {
		return jQuery(window).width() >= 740 && jQuery(this).children("ul.level1").fadeOut(100), !1
	}), jQuery("#nav li.level0.drop-menu li").mouseover(function()
														{
		if (jQuery(window).width() >= 740)
		{
			jQuery(this).children("ul").css(
				{
					top: 0,
					left: "165px"
				});
			var e = jQuery(this).offset();
			e && jQuery(window).width() < e.left + 325 ? (jQuery(this).children("ul").removeClass("right-sub"), jQuery(this).children("ul").addClass("left-sub"), jQuery(this).children("ul").css(
				{
					top: 0,
					left: "-167px"
				})) : (jQuery(this).children("ul").removeClass("left-sub"), jQuery(this).children("ul").addClass("right-sub")), jQuery(this).children("ul").fadeIn(100)
		}
	}).mouseleave(function()
				  {
		jQuery(window).width() >= 740 && jQuery(this).children("ul").fadeOut(100)
	}),
		$('#owl_new_products').owlCarousel({
		navigation : false, // Show next and prev buttons
		navigationText: false,
		slideSpeed : 300,
		pagination: false,
		paginationSpeed : 400,
		itemsCustom : [
			[0, 2],
			[480, 2],
			[700, 3],
			[1000, 3],
			[1200, 4]
		],
		autoPlay: 5000,
		//autoHeight: true
	}),
		$('#gallery_01').owlCarousel({
		navigation : false,
		navigationText: false,
		slideSpeed : 300,
		pagination: false,
		paginationSpeed : 400,
		itemsCustom : [
			[0, 2],
			[480, 2],
			[700, 3],
			[1000, 3]
		],
		autoPlay: 5000,
		autoHeight: true
	}),
		$('#owl_hot_products').owlCarousel({
		navigation : false, // Show next and prev buttons
		navigationText: false,
		slideSpeed : 300,
		pagination: false,
		paginationSpeed : 400,
		itemsCustom : [
			[0, 2],
			[480, 2],
			[700, 3],
			[1000, 3],
			[1200, 4]
		],
		autoPlay: 5000,
		//autoHeight: true
	}),
		$("#owl_small_1").owlCarousel({
		autoPlay: 5000,
		pagination: false,
		navigation: false,
		navigationText: false,
		singleItem: true,
		//autoHeight: true
	}),
		$("#owl_small_2").owlCarousel({
		autoPlay: 5000,
		pagination: false,
		navigation: false,
		navigationText: false,
		singleItem: true,
		//autoHeight: true
	}),
		$('#owl_recommend_products').owlCarousel({
		navigation : false, // Show next and prev buttons
		navigationText: false,
		slideSpeed : 300,
		pagination: false,
		paginationSpeed : 400,
		itemsCustom : [
			[0, 2],
			[480, 2],
			[700, 3],
			[1000, 4],
			[1200, 6]
		],
		autoPlay: 3000
	}),

		$("#owl_slider_index").owlCarousel({
		navigation : true, // Show next and prev buttons
		navigationText: false,
		slideSpeed : 300,
		pagination: false,
		paginationSpeed : 400,
		singleItem:true
		// items : 1, 
		// itemsDesktop : false,
		// itemsDesktopSmall : false,
		// itemsTablet: false,
		// itemsMobile : false

	}),
		/* Best Seller Slider */
		jQuery("#best-seller-slider .slider-items").owlCarousel({
		items: 4,
		itemsDesktop: [1024, 4],
		itemsDesktopSmall: [900, 3],
		itemsTablet: [600, 2],
		itemsMobile: [320, 1],
		navigation: !0,
		navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
		slideSpeed: 500,
		pagination: !1
	}),
		/* Featured Slider */
		jQuery("#featured-slider .slider-items").owlCarousel({
		items: 4,
		itemsDesktop: [1024, 4],
		itemsDesktopSmall: [900, 3],
		itemsTablet: [600, 2],
		itemsMobile: [320, 1],
		navigation: !0,
		navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
		slideSpeed: 500,
		pagination: !1
	}),
		/* Bag Seller Slider */
		jQuery("#bag-seller-slider .slider-items").owlCarousel({
		items: 3,
		itemsDesktop: [1024, 4],
		itemsDesktopSmall: [900, 3],
		itemsTablet: [600, 2],
		itemsMobile: [320, 1],
		navigation: !0,
		navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
		slideSpeed: 500,
		pagination: !1
	}),
		/* Shoe Slider */
		jQuery("#shoes-slider .slider-items").owlCarousel({
		items: 3,
		itemsDesktop: [1024, 4],
		itemsDesktopSmall: [900, 3],
		itemsTablet: [600, 2],
		itemsMobile: [320, 1],
		navigation: !0,
		navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
		slideSpeed: 500,
		pagination: !1
	}),
		/* Recommend Slider */
		jQuery("#recommend-slider .slider-items").owlCarousel({
		items: 6,
		itemsDesktop: [1024, 4],
		itemsDesktopSmall: [900, 3],
		itemsTablet: [600, 2],
		itemsMobile: [320, 1],
		navigation: !0,
		navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
		slideSpeed: 500,
		pagination: !1
	}),
		/* Brand Logo Slider */
		jQuery("#brand-logo-slider .slider-items").owlCarousel({
		autoplay: true,
		items: 6,
		itemsDesktop: [1024, 4],
		itemsDesktopSmall: [900, 3],
		itemsTablet: [600, 2],
		itemsMobile: [320, 1],
		navigation: !0,
		navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
		slideSpeed: 500,
		pagination: false,
	}),
		/* Category Description Slider */
		jQuery("#category-desc-slider .slider-items").owlCarousel(
		{
			autoplay: !0,
			items: 1,
			itemsDesktop: [1024, 1],
			itemsDesktopSmall: [900, 1],
			itemsTablet: [600, 1],
			itemsMobile: [320, 1],
			navigation: !0,
			navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
			slideSpeed: 500,
			pagination: !1
		}),
		/* More View Slider */
		jQuery("#more-views-slider .slider-items").owlCarousel(
		{
			autoplay: !0,
			items: 3,
			itemsDesktop: [1024, 4],
			itemsDesktopSmall: [900, 3],
			itemsTablet: [600, 2],
			itemsMobile: [320, 1],
			navigation: !0,
			navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
			slideSpeed: 500,
			pagination: !1
		}),
		/* Related Product Slider */
		jQuery("#related-products-slider .slider-items").owlCarousel(
		{
			items: 4,
			itemsDesktop: [1024, 4],
			itemsDesktopSmall: [992, 3],
			itemsTablet: [600, 2],
			itemsMobile: [320, 1],
			navigation: !0,
			navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
			slideSpeed: 500,
			pagination: !1,
			autoPlay: 3000
		}),
		/* Upsell Product Slider */
		jQuery("#upsell-products-slider .slider-items").owlCarousel(
		{
			items: 4,
			itemsDesktop: [1024, 4],
			itemsDesktopSmall: [992, 3],
			itemsTablet: [600, 2],
			itemsMobile: [320, 1],
			navigation: !0,
			navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
			slideSpeed: 500,
			pagination: !1,
			autoPlay: 3000
		}),
		/* Chekout Page Cart */
		function deleteCartInCheckoutPage(){
		return jQuery(".checkout-cart-index a.btn-remove2,.checkout-cart-index a.btn-remove").on("click", function(e)
																								 {
			return e.preventDefault(),
				confirm(confirm_content) ? void 0 : !1
		}), !1
	}

	slideEffectAjax()
	/* Cart Slide-down effect */
	function slideEffectAjax(){
		jQuery(".top-cart-contain").mouseenter(function()
											   {
			jQuery(this).find(".top-cart-content").stop(true, true).slideDown()
		}), jQuery(".top-cart-contain").mouseleave(function()
												   {
			jQuery(this).find(".top-cart-content").stop(true, true).slideUp()
		})
	}
	/* Sidebar */
	function deleteCartInSidebar(){
		return is_checkout_page > 0 ? !1 : void jQuery("#cart-sidebar a.btn-remove, #mini_cart_block a.btn-remove").each(function() {})
	}
	/* Accordion */
	jQuery("ul.accordion li.parent, ul.accordion li.parents, ul#magicat li.open").each(function(){
		jQuery(this).append('<em class="open-close">&nbsp;</em>')
	}), jQuery("ul.accordion, ul#magicat").accordionNew(),
		jQuery("ul.accordion li.active, ul#magicat li.active").each(function(){
		jQuery(this).children().next("div").css("display", "block")
	})
});
var isTouchDevice = "ontouchstart" in window || navigator.msMaxTouchPoints > 0;
jQuery(window).on("load", function()
				  {
	isTouchDevice && jQuery("#nav a.level-top").on("click", function()
												   {
		if (jQueryt = jQuery(this), jQueryparent = jQueryt.parent(), jQueryparent.hasClass("parent"))
		{
			if (!jQueryt.hasClass("menu-ready")) return jQuery("#nav a.level-top").removeClass("menu-ready"), jQueryt.addClass("menu-ready"), !1;
			jQueryt.removeClass("menu-ready")
		}
	}),
		/* ToTop */
		jQuery().UItoTop()
}), jQuery(window).scroll(function()
						  {
	if (jQuery(this).scrollTop() > 1) {
		jQuery("nav").addClass("sticky");
	} else {
		jQuery("nav").removeClass("sticky")
	}
}),
	function(e)
{
	jQuery.fn.UItoTop = function(i)
	{
		var t = {
			text: "",
			min: 200,
			inDelay: 600,
			outDelay: 400,
			containerID: "toTop",
			containerHoverID: "toTopHover",
			scrollSpeed: 1200,
			easingType: "linear"
		},
			n = e.extend(t, i),
			s = "#" + n.containerID,
			a = "#" + n.containerHoverID;
		jQuery("body").append('<a href="#" id="' + n.containerID + '">' + n.text + "</a>"), jQuery(s).hide().on("click", function()
																												{
			return jQuery("html, body").animate(
				{
					scrollTop: 0
				}, n.scrollSpeed, n.easingType),
				jQuery("#" + n.containerHoverID, this).stop().animate(
				{
					opacity: 0
				}, n.inDelay, n.easingType), !1
		}).prepend('<span id="' + n.containerHoverID + '"></span>').hover(function()
																		  {
			jQuery(a, this).stop().animate(
				{
					opacity: 1
				}, 600, "linear")
		}, function()
																		  {
			jQuery(a, this).stop().animate(
				{
					opacity: 0
				}, 700, "linear")
		}), jQuery(window).scroll(function()
								  {
			var i = e(window).scrollTop();
			"undefined" == typeof document.body.style.maxHeight && jQuery(s).css(
				{
					position: "absolute",
					top: e(window).scrollTop() + e(window).height() - 50
				}), i > n.min ? jQuery(s).fadeIn(n.inDelay) : jQuery(s).fadeOut(n.Outdelay)
		})
	}
}(jQuery),
	jQuery.extend(jQuery.easing,
				  {
	easeInCubic: function(e, i, t, n, s)
	{
		return n * (i /= s) * i * i + t
	},
	easeOutCubic: function(e, i, t, n, s)
	{
		return n * ((i = i / s - 1) * i * i + 1) + t
	}
}),
	/*Sidebar Menu*/
	function(e)
{
	e.fn.extend(
		{
			accordion: function()
			{
				return this.each(function() {})
			}
		})
}(jQuery), jQuery(function(e)
				  {
	e(".accordion").accordion(), e(".accordion").each(function()
													  {
		var i = e(this).find("li.active");
		i.each(function(t)
			   {
			e(this).children("ul").css("display", "block"), t == i.length - 1 && e(this).addClass("current")
		})
	})
}),
	function(e)
{
	e.fn.extend(
		{
			accordion: function(i)
			{
				var t = {
					accordion: "true",
					speed: 300,
					closedSign: "[+]",
					openedSign: "[-]"
				},
					n = e.extend(t, i),
					s = e(this);
				s.find("li").each(function()
								  {
					0 != e(this).find("ul").size() && (e(this).find("a:first").after("<em>" + n.closedSign + "</em>"), "#" == e(this).find("a:first").attr("href") && e(this).find("a:first").on("click", function()
          {
						return !1
					}))
				}), s.find("li em").on("click", function()
									   {
					0 != e(this).parent().find("ul").size() && (n.accordion && (e(this).parent().find("ul").is(":visible") || (parents = e(this).parent().parents("ul"), visible = s.find("ul:visible"), visible.each(function(i)
          {
						var t = !0;
						parents.each(function(e)
									 {
							return parents[e] == visible[i] ? (t = !1, !1) : void 0
						}), t && e(this).parent().find("ul") != visible[i] && e(visible[i]).slideUp(n.speed, function()
																									{
							e(this).parent("li").find("em:first").html(n.closedSign)
						})
					}))), e(this).parent().find("ul:first").is(":visible") ? e(this).parent().find("ul:first").slideUp(n.speed, function()
																													   {
						e(this).parent("li").find("em:first").delay(n.speed).html(n.closedSign)
					}) : e(this).parent().find("ul:first").slideDown(n.speed, function()
																	 {
						e(this).parent("li").find("em:first").delay(n.speed).html(n.openedSign)
					}))
				})
			}
		})
}(jQuery),
	function(e)
{
	e.fn.extend(
		{
			accordionNew: function()
			{
				return this.each(function()
								 {
					function i(i, n)
					{
						e(i).parent(r).siblings().removeClass(s).children(l).slideUp(o),
							e(i).siblings(l)[n || a]("show" == n ? o : !1, function()
													 {
							e(i).siblings(l).is(":visible") ? e(i).parents(r).not(t.parents()).addClass(s) : e(i).parent(r).removeClass(s), "show" == n && e(i).parents(r).not(t.parents()).addClass(s), e(i).parents().show()
						})
					}
					var t = e(this),
						n = "accordiated",
						s = "active",
						a = "slideToggle",
						l = "ul, div",
						o = "fast",
						r = "li";
					if (t.data(n)) return !1;
					e.each(t.find("ul, li>div"), function()
						   {
						e(this).data(n, !0), e(this).hide()
					}), e.each(t.find("em.open-close"), function()
							   {
						e(this).on("click", function()
								   {
							return void i(this, a)
						}), e(this).bind("activate-node", function()
										 {
							t.find(l).not(e(this).parents()).not(e(this).siblings()).slideUp(o), i(this, "slideDown")
						})
					});
					var c = location.hash ? t.find("a[href=" + location.hash + "]")[0] : t.find("li.current a")[0];
					c && i(c, !1)
				})
			}
		})
}(jQuery);

jQuery(document).ready(function(){
	$(".home-menu li").hover(
		function () {
			$(this).find("a").addClass("active");
			$(this).find(".nav-sub").show();
		}, 
		function () {
			$(this).find("a").removeClass("active");
			$(this).find(".nav-sub").hide();
		}
	);
})