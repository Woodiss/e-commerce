<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

use Twig\Extension\GlobalsInterface;

class GlobalVariables extends AbstractExtension implements GlobalsInterface
{
    public function getGlobals(): array
    {
        return [
            'my_global_variable' => 'Valeur de mon information globale',
            // Ajoutez d'autres variables globales ici si nécessaire
        ];
    }
}