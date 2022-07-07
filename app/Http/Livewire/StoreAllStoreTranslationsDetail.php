<?php

namespace App\Http\Livewire;

use App\Models\Store;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\StoreTranslations;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class StoreAllStoreTranslationsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Store $store;
    public StoreTranslations $storeTranslations;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New StoreTranslations';

    protected $rules = [
        'storeTranslations.title' => ['required', 'max:255', 'string'],
        'storeTranslations.locale' => ['required', 'in:uz,ru,en'],
    ];

    public function mount(Store $store)
    {
        $this->store = $store;
        $this->resetStoreTranslationsData();
    }

    public function resetStoreTranslationsData()
    {
        $this->storeTranslations = new StoreTranslations();

        $this->storeTranslations->locale = 'uz';

        $this->dispatchBrowserEvent('refresh');
    }

    public function newStoreTranslations()
    {
        $this->editing = false;
        $this->modalTitle = trans(
            'crud.store_all_store_translations.new_title'
        );
        $this->resetStoreTranslationsData();

        $this->showModal();
    }

    public function editStoreTranslations(StoreTranslations $storeTranslations)
    {
        $this->editing = true;
        $this->modalTitle = trans(
            'crud.store_all_store_translations.edit_title'
        );
        $this->storeTranslations = $storeTranslations;

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal()
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal()
    {
        $this->showingModal = false;
    }

    public function save()
    {
        $this->validate();

        if (!$this->storeTranslations->store_id) {
            $this->authorize('create', StoreTranslations::class);

            $this->storeTranslations->store_id = $this->store->id;
        } else {
            $this->authorize('update', $this->storeTranslations);
        }

        $this->storeTranslations->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', StoreTranslations::class);

        StoreTranslations::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetStoreTranslationsData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->store->allStoreTranslations as $storeTranslations) {
            array_push($this->selected, $storeTranslations->id);
        }
    }

    public function render()
    {
        return view('livewire.store-all-store-translations-detail', [
            'allStoreTranslations' => $this->store
                ->allStoreTranslations()
                ->paginate(20),
        ]);
    }
}
