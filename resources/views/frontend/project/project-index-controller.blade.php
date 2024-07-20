<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Projects') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex w-full justify-end items-center mb-10">
                    @can('create-projects')
                        <a href="{{ route('project.create') }}">
                            <x-buttons.success label="Create Project" />
                        </a>
                    @endcan
                </div>
                <x-tables.table class="mt-3">
                    @php $count = 1 @endphp
                    <x-slot:header>
                        <x-tables.h-column>ID</x-tables.h-column>
                        <x-tables.h-column>PROJECT NAME</x-tables.h-column>
                        <x-tables.h-column>CREATED DATE</x-tables.h-column>
                        <x-tables.h-column>ACTION</x-tables.h-column>
                    </x-slot:header>
                    @foreach ($projects as $project)
                        <x-tables.row>
                            <x-tables.column> {{ $count++ }} </x-tables.column>
                            <x-tables.column> {{ $project->name }} </x-tables.column>
                            <x-tables.column> {{ $project->created_at->format('m/d/Y') }} </x-tables.column>
                            <x-tables.column>
                                <div class="divide-x-2 divide-solid divide-gray-500">
                                    <a href="{{ route('design.index', $project->id) }}" class="px-2">
                                        Designs
                                    </a>
                                    <a href="{{ route('project.show', $project->id) }}" class="px-2">
                                        Edit
                                    </a>
                                    <div x-data class="inline">                                        
                                        <button type="button" wire:click="delete({{ $project->id }})" class="px-2">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </x-tables.column>
                        </x-tables.row>
                    @endforeach
                </x-tables.table>
            </div>
        </div>
    </div>
</div>
