<?php

namespace App\Http\Livewire\Frontend\Design;

use App\Models\Design;
use App\Models\Revision;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;


class DesignCreateController extends DesignAbstract
{
    use WithFileUploads;

    public $photo;

    public function mount(): void
    {
        $this->design = new Design();
    }

    /**
     * @return array<mixed>
     */
    public function rules()
    {
        return [
            'design.name' => 'required|max:255',
            'photo' => 'required|image|max:3000',
        ];
    }

    protected $messages = [
        'photo.required' => 'Design image is required.',
        'photo.image' => 'Please select an image.',
        'photo.max' => 'The photo must not be greater than 3mb',
    ];

    public function render(): View
    {
        return $this->view('frontend.design.design-create-controller');
    }

    public function resetPhoto()
    {
        $this->photo = null;
    }

    /**
     * @return RedirectResponse | void
     */
    public function store()
    {
        $this->validate();
        
        $this->design->project_id = $this->project->id;
        $this->design->status = 'DL to review';

        DB::beginTransaction();

        try {
            $this->design->save();

            $revision = Revision::create([
                'design_id' => $this->design->id,
            ]);

            $revision->addMedia($this->photo)->toMediaCollection('images');
            
            DB::commit();

        } catch (\Throwable $e) {
            DB::rollback();

            return $this->notify('Error: Design Could not be saved.', level: 'error');
        }

        $this->notify(
            'Design Created Successfully',
            'design.index', $this->project->id
        );
    }
}
