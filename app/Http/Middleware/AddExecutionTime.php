<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AddExecutionTime
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);

        // Process the request and get the response
        $response = $next($request);

        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;
        $formattedExecutionTime = number_format($executionTime, 3);

        // Safety Check: Only modify if the response is JSON
        if ($response instanceof JsonResponse) {
            $data = $response->getData(true); // Get data as an associative array

            // Add execution time to the data array
            $data['performance'] = [
                'time_spent' => $formattedExecutionTime . 's',
                'memory_usage' => round(memory_get_usage() / 1024 / 1024, 2) . ' MB'
            ];

            $response->setData($data);
        }

        return $response;
    }
}
