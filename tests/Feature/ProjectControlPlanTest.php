<?php

use App\Models\Projects;
use App\Models\User;
use function \Pest\Laravel\post;

test('User can create Project Control Plan', function () {

    $user = User::factory()->create();


    $project = Projects::create([
        'project_name' => 'Project Name',
        'category' => 'Project Category',
        'client' => 'Client Name',
        'area' => 'Area',
        'start_date' => '2026-01-01',
        'end_date' => '2026-01-01'
    ]);

    dump($project->id);

    $payload = [
        'project_id' => $project->id,
        'section' => 'Section 1',
        'category' => 'Pekerjaan Tanah',
        'sub_category' => 'Galian',
        'item_detail' => 'Galian tanah',
        'volume' => 100,
        'unit' => 'm3',
        'unit_price' => 50000,
    ];

    $response = post(route('plan.store'), $payload);

    $response->assertStatus(201);

});
