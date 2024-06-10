<?php

namespace Tests\Feature\Livewire;

use App\Livewire\ContactForm;
use App\Models\ContactUs;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    protected $user;

    /** @test */
    public function it_renders_the_contact_form_component()
    {
        $this->user = User::factory()->create();
        $this->actingAs($this->user);

        Livewire::test(ContactForm::class)
            ->assertViewIs('livewire.contact-form')
            ->assertSee('Name')
            ->assertSee('Email')
            ->assertSee('Message');
    }


    /**@test*/
    public function it_validates_the_contact_form_input()
    {
        $this->user = User::factory()->create();
        $this->actingAs($this->user);

        Livewire::test(ContactForm::class)
            ->set('name', '')
            ->set('email', '')
            ->set('message', '')
            ->call('submit')
            ->assertHasErrors(['name', 'email', 'message']);
    }

    /** @test */
    protected function tearDown(): void
    {
        User::destroy($this->user->id);

    }

}










//     $this->user =User::factory()->create();
//        $this->actingAs($this->user);
//        Livewire::test(ContactForm::class)
//            ->set('name', $this->user->name)
//            ->set('email', $this->user->email)
//            ->set('message', 'This is a test message')
//            ->call('submit')
//            ->assertSessionHas('success', 'Your message has been sent!')
//            ->assertRedirect(route('contact'));
