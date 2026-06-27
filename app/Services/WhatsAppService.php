<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.whatsapp_node.url', 'http://127.0.0.1:3000/api');
    }

    public function getStatus()
    {
        try {
            $response = Http::timeout(3)->get("{$this->baseUrl}/status");
            return $response->json();
        } catch (\Exception $e) {
            $this->startNodeService();
            Log::error('WhatsApp Service Status Error: ' . $e->getMessage() . ' - Attempting to auto-start service.');
            return ['status' => 'OFFLINE'];
        }
    }

    private function startNodeService()
    {
        if (cache()->has('whatsapp_service_starting')) {
            return;
        }
        
        // Prevent multiple start attempts within 15 seconds
        cache()->put('whatsapp_service_starting', true, now()->addSeconds(15));
        
        $nodeDir = base_path('whatsapp-server');
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            pclose(popen("cd /d \"{$nodeDir}\" && start /B node index.js > NUL 2>&1", "r"));
        } else {
            exec("cd \"{$nodeDir}\" && nohup node index.js > /dev/null 2>&1 &");
        }
    }

    public function getQrCode()
    {
        try {
            $response = Http::timeout(5)->get("{$this->baseUrl}/qr");
            return $response->json();
        } catch (\Exception $e) {
            Log::error('WhatsApp Service QR Error: ' . $e->getMessage());
            return ['success' => false, 'error' => 'Service offline'];
        }
    }

    public function sendMessage($phone, $message, $mediaUrl = null)
    {
        try {
            $payload = [
                'phone' => $phone,
                'message' => $message,
            ];
            
            if ($mediaUrl) {
                $payload['mediaUrl'] = $mediaUrl;
            }

            $response = Http::timeout(10)->post("{$this->baseUrl}/send", $payload);

            return $response->json();
        } catch (\Exception $e) {
            Log::error('WhatsApp Service Send Error: ' . $e->getMessage());
            return ['success' => false, 'error' => 'Failed to send message'];
        }
    }
}
