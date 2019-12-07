<?php

namespace App\Livewire\Admin;

use App\Models\Tag;
use Livewire\Component;

class TagsIndexItem extends Component
{
    public Tag $tag;

    public function render()
    {
        return view('livewire.admin.tags-index-item');
    }

    public function save(string $name)
    {
        $this->tag->name = $name;
        $this->tag->save();
    }

    public function delete()
    {
        $this->tag->delete();
        $this->redirectRoute('admin.tags.index');
    }
}
