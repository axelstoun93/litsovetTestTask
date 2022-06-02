<?php
namespace App\Service\Pager;

use CodeIgniter\Pager\PagerRenderer;

class PagerBookRenderer extends PagerRenderer
{

    public function links(): array
    {
        $links = [];

        $uri = clone $this->uri;

        for ($i = $this->first; $i <= $this->last; $i++) {
            $uri = $this->segment === 0 ? $uri->addQuery($this->pageSelector, $i) : $uri->setSegment(
                $this->segment,
                $i
            );
            $links[] = [
                'uri' => $this->createURIString(
                    $uri->getScheme(),
                    $uri->getAuthority(),
                    $uri->getPath(),
                    $uri->getQuery(),
                    $uri->getFragment()
                ),
                'title' => $i,
                'active' => ($i === $this->current),
            ];
        }

        return $links;
    }

    public function getNext()
    {
        if (!$this->hasNext()) {
            return null;
        }

        $uri = clone $this->uri;

        if ($this->segment === 0) {
            $uri->addQuery($this->pageSelector, $this->last + 1);
        } else {
            $uri->setSegment($this->segment, $this->last + 1);
        }

        return $this->createURIString(
            $uri->getScheme(),
            $uri->getAuthority(),
            $uri->getPath(),
            $uri->getQuery(),
            $uri->getFragment()
        );
    }

    public function getPrevious()
    {
        if (!$this->hasPrevious()) {
            return null;
        }

        $uri = clone $this->uri;

        if ($this->segment === 0) {
            $uri->addQuery($this->pageSelector, $this->first - 1);
        } else {
            $uri->setSegment($this->segment, $this->first - 1);
        }

        return $this->createURIString(
            $uri->getScheme(),
            $uri->getAuthority(),
            $uri->getPath(),
            $uri->getQuery(),
            $uri->getFragment()
        );
    }

    private function createURIString(
        ?string $scheme = null,
        ?string $authority = null,
        ?string $path = null,
        ?string $query = null,
        ?string $fragment = null
    ): string {
        $uri = '';

        if (!empty($scheme)) {
            $uri .= $scheme . '://';
        }

        if (!empty($authority)) {
            $uri .= $authority;
        }

        if (isset($path) && $path !== '') {
            $uri .= substr($uri, -1, 1) !== '/' ? '/' . ltrim($path, '/') : ltrim($path, '/');
        }

        if ($query) {
            $uri .= '/' . $query;
        }

        if ($fragment) {
            $uri .= '#' . $fragment;
        }

        return str_replace("=", "-", $uri);
    }

}
