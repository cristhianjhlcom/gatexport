<?php

namespace App\Livewire\Home;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Index extends Component
{
    public function mount()
    {
        $user = auth()->user();

        // dd($user->hasRole('user'));
        // dd($user->givePermissionTo(['see_dashboard']));
    }

    public function render(): View
    {
        return view('livewire.home.index');
    }
}
