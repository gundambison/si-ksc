/****
	Javascript	: member/memberLogin.js
	created	: 14-11-2015 00:38:03
	By		: Gunawan Wibisono
	Using 	: CI3 Main Model
****/

function checklogin(){
	target=$("#frmMain");
	console.log( target.serialize());
	param=target.serialize(); 
	res=sendAjax(urlLogin, param); 
		res.success(function(result,status) { 
			console.log(result);
			$("#modalBody").empty().append(result.message);
			$("#footerDetail").empty() ;
			if(result.status==true){				
				$("#modalHead").empty().append("success");
				 
			}
			else{				
				$("#modalHead").empty().append("failed");
			}
			
			$("#myModal").modal({show: true});
			if(result.status==true){	
				console.log(result.url);
				window.location.href =result.url;
			}
		});
	res.error(function(xhr,status,msg){		
		alert('error');
		console.log(status);
		console.log(msg);
		console.log(xhr);	
	}	);
}