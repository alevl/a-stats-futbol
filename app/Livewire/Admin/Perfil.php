<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Perfil extends Component
{
    public $username, $name;
    public $password1, $password2;

    public function mount()
    {
        if(auth()->user()->nivel_id <> 1)
        {
            session()->flush();
            return redirect()->route('login');
        }
    }

    public function render()
    {
        $usuario = User::where('id', auth()->user()->id)->first();

        $this->username = $usuario->username;
        $this->name = $usuario->name;

        return view('livewire.admin.perfil');
    }

    public function actualizar()
    {
        $this->validate([
            'name' => 'required|max:45',
        ]);

        $actualizar = User::where('id', auth()->user()->id)
        ->update([
            'name' => $this->name,
        ]);

        $this->dispatch('alert','Usuario actualizado');
    }

    public function actualizar_clave()
    {
        $this->validate([
            'password1' => 'required|max:255',
            'password2' => 'required|max:255',
        ]);

        if($this->password1 <> $this->password2)
        {
            $this->dispatch('no_coinciden');
        }
        else
        {
            $actualizar = User::where('id', auth()->user()->id)
            ->update([
                'password' => Hash::make($this->password1)
            ]);
    
            $this->dispatch('alert','Usuario actualizado');
        }
    }
}
