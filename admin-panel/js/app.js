$("#start-new-project").click(function(){
    $("#createNew").modal('show'); 
});

$("#start-new-cat").click(function(){
    $("#newCat").modal('show'); 
});

function update_this_course(id){
    $.ajax({
        type: "GET",
        url: "./_api/_course.php",
        data: {id: id},
        success: function(data){
            $("#update_course_id").val(data[0].course_id);
            
            $("#update_course_title").val(data[0].title);
            $("#update_course_desc").val(data[0].description);
            
            let this_c_id = data[0].category_id;
            
            $.ajax({
                type: "GET",
                url: './_api/_category.php',
                success: function(data){
                    
                    $("#update_course_category").html("");
                    $("#update_course_category").append('<option value="none">-- No Select --</option>'); 
                    
                    $.each(data, function(i, data){
                        if(data.c_id == this_c_id){
                            $("#update_course_category").append('<option value="'+data.c_id+'" selected>'+data.title+'</option>');
                        }else{
                            $("#update_course_category").append('<option value="'+data.c_id+'">'+data.title+'</option>');
                        }
                    });
                }
            });
            
            $("#update_offered_by").val(data[0].offered_by);
            $("#update_time_to_complete").val(data[0].time_to_complete);
            $("#update_yt_url").val(data[0].yt_url);
            
            $("#updateNew").modal('show');
        }
    });
}

function update_this_category(id){
    $.ajax({
        type: "GET",
        url: "./_api/_category.php",
        data: {id: id},
        success: function(data){
            $("#update_cat_id").val(data[0].c_id);
            $("#update_category_title").val(data[0].title);
            
            $("#updateCat").modal('show');
        }
    });
}