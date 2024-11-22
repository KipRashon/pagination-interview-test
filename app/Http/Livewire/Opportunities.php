<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Item;
class Opportunities extends Component
{
    use WithPagination;
    public $perPage = 20; // Default number of items per page
    public $options = [20, 50, 100, 250]; // Options for items per page
    protected $queryString = ['perPage']; // Keep perPage in the URL
    public function updatingPerPage()
    {
        $this->resetPage(); // Reset to the first page when perPage changes
    }
    public function render()
    {
        // Generate a unique cache key based on the perPage and current page
        $cacheKey = 'items_per_page_' . $this->perPage . '_page_' . $this->page;

        // Use caching to store and retrieve paginated data
        $items = Cache::remember($cacheKey, 600, function () {
            return Item::select('id', 'name') // Fetch only required fields
            ->orderBy('id', 'asc') // Consistent ordering
            ->paginate($this->perPage);
        });

        return view('livewire.opportunities', [
            'items' => $items,
            'options' => $this->options
        ]);
    }
}
