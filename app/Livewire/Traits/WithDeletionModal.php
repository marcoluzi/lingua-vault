<?php

namespace App\Livewire\Traits;

trait WithDeletionModal
{
    /**
     * Perform the deletion by calling the concrete implementation, dispatch the deletion event,
     * and close the modal.
     *
     * @throws \Exception
     */
    public function deleteItem(): void
    {
        try {
            $this->performDeletion();
            $this->dispatch($this->getDeletedEvent())->to($this->getRedirectComponent());
            $this->closeModal();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Perform the actual deletion (e.g. call the deletion service).
     *
     * @return void
     */
    abstract protected function performDeletion(): void;

    /**
     * Get the name of the deletion event to dispatch.
     *
     * @return string
     */
    abstract protected function getDeletedEvent(): string;

    /**
     * Get the component/class to which the deletion event should be dispatched.
     *
     * @return string
     */
    abstract protected function getRedirectComponent(): string;
}
