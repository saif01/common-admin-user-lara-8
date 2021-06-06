<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;


use App\Models\User;


class Index extends Component
{
    public $admin, $headquarter, $history, $mission, $vision, $businessAll, $event, $gallery, $press;

    public function mount(){
        $this->admin             = User::count();
    }

    public function render()
    {
        return view('livewire.admin.index');
    }
}
