<?php

namespace App\Http\Livewire\Frontend\Revision;

use App\Models\Revision;
use Illuminate\Contracts\View\View;
use Livewire\WithFileUploads;

class RevisionCreateController extends RevisionAbstract
{
    use WithFileUploads;

    public $photo;

    public function mount(): void
    {
        $this->revision = new Revision();
    }

    /**
     * @return array<mixed>
     */
    public function rules()
    {
        return [
            'photo' => 'required|image|max:3000',
        ];
    }

    public function render(): View
    {
        return $this->view('frontend.revision.revision-create-controller');
    }

    public function resetPhoto()
    {
        $this->photo = null;
    }

    /**
     * Define the validation messagess.
     *
     * @return array<mixed>
     */
    protected $messages = [
        'photo.required' => 'Design image is required.',
        'photo.image' => 'Please select an image.',
        'photo.max' => 'The photo must not be greater than 3mb',
    ];


    /**
     * @return RedirectResponse | void
     */
    public function store()
    {
        $this->validate();

        $this->revision->design_id = $this->design->id;

        $this->revision->save();

        $this->revision->addMedia($this->photo)->toMediaCollection('images');

        $this->notify(
            'Revision Created Successfully',
            'design.feedback',
            [$this->design->project->id, $this->design->id, $this->revision->id]
        );
    }
}
