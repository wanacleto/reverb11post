<?php

namespace App\Livewire;

use Livewire\Component;

class Contador extends Component
{
    public int $contador = 0;

    #[\Livewire\Attributes\On('contador-atualizado')]
    public function atualizarContador($valor)
    {
        \Log::info('Evento contador-atualizado recebido com valor: ' . $valor);
        $this->contador = $valor;
    }

    public function incrementar()
    {
        $this->contador++;
        \Log::info('Disparando evento contador-atualizado com valor: ' . $this->contador);
        // Dispara o evento para outros usuários conectados
        $this->dispatch('contador-atualizado', $this->contador);
    }

    public function render()
    {
        return view('livewire.contador');
    }
}
