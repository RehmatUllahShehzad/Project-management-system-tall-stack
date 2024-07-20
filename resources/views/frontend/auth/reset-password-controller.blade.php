<div class="w-full">
    <div class="inner-section">
        <section>
            <div class="auth-portal-main" style="background-image: url('/frontend/images/login.png')">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="auth-portal forgot-password div-flex">
                                <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">Reset Password</h1>

                                <form wire:submit.prevent="resetPassword">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-form">
                                                <input type="hidden" wire:model.defer="email" aria-labelledby="Email"
                                                    id="Email" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="email"
                                                    placeholder="Email" />
                                                @error('email')
                                                    <div class="error text-red-500 py-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input-form">
                                                <input type="password" wire:model.defer="password"
                                                    aria-labelledby="Password" id="Password" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                                    name="password" placeholder="Password" />
                                                @error('password')
                                                    <div class="error text-red-500 py-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input-form">
                                                <input type="password" wire:model.defer="confirm_password"
                                                    aria-labelledby="Confirm Password" id="CPassword"
                                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="confirm-password"
                                                    placeholder="Confirm Password" />
                                                @error('confirm_password')
                                                    <div class="error text-red-500 py-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" 
                                    wire:loading.attr="disabled"
                                    class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                        <div class="text" wire:loading.remove wire:target="resetPassword">
                                            Reset Password
                                        </div>
                                        <div class="loading" wire:loading wire:target="resetPassword">
                                            <i class="las la-circle-notch la-spin text-xl leading-none"></i>
                                        </div>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
