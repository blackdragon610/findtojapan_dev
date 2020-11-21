function AjaxZip(zip1,zip2,address1,address2,address3){
var self = this;
this.zip1 = zip1;
this.zip2 = zip2;
this.address1 = address1;
this.address2 = address2;
this.address3 = address3;

	$(zip1).keyup(setArea);
	$(zip2).keyup(setArea);
	


	function setArea(){
		
		if ($(self.zip1).val().length + $(self.zip2).val().length >= 7){
			
			setState();
		}
	}
	
  function setState() {
    var zip = $(self.zip1).val() + '-' + $(self.zip2).val();
		
		
		
    $.ajax({
      type : 'get',
      url : 'https://maps.googleapis.com/maps/api/geocode/json',
      crossDomain : true,
      dataType : 'json',
      data : {
        address : zip,
        language : 'ja',
        sensor : false
      },
      success : function(resp){
	     	
	     	
        if(resp.status == "OK"){
					
						        
			    var results2 = resp.results[0].address_components.filter(function(component) {
			      return component.types.indexOf("administrative_area_level_1") > -1;
			    });
			   
			   
			   $(self.address1).val(results2[0].long_name); // 初綺
			   
			    results2 = resp.results[0].address_components.filter(function(component) {
			      return component.types.indexOf("locality") > -1;
			    });
						     

          var obj = resp.results[0].address_components;
					
					
										
          if (self.address2){
	          $(self.address2).val(obj[2]['long_name']);  // 絽榊堺
	        }else{
	          $(self.address1).val($(self.address1).val() + obj[2]['long_name']);  // 絽榊堺
					}		         

          if (self.address3){
	          $(self.address3).val(obj[1]['long_name']);  // 絽榊堺
	        }else{
	          $(self.address1).val($(self.address1).val() + obj[1]['long_name']);  // 絽榊堺
					}		    

        }else{
          return false;
        }
      }
    }); 
  }  
 }