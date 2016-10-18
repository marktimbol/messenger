<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCanViewHisOrHerThreadsTest extends TestCase
{
	use DatabaseMigrations;

    public function test_a_user_can_view_all_his_or_her_threads()
    {
    	$john = factory(App\User::class)->create([
    		'name'	=> 'John'
    	]);
    	$jane = factory(App\User::class)->create([
    		'name'	=> 'Jane'
    	]);
    	$this->actingAs($john);

    	$message = factory(App\Message::class)->create([
            'from'  => $john->id,
            'to'    => $jane->id,
    		'body'	=> 'Hey Jane'
    	]);
    	$john->send($message)->toUser($jane);

    	// $this->visit('/threads')
    	// 	->see($message->body);
    }
}
