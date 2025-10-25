<?php
declare(strict_types=1);

namespace Cake\BroadcastingNotification\Test\TestCase\Channel;

use Cake\Broadcasting\Channel\PrivateChannel;
use Cake\BroadcastingNotification\Trait\BroadcastableNotificationTrait;
use Cake\Datasource\EntityInterface;
use Cake\Notification\AnonymousNotifiable;
use Cake\Notification\Notification;

/**
 * Test Broadcast Notification
 *
 * Simple notification for testing broadcast functionality
 */
class TestBroadcastNotification extends Notification
{
    use BroadcastableNotificationTrait;

    /**
     * Get channels
     *
     * @param \Cake\Datasource\EntityInterface|\Cake\Notification\AnonymousNotifiable $notifiable The notifiable entity
     * @return array<string>
     */
    public function via(EntityInterface|AnonymousNotifiable $notifiable): array
    {
        return ['broadcast'];
    }

    /**
     * Get broadcast data
     *
     * @param \Cake\Datasource\EntityInterface|\Cake\Notification\AnonymousNotifiable $notifiable The notifiable entity
     * @return array<string, mixed>
     */
    public function toBroadcast(EntityInterface|AnonymousNotifiable $notifiable): array
    {
        return [
            'message' => 'Test notification',
            'user_id' => $notifiable->get('id'),
        ];
    }

    /**
     * Get broadcast event name
     *
     * @return string
     */
    public function broadcastAs(): string
    {
        return 'notification.test.broadcast';
    }

    /**
     * Get broadcast channels
     *
     * @return array<\Cake\Broadcasting\Channel\Channel>
     */
    public function broadcastOn(): array
    {
        return [new PrivateChannel('test-channel')];
    }
}
