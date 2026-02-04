<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddExecutionTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);

        // Process the request and get the response
        $response = $next($request);

        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;
        $formattedExecutionTime = number_format($executionTime, 3); // Format to 3 decimal places

        // Decode the original response content to an array
        $originalContent = json_decode($response->getContent(), true);

        // Add execution time to the response data
        $originalContent['time_spent'] = $formattedExecutionTime . 's';

        // Encode the array back to JSON and set it as the response content
        $response->setContent(json_encode($originalContent));

        return $response;
    }
}
