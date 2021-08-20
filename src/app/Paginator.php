<?php

namespace App;

class Paginator
{
    private $page;
    private $perPage;
    private $totalCount;
    private $items;

    public function __construct(int $page, int $perPage, int $totalCount, array $items) {
        $this->page = $page;
        $this->perPage = $perPage;
        $this->totalCount = $totalCount;
        $this->items = $items;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    public function getTotalCount()
    {
        return $this->totalCount;
    }

    public function setTotalCount($totalCount)
    {
        $this->totalCount = $totalCount;
        return $this;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    public function getPerPage()
    {
        return $this->perPage;
    }

    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        return $this;
    }

    public function getLastPage()
    {
        return ceil($this->totalCount / $this->perPage);
    }
}
