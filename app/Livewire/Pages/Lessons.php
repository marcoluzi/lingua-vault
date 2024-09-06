<?php

namespace App\Livewire\Pages;

use App\Models\Lesson;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Breadcrumbs\Trail;

class Lessons extends Component
{
    use WithPagination;

    public $title = '';

    public $sortItems = [];

    public $selectedSortItem = [];

    public $sortField = 'updated_at';

    public $sortDirection = 'desc';

    public function mount()
    {
        $this->title = __('Lessons');

        $this->sortItems = [
            [
                'value' => 'updated_at',
                'label' => __('Recently practiced'),
                'action' => '$wire.sortBy("updated_at")',
                'direction' => 'desc',
            ],
            [
                'value' => 'title',
                'label' => __('Alphabetical (A-Z)'),
                'action' => '$wire.sortBy("title")',
                'direction' => 'asc',
            ],
            [
                'value' => 'progress',
                'label' => __('Progress'),
                'action' => '$wire.sortBy("progress")',
                'direction' => 'asc',
            ],
        ];

        $this->selectedSortItem = $this->sortItems[0];
    }

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push($this->title);
    }

    /**
     * Sort the lessons by the given value.
     *
     * @param  string  $value
     * @return void
     *
     * @throws \Exception If the sort value is not available in the sortItems array.
     */
    public function sortBy($value)
    {
        $sortItem = collect($this->sortItems)->firstWhere('value', $value);

        if (! $sortItem) {
            throw new \Exception('Invalid sort value.');
        }

        if ($sortItem) {
            $this->sortField = $sortItem['value'];
            $this->sortDirection = $sortItem['direction'];
            $this->selectedSortItem = $sortItem;
            $this->resetPage();
        }
    }

    /**
     * Refresh the lessons list after a lesson has been deleted.
     *
     * @return void
     */
    #[On('lesson-deleted')]
    public function refreshLessons()
    {
        $this->resetPage();
    }

    public function render()
    {
        $lessons = Lesson::orderBy($this->sortField, $this->sortDirection)->paginate(10);

        return view('livewire.pages.lessons', [
            'lessons' => $lessons,
        ])->title($this->title);
    }
}
