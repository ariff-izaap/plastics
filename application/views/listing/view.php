<?php /*if ($message = $this->service_message->render()) :?>
<?php echo $message;?>
<?php endif; */?>

<!-- button tool bar section start here -->

<div class="row">
    <div class="tableView">

		<?php echo $search_bar;?>


        <form name="<?php echo $this->namespace;?>" id="<?php echo $this->namespace;?>" action="<?php echo site_url($this->uri->segment(1, 'admin').'/'.$this->uri->segment(2, 'index').'/bulk_actions');?>" method="post">
			<?php echo $listing;?>
				
		</form>	
	</div>	




