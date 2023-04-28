<?php

use App\Models\Supplier\Supplier;

beforeEach(function () {
    $this->token = $this->actingAsAdmin();
});

it('can_get_the_records', function () {
    Supplier::factory()->count(rand(1, 100))->create();

    $response = $this->withHeaders($this->token)
        ->get(route('admin.supplier.index'));

    $response->assertOk();
});

it('can_create_a_record', function () {
    $supplier = Supplier::factory()->make();

    $response = $this->withHeaders($this->token)
        ->post(route('admin.supplier.index'), [
            'name' => $supplier->name,
            'city' => $supplier->city,
            'country' => $supplier->country
        ]);

    $response->assertOk();
});

it('can_show_a_record', function () {
    $supplier = Supplier::factory()->create();

    $response = $this->withHeaders($this->token)
        ->get(route('admin.supplier.show', $supplier->id));

    $response->assertOk();
});

it('can_update_a_record', function () {
    $supplier = Supplier::factory()->create();
    $newName = 'test';

    $response = $this->withHeaders($this->token)
        ->put(route('admin.supplier.update', $supplier->id), [
            'name' => $newName,
            'city' => $supplier->city,
            'country' => $supplier->country
        ]);

    $response->assertOk();

    $supplier = Supplier::find($supplier->id);

    expect($supplier->name)->toBe($newName);
});

it('can_delete_a_record', function () {
    $supplier = Supplier::factory()->create();

    $response = $this->withHeaders($this->token)
        ->delete(route('admin.supplier.destroy', $supplier->id));

    $response->assertOk();

    $supplier = Supplier::find($supplier->id);

    expect($supplier)->toBeNull();
});
