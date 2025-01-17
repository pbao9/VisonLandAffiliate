<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ExampleComponent extends Component
{

    public $count = 1;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }


    public function render()
    {
        return view('livewire.example-component');
    }
}
