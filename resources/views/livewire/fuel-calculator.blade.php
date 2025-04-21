<div class="max-w-xl mx-auto mt-10 mb-10 p-6 bg-white rounded shadow-lg space-y-6">
    <h2 class="text-2xl font-semibold text-gray-800 text-center">{{ __('Fuel Calculator') }}</h2>

    <form wire:submit.prevent="calculateLevel" class="flex flex-wrap gap-4 items-start">
        <div class="flex-1 min-w-[120px]">
            <x-text-input id="currentContent" type="number" name="currentContent"
                placeholder="{{ __('Current content') }}" wire:model="currentContent" class="w-full" />
            @error('currentContent')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex-1 min-w-[120px]">
            <x-text-input id="totalContent" type="number" name="totalContent" placeholder="{{ __('Total content') }}"
                wire:model="totalContent" class="w-full" />
            @error('totalContent')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <button type="submit"
                class="bg-green-700 text-white py-2 px-4 rounded hover:bg-green-900 transition duration-200 whitespace-nowrap">
                {{ __('Calculate') }}
            </button>
        </div>
    </form>

    @if($this->fuelLevelDisplay)
        <div class="text-center text-lg font-medium text-green-700">
            {{ __('Fuel level') }}:
            <span class="font-bold">{{ $this->fuelLevelDisplay }}</span>
        </div>
    @else
        <div class="text-center text-lg font-medium text-gray-500">
            {{ __('No fuel level calculated yet.') }}
        </div>
    @endif
</div>