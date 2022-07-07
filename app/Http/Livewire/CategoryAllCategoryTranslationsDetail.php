<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use App\Models\CategoryTranslations;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CategoryAllCategoryTranslationsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Category $category;
    public CategoryTranslations $categoryTranslations;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New CategoryTranslations';

    protected $rules = [
        'categoryTranslations.title' => ['required', 'max:255', 'string'],
        'categoryTranslations.title_key' => ['nullable', 'max:255', 'string'],
        'categoryTranslations.description_key' => [
            'required',
            'max:255',
            'string',
        ],
        'categoryTranslations.keywords' => ['required', 'max:255', 'string'],
        'categoryTranslations.locale' => ['required', 'in:uz,ru,en'],
    ];

    public function mount(Category $category)
    {
        $this->category = $category;
        $this->resetCategoryTranslationsData();
    }

    public function resetCategoryTranslationsData()
    {
        $this->categoryTranslations = new CategoryTranslations();

        $this->categoryTranslations->locale = 'uz';

        $this->dispatchBrowserEvent('refresh');
    }

    public function newCategoryTranslations()
    {
        $this->editing = false;
        $this->modalTitle = trans(
            'crud.category_all_category_translations.new_title'
        );
        $this->resetCategoryTranslationsData();

        $this->showModal();
    }

    public function editCategoryTranslations(
        CategoryTranslations $categoryTranslations
    ) {
        $this->editing = true;
        $this->modalTitle = trans(
            'crud.category_all_category_translations.edit_title'
        );
        $this->categoryTranslations = $categoryTranslations;

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

        if (!$this->categoryTranslations->category_id) {
            $this->authorize('create', CategoryTranslations::class);

            $this->categoryTranslations->category_id = $this->category->id;
        } else {
            $this->authorize('update', $this->categoryTranslations);
        }

        $this->categoryTranslations->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', CategoryTranslations::class);

        CategoryTranslations::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetCategoryTranslationsData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach (
            $this->category->allCategoryTranslations
            as $categoryTranslations
        ) {
            array_push($this->selected, $categoryTranslations->id);
        }
    }

    public function render()
    {
        return view('livewire.category-all-category-translations-detail', [
            'allCategoryTranslations' => $this->category
                ->allCategoryTranslations()
                ->paginate(20),
        ]);
    }
}
