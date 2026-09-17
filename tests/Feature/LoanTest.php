<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoanTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_can_be_rendered(): void
    {
        Item::create([
            'name' => 'Kamera Canon 80D',
            'code' => 'CMR-001',
            'category' => 'Multimedia',
            'description' => 'Kamera multimedia',
            'total_stock' => 2,
            'available_stock' => 2,
            'status' => 'available',
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Kamera Canon 80D');
    }

    public function test_user_can_submit_loan_request_with_nickname_and_contact(): void
    {
        $item = Item::create([
            'name' => 'Laptop ASUS ROG',
            'code' => 'LPT-001',
            'category' => 'Elektronik',
            'description' => 'Laptop spek tinggi',
            'total_stock' => 3,
            'available_stock' => 3,
            'status' => 'available',
        ]);

        $response = $this->post('/pinjam', [
            'nickname' => 'Alex',
            'borrower_name' => 'Alexander Graham',
            'phone_number' => '081299998888',
            'email' => 'alex@example.com',
            'item_id' => $item->id,
            'quantity' => 1,
            'borrow_date' => now()->toDateString(),
            'return_date' => now()->addDays(2)->toDateString(),
            'purpose' => 'Keperluan pengujian software sistem.',
        ]);

        $this->assertDatabaseHas('loans', [
            'nickname' => 'Alex',
            'borrower_name' => 'Alexander Graham',
            'email' => 'alex@example.com',
            'status' => 'pending',
        ]);

        $loan = Loan::where('nickname', 'Alex')->first();
        $response->assertRedirect(route('loans.success', $loan->loan_code));
    }

    public function test_admin_can_approve_loan_and_stock_is_decremented(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $item = Item::create([
            'name' => 'Proyektor Epson',
            'code' => 'PRJ-001',
            'category' => 'Presentasi',
            'description' => 'Proyektor ruang rapat',
            'total_stock' => 5,
            'available_stock' => 5,
            'status' => 'available',
        ]);

        $loan = Loan::create([
            'loan_code' => 'PJ-99999',
            'item_id' => $item->id,
            'nickname' => 'Budi',
            'borrower_name' => 'Budi Pratama',
            'phone_number' => '085712345678',
            'email' => 'budi@example.com',
            'quantity' => 2,
            'borrow_date' => now()->toDateString(),
            'return_date' => now()->addDays(3)->toDateString(),
            'purpose' => 'Presentasi proyek',
            'status' => 'pending',
        ]);

        $response = $this->actingAs($admin)->post("/admin/loans/{$loan->id}/status", [
            'status' => 'approved',
            'admin_notes' => 'Disetujui untuk presentasi',
        ]);

        $response->assertSessionHas('success');
        $this->assertEquals('approved', $loan->fresh()->status);
        $this->assertEquals(3, $item->fresh()->available_stock); // 5 - 2 = 3
    }

    public function test_user_can_track_loan_by_code(): void
    {
        $item = Item::create([
            'name' => 'Mic Wireless',
            'code' => 'MIC-001',
            'category' => 'Audio',
            'total_stock' => 2,
            'available_stock' => 2,
            'status' => 'available',
        ]);

        $loan = Loan::create([
            'loan_code' => 'PJ-77777',
            'item_id' => $item->id,
            'nickname' => 'Dewi',
            'borrower_name' => 'Dewi Lestari',
            'phone_number' => '082100001111',
            'email' => 'dewi@example.com',
            'quantity' => 1,
            'borrow_date' => now()->toDateString(),
            'return_date' => now()->addDays(1)->toDateString(),
            'purpose' => 'Acara seminar',
            'status' => 'pending',
        ]);

        $response = $this->get('/cek-status?query=PJ-77777');
        $response->assertStatus(200);
        $response->assertSee('PJ-77777');
        $response->assertSee('Dewi');
    }
}