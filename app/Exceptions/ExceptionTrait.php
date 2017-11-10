<?php
namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

trait ExceptionTrait
{
	public function apiException($request,$e)
	{
			if ($this->isModel($e)) {
                return $this->ModelResponse($e);
            }

	            if ($this->isHttp($e)) {
	                return $this->HttpResponse($e);
	            }

	        		return parent::render($request, $e);

	}

	protected function isModel($e)
	{
		return $e instanceof ModelNotFoundException;
	}

	protected function isHttp($e)
	{
		return $e instanceof NotFoundHttpException; 
	}

	protected function ModelResponse($e)
	{
		return response()->json([
                    'errors' => 'Product Model not found'
                ],Response::HTTP_NOT_FOUND);
	}

	protected function HttpResponse($e)
	{
		return response()->json([
                    'errors' => 'Incorect route'
                ],Response::HTTP_NOT_FOUND);
	}
}