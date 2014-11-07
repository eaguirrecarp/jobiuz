<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['opauth_config'] = array(
                                'path' => '/web/user/social_login/', //example: /ci_opauth/auth/login/
                    			'callback_url' => '/web/user/social_data/', //example: /ci_opauth/auth/authenticate/
                                'callback_transport' => 'post', //Codeigniter don't use native session
                                'security_salt' => 'your_salt',
                                'debug' => false,
                                'Strategy' => array( //comment those you don't use
                                    // 'Twitter' => array(
                                    //     'key' => 'twitter_key',
                                    //     'secret' => 'twitter_secret'
                                    // ),
                                    'Facebook' => array(
                                        'app_id' => '842185745821587',
                                        'app_secret' => '708afc9fab32b83691208350fa922c54'
                                    ),
                                    'Google' => array(
                                        'client_id' => '320729197556-bnuj50iledn3r9tahmkp2cgm1j4r63ab.apps.googleusercontent.com',
                                        'client_secret' => 'MwLpM85ZfRevy9Qxfy5nWLoy'
                                    ),
         //                            'OpenID' => array(
									// 	'openid_url' => 'openid_url'
									// )
                                )
                            );

/* End of file ci_opauth.php */
/* Location: ./application/config/ci_opauth.php */
