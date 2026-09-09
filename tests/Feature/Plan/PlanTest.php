<?php

use App\Models\ProjectControl\Plans;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Project\Projects;
use App\Models\ProjectControl\Boq;

use function Pest\Laravel\{assertDatabaseCount, get, post, put, delete};


uses(RefreshDatabase::class);


it('Create a new Plan', function () {
    \Pest\Laravel\withoutExceptionHandling();

    $boq = Boq::factory()->create();

    get(route('plan.index', $boq->id))
        ->assertStatus(200);

    $payload = [
        'boq_id' => $boq->id,
        'section' => 'Pekerjaan Persiapan',
        'item_detail' => 'Pembuatan Banner',
        'volume' => 1,
        'unit' => 'ls',
        'unit_price' => 10000,
    ];

    post(route('plan.create', $boq->id), $payload)
        ->assertRedirect();

    $this->assertDatabaseCount('plans', 1);
});

it('Should Delete Plan', function () {

    \Pest\Laravel\withoutExceptionHandling();
    $boq = Boq::factory()->create();
    $plan = Plans::factory()->create();

    delete(route('plan.delete', [$boq->id, $plan->id]))->assertRedirect();

    assertDatabaseCount('plans', 0);
});
