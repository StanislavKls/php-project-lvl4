<?php

namespace Tests\Feature;

use Tests\TestCase;
use \App\Models\Label;

class LabelsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        \Artisan::call('migrate');
        \Artisan::call('db:seed');

        $label = new Label();
        $label->created_at = now();
        $label->updated_at = now();
        $label->name = 'test';
        $label->save();
        $this->id = $label->id;
    }
    public function testIndex(): void
    {
        $response = $this->get(route('labels.index'));
        $response->assertOk();
    }
    public function testCreate(): void
    {
        $response = $this->get(route('labels.create'));
        $response->assertOk();
    }
    public function testEdit(): void
    {
        $response = $this->get(route('labels.edit', $this->id));
        $response->assertOk();
    }
    public function testStore(): void
    {
        $response = $this->post(route('labels.store', ['name' => 'test222']));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('labels', ['name' => 'test222']);
    }
}
