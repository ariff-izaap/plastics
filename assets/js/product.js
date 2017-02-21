
var upld_options = {}; 
    upld_options.uploadUrl              = base_url+'inventory/do_upload';
    upld_options.allowedFileExtensions  = ['jpg','jpeg','png','gif'];
    upld_options.maxFileSize            = 1000; //kb
    upld_options.showCaption            = false;
    upld_options.dropZoneEnabled        = false;
    upld_options.showRemove             = false;
    
    var up_folder,divid,field_name;
    
    if(prv_img != '')
        upld_options.initialPreview = [prv_img];
        
    if(page == 'social'){
        up_folder  = 'social_icon';
        divid      = 'Images';
    }    
    else
    {
        up_folder = 'product';
        divid     = 'file_name';  
    }
     
    upld_options.uploadExtraData = {'upload_folder':up_folder,'types':'gif|jpg|png|jpeg','field':Id}, 

    upld_options.slugCallback = function(filename) {      
      return filename.replace('(', '_').replace(']', '_');
    };
    
    $("#success_msg").html('');
    
    $("#"+Id).fileinput(upld_options);

    $(document).ready(function() {
         
        $('#'+Id).on('fileuploaded', function(event, data, previewId, index) {
            var form = data.form, files = data.files, extra = data.extra,
            response = data.response, reader = data.reader;
            var imgtitle    = $("#image_title").val(); 
            var productid   = $("#edit_id").val();
            var uploaded_id = response.image_id;
             $.ajax({
                      url:base_url+"inventory/update_image_title/",
                      type:"POST",
                      data:{"image_title":imgtitle,"product_id":productid,'uploaded_id':uploaded_id},
                      dataType:'json',
                      success:function(res){
                        $("#success_msg").html(res.message).fadeIn(400);
                        $("#success_msg").fadeOut(600);
                      }
                  });
                  
            $("#"+divid).val(response.fileuploaded);       
        });
    });

