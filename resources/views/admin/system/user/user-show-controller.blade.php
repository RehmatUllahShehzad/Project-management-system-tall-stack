<x-slot name="pageTitle">
    {{ __('users.edit.title') }}
</x-slot>
<form action="submit" method="POST" wire:submit.prevent="update">
    <div class="grid grid-cols-12">
        @include('admin.system.user.form')
    </div>
</form>
