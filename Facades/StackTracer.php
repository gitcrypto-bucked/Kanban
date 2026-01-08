<?php

namespace Facades;


class StackTracer
{

    public function setTrace($trace)
    {
        $this->trace = $trace;
    }

    public function setRoute($route)
    {
        $this->route = $route;
    }


    public function debug()
    {
        $html ='<!DOCTYPE html>
                <html lang="en" class="bg-gray-900 text-gray-100">
                <head>
                <meta charset="UTF-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <title>Application Error</title>
                <script src="https://cdn.tailwindcss.com"></script>
                </head>';
        $html.='<body class="font-mono p-6">
                    <div class="max-w-4xl mx-auto">
                        <div class="bg-gray-800 border border-red-500 rounded-lg shadow-lg p-6">
                        <h1 class="text-3xl font-bold text-red-400 mb-2">Whoops! Something went wrong.</h1>
                            <p class="text-sm text-gray-400 mb-4">An unexpected error occurred. Here\'s what we know:</p>
                        <div class="bg-gray-700 p-4 rounded mb-4">
                            <p class="text-red-300 font-semibold">Error:</p>
                                <pre class="whitespace-pre-wrap break-words text-red-100">TypeError: Cannot read property &quot;foo&quot; of undefined</pre>
                        </div>';

        $html.='<div class="bg-gray-700 p-4 rounded mb-4">
                            <p class="text-red-300 font-semibold">Stack Trace:</p>
                                <pre class="whitespace-pre-wrap break-words text-red-100">
                                    at Object.&lt;anonymous&gt; (/app/routes/index.js:12:15)
                                    at Module._compile (internal/modules/cjs/loader.js:999:30)
                                    at Object.Module._extensions..js (internal/modules/cjs/loader.js:1027:10)
                                    at Module.load (internal/modules/cjs/loader.js:863:32)
                                </pre>
                        </div>';

    
        $html.='<details class="bg-gray-700 p-4 rounded mb-4">
                    <summary class="cursor-pointer text-blue-400 font-semibold">Request Info</summary>
                    <pre class="mt-2 text-sm text-gray-300">
            GET /dashboard
            Host: example.com
            User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)
                    </pre>
                </details>';

        return print_r($html,true); exit();
    }

    private $trace = null;
    private $route = null;
}

?>
