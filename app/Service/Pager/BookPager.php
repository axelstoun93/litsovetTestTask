<?php
namespace App\Service\Pager;

use CodeIgniter\Pager\Exceptions\PagerException;
use CodeIgniter\Pager\Pager;
use Config\Services as AppServices;

class BookPager extends Pager
{

  public function __construct($config, $view)
  {
      $config = $config ?? config('Pager');
      $view   = $view ?? AppServices::renderer();

      parent::__construct($config, $view);
  }

    protected function displayLinks(string $group, string $template): string
    {
        if (! array_key_exists($template, $this->config->templates)) {
            throw PagerException::forInvalidTemplate($template);
        }

        $pager = new PagerBookRenderer($this->getDetails($group));

        return $this->view->setVar('pager', $pager)->render($this->config->templates[$template]);
    }
}
