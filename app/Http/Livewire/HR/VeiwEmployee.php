<?php

namespace App\Http\Livewire\HR;

use Livewire\Component;

class VeiwEmployee extends Component
{
    public function render()
    {

        return view('livewire.h-r.veiw-employee');
    }

    public function close()
    {
        $this->emitUp('returnHome');
    }
}
