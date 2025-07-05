<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Users;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Show User')]
final class UserShowManagement extends Component
{
    public function render()
    {
        return view('livewire.admin.users.show');
    }
}
