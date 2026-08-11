<?php
class main {


    public function api($form_data) {
        require_once("dbsetting/lms_vars_config.php");
        $str = json_encode($form_data);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => API_URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $str,
            CURLOPT_HTTPHEADER => array(
                'appId: '.API_ID,
                'appKey: '.API_KEY,
                'Content-Type: application/json' // Changed to application/json
            ),
            CURLOPT_SSL_VERIFYPEER => false,
        ));

        $response 	= curl_exec($curl);
        $data 		= json_decode($response, true);
       // print_r($response);
        curl_close($curl);
        return $data;

    }

// GET Newsletter
    public function get_newsletters() {
		$formData = array(
                            'method_name' 	=> 'get_newsletters'
						);
        $record = $this->api($formData);
		return $record;
	}

    public function update_newsuser($id, $status) {
		$formData = array(
							  'method_name'  => 'update_newsuser'
                            , 'id'           =>  $id
                            , 'status'       =>  $status
						);
        $result	 = $this->api($formData);
		return $result;
	}

    public function update_newsletter($id) {
        $formData = array(
              'method_name'  => 'update_newsletter'
            , 'id'           =>  $id

        );
        $result	 = $this->api($formData);
        return $result;
    }
}