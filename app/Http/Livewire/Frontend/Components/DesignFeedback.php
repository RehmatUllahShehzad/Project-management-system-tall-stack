<?php

namespace App\Http\Livewire\Frontend\Components;

use App\Models\Design;
use App\Models\Revision;
use App\Traits\VerifyProjectRelationAccess;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DesignFeedback extends Component
{
    use VerifyProjectRelationAccess;

    public Design $design;

    public Revision $revision;

    public array $notes;

    protected $listeners = ['deleteFeedback' => 'deleteFeedback'];

    public function mount()
    {
        $this->relationProjectAccess($this->design->project->id);

        $this->notes = $this->revision->feedbacks->map(function ($feedback) {
            return [
                'id' => $feedback->id,
                'x' => $feedback->x,
                'y' => $feedback->y,
            ];
        })->toArray();
    }

    public function render()
    {
        return view('frontend.components.design-feedback');
    }

    public function updatedNotes()
    {
        $notes = collect($this->notes)
            ->map(function ($note) {
                $modifiedNote = tap($note, function (&$note) {
                    $note['x'] = round($note['x'], 8);
                    $note['y'] = round($note['y'], 8);
                    unset($note['note']);
                    return $note;
                });

                $query = $this->revision->feedbacks();

                $newNote = $query->firstOrNew($modifiedNote, $modifiedNote);
                $newNote->user_id = Auth::id();
                $newNote->save();

                return [
                    'id' => $newNote->id,
                    'x' => $newNote->x,
                    'y' => $newNote->y,
                ];
            });

        if (isset(end($this->notes)['note'])) {
            $this->emit('setFeedback', $notes->sortByDesc('id')->first());
        }

        $this->notes = $notes->toArray();
    }

    public function deleteFeedback($id)
    {
        $notes = collect($this->notes);

        $index = $notes->search(fn ($note) => $note['id'] == $id);

        $this->notes = $notes->forget($index)->toArray();

        $this->revision->feedbacks()->whereId($id)->delete();
    }
}
