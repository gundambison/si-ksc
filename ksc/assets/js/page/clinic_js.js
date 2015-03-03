/*--------dialog --------*/
$("#dialog" ).dialog({
	autoOpen: false,
	width: 800,
	buttons: [
		{
			text: "Ok",
			click: function() {
				$( this ).dialog( "close" );
			}
		},
		{
			text: "Cancel",		
			click: function() {
				$( this ).dialog( "close" );
			}
		}
	]
});

$("#formDialog" ).dialog({
	autoOpen: false,
	width: 800,
	buttons: [
		{
			text: "Ok",
			click: function() {
				data = $("form#formClinic").serialize();
				console.log(data);
				$( this ).dialog( "close" );
			}
		},
		{
			text: "Cancel",		
			click: function() {
				$( this ).dialog( "close" );
			}
		}
	]
});

$("#docType").change(function(){
		var selectorform = 'form#myForm'; 
		var datax = $(selectorform).serialize();
		var param = "id="+$(this).val()+'&stat=byType';  
		$(".table tbody").empty();
		var request = $.ajax({
			url: siteUrl+"clinic/pasienlist",
			type: "POST",
			data: param,
			dataType: "json"
		});
		request.success(function(res) {
			console.log('data sudah terkirim');
			$(".table tbody").empty().append(res.message);
			  
		});
		request.error( function(jqXHR,  textStatus  ){
			alert("error :"+textStatus);
			console.log(textStatus);
			console.log(jqXHR);
		});
		
});

function detailPat(obj){
	patId=$(obj).attr('patid');
	param= "id="+patId;
	var request = $.ajax({
			url: siteUrl+"pasien/detail",
			type: "POST",
			data: param,
			dataType: "json"
		});
		request.success(function(res) {
			console.log('data sudah terkirim');
			$("#dialog div").empty().append(res.message);
			$("#dialog").dialog( "open" );  
		});
		request.error( function(jqXHR,  textStatus  ){
			alert("error :"+textStatus);
			console.log(textStatus);
			console.log(jqXHR);
		});
	
	//event.preventDefault();
}

function detailPat2(obj){
patId=$(obj).attr('patid');
	param= "id="+patId;
	url=siteUrl+"pasien/detailMr/"+patId,  
			//buka Window baru
	window.open(url,'listMR'); 

}

function mrAdd(obj){ 
	patId=$(obj).attr('patid');
	param= "id="+patId;
	url=siteUrl+"pasien/addMr/"+patId,  
			//buka Window baru
	window.open(url,'addMR');
}

 