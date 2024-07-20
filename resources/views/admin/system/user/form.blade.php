<div class="col-span-12 space-y-4">
    <x-admin.components.card heading="Basic Information">
        <div class="grid grid-cols-2 gap-4">
            <x-admin.components.input.group label="{{ __('inputs.name') }}" for="name" :error="$errors->first('user.name')">
                <x-admin.components.input.text wire:model.defer="user.name" name="name" id="name"
                    :error="$errors->first('user.name')" />
            </x-admin.components.input.group>

            <x-admin.components.input.group label="{{ __('inputs.email') }}" for="email" :error="$errors->first('user.email')">
                <x-admin.components.input.text wire:model="user.email" type="email" name="email" id="email" :error="$errors->first('user.email')" />
            </x-admin.components.input.group>
        </div>
        
        <div class="grid grid-cols-2 gap-4">
            <x-admin.components.input.group label="{{ __('inputs.role') }}" for="role" :error="$errors->first('role')">
                <x-admin.components.input.select wire:model.defer="role" name="role" :error="$errors->first('role')">
                    <option value="">Select a Role</option>
                    @forelse($roles as $_role)
                        <option value="{{ $_role->name }}" @if($role && $_role->name == $role) selected @endif>
                            {{ $_role->name }}
                        </option>
                    @empty
                    @endforelse
                </x-admin.components.select>
            </x-admin.components.input.group>
            
            <x-admin.components.input.group label="{{ __('inputs.teams') }}" for="teams" :error="$errors->first('teams')">
                <x-admin.components.select2 :options="$teams" :selectedOptions="$selectedTeams" wire:model.defer="teams" name="teams" :error="$errors->first('teams')" />
            </x-admin.components.input.group>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <x-admin.components.input.group label="{{ __('inputs.new_password') }}" for="password" :error="$errors->first('password')">
                <x-admin.components.input.text wire:model="password" type="password" name="password" id="password" :error="$errors->first('password')" />
            </x-admin.components.input.group>

            <x-admin.components.input.group label="{{ __('inputs.new_password_confirmation') }}" for="passwordConfirmation" :error="$errors->first('password_confirmation')">
                <x-admin.components.input.text wire:model="password_confirmation" type="password" name="password_confirmation" id="passwordConfirmation" :error="$errors->first('passwordConfirmation')" />
            </x-admin.components.input.group>
        </div>
    </x-admin.components.card>

    <div class="px-4 py-3 text-right rounded shadow bg-gray-50 sm:px-6">
        <button type="submit"
            class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ __($user->id ? 'users.form.update_btn' : 'users.form.create_btn') }}
        </button>
    </div>

</div>
