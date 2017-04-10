<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Categories extends TestCase
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

    public function testAddCategories(){
        $this->visit('/adminTalaha/categories/create')
            ->type('GIAY BUP BE', 'name')
            ->check('is_public')
            ->press('submit')
            ->see('Create category successfully');
    }
}
