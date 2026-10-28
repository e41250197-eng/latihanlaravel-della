<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acara 32 - Integrasi & Pengujian Reverb</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Pusher & Laravel Echo via CDN -->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.16.1/dist/echo.iife.js"></script>
</head>
<body class="bg-light py-5">
    <div class="container" style="max-width: 750px;">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0">Acara 32: Integrasi & Pengujian Real-Time Reverb</h5>
            </div>
            <div class="card-body">
                <p class="text-muted">
                    Halaman ini mendengarkan event <code>OrderPlaced</code> pada kanal WebSocket Reverb secara real-time.
                </p>
                <button id="btnOrder" class="btn btn-success w-100 py-2 fw-semibold">
                    Simulasikan Buat Transaksi Baru (Trigger Event)
                </button>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white py-2">
                <h6 class="mb-0">Log Notifikasi Real-Time</h6>
            </div>
            <div class="card-body">
                <div id="notification-box" class="alert alert-info mb-0">
                    Menunggu broadcast pesanan dari server WebSocket Reverb...
                </div>
            </div>
        </div>
    </div>

    <script>
        // Inisialisasi Laravel Echo Client terhubung ke server Reverb
        window.Pusher = Pusher;
        window.Echo = new Echo({
            broadcaster: 'reverb',
            key: 'reverb-key',
            wsHost: window.location.hostname,
            wsPort: 8080,
            forceTLS: false,
            enabledTransports: ['ws']
        });

        // Listener Event broadcast
        window.Echo.channel('orders')
            .listen('.order.placed', (e) => {
                console.log('Order Placed Event Diterima:', e);
                const box = document.getElementById('notification-box');
                box.className = 'alert alert-success';
                box.innerHTML = `
                    <strong>Notifikasi Real-Time Masuk!</strong><br>
                    Order ID: <b>#${e.order_id}</b><br>
                    Pemesan: <b>${e.user_name}</b><br>
                    Total: <b>Rp ${Number(e.total).toLocaleString('id-ID')}</b>
                `;
                alert(`Order #${e.order_id} telah ditempatkan! Total: Rp ${Number(e.total).toLocaleString('id-ID')}`);
            });

        // Trigger request AJAX untuk membuat order baru
        document.getElementById('btnOrder').addEventListener('click', function() {
            fetch("{{ route('acara32.order.store') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                }
            })
            .then(res => res.json())
            .then(data => {
                console.log('Response Controller:', data);
            });
        });
    </script>
</body>
</html>
