 <div class="row">
    <div class="breadcrumbs">
      <?php echo set_breadcrumb(); ?>
        <a href="<?php echo $this->previous_url;?>" class="btn btn-sm pull-right"><i class="back_icon"></i> Back</a>
      
    </div>
  </div>
  
     <br />
     <br />
     <div class="container">
       <div class="row">
            <div class="col-md-12">
             <h2>Products</h2>
                 <table class="table table-striped table-hover tableSite table-bordered">
                     <tr>
                        <td>Control Number</td>
                        <td>Product</td>
                        <td>Form</td>
                        <td>Color</td>
                        <td>Type</td>
                        <td>Rename</td>
                        <td>From Location</td>
                        <td>Quantity</td>
                        <td>Cost</td>
                        <td>Inbound Freight</td>
                      </tr>
                       <?php //print_r($editdata['images']); 
                           if(count($editdata['images'])>0) { 
                             foreach($editdata['images'] as $ekey => $evalue) {
                         ?>
                            <tr>
                                <td><?php echo $evalue['image_title']; ?></td>
                                <td><img src="<?php echo base_url(); ?>assets/images/product/<?php echo $evalue['file_name']; ?>" /></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                     <?php }} 
                          else { ?>
                       <tr>
                        <td colspan="11"><?php echo "No Products Found!"; ?></td>
                       </tr>
                      <?php
                        
                     }?>
                  </table>
            </div>
       </div>
         </div> 
     
          
      <br />
      <br />
          <div class="container button-sec">  
       <div class="row">
          <div class="col-md-3">
            <button type="button" class="col-md-2 btn btn-block">Create Shipment Email</button>
          </div>
          <div class="col-md-3"> 
            <button type="button" class="col-md-2 btn btn-block">Product Selection</button>
         </div>
         <div class="col-md-3">   
            <button type="button" class="col-md-2 btn btn-block">Delete Shipping Order</button>
         </div>
         <div class="col-md-3">   
            <button type="button" class="col-md-2 btn btn-block">Save Shipping Order</button>
         </div>
         
       </div>
       </div>
  

</div>  
