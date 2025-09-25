<?php

namespace App\Events;

use App\Models\Task;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskDelegated implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $task;
    public $delegatedBy;
    public $delegatedTo;

    /**
     * Create a new event instance.
     */
    public function __construct(Task $task, User $delegatedBy, User $delegatedTo)
    {
        $this->task = $task;
        $this->delegatedBy = $delegatedBy;
        $this->delegatedTo = $delegatedTo;

        \Log::info('🎯 TaskDelegated event constructor called', [
            'task_id' => $task->id,
            'delegated_by' => $delegatedBy->id,
            'delegated_to' => $delegatedTo->id,
        ]);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        $channels = [
            new PrivateChannel('user.' . $this->delegatedTo->id),
        ];

        \Log::info('🎯 TaskDelegated broadcastOn called', [
            'channels' => array_map(fn ($channel) => $channel->name, $channels),
            'task_id' => $this->task->id,
            'delegated_to' => $this->delegatedTo->id,
        ]);

        return $channels;
    }

    /**
     * Get the data to broadcast.
     */
    public function broadcastWith(): array
    {
        return [
            'id' => $this->task->id,
            'title' => $this->task->title,
            'type' => 'task_delegated',
            'message' => "Tarefa '{$this->task->title}' foi delegada para você por {$this->delegatedBy->name}",
            'delegated_by' => [
                'id' => $this->delegatedBy->id,
                'name' => $this->delegatedBy->name,
                'email' => $this->delegatedBy->email,
            ],
            'delegated_to' => [
                'id' => $this->delegatedTo->id,
                'name' => $this->delegatedTo->name,
                'email' => $this->delegatedTo->email,
            ],
            'task' => [
                'id' => $this->task->id,
                'title' => $this->task->title,
                'description' => $this->task->description,
                'priority' => $this->task->priority,
                'status' => $this->task->status,
                'category' => $this->task->category,
                'due_date' => $this->task->due_date?->format('Y-m-d H:i:s'),
                'estimated_hours' => $this->task->estimated_hours,
            ],
            'timestamp' => now()->toISOString(),
        ];
    }

    /**
     * Get the broadcast event name.
     */
    public function broadcastAs(): string
    {
        return 'task.delegated';
    }
}
