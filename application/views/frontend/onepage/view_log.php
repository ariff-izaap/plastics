<div class="modal-dialog modal-lg">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">View Call Logs</h4>
    </div>
    <div class="modal-body" style="max-height: 450px;overflow: auto;">
    	<div class="row">
    		<div class="col-md-12">
    			<table class="table table-hover table-bordered">
    				<thead>
    					<th width="8%">SNO</th><th width="15%">Salesman</th><th width="18%">Log Date</th><th width="18%">Call Type</th><th width="41%">Comments</th>
    				</thead>
    				<tbody>
    					<?php
    					if($logs)
    					{
    						$i=1;
    						foreach ($logs as $key => $value)
    						{
    							?>
    								<tr>
    									<td><?=$i++;?></td>
    									<td><?=$value['salesman'];?></td>
    									<td><?=displayData($value['log_date'],'datetime');?></td>
    									<td><?=$value['call_type'];?></td>
    									<td><?=$value['call_log'];?></td>
    								</tr>
    							<?php
    						}
    					}
    					?>
    				</tbody>
    			</table>
    		</div>
    	</div>
    </div>
    <div class="modal-footer">
      <div class="col-md-4 pull-right">
        <button data-dismiss="modal" class="btn btn-danger">Close</button>
      </div>
    </div>
  </div>
</div>
