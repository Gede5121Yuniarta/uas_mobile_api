<x-guest-layout>
    <form method="POST" action="{{ route('store.brand') }}">
        @csrf

        <!-- Brand Name -->
        <div>
            <x-input-label for="brand_name" :value="__('Brand Name')" />
            <x-text-input id="brand_name" class="block mt-1 w-full" type="text" name="brand_name" required autofocus />
            <x-input-error :messages="$errors->get('brand_name')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Save') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>