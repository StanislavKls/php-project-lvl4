<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\TaskStatus;

class TaskStatusTest extends TestCase
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

        $status = new TaskStatus();
        $status->created_at = now();
        $status->updated_at = now();
        $status->name = 'test';
        $status->save();
        $this->id = $status->id;
    }
    public function testIndex(): void
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertOk();
    }
    public function testCreate(): void
    {
        $response = $this->get(route('task_statuses.create'));
        $response->assertOk();
    }
    public function testEdit(): void
    {
        $response = $this->get(route('task_statuses.edit', $this->id));
        $response->assertOk();
    }
    public function testStore(): void
    {
        $response = $this->post(route('task_statuses.store', ['name' => 'test222']));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('task_statuses', ['name' => 'test222']);
    }
}
