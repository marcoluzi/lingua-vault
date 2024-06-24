<?php

namespace App\Livewire\Components;

use LivewireUI\Modal\ModalComponent;

class DeleteLessonModal extends ModalComponent
{
    public function render()
    {
        return view('livewire.components.delete-lesson-modal');
    }
}
