<?php

namespace App\Services;

use App\Models\Tag;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class TagService
{
    public function getAllTags() {
        return Tag::latest();
    }

    public function getSimilarTags(string $name) {
        return Tag::latest()->whereLike("name","%$name%");
    }

    public function create(array $attrs) {
        Tag::create([
            'name' => $attrs['name'],
            'slug' => Str::slug($attrs['name']),
        ]);
    }

    public function find($id): Collection {
        return Tag::findOrFail($id);
    }

    public function update(int $id, array $attrs) {
        Tag::findOrFail($id)->update($attrs);
    }

    public function delete(int $id) {
        Tag::findOrFail($id)->delete();
    }
}
