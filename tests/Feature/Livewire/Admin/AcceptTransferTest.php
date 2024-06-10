<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\AcceptTransfer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AcceptTransferTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(AcceptTransfer::class)
            ->assertStatus(200);
    }
}
