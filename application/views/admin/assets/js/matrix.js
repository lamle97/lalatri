
$(document).ready(function(){

	  $('.textarea_editor').each(function() {
	  	$(this).wysihtml5({
    		"html": true,
    		"color": true
	  	})
	  });

	  $('.iframe-btn').each(function() {
	  	$(this).fancybox({ 
		    'width'   : 900,
		    'height'  : 600,
		    'type'    : 'iframe',
		    'autoScale'     : false
	  	})  	
	  });
	
	// === Sidebar navigation === //
	
	$('.submenu > a').click(function(e)
	{
		e.preventDefault();
		var submenu = $(this).siblings('ul');
		var li = $(this).parents('li');
		var submenus = $('#sidebar li.submenu ul');
		var submenus_parents = $('#sidebar li.submenu');
		if(li.hasClass('open'))
		{
			if(($(window).width() > 768) || ($(window).width() < 479)) {
				submenu.slideUp();
			} else {
				submenu.fadeOut(250);
			}
			li.removeClass('open');
		} else 
		{
			if(($(window).width() > 768) || ($(window).width() < 479)) {
				submenus.slideUp();			
				submenu.slideDown();
			} else {
				submenus.fadeOut(250);			
				submenu.fadeIn(250);
			}
			submenus_parents.removeClass('open');		
			li.addClass('open');	
		}
	});
	
	var ul = $('#sidebar > ul');
	
	$('#sidebar > a').click(function(e)
	{
		e.preventDefault();
		var sidebar = $('#sidebar');
		if(sidebar.hasClass('open'))
		{
			sidebar.removeClass('open');
			ul.slideUp(250);
		} else 
		{
			sidebar.addClass('open');
			ul.slideDown(250);
		}
	});

	var parent = location.pathname.split("/");
	var current = location.protocol + "//" + location.hostname + "/" + parent[1] + "/"; 

	$('#sidebar > ul > li > a[href="' + current + parent[2] + '"]').parent().addClass('open active');
	$('.submenu > ul > li > a[href="' + current + parent[2] + '/' + parent[3] + '"]').parent().addClass('active');
	
	
	// === Resize window related === //
	$(window).resize(function()
	{
		if($(window).width() > 479)
		{
			ul.css({'display':'block'});	
			$('#content-header .btn-group').css({width:'auto'});		
		}
		if($(window).width() < 479)
		{
			ul.css({'display':'none'});
			fix_position();
		}
		if($(window).width() > 768)
		{
			$('#user-nav > ul').css({width:'auto',margin:'0'});
            $('#content-header .btn-group').css({width:'auto'});
		}
	});
	
	if($(window).width() < 468)
	{
		ul.css({'display':'none'});
		fix_position();
	}
	
	if($(window).width() > 479)
	{
	   $('#content-header .btn-group').css({width:'auto'});
		ul.css({'display':'block'});
	}
	
	// === Tooltips === //
	$('.tip').tooltip();	
	$('.tip-left').tooltip({ placement: 'left' });	
	$('.tip-right').tooltip({ placement: 'right' });	
	$('.tip-top').tooltip({ placement: 'top' });	
	$('.tip-bottom').tooltip({ placement: 'bottom' });	
	
	// === Search input typeahead === //
	$('#search input[type=text]').typeahead({
		source: ['Dashboard','Form elements','Common Elements','Validation','Wizard','Buttons','Icons','Interface elements','Support','Calendar','Gallery','Reports','Charts','Graphs','Widgets'],
		items: 4
	});
	
	// === Fixes the position of buttons group in content header and top user navigation === //
	function fix_position()
	{
		var uwidth = $('#user-nav > ul').width();
		$('#user-nav > ul').css({width:uwidth,'margin-left':'-' + uwidth / 2 + 'px'});
        
        var cwidth = $('#content-header .btn-group').width();
        $('#content-header .btn-group').css({width:cwidth,'margin-left':'-' + uwidth / 2 + 'px'});
	}
	
	// === Style switcher === //
	$('#style-switcher i').click(function()
	{
		if($(this).hasClass('open'))
		{
			$(this).parent().animate({marginRight:'-=190'});
			$(this).removeClass('open');
		} else 
		{
			$(this).parent().animate({marginRight:'+=190'});
			$(this).addClass('open');
		}
		$(this).toggleClass('icon-arrow-left');
		$(this).toggleClass('icon-arrow-right');
	});
	
	$('#style-switcher a').click(function()
	{
		var style = $(this).attr('href').replace('#','');
		$('.skin-color').attr('href','css/maruti.'+style+'.css');
		$(this).siblings('a').css({'border-color':'transparent'});
		$(this).css({'border-color':'#aaaaaa'});
	});
	
	$('.lightbox_trigger').click(function(e) {
		
		e.preventDefault();
		
		var image_href = $(this).attr("href");
		
		if ($('#lightbox').length > 0) {
			
			$('#imgbox').html('<img src="' + image_href + '" /><p><i class="icon-remove icon-white"></i></p>');
		   	
			$('#lightbox').slideDown(500);
		}
		
		else { 
			var lightbox = 
			'<div id="lightbox" style="display:none;">' +
				'<div id="imgbox"><img src="' + image_href +'" />' + 
					'<p><i class="icon-remove icon-white"></i></p>' +
				'</div>' +	
			'</div>';
				
			$('body').append(lightbox);
			$('#lightbox').slideDown(500);
		}
		
	});
	

	$('#lightbox').live('click', function() { 
		$('#lightbox').hide(200);
	});
	
});

// Autocomplete */
(function($) {
	$.fn.autocomplete = function(option) {
		return this.each(function() {
			var $this = $(this);
			var $dropdown = $('<ul class="dropdown-menu" />');
			
			this.timer = null;
			this.items = [];

			$.extend(this, option);

			$this.attr('autocomplete', 'off');

			// Focus
			$this.on('focus', function() {
				this.request();
			});

			// Blur
			$this.on('blur', function() {
				setTimeout(function(object) {
					object.hide();
				}, 200, this);
			});

			// Keydown
			$this.on('keydown', function(event) {
				switch(event.keyCode) {
					case 27: // escape
						this.hide();
						break;
					default:
						this.request();
						break;
				}
			});

			// Click
			this.click = function(event) {
				event.preventDefault();

				var value = $(event.target).parent().attr('data-value');

				if (value && this.items[value]) {
					this.select(this.items[value]);
				}
			}

			// Show
			this.show = function() {
				var pos = $this.position();

				$dropdown.css({
					top: pos.top + $this.outerHeight(),
					left: pos.left
				});

				$dropdown.show();
			}

			// Hide
			this.hide = function() {
				$dropdown.hide();
			}

			// Request
			this.request = function() {
				clearTimeout(this.timer);

				this.timer = setTimeout(function(object) {
					object.source($(object).val(), $.proxy(object.response, object));
				}, 200, this);
			}

			// Response
			this.response = function(json) {
				var html = '';
				var i = 0, j = 0;

				if (json.length) {
					for (i = 0; i < json.length; i++) {
						// update element items
						this.items[json[i]['value']] = json[i];

						html += '<li data-value="' + json[i]['value'] + '"><a href="#">' + json[i]['label'] + '</a></li>';
					}
				}

				if (html) {
					this.show();
				} else {
					this.hide();
				}

				$dropdown.html(html);
			}
			
			$dropdown.on('click', $.proxy(this.click, this));
			$this.after($dropdown);
		});
	}
})(window.jQuery);