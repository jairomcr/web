<?php

namespace App\Livewire\Admin;

use App\Services\TagService;
use Livewire\Component;

class TagCreate extends Component
{
    public function render()
    {
        return view('livewire.admin.tag-create');
    }

    public string $name = '';

    public function save() {
        $this->validate([
            'name' => 'required'
        ]);
        (new TagService)->create($this->pull(['name']));
        $this->redirectRoute('admin.tags.index');
    }
}
