@props([
    'disabled' => false,
    'label' => null,
    'name',
    'icon' => null,
    'hint' => null,
    'required' => false
])

<div class="{{ $attributes->get('class') ? 'mb-4 ' . $attributes->get('class') : 'mb-4' }}">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-primary mb-1">
            {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif

    <div class="relative">
        @if($icon)
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                {!! $icon !!}
            </div>
        @endif

        <input 
            id="{{ $name }}"
            name="{{ $name }}"
            {{ $disabled ? 'disabled' : '' }} 
            {!! $attributes->merge([
                'class' => 'w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring-primary sm:text-sm ' . ($icon ? 'pl-10' : '')
            ]) !!}
            @if($required) required @endif
        >
    </div>

    @if($hint)
        <p class="mt-1 text-sm text-gray-500">{{ $hint }}</p>
    @endif

    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
