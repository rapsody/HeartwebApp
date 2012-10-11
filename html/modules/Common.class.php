<?php
class Common
{
 	
	public function __construct()
	{
		
	}
	
	protected function processXML($input)
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
			
			foreach ( $inputObject as $name => $value ){
			 $val = (strtolower(trim ($value)) == '(null)')?'':trim ($value);
			 $inputObject -> $name = $val;
			}
			
			return $inputObject;
		}
	 	catch (Exception $e) {
        	
            $this -> setError($e -> getMessage());
        }
	}
	
	public function setError($error) {
        $this -> errorMessages[] = $error;
        return false;
    }
}