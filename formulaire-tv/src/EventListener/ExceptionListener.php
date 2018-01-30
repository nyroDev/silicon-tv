<?php
namespace App\EventListener;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Router;

class ExceptionListener
{
	protected $router;
	
	public function __construct(Router $router)
	{
		$this->router = $router;
	}
	
	public function onKernelException(GetResponseForExceptionEvent $event)
	{
		if ($event->getException() instanceof NotFoundHttpException) {
			$response = new RedirectResponse($this->router->generate('home'));
			$event->setResponse($response);
		}
	}
}