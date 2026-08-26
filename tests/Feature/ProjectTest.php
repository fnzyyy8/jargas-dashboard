<?php

use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

test('create Project', function () {


    $payload = [
        'project_name' => 'Project Name',
        'project_code' => 'Project Code',
        'project_number' => 'Project Number',
        'category' => 'Category',
        'budget' => 3000,
        'area' => 'Area',
        'client' => 'Client',
        'start_date' => '2026-01-01',
        'end_date' => '2026-01-01',
    ];
    $response = post(route('projects.store'), $payload);
    $response->assertStatus(201);
});
