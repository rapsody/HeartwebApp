<?php
include_once ROOT_DIR.'modules'.DS.'Common.class.php';

Class Forms extends Common {
    
    private $objFormModel;

    public function __construct()
    {
        include ROOT_DIR.'models'.DS.__class__.'.class.php';
        $class_name = __class__.'_Model';
        $this->objFormModel = new $class_name;
    }
        
    public function getForm($input) 
    {
		try{
			 $inputObject = $this->processXML($input);
			
             $forms = $this->objFormModel->getForm($inputObject->userkey, $inputObject->formid);
	        if(count($forms) > 0)
	        {
	        	return $forms;
	        }
	        else
	        {
	        	throw new Exception ("No Form Exists");
	        }
            
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
		
	
    }
	
	public function getPdfFormData($formid,$db) 
    {
		try{


             return $this->objFormModel->getPdfFormData($formid,$db);
	       
            
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
		
	
    }
    
    //@todo no clarity yet
 	public function getForms($input) 
    {
		try{
            $inputObject = $this->processXML($input);
			
			if(!isset($inputObject->userkey) || $inputObject->userkey == '')
                throw new Exception ('Invalid Userkey.');
				
            $forms = $this->objFormModel->getForms($inputObject);
	        
			if(count($forms) > 0)
	        {
	        	return $forms;
	        }
	        else
	        {
	        	throw new Exception ("No Form Exists");
	        }
            
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
    	
    }

 	public function getRecentForms($input,$limit = '') 
    {
		try{
			  
            $inputObject = $this->processXML($input);
			
			if(!isset($inputObject->userkey) || $inputObject->userkey == '')
                throw new Exception ('Invalid Userkey.');
				
          $forms = $this->objFormModel->getRecentForms($inputObject->userkey,$limit);
	     
			if(count($forms) > 0)
	        {
	        	return $forms;
	        }
	        else
	        {
	        	throw new Exception ("No Form Exists");
	        }
            
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
    	
    }
    
    public function createForm($input) 
    {
     try{
            $inputObject = $this->processXML($input);
			
           if(isset($inputObject->PatientUr)) $filename = $inputObject->PatientUr. '-' . date('Y-m-d-').rand(1000,9999).'.pdf';
		   else $filename =date('Y-m-d-').rand(1000,9999).'.pdf';
		   
		   $data = $this -> objFormModel -> getPdfFormData($inputObject->formKey,$db);
		   $filename = (isset($inputObject->formKey) && $inputObject->formKey > 0)?$data['pdffile']:$filename;
          
            $returnValue = $this -> objFormModel -> createForm($inputObject,$filename);
            //if(is_numeric($returnValue))
			if($returnValue > 0)
            {
            	if(isset($inputObject->formKey) && $inputObject->formKey > 0)
            	{
					$this->createPDF($filename,$inputObject->formKey, $inputObject->authKey);
		            return  array ("status" => 'OK');
            	}
            	else
            	{
	            	$formid = $returnValue;
					//if($inputObject->FormMedia != 1)
						$this->createPDF($filename,$formid,$inputObject->authKey);
					return  array ("status" => 'OK',"FormKey" => $formid);
            	}
            	
            }            
            return $returnValue;
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
    }
    public function getFormPDF($input)
    {
    	 $inputObject = $this->processXML($input);
    	 return $this -> objFormModel -> getFormPDF($inputObject);
    }
	
	public function getFormPDFData($input)
    {
    	 $inputObject = $this->processXML($input);
    	 return $this -> objFormModel -> getFormPDFData($inputObject);
    }
	
    public function createMediaPDF($formid)
	{
		$data = $this -> objFormModel -> getPdfFormData($formid,$db);
		$postFields = 'mode=media&filename=m_'.$data['pdffile'].'&formid='.$formid.'&data='.urlencode(serialize($data)); 
    	$ch = curl_init();
	   
        curl_setopt($ch, CURLOPT_URL, SITE_URL.'plugins/pdf/pdf.php');
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, TRUE );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $postFields);

        $sms_server = curl_exec($ch);
        curl_close($ch);
		include '../plugins/PDFMerger/PDFMerger.php';
		$pdf = new PDFMerger;

		try{		
		$pdf->addPDF('../pdf/'.$data['pdffile'], 'all')
			->addPDF('../pdf/'.'m_'.$data['pdffile'], 'all')
			->merge('file', '../pdf/'.$data['pdffile']);			
		}
		catch(Exception $ex)
		{
		}

		try{
		$pdf->addPDF('../pdf/deidentified_'.$data['pdffile'], 'all')
			->addPDF('../pdf/'.'m_'.$data['pdffile'], 'all')
			->merge('file', '../pdf/deidentified_'.$data['pdffile']);			
		}
		catch(Exception $ex)
		{
		}
		@unlink('../pdf/'.'m_'.$data['pdffile']);
	}
	
	
    public function createPDF($filename,$formid, $sharedby=null)
    {
		$data = $this -> objFormModel -> getPdfFormData($formid,$db);

	
		$sharedby = $this -> objFormModel -> getSaredUserName($sharedby);
		$postFields = 'filename='.$filename.'&formid='.$formid.'&data='.urlencode(serialize($data)).'&sharedby='.$sharedby; 
    	$ch = curl_init();
	   
         curl_setopt($ch, CURLOPT_URL, SITE_URL.'plugins/pdf/pdf.php');
                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, TRUE );
                curl_setopt( $ch, CURLOPT_POST, 1 );
                curl_setopt( $ch, CURLOPT_POSTFIELDS, $postFields);

                $sms_server = curl_exec($ch);
                curl_close($ch);	
				
		$data['PatientUr'] = '';
		$data['PatientDob'] = '';
		$data['PatientAge'] = '';
		$data['PatientSex'] = '';
		$data['PatientSurname'] = '';
		$data['PatientFirstname'] = '';
		$data['PatientAddress'] = '';
		$data['PatientSuburb'] = '';
		$data['PatientState'] = '';
		$data['PatientPostcode'] = '';
		$data['PatientEmail'] = '';
		$data['PatientTel'] = '';
		$data['PatientMob'] = '';
		$data['Sharedby'] = $sharedby;
    	$postFields1 = 'filename='.'deidentified_'.$filename.'&formid='.$formid.'&data='.urlencode(serialize($data)); 
    	$ch1 = curl_init();
	
       
         curl_setopt($ch1, CURLOPT_URL, SITE_URL.'plugins/pdf/pdf.php');
         curl_setopt( $ch1, CURLOPT_RETURNTRANSFER, TRUE );
         curl_setopt( $ch1, CURLOPT_POST, 1 );
         curl_setopt( $ch1, CURLOPT_POSTFIELDS, $postFields1);

         $sms_server = curl_exec($ch1);
         curl_close($ch1);	
     			
         //include_once('/plugins/pdf/pdf.php');
    }
	
 	public function searchForms($input) 
    {
		try{
            $inputObject = $this->processXML($input);

   		 	$forms = $this->objFormModel->searchForms($inputObject);
	        if(count($forms) > 0)
	        {
	        	 return $forms;
	        }
	        else
	        {
	        	throw new Exception ("Data Not Available");
	        }
            
			
            
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
    }
	
    public function shareForm($input) 
    {
		try{
            $inputObject = $this->processXML($input);

   		 	$forms = $this->objFormModel->shareForm($inputObject);
	        if(count($forms) > 0)
	        {
	        	 return $forms;
	        }
	        else
	        {
	        	throw new Exception ("Data Not Available");
	        }
            
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
    }
    
	public function mailForm($input) 
    {
		try{
            $inputObject = $this->processXML($input);

   		 	$forms = $this->objFormModel->getFormDetails($inputObject);
	        if(count($forms) > 0)
	        {
	        	 return $forms;
	        }
	        else
	        {
	        	throw new Exception ("Data Not Available");
	        }
            
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
    }
	
	public function sendMailFormPDF($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message, $result)
    {
    	 return $this -> objFormModel -> sendMailFormPDF($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message, $result);
    }
	
	public function getGroupFormsList($input)
    {
    	try{
            $inputObject = $this->processXML($input);
           
            if($inputObject->groupid == '')
            {
                throw new Exception (
                        'Group Id should not be left empty.'
                );
            }
            
    		if($inputObject->userkey == '')
            {
                throw new Exception (
                        'Userkey should not be left empty.'
                );
            }
        $group_formslist = $this->objFormModel->loadGroupFormsList($inputObject);
			return $group_formslist;
            
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
    
    }
	
	public function updateMedia($files,$data)
	{


		try
		{
			$inputObject = $this->processXML($data);
			foreach($files as $val)
			{
				
				$val['name'] =date('dymhis').$inputObject->formKey.$val['name'];

				if(move_uploaded_file($val['tmp_name'],ROOT_DIR.'uploads/formdata/'.$val['name']))
				{
					$pathinfo = pathinfo($val['name']);
					$temp = array();
					$temp['media_type'] = (in_array(strtolower($pathinfo['extension']),array('jpeg','jpg','gif','png')))?'IMAGE':'VIDEO';
					$temp['name'] = FORM_MEDIA_URL.$val['name'];
					$out[] = $temp;
				}
			}
			
			$return = $this->objFormModel->updateMedia($out, $inputObject->formKey, $inputObject->authKey);
			
			
			
			if($return['status'] == 'ok')
			{
				$this->createMediaPDF($inputObject->formKey);
			}
			
			return $return;
		}
		catch(Exception $ex)
		{
			return $this -> setError($ex -> getMessage());
		}
	}
	
	public function userShareForm($input) 
    {
		try{
            $inputObject = $this->processXML($input);

   		 	$forms = $this->objFormModel->userShareForm($inputObject);
	        if(count($forms) > 0)
	        {
	        	 return $forms;
	        }
	        else
	        {
	        	throw new Exception ("Data Not Available");
	        }
            
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
    }
	
	public function deleteForm($input) 
    {
		try{
            $inputObject = $this->processXML($input);

   		 	$forms = $this->objFormModel->deleteForm($inputObject);
	        if(count($forms) > 0)
	        {
	        	 return $forms;
	        }
	        else
	        {
	        	throw new Exception ("Data Not Available");
	        }
            
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
    }


	public function removemedia($input) 
	{

		try{
            $inputObject = $this->processXML($input);	        
    		 return $this -> objFormModel -> removemedia($inputObject);

        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }


    	
    }

    
}