<x-slot name="header">
    <div class="flex w-full justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Designs') }}
        </h2>
        <a class="justify-end" href="{{ route('project.index') }}">

            <x-buttons.primary label="Return to Projects" />
        </a>
    </div>
</x-slot>

<div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex w-full justify-end items-center mb-10">
                    @can('create-designs')
                        <a href="{{ route('design.create', $project->id) }}">
                            <x-buttons.success label="Create Design" />
                        </a>
                    @endcan
                </div>
                <x-tables.table class="mt-3">
                    @php $count = 1 @endphp
                    <x-slot:header>
                        <x-tables.h-column>ID</x-tables.h-column>
                        <x-tables.h-column>DESIGN NAME</x-tables.h-column>
                        <x-tables.h-column>IMAGE LINK</x-tables.h-column>
                        <x-tables.h-column>STATUS</x-tables.h-column>
                        <x-tables.h-column>CREATED DATE</x-tables.h-column>
                        <x-tables.h-column>ACTION</x-tables.h-column>
                    </x-slot:header>
                    @foreach ($designs as $design)
                        <x-tables.row>
                            <x-tables.column> {{ $loop->iteration }} </x-tables.column>
                            <x-tables.column> {{ $design->name }} </x-tables.column>
                            <x-tables.column> <a href="{{ $design->latestRevision ? $design->latestRevision->getFirstMediaUrl('images') : '#' }}"
                                    target="blank">Open Link</a> </x-tables.column>
                            <x-tables.column>
                                <livewire:frontend.components.design-status :design="$design" />
                            </x-tables.column>
                            <x-tables.column> {{ $design->created_at->format('m/d/Y') }} </x-tables.column>
                            <x-tables.column>
                                <div class="divide-x-2 divide-solid divide-gray-500">
                                    @if($design->latestRevision)
                                    <a href="{{ route('design.feedback', [$project->id, $design->id, $design->latestRevision->id]) }}"
                                        class="px-2">
                                        Feedback
                                    </a>
                                    @endif
                                    <a href="{{ route('design.show', [$project->id, $design->id]) }}" class="px-2">
                                        Edit
                                    </a>
                                    <div x-data class="inline">
                                        <button type="button" wire:click="delete({{ $design->id }})" class="px-2">
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
