/*
jwTable( Jquery Responsive Table ) by Joko Wandiro
Description: Support Table Bootstrap Twitter - easy hide / show Column Table on different devices.
Version: 1.0.0
License: http://creativecommons.org/licenses/by-nc-sa/3.0/
Free for Private and Commercial Project
*/
( function($){
$.fn.jwTable= function(options){
	var settings= {
	selector: null,
	fields: [],
	tablet_portrait: {
	show: [],
	hide: [],
	},
	phone: {
	show: [],
	hide: [],
	},
	};
	
	settings.selector= this;
	if( $.isPlainObject(options) ){
		settings= $.extend(settings, options);
	}
	
	var $obj= this;
	$obj.addClass('jwtable');
	$.each(settings.fields, function(e, value){
		$('thead tr th:eq(' + e + ')', $obj).attr({'data-field': value + '_column'});
		$('tbody tr', $obj).each( function(){
			$tr= $(this);
			$('td:eq(' + e + ')', $tr).attr({'data-field': value + '_column'});
		})
	});
	
	tablet_portrait_opt= settings.tablet_portrait;
	phone_opt= settings.phone;
	tablet_portrait_show= tablet_portrait_opt.show.toString();
	phone_show= phone_opt.show.toString();
	$('thead tr th', $obj).each( function(){
		$elem= $(this);
		data_field= $elem.attr('data-field').replace(/_column/gi, "");		
		if( tablet_portrait_show.indexOf(data_field) == -1 ){
			$elem.addClass('hidden-tablet');
		}
		if( phone_show.indexOf(data_field) == -1 ){
			$elem.addClass('hidden-phone');
		}
	})
	
	$('tbody tr', $obj).each( function(){
		$tr= $(this);
		$('td', $tr).each( function(){
			$td= $(this);
			data_field= $td.attr('data-field').replace(/_column/gi, "");
			if( tablet_portrait_show.indexOf(data_field) == -1 ){
				$td.addClass('hidden-tablet');
			}
			if( phone_show.indexOf(data_field) == -1 ){
				$td.addClass('hidden-phone');
			}
		})
	})
}
}(jQuery));
