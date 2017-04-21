<?php

namespace App\Controller;

use App\Helper\Session as Session;

/**
 * Class HomeController
 * @package App\Controller
 */
final class HomeController extends AbstractController
{
	private $session;

	/**
	 * HomeController constructor.
	 * @param $c
	 */
	public function __construct($c)
	{
		parent::__construct($c);
		$this->session = new Session();
	}

	/**
	 * @param $request
	 * @param $response
	 * @param $params
	 * @return mixed
	 */
	public function dispatch($request, $response, $params)
	{
        // SAMPLE LOGGER OUTPUT
        $this->logger->info("Example Homepage action dispatched");

        // SET A MESSAGE
	    $this->session->set("flash", "A simple message");

	    // AN ARRAY FOR SAMPLE OUTPUT
        $foobar     = [
        	"foo" => "bar"
        ];

        // IF WE NEED AN OUTPUT, RENDER SOMETHING
        return $this->view->render($response, "home.twig", $foobar);
        // IF NOT
		// return $response;
		// OR
		// return false;
    }

	/**
	 * @param $request
	 * @param $response
	 * @param $params
	 * @return mixed
	 */
    public function dashboard($request, $response, $params)
    {
    	// RETRIEVE A MESSAGE / SEE HOME ABOVE (LINE 73)
        $flash  = $this->session->get("flash");

        return $this->view->render($response, "dashboard.twig", ["flash" => $flash ] );
    }

	/**
	 * @param $request
	 * @param $response
	 * @param $params
	 * @return mixed
	 */
    public function json($request, $response, $params)
    {
        $option   = [
        	$params ,
	        "foo" => "bar"
        ];
        $response = $this->response
            ->withJson($option)
            ->withStatus(201);
        return $response;
    }
}