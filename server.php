<?php

class HttpServer
{
	public static $instance;

	public $http;
	public static $get;
	public static $post;
	public static $header;
	public static $server;
	private $application;

	public function __construct() {
		$http = new swoole_http_server("0.0.0.0", 9501);

		$http->set(
			array(
				'worker_num' => 10,
				'daemonize' => false,
	            'max_request' => 10000,
	            'dispatch_mode' => 1
			)
		);

		$http->on('WorkerStart' , array( $this , 'onWorkerStart'));

		$http->on('request', function ($request, $response) {
			if( isset($request->server) ) {
				HttpServer::$server = $request->server;
			}
			if( isset($request->header) ) {
				HttpServer::$header = $request->header;
			}
			if( isset($request->get) ) {
				HttpServer::$get = $request->get;
			}
			if( isset($request->post) ) {
				HttpServer::$post = $request->post;
			}
			ob_start();
			try {
				$yaf_request = new Yaf_Request_Http(HttpServer::$server['request_uri']);
			    $this->application->getDispatcher()->dispatch($yaf_request);
			} catch ( Yaf_Exception $e ) {
				var_dump( $e );
			}
		    $result = ob_get_contents();
		  	ob_end_clean();
		  	$response->end($result);
		});

		$http->start();
	}

	public function onWorkerStart() {
		echo 'WorkerStart'."\r\n";
		define('APPLICATION_PATH', __DIR__);
		$this->application = new Yaf_Application( APPLICATION_PATH . "/conf/application.ini");
		ob_start();
		$this->application->bootstrap()->run();
		ob_end_clean();

	}

	public static function getInstance() {
		if (!self::$instance) {
            self::$instance = new HttpServer;
        }
        return self::$instance;
	}
}

HttpServer::getInstance();