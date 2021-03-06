<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\LastFm\Service;

use Core23\LastFm\Exception\ApiException;
use Core23\LastFm\Exception\NotFoundException;

final class TagService extends AbstractService
{
    /**
     * Get the metadata for a tag on Last.fm. Includes biography.
     *
     * @param string $tag
     * @param string $lang
     *
     * @throws ApiException
     * @throws NotFoundException
     *
     * @return array
     */
    public function getInfo(string $tag, string $lang = null): array
    {
        return $this->unsignedCall('tag.getInfo', [
            'tag'  => $tag,
            'lang' => $lang,
        ]);
    }

    /**
     * Search for tags similar to this one. Returns tags ranked by similarity, based on listening data.
     *
     * @param string $tag
     *
     * @throws ApiException
     * @throws NotFoundException
     *
     * @return array
     */
    public function getSimilar($tag): array
    {
        return $this->unsignedCall('tag.getSimilar', [
            'tag' => $tag,
        ]);
    }

    /**
     * Get the top albums tagged by this tag, ordered by tag count.
     *
     * @param string $tag
     * @param int    $limit
     * @param int    $page
     *
     * @throws ApiException
     * @throws NotFoundException
     *
     * @return array
     */
    public function getTopAlbums(string $tag, int $limit = 50, int $page = 1): array
    {
        return $this->unsignedCall('tag.getTopAlbums', [
            'tag'   => $tag,
            'limit' => $limit,
            'page'  => $page,
        ]);
    }

    /**
     * Get the top artists tagged by this tag, ordered by tag count.
     *
     * @param string $tag
     * @param int    $limit
     * @param int    $page
     *
     * @throws ApiException
     * @throws NotFoundException
     *
     * @return array
     */
    public function getTopArtists(string $tag, int $limit = 50, int $page = 1): array
    {
        return $this->unsignedCall('tag.getTopArtists', [
            'tag'   => $tag,
            'limit' => $limit,
            'page'  => $page,
        ]);
    }

    /**
     * Fetches the top global tags on Last.fm, sorted by popularity (number of times used).
     *
     * @throws ApiException
     * @throws NotFoundException
     *
     * @return array
     */
    public function getTopTags(): array
    {
        return $this->unsignedCall('tag.getTopTags');
    }

    /**
     * Get the top tracks tagged by this tag, ordered by tag count.
     *
     * @param string $tag
     * @param int    $limit
     * @param int    $page
     *
     * @throws ApiException
     * @throws NotFoundException
     *
     * @return array
     */
    public function getTopTracks(string $tag, int $limit = 50, int $page = 1): array
    {
        return $this->unsignedCall('tag.getTopTracks', [
            'tag'   => $tag,
            'limit' => $limit,
            'page'  => $page,
        ]);
    }

    /**
     * Get a list of available charts for this tag, expressed as date ranges which can be sent to the chart services.
     *
     * @param string $tag
     *
     * @throws ApiException
     * @throws NotFoundException
     *
     * @return array
     */
    public function getWeeklyChartList(string $tag): array
    {
        return $this->unsignedCall('tag.getWeeklyChartList', [
            'tag' => $tag,
        ]);
    }
}
