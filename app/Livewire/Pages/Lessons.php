<?php

namespace App\Livewire\Pages;

use App\Models\Lesson;
use Livewire\Component;
use Livewire\WithPagination;

class Lessons extends Component
{
    use WithPagination;

    public $title = '';

    public $sortItems = [];

    public $selectedSortItem = [];

    public function mount()
    {
        $this->title = __('Lesson Overview');

        $this->sortItems = [
            [
                'value' => 'recent',
                'label' => __('Recently practiced'),
                'action' => '$wire.sortBy("recent")',
            ],
            [
                'value' => 'alphabetical',
                'label' => __('Alphabetical (A-Z)'),
                'action' => '$wire.sortBy("alphabetical")',
            ],
            [
                'value' => 'completionRate',
                'label' => __('Completion rate'),
                'action' => '$wire.sortBy("completionRate")',
            ],
        ];

        $this->selectedSortItem = $this->sortItems[0];
    }

    public function render()
    {
        return view('livewire.pages.lessons', [
            'lessons' => Lesson::paginate(10),
        ])->title($this->title);
    }
}
