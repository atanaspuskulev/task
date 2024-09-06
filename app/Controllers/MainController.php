<?php

namespace App\Controllers;

use Lib\View;

abstract class MainController
{
    protected View $view;
    protected string $layout = 'main.php';

    // Setter method to inject the View dependency
    public function setView(View $view): void
    {
        $this->view = $view;
    }

    protected function view(string $template, array $data = [])
    {
        if (!$this->view) {
            throw new \Exception('View not initialized');
        }

        return $this->view->render($template, $data, $this->layout);
    }
}
