<?php
namespace Smsglobal\ClassLibrary;

class PaginationDataTest extends \PHPUnit_Framework_TestCase
{
    protected function getMetaObject(
        $limit = 20, $offset = 0, $next = null, $previous = null,
        $totalCount = 20
    ) {
        return (object) array(
            'limit' => $limit,
            'offset' => $offset,
            'next' => $next,
            'previous' => $previous,
            'totalCount' => $totalCount,
        );
    }

    public function getOffsetForPageProvider()
    {
        return array(
            array(1, 20, 0),
            array(2, 20, 20),
            array(3, 20, 40),
            array(1, 100, 0),
            array(2, 100, 100),
        );
    }

    /**
     * @dataProvider getOffsetForPageProvider
     */
    public function testGetOffsetForPage($page, $itemsPerPage, $expected)
    {
        $actual = PaginationData::getOffsetForPage($page, $itemsPerPage);
        $this->assertEquals($expected, $actual);
    }

    public function testGetCurrentPage()
    {
        $paginator = new PaginationData($this->getMetaObject());
        $this->assertEquals(1, $paginator->getCurrentPage());
    }

    public function testGetCurrentPageOffset()
    {
        $paginator = new PaginationData($this->getMetaObject(20, 20));
        $this->assertEquals(2, $paginator->getCurrentPage());
    }

    public function testGetCurrentPageOffsetMore()
    {
        $paginator = new PaginationData($this->getMetaObject(20, 40));
        $this->assertEquals(3, $paginator->getCurrentPage());
    }

    public function testGetTotalPages()
    {
        $metaData = $this->getMetaObject(20, 0, null, null, 100);
        $paginator = new PaginationData($metaData);
        $this->assertEquals(5, $paginator->getTotalPages());
    }

    public function testGetTotalPagesOdd()
    {
        $metaData = $this->getMetaObject(20, 0, null, null, 105);
        $paginator = new PaginationData($metaData);
        $this->assertEquals(6, $paginator->getTotalPages());
    }

    public function testGetters()
    {
        $paginator = new PaginationData($this->getMetaObject());

        $this->assertEquals(20, $paginator->getLimit());
        $this->assertEquals(0, $paginator->getOffset());
        $this->assertEquals(null, $paginator->getNextPageUri());
        $this->assertEquals(null, $paginator->getPreviousPageUri());
        $this->assertEquals(20, $paginator->getTotalCount());
    }
}
