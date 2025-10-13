<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Materia;
use Livewire\WithPagination;

class CatalogosMaterias extends Component
{
    use WithPagination;

    // Propiedades para el formulario
    public $materia_id;
    public $grado;
    public $materia;
    
    // Propiedades para búsqueda
    public $search_grado = '';
    public $search_materia = '';
    
    // Propiedades para el modal
    public $showModal = false;
    public $modalTitle = '';
    public $isEdit = false;

    protected $rules = [
        'grado' => 'required|integer|min:1|max:3',
        'materia' => 'required|string|max:100',
    ];

    protected $messages = [
        'grado.required' => 'El grado es obligatorio.',
        'grado.integer' => 'El grado debe ser un número.',
        'grado.min' => 'El grado mínimo es 1.',
        'grado.max' => 'El grado máximo es 3.',
        'materia.required' => 'La materia es obligatoria.',
        'materia.max' => 'La materia no puede exceder 100 caracteres.',
    ];

    public function render()
    {
        $materias = Materia::query()
            ->porGrado($this->search_grado)
            ->buscar($this->search_materia)
            ->orderBy('grado', 'asc')
            ->orderBy('materia', 'asc')
            ->paginate(10);

        return view('livewire.catalogos-materias', compact('materias'));
    }

    public function crear()
    {
        $this->resetForm();
        $this->modalTitle = 'Crear Materia';
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function editar($id)
    {
        $materia = Materia::findOrFail($id);
        $this->materia_id = $materia->id;
        $this->grado = $materia->grado;
        $this->materia = $materia->materia;
        
        $this->modalTitle = 'Editar Materia';
        $this->isEdit = true;
        $this->showModal = true;
    }

    public function guardar()
    {
        $this->validate();

        if ($this->isEdit) {
            $materia = Materia::findOrFail($this->materia_id);
            $materia->update([
                'grado' => $this->grado,
                'materia' => $this->materia,
            ]);
            session()->flash('success', 'Materia actualizada exitosamente.');
        } else {
            Materia::create([
                'grado' => $this->grado,
                'materia' => $this->materia,
            ]);
            session()->flash('success', 'Materia creada exitosamente.');
        }

        $this->cerrarModal();
    }

    public function eliminar($id)
    {
        $materia = Materia::findOrFail($id);
        $materia->delete();
        session()->flash('success', 'Materia eliminada exitosamente.');
    }

    public function cerrarModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->materia_id = null;
        $this->grado = '';
        $this->materia = '';
    }

    public function updatingSearchGrado()
    {
        $this->resetPage();
    }

    public function updatingSearchMateria()
    {
        $this->resetPage();
    }
}
