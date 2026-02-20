<!DOCTYPE html>
<html>

    <head>
        <title>Event Ticket</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                color: #2c1810;
                background: linear-gradient(135deg, #fef5e7 0%, #d4a574 50%, #8b4513 100%);
                min-height: 100vh;
                padding: 20px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .ticket-box {
                border: none;
                padding: 45px;
                width: 100%;
                max-width: 550px;
                margin: 0 auto;
                background: #fefdfb;
                border-radius: 12px;
                box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            }

            .header {
                border-bottom: 1px solid #e8d9c7;
                padding-bottom: 30px;
                margin-bottom: 35px;
                text-align: center;
            }

            .title {
                font-size: 28px;
                font-weight: 600;
                color: #8b4513;
                text-align: center;
                text-transform: uppercase;
                font-family: 'Georgia', 'Times New Roman', serif;
                letter-spacing: 0.5px;
                margin-bottom: 12px;
            }

            .date-time {
                font-size: 12px;
                color: #6b5344;
                margin-top: 8px;
            }

            .info-row {
                margin-bottom: 22px;
                padding: 10px 0;
                border-bottom: 1px solid #f5ede8;
            }

            .info-row:last-of-type {
                border-bottom: none;
            }

            .label {
                font-size: 10px;
                color: #8b4513;
                text-transform: uppercase;
                font-weight: 600;
                letter-spacing: 0.8px;
                display: block;
                margin-bottom: 4px;
                opacity: 0.85;
            }

            .value {
                font-size: 16px;
                font-weight: 500;
                color: #2c1810;
            }

            .qr-area {
                text-align: center;
                margin-top: 40px;
                padding-top: 30px;
                border-top: 1px solid #e8d9c7;
            }

            .qr-area img {
                width: 140px;
                height: 140px;
                border: none;
                border-radius: 8px;
                padding: 8px;
                background: white;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            }

            .qr-text {
                font-size: 10px;
                color: #8b4513;
                margin-top: 12px;
                font-weight: 500;
                letter-spacing: 0.3px;
            }

            .footer {
                font-size: 9px;
                text-align: center;
                margin-top: 30px;
                color: #8b4513;
                padding-top: 20px;
                border-top: 1px solid #f5ede8;
                opacity: 0.8;
            }

            .badge {
                background: #fef5e7;
                padding: 6px 14px;
                border-radius: 4px;
                font-size: 11px;
                font-weight: 600;
                color: #8b4513;
                border: 1px solid #e8d9c7;
                display: inline-block;
                margin-top: 15px;
                letter-spacing: 0.5px;
            }

            .guests-info {
                font-size: 11px;
                color: #8b4513;
                margin-top: 4px;
                opacity: 0.8;
            }

            .ref-info {
                font-size: 10px;
                color: #8b4513;
                margin-top: 8px;
            }
        </style>
    </head>

    <body>

        <div class="ticket-box">
            <!-- Header -->
            <div class="header">
                <div class="title">{{ $ticket->event->title }}</div>
                <div class="date-time">
                    <span class="label">Date:</span>
                    <strong>{{ \Carbon\Carbon::parse($ticket->event->date)->format('M d, Y') }}</strong>
                    &nbsp;•&nbsp;
                    <strong>{{ \Carbon\Carbon::parse($ticket->event->time)->format('g:i A') }}</strong>
                </div>
            </div>

            <!-- Event Details -->
            <div class="info-row">
                <div class="label">Location</div>
                <div class="value">{{ $ticket->event->location }}</div>
            </div>

            <div class="info-row">
                <div class="label">Total Attending</div>
                <div class="value">{{ $ticket->guests_count + 1 }} People</div>
            </div>

            <div style="margin-top: 25px;">
                <span class="badge">
                    {{ $payment ? 'PAID TICKET' : 'FREE ENTRY' }}
                </span>
                @if ($payment)
                    <div class="ref-info">Reference: <strong>#{{ strtoupper($payment->reference) }}</strong></div>
                @endif
            </div>

            <!-- QR Code -->
            <div class="qr-area">
                <img src="{!! $qrcode !!}" alt="QR Code">
                <p class="qr-text">Scan at venue entrance</p>
            </div>

            <div class="footer">
                Micmash EventHub • {{ date('M d, Y H:i') }}
            </div>
        </div>

    </body>

</html>
