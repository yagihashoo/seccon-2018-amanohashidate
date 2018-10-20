<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            app('sentry')->captureException($exception);
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($request->is('api/*') || $request->ajax()) {
            $class = get_class($e);

            switch ($class) {
                case AuthenticationException::class:
                    $ret = [
                        'status' => 401,
                        'message' => 'Authentication required',
                    ];
                    break;
                case AuthorizationException::class:
                    $ret = [
                        'status' => 403,
                        'message' => 'forbidden',
                    ];
                    break;
                case QueryException::class:
                    $code = $e->getCode();
                    $ret = [
                        'status' => 500,
                        'message' => self::dbErrorMsg($code),
                    ];
                    break;
                default:
                    Log::error($e);
                    $ret = [
                        'status' => 500,
                        'message' => 'Internal server error',
                    ];
                    break;
            }
            return response()->json($ret, $ret['status']);
        } elseif ($this->isHttpException($e)) {
            $code = $e->getStatusCode();

            switch ($code) {
                case 403:
                    return response()->view('errors.403');
                    break;
                case 404:
                    return response()->view('errors.404');
                    break;
                case 500:
                    return response()->view('errors.500');
                    break;
                default:
                    return parent::render($request, $e);
                    break;
            }
        }

        return parent::render($request, $e);
    }

    protected static function dbErrorMsg(int $code): string
    {
        switch ($code) {
            case 23000: // ER_DUP_ENTRY
                return 'Duplicated entry';
                break;
            default:
                return 'Database error';
                break;
        }
    }
}
