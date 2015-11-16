/****
	Javascript	: other/otherMenu.js
	created	: 09-11-2015 12:23:12
	By		: Gunawan Wibisono
	Using 	: CI3 Main Model
****/ 

var lastsel=0;
function saveFormData()
{
	target=$("#frmMainMenu");
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

function btnAddMainMenu()
{
	statusBtn=true;
	param={action:"add"}
	if(statusBtn==true){
		res=sendAjax(urlFormAddParent,param);
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
	param={menu_id:lastsel}
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
		$("#modalBody").empty().append("Check kembali Input Anda");
			$("#footerDetail").empty() ;
			$("#modalHead").empty().append("Warning");
			$("#myModal").modal({show: true});
	
	}
}

jQuery("#list").jqGrid({
   	url:dataUrl1,
	datatype: "json",
   	colNames:['ID','Nama','Permision', 'Judul','Pos'],
   	colModel:[
   		{name:'id',index:'menu_id', width:55, align:"right"},
   		{name:'name',index:'menu_name', width:190},
		{name:'permision',sortable:false,width:99,align:"center"},
   		{name:'title',index:'menu_title', width:150},
   		{name:'pos',index:'menu_position', width:55},
   		 		
   	],
   	rowNum:15,
   	rowList:[15,25,40],
   	pager: '#pager',
   	sortname: 'menu_position',
    viewrecords: true,
    sortorder: "asc",
    caption:"Menu Editor",
	editurl:urlother,
	onSelectRow: function(id){
		if(id && id!==lastsel){			 
			lastsel=id;
		}
		ids=id;
		var ret = jQuery("#list").jqGrid('getRowData',id);
			console.log(ret);
		 
		jQuery("#list2").jqGrid('setGridParam',{url:dataUrl2+"?parent="+ids,page:1});
		jQuery("#list2").jqGrid('setCaption',"Sub Menu: "+ret.title)
			.trigger('reloadGrid');	
	}
});
jQuery("#list").jqGrid('navGrid','#pager',{edit:false,add:false,del:false});

jQuery("#list2").jqGrid({
   	url:dataUrl2,
	datatype: "json",
   	colNames:['ID','Nama','Permision', 'Judul','Pos'],
   	colModel:[
   		{name:'id',index:'menu_id', width:55},
   		{name:'name',index:'menu_name', width:190},
		{name:'permision',sortable:false,width:99,align:"center"},
   		{name:'title',index:'menu_title', width:250},
		{name:'pos',index:'menu_position', width:66},
				
   	],
   	rowNum:9,
   	rowList:[9,15,25,40],
   	pager: '#pager2',
   	sortname: 'menu_position',
    viewrecords: true,
    sortorder: "asc",
    caption:"Menu Editor",
	editurl:urlother,
	onSelectRow: function(id){
		if(id && id!==lastsel){			 
			lastsel=id;
			
		} 
			
	}
});
jQuery("#list2").jqGrid('navGrid','#pager2',{edit:false,add:false,del:false});