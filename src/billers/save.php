<?php
include('./include/include_main.php'); 

//stop the direct browsing to this file - let index.php handle which files get displayed
checkLogin();



# Deal with op and add some basic sanity checking

$op = !empty( $_POST['op'] ) ? addslashes( $_POST['op'] ) : NULL;

#insert biller
 	
if ( $op === 'insert_biller') {
	
 	$sql = "INSERT into
			{$tb_prefix}biller
		VALUES
			(
				'',
				'$_POST[b_name]',
				'$_POST[b_street_address]',
				'$_POST[b_street_address2]',
				'$_POST[b_city]',
				'$_POST[b_state]',
				'$_POST[b_zip_code]',
				'$_POST[b_country]',
				'$_POST[b_phone]',
				'$_POST[b_mobile_phone]',
				'$_POST[b_fax]',
				'$_POST[b_email]',
				'$_POST[b_co_logo]',
				'$_POST[b_co_footer]',
				'$_POST[b_notes]',
				'$_POST[b_custom_field1]',
				'$_POST[b_custom_field2]',
				'$_POST[b_custom_field3]',
				'$_POST[b_custom_field4]',
				'$_POST[b_enabled]'
			 )";
 	
 	if (mysql_query($sql, $conn)) {
 		$display_block = $LANG_save_biller_success;
 	} else {
 		$display_block = $LANG_save_biller_failure.$sql;
 	}
 	
 	//header( 'refresh: 2; url=index.php?module=billers&view=manage' );
	$refresh_total = "<META HTTP-EQUIV=REFRESH CONTENT=2;URL=index.php?module=billers&view=manage>";
 	
}

#edit biller

else if (  $op === 'edit_biller' ) {

	if (isset($_POST['save_biller'])) {
		$sql = "UPDATE
				{$tb_prefix}biller
			SET
				b_name = '$_POST[b_name]',
				b_street_address = '$_POST[b_street_address]',
				b_street_address2 = '$_POST[b_street_address2]',
				b_city = '$_POST[b_city]',b_state = '$_POST[b_state]',
				b_zip_code = '$_POST[b_zip_code]',
				b_country = '$_POST[b_country]',
				b_phone = '$_POST[b_phone]',
				b_mobile_phone = '$_POST[b_mobile_phone]',
				b_fax = '$_POST[b_fax]',
				b_email = '$_POST[b_email]',
				b_co_logo = '$_POST[b_co_logo]',
				b_co_footer = '$_POST[b_co_footer]',
				b_notes = '$_POST[b_notes]',
				b_custom_field1 = '$_POST[b_custom_field1]',
				b_custom_field2 = '$_POST[b_custom_field2]',
				b_custom_field3 = '$_POST[b_custom_field3]',
				b_custom_field4 = '$_POST[b_custom_field4]',
				b_enabled = '$_POST[b_enabled]'
			WHERE
				b_id = '$_GET[submit]'";
		if (mysql_query($sql, $conn)) {
			$display_block = $LANG_save_biller_success;
		} else {
			$display_block = $LANG_save_biller_failure;
		}

		$refresh_total =  "<META HTTP-EQUIV=REFRESH CONTENT=2;URL=index.php?module=billers&view=manage>";

		}

	else if (isset($_POST['cancel'])) {

		$refresh_total = "<META HTTP-EQUIV=REFRESH CONTENT=0;URL=index.php?module=billers&view=manage>";
	}


$refresh_total = "<META HTTP-EQUIV=REFRESH CONTENT=2;URL=index.php?module=billers&view=manage>";
}
?>

<html>
<head>
<?php

include('./include/include_main.php');

$refresh_total = isset($refresh_total) ? $refresh_total : '&nbsp';
$display_block_items = isset($display_block_items) ? $display_block_items : '&nbsp;';
echo <<<EOD
{$refresh_total}

<br>
<br>
{$display_block}
<br><br>
{$display_block_items}

EOD;
?>
<!-- ./src/include/design/footer.inc.php gets called here by controller srcipt -->
