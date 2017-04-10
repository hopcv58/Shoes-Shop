<?php

namespace Tests\Feature;

use App\Responsitory\Business;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BusinessTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
  /*  public function testExample()
    {
        $this->assertTrue(true);
    }*/

    private $business;
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->business = new Business();
        parent::__construct($name, $data, $dataName);
    }

    protected function setUp()
    {
        $this->business = new Business();
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    public function testAdminGetAllProductsFromCates()
    {
//        $this->assertArrayHasKey(0, $this->business->adminGetAllProductsFromCate(10));
        $this->assertNull($this->business->adminGetAllProductsFromCate(10));
    }
}