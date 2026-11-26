<?php

namespace Tests\Feature;

use App\Mail\LoanReminderMail;
use App\Models\Item;
use App\Models\Loan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class OverdueReminderTest extends TestCase
{
    use RefreshDatabase;

    public function test_auto_check_middleware_triggers_reminder_once_every_30_minutes(): void
    {
        Mail::fake();
        Cache::forget('auto_remind_overdue_checked');

        $item = Item::create([
            'name' => 'Proyektor Epson EB-X500',
            'code' => 'PRJ-101',
            'category' => 'Multimedia',
            'total_stock' => 5,
            'available_stock' => 2,
            'status' => 'available',
        ]);

        // 1. Overdue approved pinjam -> MUST receive reminder
        Loan::create([
            'loan_code' => 'PJ-11111',
            'item_id' => $item->id,
            'nickname' => 'Jena',
            'borrower_name' => 'Jena Pratama',
            'phone_number' => '08111111111',
            'email' => 'overdue@example.com',
            'quantity' => 1,
            'borrow_date' => now('Asia/Jakarta')->subDays(7)->toDateString(),
            'return_date' => now('Asia/Jakarta')->subDays(3)->toDateString(),
            'type' => 'pinjam',
            'purpose' => 'Acara sekolah',
            'status' => 'approved',
        ]);

        // 2. Approved pinjam returning in future -> MUST NOT receive reminder
        Loan::create([
            'loan_code' => 'PJ-22222',
            'item_id' => $item->id,
            'nickname' => 'Rose',
            'borrower_name' => 'Roseana',
            'phone_number' => '08222222222',
            'email' => 'future@example.com',
            'quantity' => 1,
            'borrow_date' => now('Asia/Jakarta')->toDateString(),
            'return_date' => now('Asia/Jakarta')->addDays(5)->toDateString(),
            'type' => 'pinjam',
            'purpose' => 'Presentasi',
            'status' => 'approved',
        ]);

        // 3. Pending/returned overdue -> MUST NOT receive reminder
        Loan::create([
            'loan_code' => 'PJ-33333',
            'item_id' => $item->id,
            'nickname' => 'Budi',
            'borrower_name' => 'Budi Santoso',
            'phone_number' => '08333333333',
            'email' => 'returned@example.com',
            'quantity' => 1,
            'borrow_date' => now('Asia/Jakarta')->subDays(10)->toDateString(),
            'return_date' => now('Asia/Jakarta')->subDays(5)->toDateString(),
            'type' => 'pinjam',
            'purpose' => 'Lomba',
            'status' => 'returned',
        ]);

        // First web access triggers middleware & reminder command
        $this->get('/')->assertStatus(200);

        $this->assertTrue(Cache::has('auto_remind_overdue_checked'));

        Mail::assertSent(LoanReminderMail::class, 1);
        Mail::assertSent(LoanReminderMail::class, function (LoanReminderMail $mail) {
            return $mail->hasTo('overdue@example.com')
                && $mail->daysOverdue === 3;
        });
        Mail::assertNotSent(LoanReminderMail::class, fn (LoanReminderMail $m) => $m->hasTo('future@example.com'));
        Mail::assertNotSent(LoanReminderMail::class, fn (LoanReminderMail $m) => $m->hasTo('returned@example.com'));

        // Second web access within 30 minutes hits cache and does not re-send
        $this->get('/')->assertStatus(200);
        Mail::assertSent(LoanReminderMail::class, 1);
    }
}
