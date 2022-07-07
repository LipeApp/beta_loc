<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use App\Models\ProductTranslations;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductAllProductTranslationsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Product $product;
    public ProductTranslations $productTranslations;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New ProductTranslations';

    protected $rules = [
        'productTranslations.title' => ['required', 'max:255', 'string'],
        'productTranslations.info' => ['required', 'max:255', 'string'],
        'productTranslations.title_key' => ['required', 'max:255', 'string'],
        'productTranslations.description_key' => [
            'required',
            'max:255',
            'string',
        ],
        'productTranslations.keywords' => ['required', 'max:255', 'string'],
        'productTranslations.locale' => ['required', 'in:uz,ru,en'],
    ];

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->resetProductTranslationsData();
    }

    public function resetProductTranslationsData()
    {
        $this->productTranslations = new ProductTranslations();

        $this->productTranslations->locale = 'uz';

        $this->dispatchBrowserEvent('refresh');
    }

    public function newProductTranslations()
    {
        $this->editing = false;
        $this->modalTitle = trans(
            'crud.product_all_product_translations.new_title'
        );
        $this->resetProductTranslationsData();

        $this->showModal();
    }

    public function editProductTranslations(
        ProductTranslations $productTranslations
    ) {
        $this->editing = true;
        $this->modalTitle = trans(
            'crud.product_all_product_translations.edit_title'
        );
        $this->productTranslations = $productTranslations;

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

        if (!$this->productTranslations->product_id) {
            $this->authorize('create', ProductTranslations::class);

            $this->productTranslations->product_id = $this->product->id;
        } else {
            $this->authorize('update', $this->productTranslations);
        }

        $this->productTranslations->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', ProductTranslations::class);

        ProductTranslations::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetProductTranslationsData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach (
            $this->product->allProductTranslations
            as $productTranslations
        ) {
            array_push($this->selected, $productTranslations->id);
        }
    }

    public function render()
    {
        return view('livewire.product-all-product-translations-detail', [
            'allProductTranslations' => $this->product
                ->allProductTranslations()
                ->paginate(20),
        ]);
    }
}
