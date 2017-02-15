<option value=""></option>
<?php
if($tb)
{
	foreach ($tb as $value)
	{
		?>
		<option value="<?=$value['id'];?>"><?=$value['name'];?></option>
		<?php
	}
}
?>