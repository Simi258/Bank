<?php

namespace Livewire\Admin;

use App\Livewire\Admin\CustomerIndex;
use App\Models\User;
use Livewire\Livewire;
use Termwind\Components\Li;
use Tests\TestCase;

class CustomerIndexTest extends TestCase
{
    protected $user;
    /** @test */
    public function renders_successfully()
    {
        $this->user = User::factory()->create([
            'user_type' => 'employer'
        ]);

        Livewire::actingAs($this->user)
            ->test(CustomerIndex::class)
            ->assertStatus(200);
    }

    /** @test */
    public function can_search_customer()
    {
        $searchTerm = 'Simran';
        $this->user = User::factory()->create([
            'user_type' => 'employer',
            'name' => $searchTerm
        ]);

        Livewire::actingAs($this->user)
            ->test(CustomerIndex::class)
            ->set('search', $searchTerm)
            ->assertSee($searchTerm);
    }
    protected function tearDown(): void
    {
        User::destroy($this->user->id);
    }

}
