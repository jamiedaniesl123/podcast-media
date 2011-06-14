<?PHP
/*========================================================================================*\
	#	Coder    :  Ian Newton
	#	Date     :  24th May,2011
	#	Test version  
	#	input controller to accept post requests from the admin server
\*=========================================================================================*/

require_once("../lib/config.php");
require_once("../lib/classes/action.class.php");
require_once("../lib/classes/output.class.php");

$dataStream = file_get_contents("php://input");

$dataMess=explode('=',urldecode($dataStream));
// print_r($dataMess[1]);

if ($dataMess[1]!='') {

	$data=json_decode($dataMess[1],true);
//print_r($data);

	$mysqli = new mysqli($dbhost, $dbusername, $dbuserpass, $dbname);

	$dataObj = new Default_Model_Action_Class($mysqli);
	
	if (isset($data['command'])) {

		 if ($data['command']=='processfile'){
				$m_data = $dataObj->queueAction($data['data'],$data['number'],$data['command'],$data['timestamp']);
			
			}else if ($data['command']=='metadata'){
				$m_data = $dataObj->queueAction($data['data'],$data['number'],$data['command'],$data['timestamp']);
			
			}else if ($data['command']=='deletefile'){
				$m_data = $dataObj->queueAction($data['data'],$data['number'],$data['command'],$data['timestamp']);
				
			}else if ($data['command']=='deletefolder'){
				$m_data = $dataObj->queueAction($data['data'],$data['number'],$data['command'],$data['timestamp']);
				
			}else if ($data['command']=='checkfile'){
				$m_data = $dataObj->doCheckFile($data['data'],$data['number'],$data['timestamp']);
				
			}else if ($data['command']=='status'){
				$m_data = $dataObj->getStatus($data['data'],$data['number'],$data['command']);
				
			}

	}else{
		$m_data = $dataObj->getStatus($data['data'],$data['number']);
	}
	

}else{
	$m_data = array('status'=>'NACK', 'data'=>'No request values set!', 'timestamp'=>time());
}

$jsonData = json_encode($m_data);
echo $jsonData;
	

?>