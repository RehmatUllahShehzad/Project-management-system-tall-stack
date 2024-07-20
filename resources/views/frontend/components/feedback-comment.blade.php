<div>
    <x-frontend.components.slideover wire:model="showComments" title="Comments">

        <section class="py-2">
            <div class="mb-5 flex items-center justify-between">
                <div class="rounded-md bg-pink-400/70 px-2 font-semibold text-gray-900"> {{ count($comments) }} </div>
                <button type="button" class="float-right bg-red-400 hover:bg-red-500 text-white p-2 rounded-lg"
                    wire:click="emitDeleteFeedback"> Delete Feedback</button>
            </div>

            <div class="space-y-2">
                @foreach ($comments as $comment)
                    <div
                        class="flex space-x-4 rounded-xl @if ($comment->is_approved) bg-white @else bg-gray-50 @endif p-3 shadow-sm">
                        <img class="aspect-square w-14 h-14 rounded-full bg-center object-cover"
                            src="https://www.gravatar.com/avatar/366450939c7cfdc290b2ee3c2ed7726a?s=100&d=mp"
                            alt="" />
                        <div class="flex-1 w-64">
                            <h4 class="font-semibold text-gray-600"> {{ $comment->user->name }} </h4>
                            <p class="text-sm text-slate-400">{{ $comment->comment }}</p>
                        </div>
                        @can('approve-comments')
                            @if (!$comment->is_approved)
                                <div>
                                    <button wire:click="approve_comment({{ $comment->id }})" type="button" wire:loading.attr="disabled"
                                        class="px-3 py-1 text-xs font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                        <span wire:loading.remove wire:target="approve_comment({{ $comment->id }})">APPROVE</span>
                                        <span wire:loading wire:target="approve_comment({{ $comment->id }})"><i
                                                class="las la-circle-notch la-spin text-xl leading-none"></i></span>
                                    </button>
                                </div>
                            @endif
                        @endcan
                        @if (Auth::id() === $comment->user->id ||
                            Auth::user()->roles->first()->hasPermissionTo('delete-others-comments'))
                            <div>
                                <button wire:click="delete({{ $comment->id }})" type="button"
                                    wire:loading.attr="disabled"
                                    class="rounded-full bg-slate-300 px-2 text-xl text-white hover:bg-slate-400">
                                    <span wire:loading.remove wire:target="delete({{ $comment->id }})">&times;</span>
                                    <span wire:loading wire:target="delete({{ $comment->id }})"><i
                                            class="las la-circle-notch la-spin text-sm mb-2 leading-none"></i></span>
                                </button>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>

        <section class="bg-white w-full shadow rounded-lg p-5 pb-20 mt-3">
            <h4 class="font-medium text-slate-500 mb-5">Add Comment</h4>
            <form wire:submit.prevent="saveComment">
                <textarea wire:model.defer="comment"
                    class="bg-gray-200 w-full rounded-lg shadow border border-gray-800 p-2 @error('comment') border-red-500 @enderror"
                    rows="5" placeholder="Write a comment..."></textarea>
                @error('comment')
                    <span class="error text-red-500">{{ $message }}</span>
                @enderror
                <div class="w-full mt-3">
                    <button type="submit" wire:loading.attr="disabled"
                        class="float-right bg-indigo-400 hover:bg-indigo-300 text-white p-2 rounded-lg">
                        <span wire:loading.remove wire:target="comment">Add Comment</span>
                        <span wire:loading wire:target="comment"><i
                                class="las la-circle-notch la-spin text-xl leading-none"></i></span>
                    </button>
                </div>
            </form>
        </section>

    </x-frontend.components.slideover>
</div>
