<?php

use Illuminate\Console\Command;
use App\Models\User;

class CheckDocentesCommand extends Command
{
    protected $signature = 'check:docentes';
    protected $description = 'Verificar usuarios con puesto DOCENTE';

    public function handle()
    {
        $this->info('Verificando usuarios con puesto DOCENTE...');
        
        $docentes = User::where('puesto', 'DOCENTE')->get(['id', 'name', 'email', 'puesto', 'estatus']);
        
        if ($docentes->count() > 0) {
            $this->info("Encontrados {$docentes->count()} docentes:");
            foreach ($docentes as $docente) {
                $status = $docente->estatus ? 'Activo' : 'Inactivo';
                $this->line("ID: {$docente->id} | Nombre: {$docente->name} | Email: {$docente->email} | Puesto: {$docente->puesto} | Estatus: {$status}");
            }
        } else {
            $this->warn('No se encontraron usuarios con puesto DOCENTE');
        }
        
        $this->info('Todos los usuarios:');
        $allUsers = User::all(['id', 'name', 'email', 'puesto', 'estatus']);
        foreach ($allUsers as $user) {
            $status = $user->estatus ? 'Activo' : 'Inactivo';
            $this->line("ID: {$user->id} | Nombre: {$user->name} | Email: {$user->email} | Puesto: {$user->puesto} | Estatus: {$status}");
        }
    }
}
