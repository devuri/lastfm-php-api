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

final class AlbumService extends AbstractService
{
    /**
     * Tag an album using a list of user supplied tags.
     *
     * @param SessionInterface $session
     * @param string           $artist
     * @param string           $album
     * @param string[]         $tags
     *
     * @throws \InvalidArgumentException
     * @throws ApiException
     * @throws NotFoundException
     */
    public function addTags(SessionInterface $session, string $artist, string $album, array $tags): void
    {
        $count = count($tags);

        if (0 === $count) {
            return;
        } elseif ($count > 10) {
            throw new \InvalidArgumentException('A maximum of 10 tags is allowed');
        }

        $this->signedCall('album.addTags', [
            'artist' => $artist,
            'album'  => $album,
            'tags'   => implode(',', $tags),
        ], $session, 'POST');
    }

    /**
     * Get the metadata for an album on Last.fm using the musicbrainz id.
     *
     * @param string $mbid
     * @param bool   $autocorrect
     * @param string $username
     * @param string $lang
     *
     * @throws ApiException
     * @throws NotFoundException
     *
     * @return array
     */
    public function getInfoByMBID(string $mbid, bool $autocorrect = false, $username = null, $lang = null): array
    {
        return $this->unsignedCall('album.getInfo', [
            'mbid'        => $mbid,
            'autocorrect' => (int) $autocorrect,
            'username'    => $username,
            'lang'        => $lang,
        ]);
    }

    /**
     * Get the metadata for an album on Last.fm using the album name.
     *
     * @param string $artist
     * @param string $album
     * @param bool   $autocorrect
     * @param string $username
     * @param string $lang
     *
     * @throws ApiException
     * @throws NotFoundException
     *
     * @return array
     */
    public function getInfo($artist, string $album, bool $autocorrect = false, $username = null, $lang = null): array
    {
        return $this->unsignedCall('album.getInfo', [
            'artist'      => $artist,
            'album'       => $album,
            'autocorrect' => (int) $autocorrect,
            'username'    => $username,
            'lang'        => $lang,
        ]);
    }

    /**
     * Get the tags applied by an individual user to an album on Last.fm.
     *
     * @param string $artist
     * @param string $album
     * @param string $username
     * @param bool   $autocorrect
     *
     * @throws ApiException
     * @throws NotFoundException
     *
     * @return array
     */
    public function getTags($artist, string $album, string $username, bool $autocorrect = false): array
    {
        return $this->unsignedCall('album.getTags', [
            'artist'      => $artist,
            'album'       => $album,
            'autocorrect' => (int) $autocorrect,
            'user'        => $username,
        ]);
    }

    /**
     * Get the tags applied by an individual user to an album on Last.fm.
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
        return $this->unsignedCall('album.getTags', [
            'mbid'        => $mbid,
            'autocorrect' => (int) $autocorrect,
            'user'        => $username,
        ]);
    }

    /**
     * Get the top tags applied to an album on Last.fm.
     *
     * @param string $artist
     * @param string $album
     * @param bool   $autocorrect
     *
     * @throws ApiException
     * @throws NotFoundException
     *
     * @return array
     */
    public function getTopTags($artist, string $album, bool $autocorrect = false): array
    {
        return $this->unsignedCall('album.getTopTags', [
            'artist'      => $artist,
            'album'       => $album,
            'autocorrect' => (int) $autocorrect,
        ]);
    }

    /**
     * Get the top tags applied to an album on Last.fm.
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
        return $this->unsignedCall('album.getTopTags', [
            'mbid'        => $mbid,
            'autocorrect' => (int) $autocorrect,
        ]);
    }

    /**
     * Remove a user's tag from an album.
     *
     * @param SessionInterface $session
     * @param string           $artist
     * @param string           $album
     * @param string           $tag
     *
     * @throws ApiException
     * @throws NotFoundException
     */
    public function removeTag(SessionInterface $session, string $artist, string $album, string $tag): void
    {
        $this->signedCall('album.removeTag', [
            'artist' => $artist,
            'album'  => $album,
            'tag'    => $tag,
        ], $session, 'POST');
    }

    /**
     * Search for an album by name. Returns album matches sorted by relevance.
     *
     * @param string $album
     * @param int    $limit
     * @param int    $page
     *
     * @throws ApiException
     * @throws NotFoundException
     *
     * @return array
     */
    public function search(string $album, int $limit = 50, int $page = 1): array
    {
        return $this->unsignedCall('album.search', [
            'album' => $album,
            'limit' => $limit,
            'page'  => $page,
        ]);
    }
}
