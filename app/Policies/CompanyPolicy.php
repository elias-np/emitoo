<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class CompanyPolicy
{
    /**
     * Verificar se o modelo pertence à empresa do usuário.
     */
    public function belongToCompany(User $user, Model $model): bool
    {
        // Se o modelo tem company_id, verificar se corresponde
        if ($model->hasAttribute('company_id')) {
            return $model->company_id === $user->company_id;
        }

        // Se o modelo tem um relacionamento company, verificar
        if ($model->hasAttribute('company') || method_exists($model, 'company')) {
            return optional($model->company)->id === $user->company_id;
        }

        return false;
    }
}
