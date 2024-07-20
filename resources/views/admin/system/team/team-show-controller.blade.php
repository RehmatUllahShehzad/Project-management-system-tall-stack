<x-slot name="pageTitle">
    {{ __('teams.edit.title') }}
</x-slot>
<div>
    <form action="submit" method="POST" wire:submit.prevent="update">
        <div class="grid grid-cols-12">
            @include('admin.system.team.form')
        </div>
    </form>

    <div
        class="overflow-hidden shadow-gray-800 dark:shadow-gray-50 border border-gray-300 dark:border-gray-500 sm:rounded-lg mt-5">
        <x-admin.components.table class="w-full whitespace-no-wrap p-2">
            <x-slot name="head">
                <x-admin.components.table.heading>{{ __('global.user') }}</x-admin.components.table.heading>
                <x-admin.components.table.heading>{{ __('global.active') }}</x-admin.components.table.heading>
            </x-slot>
            <x-slot name="body">
                @forelse($teamUsers as $user)
                    <x-admin.components.table.row wire:loading.class.delay="opacity-50">
                        <x-admin.components.table.cell>{{ $user->name }}</x-admin.components.table.cell>
                        <x-admin.components.table.cell>
                            <x-icon :ref="!$user->deleted_at ? 'check' : 'x'" :class="!$user->deleted_at ? 'text-green-500' : 'text-red-500'" style="solid" />
                        </x-admin.components.table.cell>
                    </x-admin.components.table.row>
                @empty
                    <x-admin.components.table.no-results />
                @endforelse
            </x-slot>
        </x-admin.components.table>
    </div>
</div>
