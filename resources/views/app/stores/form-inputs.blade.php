@php $editing = isset($store) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.textarea name="phone" label="Phone" maxlength="255" required
            >{{ old('phone', ($editing ? $store->phone : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="maps" label="Maps" maxlength="255" required
            >{{ old('maps', ($editing ? $store->maps : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
