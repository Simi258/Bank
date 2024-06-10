<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\MessagesList;
use App\Models\ContactUs;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class MessagesListTest extends TestCase
{
    public $employer;
    public $message;
    /** @test */
    public function admin_can_view_messages_list()
    {
        $this->employer = User:: factory()->create([
            'user_type' => 'employer'
        ]);
        $this->actingAs($this->employer);
        $this->message = ContactUs::factory()->count(10)->create();

        Livewire::test(MessagesList::class)
            ->assertSeeTextInOrder(
                $this->message->map(fn($message) => $message->subject)
                    ->toArray()
            );
    }

    /** @test */
    public function admin_can_delete_message()
    {
        $this->employer = User:: factory()->create([
            'user_type' => 'employer'
        ]);
        $this->actingAs($this->employer);
        $this->message = ContactUs::factory()->create();

        Livewire::test(MessagesList::class)
            ->call('deleteMessage', $this->message->id);

        $this->assertDatabaseMissing('contact_us', [
            'id' => $this->message->id,
        ]);
    }

    protected function tearDown(): void
    {
        User::destroy($this->employer->id);
    }
}
