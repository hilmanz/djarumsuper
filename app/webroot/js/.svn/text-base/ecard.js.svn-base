var Collection = Backbone.Collection.extend();
var Model = Backbone.Model.extend();
var sequences = new Collection();
var player = new Model({currentFrame:0,isBusy:false});
var index = new Model();
var docroot = "/";
index.set('frame1',0);
index.set('frame2',1);
index.set('frame3',2);
index.set('frame4',3);
index.set('frame5',4);
index.set('frame6',5);
index.set('frame7',6);
index.set('frame8',7);
index.set('frame9',8);
index.set('frame10',9);
sequences.add([new Model({data:null}),new Model({data:null}),new Model({data:null}),
				new Model({data:null}),new Model({data:null}),new Model({data:null}),
				new Model({data:null}),new Model({data:null}),new Model({data:null}),
				new Model({data:null})]);
var items = new Model({
						item:{}
					  });

//model-events
player.on('change:currentFrame', function(model, frame) {
  player.set('isBusy',true);
});
//-->
function ecard_add_item(obj){
	var id = 'item'+obj.id;
	var item = items.get('item');
	item[id] = obj;
	items.set('item',item);
}
function ecard_render_items(){
	item = items.get('item');
	$.each(item,function(i,v){
		var span = $('<span id="'+i+'" class="assetthumb dragable">'+
					 '<a href="javascript:void(0);" onclick="preview(\''+v.type+'\',\''+v.file+'\');"><img src="'+docroot+'content/ecard/'+v.thumb+'"/></a>'+
					 '</span>');
		$(".item_container").append(span);
	});
	show_images();
	//dragable and dropable setup
	$(".dragable").draggable({appendTo:'body',scroll:false,containment:'window',helper:'clone'});
	$(".droppable").droppable({
			drop: function(event,ui){
				var idx = index.get($(this).attr('id'));
				sequences.at(idx).set('data',item[ui.draggable[0].id]);
				$(this)
					.html('<img src="'+docroot+'content/ecard/'+item[ui.draggable[0].id].thumb+'"/>');
			}
		});
	//-->
}


function sequence_filled(){
	var n_filled = 0;
	sequences.each(function(seq){
		if(seq.get('data')!=null){
			n_filled++;
			return false;
		}
	});
	if(n_filled!=0){
		return true;
	}	
}
function getSequences(){
	var sq = [];
	sequences.each(function(seq){
		var d = seq.get('data');
		if(d!=null){
			sq.push(d);
		}
	});
	return base64_encode(JSON.stringify(sq));
}

function show_images(){
	var item = items.get('item');
	$.each(item,function(v,w){
	   
	    if(w.type=="image"){
	        $("#"+v).fadeIn();
	    }else{
	    	$("#"+v).hide();
	    }
	});
}
function show_videos(){
	var item = items.get('item');
	$.each(item,function(v,w){
	    if(w.type=="video"){
	        $("#"+v).fadeIn();
	    }else{
	    	$("#"+v).hide();
	    }
	});
}
function preview(type,file){
	$("#preview").html('');
	$('#preview').reveal();
	if(type=="image"){
		var ct = $("<img src='"+docroot+"/content/ecard/"+file+"' width='100%'/>");
		$("#preview").append(ct);
	}else{
		var ct = $('<a href="'+docroot+'/content/ecard/'+file+'" '+
				   'style="display:block;width:425px;height:300px;"'+
    			  'id="player"></a>');
    	$("#preview").append(ct);
    	flowplayer("player", docroot+"flowplayer/flowplayer-3.2.14.swf");		  
	}
}

