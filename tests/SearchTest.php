<?php

namespace src\Tests;

use SNicholson\IPFO\Helpers\RightNumber;
use WorkAnyWare\IPFO\IPF;
use SNicholson\IPFO\Search;
use WorkAnyWare\IPFO\IPRights\SearchType;
use WorkAnyWare\IPFO\IPRights\Number;

class SearchTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $searchInterfaceMock;

    public function setUp()
    {
        $this->searchInterfaceMock = $this->getMockBuilder('SNicholson\IPFO\Searches\PatentSearch')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @test Test Search By Trade Mark Application Sets Correct Objects
     */
    public function testSearchByTradeMarkApplicationSetsCorrectObjects()
    {
        $search = Search::tradeMark()->byApplicationNumber('EP12345');
        $this->assertEquals(SearchType::tradeMark(), $search->getIPType());
        $this->assertEquals(RightNumber::application('EP12345'), $search->getNumber());
    }

    /**
     * @test Test Search By Patent Application Sets Correct Objects
     */
    public function testSearchByPatentApplicationSetsCorrectObjects()
    {
        $search = Search::patent()->byApplicationNumber('EP12345');
        $this->assertEquals(SearchType::patent(), $search->getIPType());
        $this->assertEquals(RightNumber::application('EP12345'), $search->getNumber());
    }

    /**
     * @test Test Search By Trade Mark Publication Sets Correct Objects
     */
    public function testSearchByTradeMarkPublicationSetsCorrectObjects()
    {
        $search = Search::tradeMark()->byPublicationNumber('EP12345');
        $this->assertEquals(SearchType::tradeMark(), $search->getIPType());
        $this->assertEquals(RightNumber::publication('EP12345'), $search->getNumber());
    }

    /**
     * @test Test Search By Patent Publication Sets Correct Objects
     */
    public function testSearchByPatentPublicationSetsCorrectObjects()
    {
        $search = Search::patent()->byPublicationNumber('EP12345');
        $this->assertEquals(SearchType::patent(), $search->getIPType());
        $this->assertEquals(RightNumber::publication('EP12345'), $search->getNumber());
    }

    /**
     * @test Test Search calls Search InterFace Correctly
     */
    public function testSearchCallsSearchInterFaceCorrectly()
    {
        $search = Search::patent()->byPublicationNumber('EP12345');
        $this->searchInterfaceMock->expects($this->once())->method('numberSearch')->with($search->getNumber())
            ->willReturn(new IPF());
        $search->run($this->searchInterfaceMock);
    }

    public function testSearchSetsSuccessToTrueOnSuccess()
    {
        $search = Search::patent()->byPublicationNumber('EP12345');
        $this->searchInterfaceMock->expects($this->once())->method('numberSearch')->with($search->getNumber())
                                  ->willReturn(new IPF());
        $this->assertEquals(true, $search->run($this->searchInterfaceMock)->getSuccess());
    }

    public function testSearchSetsSuccessToFalseOnSuccess()
    {
        $search = Search::patent()->byPublicationNumber('EP12345');
        $this->searchInterfaceMock->expects($this->once())->method('numberSearch')->with($search->getNumber())
                                  ->willReturn(false);
        $this->assertEquals(false, $search->run($this->searchInterfaceMock)->getSuccess());
    }
}
