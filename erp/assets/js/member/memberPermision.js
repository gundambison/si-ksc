/****
	Javascript	: member/memberPermision.js
	created	: 09-11-2015 11:09:06
	By		: Gunawan Wibisono
	Using 	: CI3 Main Model
****/
var lastsel;
function saveFormData()
{
	target=$("#frmMain");
	console.log( target.serialize());
	param=target.serialize(); 
	res=sendAjax(urlFormSave,param); 
		res.success(function(result,status) { 
			console.log("success");
			console.log(result);
			$("#modalBody").empty().append(result.body);
			$("#footerDetail").empty().append(result.footer);
			$("#modalHead").empty().append(result.title);
			$("#myModal").modal({show: false}); 
			jQuery("#list,#list2").trigger('reloadGrid');	
		});
		res.error(function(xhr,status,msg){			 
			console.log("Error");
			console.log(status);
			console.log(msg);
			console.log(xhr);			
		});
		
}

function btnAdd()
{
statusBtn=true;
	param={action:"addSub"}
	if(statusBtn==true){
		res=sendAjax(urlFormAdd,param);
		res.success(function(result,status) {
			$("#modalBody").empty().append(result.body);
			$("#footerDetail").empty().append(result.footer);
			$("#modalHead").empty().append(result.title);
			$("#myModal").modal({show: true});			 
			console.log("success");console.log(result);			 
		});
		res.error(function(xhr,status,msg){
			$("#modalBody").empty().append(msg);
			$("#footerDetail").empty().append("status :"+status);
			$("#modalHead").empty().append("ERROR");
			$("#myModal").modal({show: true});
			console.log("Error");
			console.log(status);
			console.log(msg);
			console.log(xhr);
			
		});
	}
	else{ 
		$("#modalBody").empty().append("Check kembali Input Anda");
			$("#footerDetail").empty() ;
			$("#modalHead").empty().append("Warning");
			$("#myModal").modal({show: true});
	
	}
}

function btnEdit()
{
statusBtn=false;
	param={permit_id:lastsel}
	console.log('edit='+lastsel);
	if(lastsel>0) statusBtn=true;	
	if(statusBtn==true){
		res=sendAjax(urlFormEdit,param);
		res.success(function(result,status) {
			$("#modalBody").empty().append(result.body);
			$("#footerDetail").empty().append(result.footer);
			$("#modalHead").empty().append(result.title);
			$("#myModal").modal({show: true});
			 
			console.log("success");console.log(result);
			 
		});
		res.error(function(xhr,status,msg){
			$("#modalBody").empty().append(msg);
			$("#footerDetail").empty().append("status :"+status);
			$("#modalHead").empty().append("ERROR");
			$("#myModal").modal({show: true});
			console.log("Error");
			console.log(status);
			console.log(msg);
			console.log(xhr);
			
		});
	}
	else{ 
		$("#modalBody").empty().append("Pilih Salah satu Data");
			$("#footerDetail").empty() ;
			$("#modalHead").empty().append("Warning");
			$("#myModal").modal({show: true});
	
	}
}


/*========================*/
jQuery("#list").jqGrid({
   	url:dataUrl1,
	datatype: "json",
   	colNames:['ID','Name', 'Created'],
   	colModel:[
   		{name:'id',index:'permit_id',align:"right", width:55},
		{name:'name',index:'permit_name', width:295},
   		{name:'created',index:'permit_created', width:200}, 
   	],
   	rowNum:15,
   	rowList:[15,25,40],
   	pager: '#pager',
   	sortname: 'permit_id',
    viewrecords: true,
    sortorder: "asc",
    caption:"Permision",
	editurl:urlother,
	onSelectRow: function(id){
		if(id && id!==lastsel){			 
			lastsel=id;
		}
	}
});
jQuery("#list").jqGrid('navGrid','#pager',{edit:false,add:false,del:false});