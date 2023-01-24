jQuery(document).ready(function($) {
	"use strict";
	/* -------------------------------------
			MOBILE MENU
	-------------------------------------- */
	function collapseMenu(){
		$('.medicll-navigation ul li.medicll-hasdropdown').prepend('<span class="medicll-dropdowarrow"><i class="fa fa-angle-down"></i></span>');
		$('.medicll-navigation ul li.medicll-hasdropdown span').on('click', function() {
			$(this).next().next().slideToggle(300);
		});
	}
	collapseMenu();
	/* -------------------------------------
			HOME SLIDER
	-------------------------------------- */
	if (jQuery("#medicll-homeslider").length > 0) {
		jQuery("#medicll-homeslider").owlCarousel({
			slideSpeed : 300,
			paginationSpeed : 400,
			singleItem:true,
			navigation : true,
			pagination : false,
			navigationText: [
				"<span class='medicll-btncurveprev'><i class='fa fa-long-arrow-left'></i></span>",
				"<span class='medicll-btncurvenext'><i class='fa fa-long-arrow-right'></i></span>"
			],
		});
	}
	/* ---------------------------------------
			STATISTICS
	 -------------------------------------- */
	try {
		jQuery('.medicll-counter').appear(function () {
			jQuery('.medicll-count h3').countTo();
		});
	} catch (err) {}
	/* -------------------------------------
			PRETTY PHOTO GALLERY
	-------------------------------------- */
	jQuery("a[data-rel]").each(function () {
		jQuery(this).attr("rel", jQuery(this).data("rel"));
	});
	if (jQuery("a[data-rel^='prettyPhoto']").length > 0) {
		jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
			animation_speed: 'normal',
			theme: 'dark_square',
			slideshow: 3000,
			autoplay_slideshow: false,
			social_tools: false
		});
	}
	/* ---------------------------------------
			PORTFOLIO FILTERABLE
	-------------------------------------- */
	var $container = jQuery('.medicll-projects');
	var $optionSets = jQuery('.option-set');
	var $optionLinks = $optionSets.find('a');
	function medicll_doIsotopeFilter() {
		if (jQuery().isotope) {
			var isotopeFilter = '';
			$optionLinks.each(function () {
				var selector = jQuery(this).attr('data-filter');
				var link = window.location.href;
				var firstIndex = link.indexOf('filter=');
				if (firstIndex > 0) {
					var id = link.substring(firstIndex + 7, link.length);
					if ('.' + id == selector) {
						isotopeFilter = '.' + id;
					}
				}
			});
			$container.isotope({
				filter: isotopeFilter
			});
			$optionLinks.each(function () {
				var $this = jQuery(this);
				var selector = $this.attr('data-filter');
				if (selector == isotopeFilter) {
					if (!$this.hasClass('medicll-active')) {
						var $optionSet = $this.parents('.option-set');
						$optionSet.find('.medicll-active').removeClass('medicll-active');
						$this.addClass('medicll-active');
					}
				}
			});
			$optionLinks.on('click', function () {
				var $this = jQuery(this);
				var selector = $this.attr('data-filter');
				$container.isotope({itemSelector: '.medicll-project', filter: selector});
				if (!$this.hasClass('medicll-active')) {
					var $optionSet = $this.parents('.option-set');
					$optionSet.find('.medicll-active').removeClass('medicll-active');
					$this.addClass('medicll-active');
				}
				return false;
			});
		}
	}
	var isotopeTimer = window.setTimeout(function () {
		window.clearTimeout(isotopeTimer);
		medicll_doIsotopeFilter();
	}, 1000);
	/* -------------------------------------
			SLIDER
	-------------------------------------- */
	if (jQuery("#medicll-docteamslider").length > 0) {
		jQuery("#medicll-docteamslider").owlCarousel({
			autoPlay : false,
			slideSpeed : 300,
			navigation : true,
			pagination : false,
			navigationText: [
				"<span class='medicll-btnsquareprev'><i class='fa fa-long-arrow-left'></i></span>",
				"<span class='medicll-btnsquarenext'><i class='fa fa-long-arrow-right'></i></span>"
			],
			itemsCustom : [
				[0, 1],
				[480, 2],
				[992, 3],
				[1200, 4],
			],
		});
	}
	/* -------------------------------------
			TESTIMONIALS SLIDER
	-------------------------------------- */
	if (jQuery("#medicll-testimonialslider").length > 0) {
		jQuery("#medicll-testimonialslider").owlCarousel({
			slideSpeed : 300,
			paginationSpeed : 400,
			singleItem:true,
			navigation : true,
			pagination : false,
			navigationText: [
				"<span class='medicll-btnroundprev'><i class='fa fa-angle-left'></i></span>",
				"<span class='medicll-btnroundnext'><i class='fa fa-angle-right'></i></span>"
			],
		});
	}
	/* -------------------------------------
			Google Map
	-------------------------------------- */
	if (jQuery("#medicll-locationmap").length > 0) {
		jQuery("#medicll-locationmap").gmap3({
			map:{
				options:{
					center:[46.578498,2.457275],
					zoom: 6,
					scrollwheel: false,
					disableDoubleClickZoom: true,
				}
			},
			marker:{
				values:[
					{latLng:[48.8620722, 2.352047], data:"Paris !", options:{icon: "images/mapmarker.png"}},
					{address:"86000 Poitiers, France", data:"Poitiers : great city !", options:{icon: "images/mapmarker.png"}},
					{address:"66000 Perpignan, France", data:"Perpignan ! GO USAP !", options:{icon: "images/mapmarker.png"}}
				],
				options:{
					draggable: false
				},
				events:{
					mouseover: function(marker, event, context){
						var map = $(this).gmap3("get"),
						infowindow = $(this).gmap3({get:{name:"infowindow"}});
						if (infowindow){
							infowindow.open(map, marker);
							infowindow.setContent(context.data);
						} else {
							$(this).gmap3({
								infowindow:{
									anchor:marker,
									options:{content: context.data}
								}
							});
						}
					},
					mouseout: function(){
						var infowindow = $(this).gmap3({get:{name:"infowindow"}});
						if (infowindow){
							infowindow.close();
						}
					}
				}
			}
		});
	}
	/* -------------------------------------
			BRANDS SLIDER
	-------------------------------------- */
	if (jQuery("#medicll-brandsslider").length > 0) {
		jQuery("#medicll-brandsslider").owlCarousel({
			autoPlay : false,
			slideSpeed : 300,
			navigation : false,
			pagination : false,
			navigationText: [
				"<span class='medicll-btnsquareprev'><i class='fa fa-long-arrow-left'></i></span>",
				"<span class='medicll-btnsquarenext'><i class='fa fa-long-arrow-right'></i></span>"
			],
			itemsCustom : [
				[0, 2],
				[480, 3],
				[992, 4],
				[1200, 6],
			],
		});
	}
	/* -------------------------------------
			ACCORDION
	-------------------------------------- */
	jQuery(function() {
		jQuery('.medicll-panelcontent').hide();
		jQuery('#medicll-accordion h4:first').addClass('active').next().slideDown('slow');
		jQuery('#medicll-accordion h4').click(function() {
			if(jQuery(this).next().is(':hidden')) {
				jQuery('#medicll-accordion h4').removeClass('active').next().slideUp('slow');
				jQuery(this).toggleClass('active').next().slideDown('slow');
			}
		});
	});
	/* -------------------------------------
			FAQ SMOOTH SCROLL
	-------------------------------------- */
	$(function() {
		$('#medicll-content').on('click', 'a[href*="#"]:not([href="#"])', function(e) {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				if (target.length) {
					$('html, body').animate({
						scrollTop: target.offset().top
					}, 1000);
					return false;
				}
			}
		});
	});
	/* -------------------------------------
			DATE PICKER
	-------------------------------------- */
	if (jQuery(".medicll-datetimepicker").length > 0) {
		$('.medicll-datetimepicker').datetimepicker();
	}
});