<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\LastFm\Service;

use Core23\LastFm\Connection\SessionInterface;
use Core23\LastFm\Exception\ApiException;
use Core23\LastFm\Exception\NotFoundException;

final class ArtistService extends AbstractService
{
    /**
     * Tag an artist using a list of user supplied tags.
     *
     * @param SessionInterface $session
     * @param string           $artist
     * @param string[]         $tags
     *
     * @throws \InvalidArgumentException
     * @throws ApiException
     * @throws NotFoundException
     */
    public function addTags(SessionInterface $session, string $artist, array $tags): void
    {
        $count = count($tags);

        if (0 === $count) {
            return;
        } elseif ($count > 10) {
            throw new \InvalidArgumentException('A maximum of 10 tags is allowed');
        }

        $this->signedCall('artist.addTags', [
            'artist' => $artist,
            'tags'   => implode(',', $tags),
        ], $session, 'POST');
    }

    /**
     * Check whether the supplied artist has a correction to a canonical artist.
     *
     * @param string $artist
     *
     * @throws ApiException
     * @throws NotFoundException
     *
     * @return array
     */
    public function getCorrection(string $artist): array
    {
        return $this->unsignedCall('artist.getCorrection', [
            'artist' => $artist,
        ]);
    }

    /**
     * Get the metadata for an artist on Last.fm. Includes biography.
     *
     * @param string $artist
     *
     * @throws ApiException
     * @throws NotFoundException
     *
     * @return array
     */
    public function getInfo(string $artist): array
    {
        return $this->unsignedCall('artist.getInfo', [
            'artist' => $artist,
        ]);
    }

    /**
     * Get all the artists similar to this artist.
     *
     * @param string $artist
     * @param int    $limit
     * @param bool   $autocorrect
     *
     * @throws ApiException
     * @throws NotFoundException
     *
     * @return array
     */
    public function getSimilar(string $artist, int $limit = 50, bool $autocorrect = false): array
    {
        return $this->unsignedCall('artist.getSimilar', [
            'artist'      => $artist,
            'limit'       => $limit,
            'autocorrect' => (int) $autocorrect,
        ]);
    }

    /**
     * Get all the artists similar to this artist using musicbrainz id.
     *
     * @param string $mbid
     * @param int    $limit
     * @param bool   $autocorrect
     *
     * @throws ApiException
     * @throws NotFoundException
     *
     * @return array
     */
    public function getSimilarByMBID($mbid, int $limit = 50, bool $autocorrect = false): array
    {
        return $this->unsignedCall('artist.getSimilar', [
            'mbid'        => $mbid,
            'limit'       => $limit,
            'autocorrect' => (int) $autocorrect,
        ]);
    }

    /**
     * Get the tags applied by an individual user to an artist on Last.fm.
     *
     *
     * @param string $artist
     * @param string $username
     * @param bool   $autocorrect
     *
     * @throws ApiException
     * @throws NotFoundException
     *
     * @return array
     */
    public function getTags($artist, string $username, bool $autocorrect = false): array
    {
        return $this->unsignedCall('artist.getTags', [
            'artist'      => $artist,
            'user'        => $username,
            'autocorrect' => (int) $autocorrect,
        ]);
    }

    /**
     * Get the tags applied by an individual user to an artist using musicbrainz id on Last.fm.
     *
     * @param string $mbid
     * @param string $username
     * @param bool   $autocorrect
     *
     * @throws ApiException
     * @throws NotFoundException
     *
     * @return array
     */
    public function getTagsByMBID($mbid, string $username, bool $autocorrect = false): array
    {
        return $this->unsignedCall('artist.getTags', [
            'mbid'        => $mbid,
            'user'        => $username,
            'autocorrect' => (int) $autocorrect,
        ]);
    }

    /**
     * Get the top albums for an artist on Last.fm, ordered by popularity.
     *
     * @param string $artist
     * @param int    $page
     * @param int    $limit
     * @param bool   $autocorrect
     *
     * @throws ApiException
     * @throws NotFoundException
     *
     * @return array
     */
    public function getTopAlbums($artist, int $page = 1, int $limit = 10, bool $autocorrect = false): array
    {
        return $this->unsignedCall('artist.getTopAlbums', [
            'artist'      => $artist,
            'page'        => $page,
            'limit'       => $limit,
            'autocorrect' => (int) $autocorrect,
        ]);
    }

    /**
     * Get the top albums for an artist using musicbrainz id on Last.fm, ordered by popularity.
     *
     * @param string $mbid
     * @param int    $page
     * @param int    $limit
     * @param bool   $autocorrect
     *
     * @throws ApiException
     * @throws NotFoundException
     *
     * @return array
     */
    public function getTopAlbumsByMBID($mbid, int $page = 1, int $limit = 10, bool $autocorrect = false): array
    {
        return $this->unsignedCall('artist.getTopAlbums', [
            'mbid'        => $mbid,
            'page'        => $page,
            'limit'       => $limit,
            'autocorrect' => (int) $autocorrect,
        ]);
    }

    /**
     * Get the top tags for an artist on Last.fm, ordered by popularity.
     *
     * @param string $artist
     * @param bool   $autocorrect
     *
     * @throws ApiException
     * @throws NotFoundException
     *
     * @return array
     */
    public function getTopTags($artist, bool $autocorrect = false): array
    {
        return $this->unsignedCall('artist.getTopTags', [
                'artist'      => $artist,
                'autocorrect' => (int) $autocorrect,
            ]);
    }

    /**
     * Get the top tags for an artist on Last.fm using musicbrainz id, ordered by popularity.
     *
     * @param string $mbid
     * @param bool   $autocorrect
     *
     * @throws ApiException
     * @throws NotFoundException
     *
     * @return array
     */
    public function getTopTagsByMBID($mbid, bool $autocorrect = false): array
    {
        return $this->unsignedCall('artist.getTopTags', [
                'mbid'        => $mbid,
                'autocorrect' => (int) $autocorrect,
            ]);
    }

    /**
     * Get the top tracks by an artist on Last.fm, ordered by popularity.
     *
     * @param string $artist
     * @param int    $page
     * @param int    $limit
     * @param bool   $autocorrect
     *
     * @throws ApiException
     * @throws NotFoundException
     *
     * @return array
     */
    public function getTopTracks($artist, int $page = 1, int $limit = 10, bool $autocorrect = false): array
    {
        return $this->unsignedCall('artist.getTopTracks', [
            'artist'      => $artist,
            'page'        => $page,
            'limit'       => $limit,
            'autocorrect' => (int) $autocorrect,
        ]);
    }

    /**
     * Get the top tracks by an artist on Last.fm using musicbrainz id, ordered by popularity.
     *
     * @param string $mbid
     * @param int    $page
     * @param int    $limit
     * @param bool   $autocorrect
     *
     * @throws ApiException
     * @throws NotFoundException
     *
     * @return array
     */
    public function getTopTracksByMBID($mbid, int $page = 1, int $limit = 10, bool $autocorrect = false): array
    {
        return $this->unsignedCall('artist.getTopTracks', [
            'mbid'        => $mbid,
            'page'        => $page,
            'limit'       => $limit,
            'autocorrect' => (int) $autocorrect,
        ]);
    }

    /**
     * Remove a user's tag from an artist.
     *
     * @param SessionInterface $session
     * @param string           $artist
     * @param string           $tag
     *
     * @throws ApiException
     * @throws NotFoundException
     */
    public function removeTag(SessionInterface $session, string $artist, string $tag): void
    {
        $this->signedCall('artist.removeTag', [
            'artist' => $artist,
            'tag'    => $tag,
        ], $session, 'POST');
    }

    /**
     * Search for an artist by name. Returns artist matches sorted by relevance.
     *
     * @param string $artist
     * @param int    $limit
     * @param int    $page
     *
     * @throws ApiException
     * @throws NotFoundException
     *
     * @return array
     */
    public function search(string $artist, int $limit = 50, int $page = 1): array
    {
        return $this->unsignedCall('artist.search', [
            'artist' => $artist,
            'limit'  => $limit,
            'page'   => $page,
        ]);
    }
}
