<?PHP
/*========================================================================================*\
	#	Coder    :  Ian Newton
	#	Date     :  24th May,2011
	#	Test version  
	#	itest controller to send and display responses to simulate admin end
\*=========================================================================================*/

require_once("./lib/config.php");
require_once("./lib/classes/output.class.php");

	$outObj = new Default_Model_Output_Class();


if (isset($_REQUEST['action_select'])) {
	
	echo $_REQUEST['action_select'];

	if ($_REQUEST['action_select'] == 'addfile') {
		$fdata= array('custom_id'=>'', 'fname'=>'firstfile.m4v', 'type'=>'utube', 'encode'=>'500kbs', 'count'=>'1');
		$fdata[]= array('custom_id'=>'', 'fname'=>'secondfile.m4v', 'type'=>'itunes', 'encode'=>'196kbs', 'count'=>'2');
		$postData=array(	'command'=>'addfile' ,'number'=>1,'data'=>$fdata,'timestamp'=>time());

	}else if ($_REQUEST['action_select'] == 'checkfile'){
		$fdata= array('custom_id'=>'', 'fname'=>'firstfile.mp4', 'count'=>'1');
		$fdata[]= array('custom_id'=>'', 'fname'=>'secondfile.mp4', 'count'=>'2');
		$fdata[]= array('custom_id'=>'', 'fname'=>'thirdfile.mp4', 'count'=>'3');
		$fdata[]= array('custom_id'=>'', 'fname'=>'fourthfile.mp4', 'count'=>'4');
		$postData=array(	'command'=>'checkfile' ,'number'=>4,'data'=>$fdata,'timestamp'=>time());

	}else if ($_REQUEST['action_select'] == 'metadata'){
		$fdata= array('custom_id'=>'', 
		'fname'=>'firstfile.mp4', 
		'account'=>'The account', 
		'author'=>'The author', 
		'comments'=>'Some comments here', 
		'contentId'=>'A content ID',  
		'expirationDate'=>'24/09/2011',  
		'releaseDate'=>'24/09/2010',  
		'revision'=>'1.01',  
		'securityGroup'=>'secure group',  
		'title'=>'Title 1',  
		'type'=>'the data type', 
		'count'=>'1');
		$fdata[]= array('custom_id'=>'', 
		'fname'=>'firstfile.mp4', 
		'account'=>'The account', 
		'author'=>'The author', 
		'comments'=>'Some comments here', 
		'contentId'=>'A content ID',  
		'expirationDate'=>'24/09/2011',  
		'releaseDate'=>'24/09/2010',  
		'revision'=>'1.01',  
		'securityGroup'=>'secure group',  
		'title'=>'Title 1',  
		'type'=>'the data type', 
		'count'=>'2');
		$fdata[]= array('custom_id'=>'', 
		'fname'=>'firstfile.mp4', 
		'account'=>'The account', 
		'author'=>'The author', 
		'comments'=>'Some comments here', 
		'contentId'=>'A content ID',  
		'expirationDate'=>'24/09/2011',  
		'releaseDate'=>'24/09/2010',  
		'revision'=>'1.01',  
		'securityGroup'=>'secure group',  
		'title'=>'Title 1',  
		'type'=>'the data type', 
		'count'=>'3');
		$fdata[]= array('custom_id'=>'', 
		'fname'=>'firstfile.mp4', 
		'account'=>'The account', 
		'author'=>'The author', 
		'comments'=>'Some comments here', 
		'contentId'=>'A content ID',  
		'expirationDate'=>'24/09/2011',  
		'releaseDate'=>'24/09/2010',  
		'revision'=>'1.01',  
		'securityGroup'=>'secure group',  
		'title'=>'Title 1',  
		'type'=>'the data type', 
		'count'=>'4');
		$postData=array(	'command'=>'metadata' ,'number'=>4,'data'=>$fdata,'timestamp'=>time());

	}else if ($_REQUEST['action_select'] == 'deletefile'){
		$fdata= array('custom_id'=>'', 'filename'=>'firstfile.mp4', 'count'=>'1');
		$fdata[]= array('custom_id'=>'', 'filename'=>'secondfile.mp4', 'count'=>'2');
		$fdata[]= array('custom_id'=>'', 'filename'=>'thirdfile.mp4', 'count'=>'3');
		$fdata[]= array('custom_id'=>'', 'filename'=>'fourthfile.mp4', 'count'=>'4');
		$postData=array(	'command'=>'deletefile' ,'number'=>1,'data'=>$fdata,'timestamp'=>time());

	}else if ($_REQUEST['action_select'] == 'deletefolder'){
		$fdata= array('custom_id'=>'', 'foldername'=>'/itunes', 'count'=>'1');
		$fdata[]= array('custom_id'=>'', 'foldername'=>'/utube', 'count'=>'2');
		$postData=array(	'command'=>'deletefolder' ,'number'=>1,'data'=>$fdata,'timestamp'=>time());
	}else{
	$postData=array(	'command'=>'status' ,'number'=>1,'data'=>'some data here!','timestamp'=>time());
	}
	
}else{
	$postData=array(	'command'=>'status' ,'number'=>1,'data'=>'some data here!','timestamp'=>time());
}
	$postData0=array('mess'=>json_encode($postData));
	$result=$outObj->rest_helper($mediaUrl, $postData0, 'GET', 'json');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin post command</title>
<script type="application/x-javascript">
<!--
function submitform()
{
	document.getElementById('action').submit();
}
-->
</script>
</head>

<body>
<?PHP 
echo "<br /><br /><b>Sending: </b>";
print_r(json_encode($postData));
echo "<br /><br /><b>Returns: </b>";
 if (isset($result)) print_r ($result);?>
<br /><br /> 
 <form action="" method="post" enctype="application/x-www-form-urlencoded" name="action" id="action">
 
 <select name="action_select" onchange="javascript:submitform();">
 <option value="">Select action ...</option>
 <option value="">Status</option>
 <option value="addfile">C - Add file(s)</option>
 <option value="checkfile">R - Check file(s)</option>
 <option value="metadata">U - Write Meta Data</option>
 <option value="deletefile">D - Delete File(s)</option>
 <option value="deletefolder">D - Delete Folder(s)</option>
 </select>
 
 </form>
</body>
</html>
