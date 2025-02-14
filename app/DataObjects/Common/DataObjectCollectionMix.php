<?php
declare(strict_types=1);

namespace App\DataObjects\Common;

use Illuminate\Support\Collection;

class DataObjectCollectionMix
{
    public Collection|array $items;
    public int $total_count;
    public int $limit;
    public int $page;
    public DataObjectPagination $links;

    public function __construct(Collection|array $items, int $total_count, int $limit, int $page)
    {
        $this->items       = $items;
        $this->total_count = $total_count;
        $this->limit       = $limit;
        $this->page        = $page;
        $this->links       = new DataObjectPagination($total_count, $limit, $page);
    }
}
