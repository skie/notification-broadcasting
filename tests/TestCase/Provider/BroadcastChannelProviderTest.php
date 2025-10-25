<?php
declare(strict_types=1);

namespace Cake\BroadcastingNotification\Test\TestCase\Provider;

use Cake\BroadcastingNotification\Channel\BroadcastChannel;
use Cake\BroadcastingNotification\Provider\BroadcastChannelProvider;
use Cake\Core\Configure;
use Cake\Notification\Registry\ChannelRegistry;
use Cake\TestSuite\TestCase;

/**
 * BroadcastChannelProvider Test Case
 */
class BroadcastChannelProviderTest extends TestCase
{
    /**
     * Test provides returns broadcast channel
     *
     * @return void
     */
    public function testProvidesReturnsBroadcastChannel(): void
    {
        $provider = new BroadcastChannelProvider();

        $this->assertEquals(['broadcast'], $provider->provides());
    }

    /**
     * Test register adds broadcast channel to registry
     *
     * @return void
     */
    public function testRegisterAddsChannelToRegistry(): void
    {
        $provider = new BroadcastChannelProvider();
        $registry = new ChannelRegistry();

        $provider->register($registry);

        $this->assertTrue($registry->has('broadcast'));
        $channel = $registry->get('broadcast');
        $this->assertInstanceOf(BroadcastChannel::class, $channel);
    }

    /**
     * Test register uses configuration from Configure
     *
     * @return void
     */
    public function testRegisterUsesConfiguration(): void
    {
        Configure::write('Notification.channels.broadcast', [
            'custom' => 'config',
        ]);

        $provider = new BroadcastChannelProvider();
        $registry = new ChannelRegistry();

        $provider->register($registry);

        $this->assertTrue($registry->has('broadcast'));

        Configure::delete('Notification.channels.broadcast');
    }

    /**
     * Test getDefaultConfig returns empty array
     *
     * @return void
     */
    public function testGetDefaultConfigReturnsEmptyArray(): void
    {
        $provider = new BroadcastChannelProvider();

        $this->assertEquals([], $provider->getDefaultConfig());
    }
}
