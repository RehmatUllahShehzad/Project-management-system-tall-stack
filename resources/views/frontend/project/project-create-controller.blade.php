<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Projects') }}
    </h2>
</x-slot>

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <x-forms.form method="post" action="submit" title="Create Project" 
            submit-text="create project">
            <form action="submit" method="POST" wire:submit.prevent="store">
                @csrf
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <x-forms.input name="project.name" type="text" label="Project Name" wire:model.defer="project.name"></x-forms.input>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <x-buttons.success type="submit" >
                            Save
                        </x-buttons.success>
                    </div>
                </div>
            </form>
        </x-forms.form>
        </div>
    </div>
</div>
