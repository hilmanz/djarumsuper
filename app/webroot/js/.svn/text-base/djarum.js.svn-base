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
$(document).ready(function() {
	// Carousel Merchandise
    $('#listMerchandise').jcarousel({
        scroll: 1
    });
    $('.latestGallery').jcarousel({
        scroll: 5
    });
	/*------------POP UP------------*/	
	jQuery(".showPopup").click(function(){
		$('html, body').animate({scrollTop: '0px'}, 800);
		var targetID = jQuery(this).attr('href');
		jQuery(targetID).fadeIn();
		jQuery("#bgPopup").fadeIn();
		jQuery(targetID+" .popupContent img").attr('src',imgpath+'/medium_'+jQuery(this).attr('img-data'));
		jQuery(targetID+" .popupFooter a[no=1]").attr('href',imgpath+'/1280x768_'+jQuery(this).attr('img-data'));
		jQuery(targetID+" .popupFooter a[no=2]").attr('href',imgpath+'/800x600_'+jQuery(this).attr('img-data'));
		jQuery(targetID+" .popupHeader span.title").html(jQuery(this).attr('title'));
		if(typeof jQuery(this).attr('taken-by') !== 'undefined'){
			jQuery(targetID+" .popupHeader span.authors").html(' | Photographed by : '+jQuery(this).attr('taken-by'));
		}else{
			jQuery(targetID+" .popupHeader span.authors").html('');
		}
		if(typeof jQuery(this).attr('place') !== 'undefined'){
			jQuery(targetID+" .popupHeader span.place").html(' | '+jQuery(this).attr('place'));
		}else{
			jQuery(targetID+" .popupHeader span.place").html('');
		}
		
	});
	jQuery("a.popupClose,#bgPopup").click(function(){
		jQuery(".popup").fadeOut();

		jQuery("#bgPopup").fadeOut();
	});
	jQuery(".showPopup2").click(function(){
		$('html, body').animate({scrollTop: '0px'}, 800);
		var targetID = jQuery(this).attr('href');
		jQuery(targetID).fadeIn();
		jQuery("#bgPopup").fadeIn();
		$('.popupContent2 div').html('');
		render_view('#video-'+$(this).attr('videoID'),'.popupContent2 div',[]);
		jQuery(targetID+" .popupFooter a[no=1]").attr('href',imgpath+'/1280x768_'+jQuery(this).attr('img-data'));
		jQuery(targetID+" .popupFooter a[no=2]").attr('href',imgpath+'/800x600_'+jQuery(this).attr('img-data'));
		jQuery(targetID+" .popupHeader span.title").html(jQuery(this).attr('title'));
		if(typeof jQuery(this).attr('taken-by') !== 'undefined'){
			jQuery(targetID+" .popupHeader span.authors").html(' | Uploaded by : '+jQuery(this).attr('taken-by'));
		}else{
			jQuery(targetID+" .popupHeader span.authors").html('');
		}
		if(typeof jQuery(this).attr('place') !== 'undefined'){
			jQuery(targetID+" .popupHeader span.place").html(' | '+jQuery(this).attr('place'));
		}else{
			jQuery(targetID+" .popupHeader span.place").html('');
		}
		
	});
});
$(function() {
		$( ".datepicker" ).datepicker();
});
// DROPDOWN 
$(document).ready(function(){
	 $('#navigations').superfish({
		//add options here if required
	});

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
				$("#mapGallery .popupContent2 .contentPopup").html("<div class='loaders'>Mohon tunggu sebentar..</div>");
		  },
		  success: function( response ) {
			 $("#mapGallery .popupContent2 .contentPopup").html(response);
		  }
	});
}
function article_counts(id){
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
	
	
	
	//load content
	_sUrl = tripUrl+"/"+categories[id]+"?ajax=1&count=1&p="+categories[id];
	$.ajax({
		  url: _sUrl,
		  dataType: 'json',
		  beforeSend: function(){
				$(".minipopup div.ctLoader").show();
				$(".minipopup div.ctLand,div.ctAir,div.ctWater").hide();
		  },
		  success: function( response ) {
			 //$("#mapTooltip .popupContent2 .contentPopup").html(response);
			 
			 $(".minipopup div.ctLand span.ctCount").html(parseInt(response.land));
			 $(".minipopup div.ctAir span.ctCount").html(parseInt(response.air));
			 $(".minipopup div.ctWater span.ctCount").html(parseInt(response.water));

			 $(".minipopup div.ctLoader").hide();
			 $(".minipopup div.ctLand,div.ctAir,div.ctWater").fadeIn();
		  }
	});
}
$(document).ready(function() {
	try{
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
	}catch(err){

	}
	console.log('foo');

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

//rating plugin
(function( $ ) {
$.fn.rateme = function(param){
	return this.each(function() {
			
			var startValue = (typeof param.startValue!=="undefined") ? startValue = param.startValue : 0;
			var star = $('<div class="rate">');
			var isClicked = false;
			star.attr('no',0);
			star.css({width:'22px',height:'20px',marginRight:'1px',backgroundImage:'url('+param.source+'star2.png)',float:'left',cursor:'pointer'});
			star.html('&nbsp;');
			star.mouseover(function(e){
				if(param.disableAfterClick&&isClicked) return false;
				isClicked=false;
				star.css('background-image','url('+param.source+'star.png)');
				for(var i=0;i<=$(this).attr('no');i++){
					$("div.rate[no='"+i+"']").css('background-image','url('+param.source+'star.png)');
				}
			}).mouseout(function(e){
				if(param.disableAfterClick&&isClicked) return false;
				if(!isClicked){
					for(var i=0;i<5;i++){
						$("div.rate[no='"+i+"']").css('background-image','url('+param.source+'star2.png)');
					}
				}
			}).click(function(e){
				if(param.disableAfterClick&&isClicked) return false;
				isClicked = true;
				//console.log(parseInt($(this).attr('no'))+1);
				param.onComplete(parseInt($(this).attr('no'))+1);
			});
			var star2 = star.clone(true).attr('no',1);
			var star3 = star.clone(true).attr('no',2);
			var star4 = star.clone(true).attr('no',3);
			var star5 = star.clone(true).attr('no',4);
			
			$(this).append(star);
			$(this).append(star2);
			$(this).append(star3);
			$(this).append(star4);
			$(this).append(star5);
			if(startValue>0){
				for(var i=0;i<startValue;i++){
					$("div.rate[no='"+i+"']").css('background-image','url('+param.source+'star.png)');
				}
			}

		});
	}
})( jQuery );

function api_call(u,c){
	$.ajax({
		  url: u,
		  dataType: 'json',
		  success: c
		}
	);
}
function api_post(u,d,c){
	$.ajax({
	  url: u,
	  dataType: 'json',
	  type:'POST',
	  data:d,
	  success: c});	
}

// Slider
$(window).load(function() {
  // The slider being synced must be initialized first
  $('#carousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 210,
    itemMargin: 0,
	minItems: 6,
    asNavFor: '#slider'
  });
  $('#slider').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
	directionNav: true,  
    sync: "#carousel"
  });
  $('#carouseladv').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 210,
    itemMargin: 0,
	minItems: 4,
    asNavFor: '#slideradv'
  });
  $('#slideradv').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
	directionNav: true,  
    sync: "#carouseladv"
  });
});
$(window).load(function(){
  $('.flexslider').flexslider({
	animation: "slide",
    controlNav: false,
	start: function(slider){
	  $('body').removeClass('loading');
	}
  });
});

$(function() {
	$( "#tabs" ).tabs();
});

function render_view(tpl_source,target,data){
	try{
		var View = Backbone.View.extend({
	        initialize: function(){
	            this.render();
	        },
	        render: function(){
	            var variables = data;
	            var template = _.template($(tpl_source).html(),variables);
	            this.$el.html(template);
	        }
	    });
	    var view = new View({el:$(target)});
	    
   }catch(error){
   		console.log(error.message);
   }
}
function prepend_view(tpl_source,target,data){
	try{
		var View = Backbone.View.extend({
	        initialize: function(){
	            this.render();
	        },
	        render: function(){
	            var variables = data;
	            var template = _.template($(tpl_source).html(),variables);
	            this.$el.prepend(template);
	        }
	    });
	    var view = new View({el:$(target)});
   }catch(error){
   	 	
   }
}
function append_view(tpl_source,target,data){
	try{
		var View = Backbone.View.extend({
	        initialize: function(){
	            this.render();
	        },
	        render: function(){
	            var variables = data;
	            var template = _.template($(tpl_source).html(),variables);
	            this.$el.append(template);
	            this.$el.css('display','none');
	            this.$el.fadeIn();
	        }
	    });
	    var view = new View({el:$(target)});
	    
   }catch(error){
   	 
   }
}