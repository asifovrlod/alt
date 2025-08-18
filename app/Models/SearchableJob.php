<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class SearchableJob extends Model
{
    use Searchable;

    protected $entry;

    public function __construct($entry = null, array $attributes = [])
    {
        parent::__construct($attributes);

        if ($entry) {
            $this->entry = $entry;
        }
    }

    /**
     * Get the indexable data for Algolia.
     */
    public function toSearchableArray()
    {
        return [
            'id' => $this->entry->id(),
            'title' => $this->entry->get('title'),
            'description' => $this->entry->get('description'),
            'location' => $this->entry->get('location'),
            // add more fields if needed
        ];
    }
}
