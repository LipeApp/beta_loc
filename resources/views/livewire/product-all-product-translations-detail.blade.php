<div>
    <div>
        @can('create', App\Models\ProductTranslations::class)
        <button class="button" wire:click="newProductTranslations">
            <i class="mr-1 icon ion-md-add text-primary"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\ProductTranslations::class)
        <button
            class="button button-danger"
             {{ empty($selected) ? 'disabled' : '' }}
            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
            wire:click="destroySelected"
        >
            <i class="mr-1 icon ion-md-trash text-primary"></i>
            @lang('crud.common.delete_selected')
        </button>
        @endcan
    </div>

    <x-modal wire:model="showingModal">
        <div class="px-6 py-4">
            <div class="text-lg font-bold">{{ $modalTitle }}</div>

            <div class="mt-5">
                <div>
                    <x-inputs.group class="w-full lg:w-4/12">
                        <x-inputs.text
                            name="productTranslations.title"
                            label="Title"
                            wire:model="productTranslations.title"
                            maxlength="255"
                            placeholder="Title"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="w-full lg:w-4/12">
                        <x-inputs.textarea
                            name="productTranslations.info"
                            label="Info"
                            wire:model="productTranslations.info"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="w-full lg:w-4/12">
                        <x-inputs.textarea
                            name="productTranslations.title_key"
                            label="Title Key"
                            wire:model="productTranslations.title_key"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="w-full lg:w-4/12">
                        <x-inputs.textarea
                            name="productTranslations.description_key"
                            label="Description Key"
                            wire:model="productTranslations.description_key"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="w-full lg:w-4/12">
                        <x-inputs.textarea
                            name="productTranslations.keywords"
                            label="Keywords"
                            wire:model="productTranslations.keywords"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="w-full lg:w-4/12">
                        <x-inputs.select
                            name="productTranslations.locale"
                            label="Locale"
                            wire:model="productTranslations.locale"
                        >
                            <option value="uz" {{ $selected == 'uz' ? 'selected' : '' }} >Uz</option>
                            <option value="ru" {{ $selected == 'ru' ? 'selected' : '' }} >Ru</option>
                            <option value="en" {{ $selected == 'en' ? 'selected' : '' }} >En</option>
                        </x-inputs.select>
                    </x-inputs.group>
                </div>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-50 flex justify-between">
            <button
                type="button"
                class="button"
                wire:click="$toggle('showingModal')"
            >
                <i class="mr-1 icon ion-md-close"></i>
                @lang('crud.common.cancel')
            </button>

            <button
                type="button"
                class="button button-primary"
                wire:click="save"
            >
                <i class="mr-1 icon ion-md-save"></i>
                @lang('crud.common.save')
            </button>
        </div>
    </x-modal>

    <div class="block w-full overflow-auto scrolling-touch mt-4">
        <table class="w-full max-w-full mb-4 bg-transparent">
            <thead class="text-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left w-1">
                        <input
                            type="checkbox"
                            wire:model="allSelected"
                            wire:click="toggleFullSelection"
                            title="{{ trans('crud.common.select_all') }}"
                        />
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.product_all_product_translations.inputs.title')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.product_all_product_translations.inputs.info')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.product_all_product_translations.inputs.title_key')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.product_all_product_translations.inputs.description_key')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.product_all_product_translations.inputs.keywords')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.product_all_product_translations.inputs.locale')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($allProductTranslations as $productTranslations)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3 text-left">
                        <input
                            type="checkbox"
                            value="{{ $productTranslations->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $productTranslations->title ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $productTranslations->info ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $productTranslations->title_key ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $productTranslations->description_key ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $productTranslations->keywords ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $productTranslations->locale ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $productTranslations)
                            <button
                                type="button"
                                class="button"
                                wire:click="editProductTranslations({{ $productTranslations->id }})"
                            >
                                <i class="icon ion-md-create"></i>
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7">
                        <div class="mt-10 px-4">
                            {{ $allProductTranslations->render() }}
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
