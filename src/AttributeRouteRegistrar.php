<?php

namespace Diyorbek\AttributeRoutes;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class AttributeRouteRegistrar
{
    public function registerRoutes(string $namespace = ''): void
    {
        $controllerPath = app_path('Http/Controllers/' . $namespace);
        $controllerNamespace = 'App\\Http\\Controllers' . ($namespace ? '\\' . str_replace('/', '\\', $namespace) : '');

        if (!is_dir($controllerPath)) {
            Log::warning("Controller path does not exist: {$controllerPath}");
            return;
        }

        $files = File::allFiles($controllerPath);

        foreach ($files as $file) {
            $class = $controllerNamespace . '\\' . $file->getFilenameWithoutExtension();
            Log::info("Processing controller: {$class}");

            if (!class_exists($class)) {
                Log::warning("Class does not exist: {$class}");
                continue;
            }

            $reflection = new \ReflectionClass($class);

            foreach ($reflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
                foreach ($method->getAttributes() as $attribute) {
                    $instance = $attribute->newInstance();
                    $attributeClass = class_basename($attribute->getName());
                    $httpMethod = strtolower($attributeClass);

                    Log::info("Registering route: {$httpMethod} {$instance->uri} for {$class}::{$method->getName()}");

                    $route = Route::$attributeClass($instance->uri, [$class, $method->getName()])->middleware('web');
                    Log::info("Registered route: " . $httpMethod . ' ' . $instance->uri);
                    if ($route) {
                        if (!empty($instance->middleware)) {
                            $route->middleware($instance->middleware);
                        }
                        if ($instance->when) {
                            $route->when($instance->when);
                        }
                        if ($instance->name) {
                            $route->name($instance->name);
                        }
                    }
                }
            }
        }

        // Log all registered routes
        $routes = array_map(function ($route) {
            return [
                'method' => implode('|', $route->methods()),
                'uri' => $route->uri(),
                'action' => is_array($route->action['uses']) ? implode('@', $route->action['uses']) : $route->action['uses'],
                'middleware' => $route->action['middleware'] ?? [],
            ];
        }, Route::getRoutes()->getRoutes());
        Log::info('Final registered routes: ' . json_encode($routes, JSON_PRETTY_PRINT));
    }
}