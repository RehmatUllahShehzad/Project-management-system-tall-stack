
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        <a href="/">
            <x-admin.components.application-logo class="w-30 h-20 fill-current text-gray-500" />
        </a>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <form wire:submit.prevent="register">
            <h1 class="mb-4 text-center text-xl font-semibold text-gray-700 dark:text-gray-200">
                Register
            </h1>

                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Name</span>

                        <input type="text" wire:model.defer='user.name' class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            aria-labelledby="name" id="name" name="Name"
                            placeholder="Name" />
                        @error('user.name')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror
                    </label>

                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Email</span>

                        <input type="email" wire:model.defer="user.email" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            aria-labelledby="email" id="email" name="email" placeholder="Email" />
                        @error('user.email')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror
                    </label>

                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Password</span>

                        <input type="password" wire:model.defer="password" autocomplete="new-password"
                            autocomplete="off" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" aria-labelledby="password"
                            id="password" name="password" placeholder="Password" />
                        @error('password')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror
                    </label>
                    
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Confirm Password</span>

                        <input type="password" wire:model.defer="confirmPassword" autocomplete="off"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" aria-labelledby="confirm-pwd" id="confirm-pwd"
                            name="repassword" placeholder="Confirm Password" />
                        @error('confirmPassword')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror
                    </label>
        
                    <button class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        <div class="text" wire:loading.remove wire:target="Register">
                            Sign Up
                        </div>
                        <div class="loading" wire:loading wire:target="Register">
                            <i class="las la-circle-notch la-spin text-xl leading-none"></i>
                        </div>
                    </button>
                
                    
                <p class="mt-4">
                    <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline" href="{{ route('admin.login') }}">
                        Already have an account?
                    </a>
                </p>
        </form>
    </div>
</div>
