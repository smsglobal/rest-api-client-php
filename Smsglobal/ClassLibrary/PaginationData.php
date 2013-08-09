<?php
namespace Smsglobal\RestApiClient;

/**
 * Utility for making the REST API's resource list response 'meta' object easier
 * to use. Handy for displaying page numbers, etc.
 *
 * @package Smsglobal\RestApiClient
 */
class PaginationData
{
    /**
     * Default limit of items per page
     */
    const DEFAULT_LIMIT = 20;

    /**
     * Limit (items per page)
     * @var int
     */
    protected $limit;

    /**
     * Offset
     * @var int
     */
    protected $offset;

    /**
     * URI of next page
     * @var null|string
     */
    protected $nextPageUri;

    /**
     * URI of previous page
     * @var null|string
     */
    protected $previousPageUri;

    /**
     * Total count of objects
     * @var int
     */
    protected $totalCount;

    /**
     * Current page number
     * @var int
     */
    protected $currentPage;

    /**
     * Total pages
     * @var int
     */
    protected $totalPages;

    /**
     * Handy function for calculating the value for the list offset based on a
     * page number.
     *
     * @param int $page         Page number to calculate the offset for
     * @param int $itemsPerPage How many items per page
     * @return int Offset
     */
    public static function getOffsetForPage(
        $page,
        $itemsPerPage = self::DEFAULT_LIMIT
    ) {
        return $page * $itemsPerPage - $itemsPerPage;
    }

    /**
     * Constructor
     *
     * @param \stdClass $metaData 'meta' object from the API response for lists
     */
    public function __construct(\stdClass $metaData)
    {
        $this->limit = $metaData->limit;
        $this->offset = $metaData->offset;
        $this->nextPageUri = $metaData->next;
        $this->previousPageUri = $metaData->previous;
        $this->totalCount = $metaData->totalCount;
    }

    /**
     * Gets the current page number
     *
     * @return int
     */
    public function getCurrentPage()
    {
        if (null === $this->currentPage) {
            if (0 === $this->offset) {
                $this->currentPage = 1;
            } else {
                $this->currentPage = (int) ($this->offset / $this->limit) + 1;
            }
        }

        return $this->currentPage;
    }

    /**
     * Gets the total number of pages
     *
     * @return int
     */
    public function getTotalPages()
    {
        if (null === $this->totalPages) {
            $this->totalPages = (int) ceil($this->totalCount / $this->limit);
        }

        return $this->totalPages;
    }

    /**
     * Gets the limit (items per page)
     *
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * Gets the URI of the next page. Null if there is no next page
     *
     * @return null|string
     */
    public function getNextPageUri()
    {
        return $this->nextPageUri;
    }

    /**
     * Gets the offset
     *
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * Gets the URI of the previous page. Null if there is no previous page
     *
     * @return null|string
     */
    public function getPreviousPageUri()
    {
        return $this->previousPageUri;
    }

    /**
     * Gets the total count of objects
     *
     * @return int
     */
    public function getTotalCount()
    {
        return $this->totalCount;
    }
}
