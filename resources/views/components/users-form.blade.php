@props(['user'])
<form {{ $attributes->merge() }}>
    {{ $slot }}
    <div class="border-b">
        <div class="flex items-center justify-end mr-5 md:justify-between">
            <div class="flex-1 block min-w-0">
                <div class="flex flex-col p-6">
                    <ol class="inline-flex p-0 list-none">
                        <li class="flex items-center">
                            <a href="{{ route('users.index') }}"
                               class="font-semibold leading-relaxed text-gray600"> {{ __('Utenti') }}</a>
                        </li>
                        @isset($user)
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                                <span class="font-semibold leading-relaxed textblack ">{{$user->name}}</span>

                            </li>
                        @else
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                                <span class="font-semibold leading-relaxed textgray-600"> {{ __('Nuovo Utente') }}
 </span>
                            </li>
                        @endisset
                    </ol>
                </div>
            </div>
            <div class="py-5">
 <span class="ml-3 rounded-md shadow-sm">
 <button type="submit"
         class="inline-flex items-center px-4 py-2 text-sm
font-medium leading-5 text-gray-700 transition duration-150 ease-in-out
bg-green-300 border border-green-100 rounded-md hover:bg-green-400
hover:text-gray-500 focus:outline-none focus:shadow-outline-blue
focus:border-blue-300 active:text-gray-800 active:bg-gray-50">
<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
</svg>
 </button>
 </span>
            </div>
        </div>
    </div>
    <div class="p-6">
        <div class="mb-5 -mt-1 text-center">
            <div class="relative w-32 h-32 mx-auto mb-2 bg-gray-100 border
rounded-full">
                <img alt="" id="cover" class="object-cover w-full h-32
rounded-full" src="@isset($user->avatar)/{{$user->avatar}} @else
                    https://eu.ui-avatars.com/api/?name={{isset($user->name) ? $user->name :
'Nuovo Utente' }} @endisset">
            </div>
            <label for="uploadcover" class="items-center justify-between px-4
py-2 font-medium text-left text-gray-600 bg-white border rounded-lg
shadow-sm cursor-pointer inine-flex focus:outline-none hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="inline-flex
flex-shrink-0 w-6 h-6 mr-1 -mt-1"
                     viewBox="0 0 24 24" stroke-width="2"
                     stroke="currentColor" fill="none"
                     stroke-linecap="round" stroke-linejoin="round">
                    <rect x="0" y="0" width="24" height="24" stroke="none">
                    </rect>
                    <path
                        d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1
1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2
2 0 0 1 2 -2"></path>
                    <circle cx="12" cy="13" r="3"></circle>
                </svg>
                {{ __('Carica Avatar') }}
            </label>
            <input name="avatar" id="uploadcover" accept="image/*"
                   onchange="document.getElementById('cover').src =window.URL.createObjectURL(this.files[0])"
                   class="hidden" type="file">
            @error('avatar')
            <p class="mt-4 text-xs italic text-red-500">
                {{ $message }}
            </p>
            @enderror
        </div>
        <div class="mb-6 md:flex md:items-center">
            <div class="md:w-1/3">
                <x-label class="px-1 text-sm text-gray-600 md:flex md:justifyend md:px-5" for="name"
                         :value="__('Username')"/>
            </div>
            <div class="md:w-2/3">
                <div>
                    <x-input type="text"
                             id="name"
                             class="block w-full md:w-3/5 "
                             name="name"
                             :value="$user->name ?? old('name')"
                             autofocus/>
                </div>
            </div>
        </div>
        <div class="mb-6 md:flex md:items-center">
            <div class="md:w-1/3">
                <x-label class="px-1 text-sm text-gray-600 md:flex md:justifyend md:px-5" for="email"
                         :value="__('Email')"/>
            </div>
            <div class="md:w-2/3">
                <div>
                    <x-input type="email"
                             id="email"
                             class="block w-full md:w-3/5"
                             name="email"
                             :value="$user->email ?? old('email')"
                             autofocus/>
                </div>
            </div>
        </div>
        <div class="mb-6 md:flex md:items-center">
            <div class="md:w-1/3">
                <x-label class="px-1 text-sm text-gray-600 md:flex md:justify-end md:px-5" for="password"
                         :value="__('Password')"/>
            </div>
            <div class="md:w-2/3">
                <div>
                    <x-input type="password"
                             id="password"
                             class="block w-full md:w-3/5"
                             name="password"
                             :value="old('password')"
                             autofocus/>
                </div>
            </div>
        </div>
    </div>
</form>
