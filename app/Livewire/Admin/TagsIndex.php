<?php

namespace App\Livewire\Admin;

use App\Services\TagService;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class TagsIndex extends Component
{
    use WithPagination;
    public string $paginationTheme = "bootstrap";

    public function render()
    {
        return view('livewire.admin.tags-index');
    }

    public string $searchTag = '';
    public bool $creating = false;
    

    #[Computed]
    public function filteredTags() {
        $tagService = app(TagService::class);
        return $tagService->getSimilarTags($this->searchTag)->paginate(20);
    }

    #[Computed]
    public function tags() {
        $tagService = new TagService();
        return $tagService->getAllTags()->paginate(20);
    }

    public function showCreateModal() {
        $this->creating = true;
    }
}
