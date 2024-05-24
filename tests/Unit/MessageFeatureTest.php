namespace Tests\Feature;


use App\Models\User;
use App\Models\Contact;
use App\Models\Message;
use Tests\TestCase;

class MessageTest extends TestCase {
    public function testMessageCreation() {
        $user = User::factory()->create();
        $contact = Contact::factory()->create(['user_id' => $user->id]);


        $message = Message::create([
            'user_id' => $user->id,
            'contact_id' => $contact->id,
            'type' => 'sms',
            'message_content' => 'This is a test content.....',
        ]);

        $this->assertDatabaseHas('messages', [
            'user_id' => $user->id,
            'contact_id' => $contact->id,
            'type' => 'sms',
            'message_content' => 'This is a test content.....',
        ]);
    }
}
