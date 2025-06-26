<?php

declare(strict_types=1);

namespace App\Livewire\Profile;

use Illuminate\Contracts\View\View;
use Livewire\Component;

final class Index extends Component
{
    public function render(): View
    {
        return view('livewire.profile.index');
    }
}
