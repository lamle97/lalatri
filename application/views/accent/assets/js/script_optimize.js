/*
* @Author:	Minh Phạm
* @Skype:	phamminh239
* @Date:	2017-03-08
* @Last Modified by:   phamminh239
* @Last Modified time: 2017-03-13
*/

$(document).on('click', '.overlay, .close-popup, .btn-continue, .fancybox-close', function() {
	awe.hidePopup('.awe-popup');
	setTimeout(function() {
		$('.loading').removeClass('loaded-content');
	}, 500);
	return false;
})

$(document).ready(function() {
	//	"use strict";

	var ww = $(window).width();
	if (ww < 992){
		$('.top-cart-contain').on('click touch',  function(){
			window.location.href='/cart';
		});
	}

	/** COLLECTION **/
	if (ww >= 992 && ww <= 1200){
		$('.side-nav-categories .block-title h2').text('Danh mục');
	} else {
		$('.side-nav-categories .block-title h2').text('Danh mục sản phẩm');
	}

	$(window).on('resize', function(){
		ww= $(window).width();
		if (ww >= 992 && ww <= 1200){
			$('.side-nav-categories .block-title h2').text('Danh mục');
		} else {
			$('.side-nav-categories .block-title h2').text('Danh mục sản phẩm');
		}
	});

	$('.blog_new_loop_info').css('padding-left',$('.blog_new_loop > a').width() + 15)

	/** MOBILE **/
	$('.myaccount').on('click touch', function(){
		$('.accounts').slideToggle();
	});

	if(ww <= 480){
		$('.mttoggle h4').click(function(){
			$(this).next('ul,div').slideToggle('slow');
		});
	} else {
		$('.mttoggle ul,.mttoggle > div').show();
	}

	//Thu gọn danh mục sản phẩm
	$('#magicat').each(function(){
		var nc = $(this).find('.level0').length;
		if (nc > 5){
			$('.level0',this).eq(6).nextAll().hide().addClass('toggleable');
			$(this).append('<li class="more"><a title="Xem thêm"><i class="fa fa-caret-down"></i></a></li>');
		}
	});
	$('#magicat').on('click','.more', function(){
		if($(this).hasClass('less')){
			$(this).html('<a title="Xem thêm"><i class="fa fa-caret-down"></i></a>').removeClass('less');
		} else {
			$(this).html('<a title="Thu gọn"><i class="fa fa-caret-up"></i></a>').addClass('less');;
		}
		$(this).siblings('li.toggleable').slideToggle();
	});


	/*** BLOG NEWS ***/
	$("#owl_blogs_news").owlCarousel({
		navigation : false, // Show next and prev buttons
		//autoPlay: true,
		slideSpeed : 300,
		paginationSpeed : 400,
		singleItem:true,
		pagination: false,
		autoHeight: true
	});
});