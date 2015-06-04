
function commonAjaxSubmit(url,formObj){
	
	    if(!formObj||formObj==''){
	
	        var formObj="form";
	
	    }
	   
	    if(!url||url==''){
	
	        var url=document.URL;
	
	    }
	
	    var options={
	
	    	  beforeSubmit:showRequest,
	
	  		  success:showResponse
	
	  	 };
	
	    jQuery(formObj).ajaxForm(options);
	
	    return false;
	
	}
	
	function showRequest(formData,jqForm,options){
	
		var check=CheckForm(formData,jqForm,"help-inline");
		if(!check)return false;
		return true;
	
	}
	
	function showResponse(data,statusText,xhr,$form){
		 
	      var status=data['status'];
	
	      var msg=data['info'];
	
	      var url=data['url'];
	      if(status==1){
	      alert(msg);
	      window.location.href=url;
	      }else{
	    	  //fleshVerify();
	    	  alert(msg);
	      }
	}    
