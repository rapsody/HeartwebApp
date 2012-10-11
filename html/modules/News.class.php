<?php
Class News {
    
    private $objNewsModel;

    public function __construct()
    {
        include ROOT_DIR.'models'.DS.__class__.'.class.php';
        $class_name = __class__.'_Model';
        $this->objNewsModel = new $class_name;
    }
        
    public function getNews() 
    {
        $news = $this->objNewsModel->loadNews();
        return $news;
    }
	
	public function getNewsDetails($input) 
    {
			try{
            if (!isset($input[2]) ) throw new Exception ("Invalid Input");
            
            libxml_use_internal_errors(true);
                
            // convert the xml into Object
            $inputObject = simplexml_load_string(
                                    $input, 
                                    "SimpleXMLElement" , 
                                    LIBXML_NOCDATA
                                );
                                
            if (!$inputObject) {

                // @var Array to store the error messages
                $errors = array ();
                
                // loop through the errors and store the errors in $errors
                foreach ( libxml_get_errors() as $e ) 
                    $errors[] = $e -> message;
            
                // @var String Errors are joined by a newline
                $errors = join ("\n", $errors);
                
                // throw the error
                throw new Exception ($errors);
            } // if !$inputObject
            
			if(!isset($inputObject -> newsid) || $inputObject -> newsid == '')
				throw new Exception ('News ID is empty');
            
		    $newsdetails = $this->objNewsModel->loadNewsDetails($inputObject->newsid);
			//print_r($newsdetails);
			if(count($newsdetails) > 0)
	        {
	        	return $newsdetails;
	        }
	        else
	        {
	        	throw new Exception ("No News Found");
	        }
		}
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
    }
	
}