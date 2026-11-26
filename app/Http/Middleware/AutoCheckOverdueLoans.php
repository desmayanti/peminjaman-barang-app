<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AutoCheckOverdueLoans
{
    /**
     * Cek dan kirim pengingat keterlambatan peminjaman secara otomatis setiap 30 menit saat website diakses.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            Cache::remember('auto_remind_overdue_checked', now()->addMinutes(30), function (): string {
                try {
                    Artisan::call('loans:remind-email');
                } catch (\Throwable $e) {
                    Log::warning('Gagal menjalankan auto-check pengingat email peminjaman: ' . $e->getMessage());
                }

                return now()->toDateTimeString();
            });
        } catch (\Throwable $e) {
            Log::warning('Gagal mengakses cache auto_remind_overdue_checked: ' . $e->getMessage());
        }

        return $next($request);
    }
}
