<?php
declare(strict_types=1);

namespace Cake\BroadcastingNotification\Provider;

use Cake\BroadcastingNotification\Channel\BroadcastChannel;
use Cake\Core\Configure;
use Cake\Notification\Extension\ChannelProviderInterface;
use Cake\Notification\Registry\ChannelRegistry;

/**
 * Broadcast Channel Provider
 *
 * Registers the Broadcast channel with the notification system.
 */
class BroadcastChannelProvider implements ChannelProviderInterface
{
    /**
     * @inheritDoc
     */
    public function provides(): array
    {
        return ['broadcast'];
    }

    /**
     * @inheritDoc
     */
    public function register(ChannelRegistry $registry): void
    {
        $config = array_merge(
            $this->getDefaultConfig(),
            (array)Configure::read('Notification.channels.broadcast', []),
        );

        $registry->load('broadcast', [
            'className' => BroadcastChannel::class,
        ] + $config);
    }

    /**
     * @inheritDoc
     */
    public function getDefaultConfig(): array
    {
        return [];
    }
}
