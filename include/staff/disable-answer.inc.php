<?php
if(!defined('OSTADMININC') || !$thisstaff || !$thisstaff->isAdmin()) die('Access Denied');


if(isset($_POST['submit']))
{
	$spojeni->execute_query("TRUNCATE TABLE `cis_disable_answer`");
	if (isset($_POST['department'])) 
	{
		$departments = $_POST['department'];
		foreach ($departments as $deptid) {$spojeni->execute_query("INSERT INTO `cis_disable_answer`(department_id, disable) VALUES($deptid, 1)");}
		
	}
}

$deptDB = TABLE_PREFIX."department";
$ost_departments    = mysqli_query($spojeni_ost, "SELECT * FROM $deptDB"); ?>

<form action="disable-answer_settings.php" method="POST"> <?php
	csrf_token(); ?>
	<input type="hidden" name="t" value="system">

	<table class="form_table settings_table" width="940" border="0" cellspacing="0" cellpadding="2">
		<div style="padding-left:2px;">
			<tbody>
				<tr>
					<th colspan="2">
						<em><b><?php echo __('Departments'); ?></b><?php echo __(' for which the prefix will be set to "do not answer"'); ?></em>
					</th>
				</tr> <?php
				
				while ($zaznam_ost_departments = mysqli_fetch_array ($ost_departments)) 
				{
					$ddisable 	= 0;
					$did 		= $zaznam_ost_departments["id"];
					$dname	 	= $zaznam_ost_departments["name"];
					
					$cis_disable_answer = mysqli_query($spojeni, "SELECT * FROM `cis_disable_answer` WHERE `department_id` = $did");
					while ($zaznam_disable_answer = mysqli_fetch_array ($cis_disable_answer)) 
					{
						$ddisable = $zaznam_disable_answer["disable"];
					} ?>
					
					<tr>
						<td width="300"><?php echo $dname;?></td>
						<td>
							<?php if ($ddisable == 0) { ?> <input type="checkbox" name="department[]" value=<?php echo $did; ?>> <?php } ?>
							<?php if ($ddisable == 1) { ?> <input type="checkbox" name="department[]" value=<?php echo $did; ?> checked> <?php } ?>
						</td>
					</tr> <?php
				} ?>
			</tbody>
		</div>
	</table>
	<p style="text-align:center;">
		<input class="button" type="submit" name="submit" value="<?php echo __('Save Changes');?>">
		<input class="button" type="reset" name="reset" value="<?php echo __('Reset Changes');?>">
	</p>
</form>