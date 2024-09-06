<?php

declare(strict_types=1);

namespace Lib;

use Exception;

class View
{
    private string $resourcesPath;
    private string $layoutDir;

    public function __construct(array $options = [])
    {
        $this->resourcesPath = $options['viewsPath'] ?? '/../views/';
        $this->resourcesPath = rtrim($this->resourcesPath, '/') . '/';
        $this->layoutDir = $this->resourcesPath . ($options['layoutDir'] ?? 'layouts/');
    }

    public function render(string $view, array $data = [], string $layout = 'layout.php'): string
    {
        extract($data);

        // Capture the view content
        $content = $this->renderView($view, $data);

        // Return the final layout with the content injected
        return $this->renderLayout($layout, $content, $data);
    }

    private function renderView(string $view, array $data): string
    {
        extract($data);

        ob_start();

        $viewFile = __DIR__ . $this->resourcesPath . $view;

        if (!file_exists($viewFile)) {
            throw new Exception("View file not found: $viewFile");
        }

        include $viewFile;

        return ob_get_clean();
    }

    private function renderLayout(string $layout, string $content, array $data): string
    {
        extract($data);

        ob_start();

        $layoutFile = __DIR__ . $this->layoutDir . $layout;

        if (!file_exists($layoutFile)) {
            throw new Exception("Layout file not found: $layoutFile");
        }

        include $layoutFile;

        return ob_get_clean();
    }
}
