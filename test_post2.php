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

// Create a dummy uploaded file
file_put_contents('dummy.jpg', 'fake image content');
$file = new Illuminate\Http\UploadedFile(
    'dummy.jpg', 'dummy.jpg', 'image/jpeg', null, true
);

$request = Illuminate\Http\Request::create('/admin/buku', 'POST', [
    'judul' => 'Test File',
    'author' => 'Test File',
    'id_kategoris' => 1,
    'description' => 'test',
    '_token' => csrf_token()
], [], ['cover' => $file]);

$response = app()->handle($request);
echo "Status: " . $response->getStatusCode() . "\n";
if ($response->getStatusCode() == 302) {
    echo "Redirect: " . $response->headers->get('Location') . "\n";
    $errors = session()->get('errors');
    if ($errors) {
        echo "Errors: \n";
        print_r($errors->all());
    }
}
