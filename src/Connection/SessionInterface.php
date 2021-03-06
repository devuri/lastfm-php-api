<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\LastFm\Connection;

interface SessionInterface
{
    /**
     * Returns name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Returns key.
     *
     * @return string
     */
    public function getKey(): string;

    /**
     * Returns subscriber.
     *
     * @return int
     */
    public function getSubscriber(): int;
}
