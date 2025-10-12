<?php

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Migrar fotos de perfil al nuevo sistema
$users = DB::table('users')->whereNotNull('profile_photo_path')->get();

foreach ($users as $user) {
    $oldPath = $user->profile_photo_path;
    
    // Si la foto está en el directorio de storage, copiarla al nuevo directorio
    if (strpos($oldPath, 'profile-photos/') !== false) {
        $filename = basename($oldPath);
        $sourcePath = public_path('storage/' . $oldPath);
        $destPath = public_path('images/profiles/profile_' . $user->id . '_' . time() . '.png');
        
        if (file_exists($sourcePath)) {
            if (copy($sourcePath, $destPath)) {
                $newPath = 'images/profiles/' . basename($destPath);
                DB::table('users')->where('id', $user->id)->update(['profile_photo_path' => $newPath]);
                echo "Migrado usuario {$user->id}: {$oldPath} -> {$newPath}\n";
            } else {
                echo "Error copiando foto para usuario {$user->id}\n";
            }
        }
    }
}

echo "Migración completada.\n";
