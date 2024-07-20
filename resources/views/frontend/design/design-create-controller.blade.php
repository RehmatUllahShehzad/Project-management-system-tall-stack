<x-slot name="header">
    <div class="flex w-full justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Designs
        </h2>
        <a class="justify-end" href="{{ route('design.index', $project->id) }}">

            <x-buttons.primary label="Return to List" />
        </a>
    </div>
</x-slot>

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <x-forms.form method="post" action="submit" title="Create Design" 
                submit-text="create Design">
                <form action="submit" method="POST" wire:submit.prevent="store">
                    @csrf
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                            <x-forms.input name="design.name" type="text" label="Design Name" wire:model.defer="design.name"></x-forms.input>
                            <x-forms.file name="photo" label="Design Image" temporaryUrl="{{ $photo ? $photo->temporaryUrl() : null }}" model="photo" remove="resetPhoto()"></x-forms.file>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <x-buttons.success type="submit" wire:loading.attr="disabled">
                                <span wire:loading.remove>Create</span>
                                <span wire:loading><i class="las la-circle-notch la-spin text-xl leading-none"></i></span>
                            </x-buttons.success>
                        </div>
                    </div>
                </form>
            </x-forms.form>
        </div>  
    </div>
</div>