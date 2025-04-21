<?php

namespace App\Livewire;

use Livewire\Component;

class FuelCalculator extends Component
{
    public $currentContent;
    public $totalContent;
    public $fuelLevel;

    public $error;

    public function getFuelLevelDisplayProperty()
    {
        if ($this->fuelLevel === null) return null;

        if ($this->fuelLevel <= 1) {
            return 'E';
        } elseif ($this->fuelLevel >= 99) {
            return 'F';
        }

        return $this->fuelLevel . '%';
    }

    public function rules()
    {
        return [
            'currentContent' => 'required|numeric|lte:totalContent',
            'totalContent' => 'required|numeric|gt:0',
        ];
    }

    public function calculateLevel()
    {
        $this->validate();

        $this->fuelLevel = round(($this->currentContent / $this->totalContent) * 100, 2);
    }

    public function render()
    {
        return view('livewire.fuel-calculator');
    }
}
