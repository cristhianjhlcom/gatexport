<?php

declare(strict_types=1);

namespace App\Livewire\Shared;

use Livewire\Component;

final class Dropzone extends Component
{
    public function render()
    {
        return view('livewire.shared.dropzone');
    }
}
