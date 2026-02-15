<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Gère une requête entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role  Le rôle requis pour accéder à la route
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Vérifier si l'utilisateur est connecté
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // 2. Récupérer le rôle de l'utilisateur (colonne 'role' ajoutée précédemment)
        $userRole = $request->user()->role;

        // 3. Logique de permission :
        // L'Admin a accès à TOUT.
        // Sinon, le rôle de l'utilisateur doit correspondre exactement au rôle requis.
        if ($userRole === 'Admin' || $userRole === $role) {
            return $next($request);
        }

        // 4. Si l'utilisateur n'a pas le droit, on bloque l'accès
        abort(403, "Accès refusé : Vous n'avez pas le rôle [$role] nécessaire pour cette action.");
    }
}