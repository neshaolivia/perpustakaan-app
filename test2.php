<?php require 'vendor/autoload.php'; \ = require_once 'bootstrap/app.php'; \->make('Illuminate\Contracts\Console\Kernel')->bootstrap(); echo App\Models\Kategoris::count();
