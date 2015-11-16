/****
	Javascript	: main.js
	created	: 22-07-2015 17:12:09
	By		: CI3 Stock Controllers
****/
function sendAjax(url,params){
	var request = $.ajax({
          url: url,
          type: "POST",
          data: params,
          dataType: "json", 
		  cache:false,
		  timeout:20000, 
    });
	
	return request;
}

function showModalAjax(url,params,title,showModal){
	var request = $.ajax({
          url: url,
          type: "POST",
          data: params,
          dataType: "json",
		  beforeSend(xhr){
/*		  
			console.log('url:'+url); console.log(params); console.log(xhr);
*/
		  },
		  cache:false,
		  timeout:20000,
		  
		  
    });
	request.success(function(result,status) {
		$("#modalBody").empty().append(result.body);
		$("#footerDetail").empty().append(result.footer);
		$("#modalHead").empty().append(title);
		$("#myModal").modal({show: showModal});
		$("#myModal").show(); 
		console.log("success");console.log(result);
		 
	});
	request.error(function(xhr,status,msg){
		$("#modalBody").empty().append(msg);
		$("#footerDetail").empty().append("status :"+status);
		$("#modalHead").empty().append("ERROR");
		$("#myModal").modal({show: true});
		console.log("Error");
		console.log(status);
		console.log(msg);
		console.log(xhr);
		
	});
	return true;
}