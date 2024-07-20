<div>
    <section class="overflow-auto max-h-screen text-gray-700 z-10">
        <div class="container px-5 py-2 mx-auto lg:pt-2 lg:px-2">

            <div class="mb-5 flex items-center justify-between">
                <div class="rounded-md bg-pink-400/70 px-2 font-semibold text-gray-900"> {{ count($design->revisions) }}
                </div>
                <h4 class="font-medium text-slate-500">Revisions</h4>
                <a class="justify-end" href="{{ route('revision.create', $design->id) }}" title="Create Revision">
                    <div
                        class="inline-flex justify-center items-center w-7 h-7 text-sm opacity-60 font-bold text-white bg-violet-700 rounded-full">
                        <i class="las la-plus leading-none"></i>
                    </div>
                </a>
            </div>

            <div class="flex flex-wrap -m-1 md:-m-2">
                @foreach ($design->revisions as $revision)
                    <a href="{{ route('design.feedback', [$design->project->id, $design->id, $revision->id]) }}"
                        class="flex flex-wrap w-100">
                        <div class="w-full p-1 md:p-2 relative">
                            <div
                                class="inline-flex absolute top-5 left-5 justify-center items-center w-6 h-6 text-xs opacity-60 font-bold text-white bg-gray-700 rounded-full">
                                {{ $loop->iteration }}
                            </div>
                            <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                                src="{{ $revision->getFirstMediaUrl('images') }}">
                            @if (!$loop->first)
                                <div class="inline-flex absolute top-5 right-5 justify-center items-center w-6 h-6 text-xs opacity-60 font-bold text-white bg-gray-700 rounded-full"
                                    wire:click.prevent="delete({{ $revision->id }})">
                                    <i class="las la-times leading-none"></i>
                                </div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
            
        </div>
    </section>
</div>
