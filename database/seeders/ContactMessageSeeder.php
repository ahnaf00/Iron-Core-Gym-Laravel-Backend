<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Seeder;

class ContactMessageSeeder extends Seeder
{
    public function run(): void
    {
        $messages = [
            ['name' => 'Jordan Miles', 'email' => 'jordan.miles@email.com', 'subject' => 'Membership Inquiry', 'message' => 'Hi, I\'m interested in joining Iron Core Gym. Could you tell me more about the Premium plan and whether it includes access to personal training sessions?', 'is_read' => false],
            ['name' => 'Priya Sharma', 'email' => 'priya.sharma@email.com', 'subject' => 'Class Schedule Question', 'message' => 'Hello! I wanted to ask if the Morning Yoga class on Tuesdays is still available. I tried to book online but the slot seemed full.', 'is_read' => false],
            ['name' => 'David Chen', 'email' => 'd.chen92@email.com', 'subject' => 'Personal Training Request', 'message' => 'I\'ve been a Basic member for 6 months and I\'m thinking about upgrading to Elite for the personal training sessions. Can you let me know how the upgrade works?', 'is_read' => true, 'read_at' => now()],
            ['name' => 'Aisha Okafor', 'email' => 'aisha.okafor@gmail.com', 'subject' => 'Locker Room Feedback', 'message' => 'I wanted to share some feedback about the locker room facilities. The showers in the women\'s locker room have had low water pressure for the past two weeks.', 'is_read' => true, 'read_at' => now()],
            ['name' => 'Tom Eriksson', 'email' => 'tom.e@workmail.com', 'subject' => 'Corporate Membership', 'message' => 'I\'m the HR manager at a local tech company. We\'re exploring corporate gym partnerships. Does Iron Core offer group or corporate plans?', 'is_read' => false],
            ['name' => 'Layla Nasser', 'email' => 'layla.n@email.com', 'subject' => 'Lost Item', 'message' => 'I think I left my water bottle near the free weights area last Thursday evening. It\'s a black Hydro Flask with a small sticker. Has anyone turned it in?', 'is_read' => true, 'read_at' => now()],
        ];

        foreach ($messages as $message) {
            ContactMessage::create($message);
        }
    }
}
