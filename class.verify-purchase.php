<?php
class EnvatoApi2 {
    // Bearer, no need for OAUTH token, change this to your bearer string
    // https://build.envato.com/api/#token
    
    private static $bearer = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"; // replace the API key here.
    
    static function getPurchaseData( $code ) {
      
      //setting the header for the rest of the api
      $bearer   = 'bearer ' . self::$bearer;
      $header   = array();
      $header[] = 'Content-length: 0';
      $header[] = 'Content-type: application/json; charset=utf-8';
      $header[] = 'Authorization: ' . $bearer;
      
      $verify_url = 'https://api.envato.com/v3/market/author/sale/';
      $ch_verify = curl_init( $verify_url . '?code=' . $code );
      
      curl_setopt( $ch_verify, CURLOPT_HTTPHEADER, $header );
      curl_setopt( $ch_verify, CURLOPT_SSL_VERIFYPEER, false );
      curl_setopt( $ch_verify, CURLOPT_RETURNTRANSFER, 1 );
      curl_setopt( $ch_verify, CURLOPT_CONNECTTIMEOUT, 5 );
      curl_setopt( $ch_verify, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
      
      $cinit_verify_data = curl_exec( $ch_verify );
      curl_close( $ch_verify );
      
      if ($cinit_verify_data != "")    
        return json_decode($cinit_verify_data);  
      else
        return false;
        
    }
    
    static function verifyPurchase( $code ) {
      $verify_obj = self::getPurchaseData($code); 
      
      // Check for correct verify code
      if ( 
          (false === $verify_obj) || 
          !is_object($verify_obj) ||
          isset($verify_obj->error) ||
          !isset($verify_obj->sold_at)
      )
        return -1;

      // If empty or date present, then it's valid
      if (
        $verify_obj->supported_until == "" ||
        $verify_obj->supported_until != null
      )
        return $verify_obj;  
      
      // Null or something non-string value, thus support period over
      return 0;
      
    }
  }
?>