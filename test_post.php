<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$user = App\Models\User::where('role', 'admin')->first();
if (!$user) {
    echo "No admin user found\n";
    exit;
}

auth()->login($user);

$request = Illuminate\Http\Request::create('/admin/buku', 'POST', [
    'judul' => 'Test Post',
    'author' => 'Test Post',
    'id_kategoris' => 1,
    'description' => 'test',
    '_token' => csrf_token()
]);

$response = app()->handle($request);
echo "Status: " . $response->getStatusCode() . "\n";
if ($response->getStatusCode() == 302) {
    echo "Redirect: " . $response->headers->get('Location') . "\n";
    // Check if session has errors
    $errors = session()->get('errors');
    if ($errors) {
        echo "Errors: \n";
        print_r($errors->all());
    } else {
        echo "Success message: " . session()->get('success') . "\n";
    }
} else {
    echo "Content: " . $response->getContent() . "\n";
}
