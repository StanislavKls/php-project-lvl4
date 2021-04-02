<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;

class TaskTest extends TestCase
{
    private $task;  /* @phpstan-ignore-line */
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
        $status->name = 'test';
        $status->save();

        $user = User::factory()->create();
        $data = ['name' => 'test1',
        'description' => 'testtest',
        'status_id' => TaskStatus::first()->id,  /* @phpstan-ignore-line */
        'created_by_id' => $user->id,
        'assigned_to_id' => $user->id
        ];
        $this->task = new Task();       /* @phpstan-ignore-line */
        $this->task->fill($data);
        $this->task->save();
    }
    public function testIndex(): void
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
    }
    public function testCreate(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('tasks.create'));
        $response->assertOk();
    }
    public function testStore(): void
    {
        $user      = User::factory()->create();
        $response  = $this->post(route('task_statuses.store', ['name' => 'test']));
        $status_id = TaskStatus::first()->id;   /* @phpstan-ignore-line */
        $data      = ['name' => 'test2',
                      'description' => 'testtest',
                      'status_id' => $status_id,
                      'assigned_to_id' => $user->id
                    ];
        $response = $this->actingAs($user)->post(route('tasks.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', $data);
    }
    public function testShow(): void
    {
        $response = $this->get(route('tasks.show', $this->task->id));   /* @phpstan-ignore-line */
        $response->assertOk();
    }
    public function testEdit(): void
    {
        $response = $this->get(route('tasks.edit', $this->task->id));   /* @phpstan-ignore-line */
        $response->assertOk();
    }
    public function testUpdate(): void
    {
        $user = User::factory()->create();
        $data = ['name' => 'testNEW',
                 'description' => 'testtest',
                 'status_id' => $this->task->status->id,                /* @phpstan-ignore-line */
                 'created_by_id' => $this->task->createdBy->id,         /* @phpstan-ignore-line */
                 'assigned_to_id' => $this->task->assignedTo->id,       /* @phpstan-ignore-line */
        ];
        $response = $this->actingAs($user)
                         ->patch(route('tasks.update', $this->task), $data);   /* @phpstan-ignore-line */
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', $data);
    }
    public function testDestroy(): void
    {
        $user     = User::factory()->create();
        $response = $this->actingAs($user)->delete(route('tasks.destroy', [$this->task]));  /* @phpstan-ignore-line */
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseMissing('tasks', ['id' => $this->task->id]);                   /* @phpstan-ignore-line */
    }
}
