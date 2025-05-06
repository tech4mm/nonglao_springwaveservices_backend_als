<?php
return [
  // 'paths' => ['api/*', 'broadcasting/auth', 'sanctum/csrf-cookie'],
  'paths' => [
    'api/*',
    'sanctum/csrf-cookie',
    'login',
    'logout',
    'broadcasting/auth',
],
  'allowed_methods' => ['*'],
  'allowed_origins' => ['http://localhost:5173', 'http://127.0.0.1:5173','https://nonglao.springwaveservices.com'],
  'allowed_headers' => ['*'],
  'exposed_headers' => [],
  'max_age' => 0,
  'supports_credentials' => true,
];
