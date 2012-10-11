<?php
try
{
	if(isset($_FILES) && count($_FILES) > 0)
	{
		foreach($_FILES as $k => $val)
		{
			$upload = move_uploaded_file($val['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'/heartweb/actual/uploads/'.$val['name']);
			if($upload)
			echo 'uploaded successfully';
			else
			{
				if($val['size'] == 0)
				{
				echo 'Please upload file with less than 2 MB in size';
				}
				else
				{
				echo $val['error'];
				}
			}		
		}
	}
	else
	{
		echo 'No file posted.';
	}
}
catch(Exception $ex)
{
$ex->getMessage();
}
 