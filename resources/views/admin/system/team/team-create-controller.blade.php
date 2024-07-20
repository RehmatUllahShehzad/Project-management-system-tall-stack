<x-slot name="pageTitle">
    {{ __('teams.create.title') }}
</x-slot>
<form action="submit" method="POST" wire:submit.prevent="create">
    <div class="grid grid-cols-12">
        @include('admin.system.team.form')
    </div>
</form>
