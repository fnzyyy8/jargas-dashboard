<?php

use App\Models\ProjectControl\Plans;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\post;
use function Pest\Laravel\withoutExceptionHandling;

uses(RefreshDatabase::class);

it('can create detail plan', function () {
    withoutExceptionHandling();

    $plan = Plans::factory()->create();

    $payload = [
        'plan_id' => $plan->id,
        'plan_date' => '2026-01-01',
        'plan_volume' => 3
    ];
    post(route('plan.detail.create', [$plan->boq_id, $plan->id]), $payload)
        ->assertStatus(200);

    assertDatabaseCount('plan_details', 1);
});
