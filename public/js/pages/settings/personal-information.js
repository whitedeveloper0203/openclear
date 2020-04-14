$('#country').change(function(){
    var countryID = $(this).val();    

    if(countryID){
        $.ajax({
            type: "GET",
            url: siteUrl + "/personal-information/get-state-list?country_id="+countryID,
            success:function(res){               
                if(res){
                    $("#state").empty();
                    $("#state").append('<option>Select</option>');
                    $.each(res,function(key, value){
                        $("#state").append('<option value="'+value['id']+'">'+value['name']+'</option>');
                    });
                
                } else{
                    $("#state").empty();
                }
            }
        });
    }else{
        $("#state").empty();
        $("#city").empty();
    }      
});

$('#state').on('change',function(){
    var stateID = $(this).val();
        
    if(stateID){
        $.ajax({
            type:"GET",
            url:siteUrl + "/personal-information/get-city-list?state_id="+stateID,
            success:function(res){               
                if (res){
                    $("#city").empty();
                    $.each(res,function(key, value){
                        $("#city").append('<option value="'+value['id']+'">'+value['name']+'</option>');
                    });
                
                } else{
                    $("#city").empty();
                }
            }
        });
    } else {
        $("#city").empty();
    }

});