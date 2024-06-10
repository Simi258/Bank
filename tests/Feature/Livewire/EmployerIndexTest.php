<?php

namespace Tests\Feature\Livewire;

use App\Livewire\EmployerIndex;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class EmployerIndexTest extends TestCase
{
    protected $user;
    protected $employer;
    /** @test */
    public function renders_successfully()
    {
        $this->user = User::factory()->create([
            'user_type' => 'employer',
        ]);


        Livewire::actingAs($this->user)
            ->test('employer-index')
            ->assertStatus(200);

        $this->user->delete();
    }
    /** @test */
    public function  can_search_employers()
    {
        $searchTerm = 'Name';
        $this->user = User::factory()->create([
            'user_type'=> 'employer',
            'name'=> $searchTerm,
        ]);

        Livewire::actingAs($this->user)
            ->test('employer-index')
            ->set('search',$searchTerm)
            ->assertSee($searchTerm);

       $this->user->delete();
    }

    /** @test */
    public function can_show_employer_info()
    {
        // Arrange
        $this->user = User::factory()->create([
            'user_type' => 'employer',
        ]);

        $this->employer= User::factory()->create([
            'user_type' => 'employer',
        ]);


        // Act
        $response = $this->actingAs($this->user)
            ->get(route('employ.info-employer', $this->employer->id));

        // Assert
        $response->assertStatus(200);
        $response->assertSee($this->employer->name);

        $this->user->delete();
        $this->employer->delete();
    }



}
