<x-guest-layout>
    <div class="border-8 p-4 bg-white">
        <div class="mb-4 text-sm text-white-600 text-center">
            {{ __('ご登録されたメールアドレスを入力してください。') }}
        </div>
    
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
    
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
    
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('メールアドレス')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
    
            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="mt-2 bg-sky-500 hover:bg-sky-700 text-white rounded-full">
                    {{ __('送信') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
