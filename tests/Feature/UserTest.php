<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testBasic()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_login()
    {
        $response = $this->call('GET', 'adminTalaha/login');
        $this->assertResponseStatus(200); //Tương đương với lệnh trên
        $this->assertEquals('Lê Anh', $response->getContent());
    }

    public function testAddCategories(){
        $this->visit('/adminTalaha/categories/create')
            ->type('GIAY BUP BE', 'name')
            ->check('is_public')
            ->press('submit')
            ->see('Create category successfully');
    }


}
