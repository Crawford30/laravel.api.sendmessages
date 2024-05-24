<?php
namespace Tests\Feature;


use App\Models\User;
use App\Models\Contact;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessageFeatureTest extends TestCase {
    use RefreshDatabase;

    public function testMessageIndex() {
        $response = $this->get('/api/message/all-messages');
        $response->assertStatus(201);
    }

    public function testMessageStore() {
        $user = User::factory()->create();
        $contact = Contact::factory()->create(['user_id' => $user->id]);

        $response = $this->postJson('/api/message/send-message', [
            'user_id' => $user->id,
            'contact_id' => $contact->id,
            'type' => 'sms',
            'message_content' => 'I am testing this message content with a valid',
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(['id', 'user_id', 'contact_id', 'type', 'content', 'created_at', 'updated_at']);
    }

    public function testInvalidMessageType() {
        $user = User::factory()->create();
        $contact = Contact::factory()->create(['user_id' => $user->id]);

        $response = $this->postJson('/api/message/send-message', [
            'user_id' => $user->id,
            'contact_id' => $contact->id,
            'type' => 'invalid_type',
            'message_content' => 'I am testing this message content with invalid type',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['type']);
    }
}
