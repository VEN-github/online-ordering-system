<?php

declare(strict_types=1);

use App\Models\Faq\Faq;

beforeEach(function () {
    $this->token = $this->actingAsAdmin();
});

it('can_get_the_records', function () {
    Faq::factory()->count(rand(1, 100))->create();

    $response = $this->withHeaders($this->token)
        ->get(route('admin.faq.index'));

    $response->assertOk();
});

it('can_create_a_record', function () {
    $faq = Faq::factory()->make();

    $response = $this->withHeaders($this->token)
        ->post(route('admin.faq.index'), [
            'question' => $faq->question,
            'slug' => $faq->slug,
            'answer' => $faq->answer,
            'active' => $faq->active,
        ]);

    $response->assertOk();
});

it('can_show_a_record', function () {
    $faq = Faq::factory()->create();

    $response = $this->withHeaders($this->token)
        ->get(route('admin.faq.show', $faq->slug));

    $response->assertOk();
});

it('can_update_a_record', function () {
    $faq = Faq::factory()->create();
    $newQuestion = 'test';

    $response = $this->withHeaders($this->token)
        ->patch(route('admin.faq.update', $faq->slug), [
            'question' => $newQuestion,
            'answer' => $faq->answer,
            'active' => $faq->active,
        ]);

    $response->assertOk();

    $faq = Faq::find($faq->id);

    expect($faq->question)->toBe($newQuestion);
});

it('can_delete_a_record', function () {
    $faq = Faq::factory()->create();

    $response = $this->withHeaders($this->token)
        ->delete(route('admin.faq.destroy', $faq->slug));

    $response->assertOk();

    $faq = Faq::find($faq->id);

    expect($faq)->toBeNull();
});
