<?php

namespace App\Livewire\Producto;

use App\Models\Productos;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Productoslive extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'idproducto';
    public $sortDirection = 'asc';

    protected $paginationTheme = 'bootstrap';

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
        'sortField' => ['except' => 'idproducto'],
        'sortDirection' => ['except' => 'asc'],
    ];

    #[On('listarproductoDesdeJS')]
    public function refreshList()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

    public function render()
    {
        $modelo = new Productos();

        $resultado = $modelo->mostraproducto([
            'search' => $this->search,
            'porPagina' => $this->perPage,
            'paginado' => true,
            'orderBy' => $this->sortField,
            'orderDirection' => $this->sortDirection,
        ]);

        return view('livewire.producto.productoslive', [
            'data' => $resultado['data'] ?? []
        ]);
    }
}
