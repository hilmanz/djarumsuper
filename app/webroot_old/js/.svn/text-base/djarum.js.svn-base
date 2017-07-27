//Model 
var Model = Backbone.Model.extend();
var CategoryCol = Backbone.Collection.extend();
var Category = Backbone.Model.extend();
var catCollection = new CategoryCol();
var tripUrl = "";
var DS = new Model({
						edit_article_n_category:0,
						edit_article_categories:new CategoryCol(),
						edit_article_id:0,
						edit_article_category_list:[]
					});
DS.get('edit_article_categories').on('add',function(){
	$(".categoryList").html('');
	//repopulate the categories list for the article.
	DS.set('edit_article_n_category',DS.get('edit_article_categories').size());
	//append categories list in hidden field
	var categories = [];
	
	DS.get('edit_article_categories').each(function(v,i){
		categories.push(v.id);
		var div = $("<div>");
		div.attr('id','cat'+DS.get('edit_article_n_category'));
		div.attr('no',v.get('id'));
		div.html('<span>'+v.get('name')+'</span>');
		//btn delete
		var btnDelete = $("<a>");
		btnDelete.attr('href','javascript:void(0);');
		btnDelete.html('Delete');
		btnDelete.click(function(){
			var p = $(this).parent();
			var no = $(this).parent().attr('no');
			var toDelete = [];
			DS.get('edit_article_categories').each(function(x,v){
				if(x.id==no){
					toDelete.push(v);
				}
			});
			$.each(toDelete,function(i,v){
				DS.get('edit_article_categories').remove(DS.get('edit_article_categories').at(v));
				DS.set('edit_article_n_category',DS.get('edit_article_categories').length);
				p.remove();
			});
			var categories = [];
			DS.get('edit_article_categories').each(function(t,tt){
				categories.push(t.get('id'));
			});
			var str = implode(',',categories);
			$("#categories").val(str);
		});
		div.append(btnDelete);
		$(".categoryList").append(div);
		
	});
	var str = implode(',',categories);
	
	$("#categories").val(str);
	
});

//-->
jQuery(document).ready(function() {
	// Carousel Merchandise
    jQuery('#listMerchandise').jcarousel({
        scroll: 1
    });
	// SLIDER
	$(".slider").slideshow({
		width      : 820,
		height     : 360,
		transition : ['barleft',
					'barright']
	});
	/*------------POP UP------------*/	
	jQuery(".viewPopup").click(function(){
		var targetID = jQuery(this).attr('href');
		jQuery(targetID).fadeIn();
		jQuery("#bgPopup").fadeIn();
	});
	jQuery("a.closePopup,#bgPopup").click(function(){
		jQuery(".popupContainer").fadeOut();
		jQuery("#bgPopup").fadeOut();
	});
	jQuery(".showPopup").click(function(){
		var targetID = jQuery(this).attr('href');
		jQuery(targetID).fadeIn();
		jQuery("#bgPopup2").fadeIn();
		jQuery('html, body').animate({scrollTop: '0px'}, 800);
	});
	jQuery("a.hidePopup,#bgPopup2").click(function(){
		jQuery(".popupContainer2").fadeOut();
		jQuery("#bgPopup2").fadeOut();
	});
});
$(function() {
		$( ".datepicker" ).datepicker();
});
// DROPDOWN 
jQuery(function(){
	jQuery('ul.sf-menu').superfish();
});

function open_article(id){
	var categories = ['index',
						'aceh',
						'sumut',
						'sumbar',
						'riau',
						'jambi',
						'bengkulu',
						'sumsel',
						'kpriau',
						'kalbar',
						'babel',
						'kalteng',
						'kalsel',
						'sulbar',
						'kaltim',
						'gorontalo',
						'sulut',
						'malut',
						'sultara',
						'sulteng',
						'irja',
						'papua',
						'maluku',
						'sulsel',
						'ntt',
						'ntb',
						'bali',
						'jatim',
						'jateng',
						'jakarta',
						'jabar',
						'jogja',
						'lampung',
						'banten'];
	
	$("#mapGallery").fadeIn();
	$("#bgPopup").fadeIn();
	
	//load content
	_sUrl = tripUrl+"/"+categories[id]+"?ajax=1";
	$.ajax({
		  url: _sUrl,
		  dataType: 'html',
		  beforeSend: function(){
				$("#mapGallery #popupContent .popupContent").html("<div class='loaders'>Mohon tunggu sebentar..</div>");
		  },
		  success: function( response ) {
			 $("#mapGallery #popupContent .popupContent").html(response);
		  }
	});
}

$(document).ready(function() {
	$("a[rel=gallery]").fancybox({
		'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'titlePosition' 	: 'over',
		'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
			return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
		}
	});
	
	//edit article
	$("#btnSetCategory").click(function(){
		if(DS.get('edit_article_n_category')<3){
			var m = new Category({'id':$("#category").val(),
									'name':$("#category option:selected").text()
								});
			DS.get('edit_article_categories').add(m);
		}
	});
});
function del_cookie(name)
{
    document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}
function deleteAllCookies() {
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    }
}