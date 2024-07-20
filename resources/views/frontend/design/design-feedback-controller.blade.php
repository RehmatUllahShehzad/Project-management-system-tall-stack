<x-slot name="header">
    <div class="flex w-full justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Feedback
        </h2>
        <a class="justify-end" href="{{ route('design.index', $project->id) }}">
            <x-buttons.primary label="Return to List" />
        </a>
    </div>
</x-slot>

<x-slot name="links">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" media="screen">
    <link rel="stylesheet" href="{{ asset('lib/imgNotes.css') }}">
</x-slot>

<div class="max-w-12xl mx-auto sm:px-6 lg:px-8 py-12">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="bg-white border-b border-gray-200">

            <div class="grid grid-cols-8 gap-1 p-4 relative">
                <div>
                    <livewire:frontend.components.design-revision :design="$design" />
                </div>
                <div class="col-span-7">
                    <livewire:frontend.components.design-feedback :design="$design" :revision="$revision" />
                </div>
                <div>
                    <livewire:frontend.components.feedback-comment :design="$design" />
                </div>
            </div>
            
        </div>
    </div>
</div>

<x-slot name="preJs">
    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/jquery-mousewheel@3.1.13"></script>
    <script type="text/javascript" src="{{ asset('lib/hammer.min.js') }}"></script>
    <script type="text/javascript" src="https://unpkg.com/jquery-hammerjs@2.0.0"></script>
    <script type="text/javascript" src="{{ asset('lib/imgViewer.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lib/imgNotes.js') }}"></script>
</x-slot>
