$("#bagianGigi").click(function(){
	updateGigi();
});
$("#gigi").keyup(function(){
	updateGigi();
});


function updateGigi(){	
	exGigi = $("#exampleGigi");
	style  = "gigi"+$("#bagianGigi").val();
	isi = $("#gigi").val();
	console.log("style="+style);
	console.log("isis="+isi);
	exGigi.removeClass("gigi1").removeClass("gigi2").removeClass("gigi3").removeClass("gigi4");
	exGigi.addClass(style);
	exGigi.html(isi);

}

function saveMedrec()
{
	var selectorform = 'form#pasienForm'; 
	var datax = $(selectorform).serialize();
	var request = $.ajax({
			url: siteUrl+"pasien/saveMedrec",
			type: "POST",
			data: datax,
			dataType: "json"
		});
		request.success(function(res) {
			console.log('data sudah terkirim');
			if( res.error  ){ 
				alert( res.message);
			}else{ 
				alert("silakan tutup halaman ini");
			}
			  
		});
		request.error( function(jqXHR,  textStatus  ){
			alert("error :"+textStatus);
			console.log(textStatus);
			console.log(jqXHR);
		});
}

$().button('loading');
/* editor */
 tinymce.init({
    selector: "textarea",
	 plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save contextmenu paste textcolor"
   ], 
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons", 
   style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
   
        {title: 'Table styles'},
        {title:	 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ]
 });  	
