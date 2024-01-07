<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    
    <div class="border-8 p-4 bg-white">
        <div class="flex justify-between border border-white p-4">
            <div class="flex-col">
            　<div class="bg-white">
                <div class="mt-6 flex flex-col justify-center">
                    <div class="h-32 w-96 border border-white rounded p-4 bg-green-500">
                        <span class="text-lg text-white">LINEでログイン</span>
                    </div>
                </div>
            </div>
            <div class="bg-white">
                <div class="mt-6 flex flex-col justify-center">
                    <div class="h-32 w-96 border border-white rounded p-4 bg-sky-500">
                        <span class="text-lg text-white">Googleでログイン</span>
                    </div>
                </div>
            </div>
            <div class="bg-white">
                <div class="mt-6 flex flex-col justify-center">
                    <div class="h-32 w-96 border border-whiterounded p-4">
                        <span class="text-lg">Twitterでログイン</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="flex flex-col items-center mt-8">
            <span class="textlg">SNSでログイン</span>
        </div>
        
        <div>
            <div class="border p-8 bg-gray-100">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="text-center mb-8"> 
                        <x-input-label :value="__('メールアドレスでログイン')" class="text-sm font-medium text-gray-600" />
                    </div>
            
                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
            
                    <!-- パスワード -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
            
                    <!-- 記憶 -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('ログイン状態を保存') }}</span>
                        </label>
                    </div>
            
                    <!-- ログインボタン -->
                    <div class="text-center mt-4">
                        <x-primary-button class="mt-2 bg-sky-500 hover:bg-sky-700 text-white rounded-full">
                            {{ __('ログイン') }}
                        </x-primary-button>
                    </div>
            
                    <!-- パスワード忘れ場合 -->
                    <div class="text-center mt-2">
                        <a class="text-blue-500 hover:underline" href="{{ route('password.request') }}">
                            {{ __('パスワードを忘れた場合') }}
                        </a>
                    </div>
            
                </form>
            </div>    
            
                <!-- 新しいアカウントの作成-->
                <div class="mt-8 border border-gray-300 p-4 rounded-md text-center bg-gray-100">
                    <p class="text-gray-600 text-sm">アカウントをお持ちではない場合</p>
                    <x-primary-button class="mt-2 bg-sky-500 hover:bg-sky-700 text-white rounded-full">
                        <a href="{{ route('register') }}">新しいアカウントを作成</a>
                    </x-primary-button>
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>
</x-guest-layout>
