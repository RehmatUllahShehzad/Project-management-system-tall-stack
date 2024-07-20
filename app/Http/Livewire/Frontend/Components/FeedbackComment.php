<?php

namespace App\Http\Livewire\Frontend\Components;

use App\Models\Comment;
use App\Models\Design;
use App\Models\Feedback;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FeedbackComment extends Component
{
    public $showComments = false;

    public Design $design;

    public ?Feedback $feedback = null;

    public $comment;

    public Collection $comments;

    protected $listeners = ['setFeedback', 'showComments'];

    protected $rules = [
        'comment' => 'required|string',
    ];

    public function mount()
    {
        $this->comments = new Collection;
    }

    public function render()
    {
        return view('frontend.components.feedback-comment');
    }

    public function setFeedback($note)
    {
        $this->feedback = Feedback::findOrFail($note['id']);

        if (Auth::user()->roles->first()->hasPermissionTo('view-unapproved-comments')) {
            $this->comments = $this->feedback->comments;
        } else {
            $this->comments = $this->feedback->approved_comments;
        }

        $this->showComments = true;
    }

    public function resetFeedback()
    {
        $id = $this->feedback->id ?? null;
        $this->feedback = null;

        $this->comments = new Collection();

        $this->showComments = false;

        return $id;
    }

    public function saveComment()
    {
        if ($this->feedback) {

            if (Auth::user()->roles->first()->hasPermissionTo('post-comments')) {

                $this->validate();

                $is_approved = false;
                if (Auth::user()->roles->first()->hasPermissionTo('approve-comments')) {
                    $is_approved = true;
                }

                $newComment = Comment::create(['user_id' => Auth::id(), 'feedback_id' => $this->feedback->id, 'comment' => $this->comment, 'is_approved' => $is_approved]);

                $this->comments->push($newComment);

                $this->comment = '';
            }
        }
    }

    public function delete($id)
    {
        $index = $this->comments->search(fn ($comment) => $comment->id == $id);

        $this->comments->get($index)->delete();

        $this->comments->forget($index);
    }

    public function emitDeleteFeedback()
    {
        $this->emit('deleteFeedback', $this->resetFeedback());
    }


    public function approve_comment($id)
    {
        $index = $this->comments->search(fn ($comment) => $comment->id == $id);

        $this->comments->get($index)->update(['is_approved' => true]);
    }
}
