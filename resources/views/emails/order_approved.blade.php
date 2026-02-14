<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Approved - Nichijou Japan ID</title>
    <style>
        /* Reset Styles */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        /* General */
        body {
            margin: 0;
            padding: 0;
            width: 100% !important;
            height: 100% !important;
            background-color: #f3f4f6;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333333;
            line-height: 1.6;
        }

        /* Client Specific Fixes */
        .apple-link a {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* Button Hover */
        .btn-primary:hover {
            background-color: #4338ca !important;
        }
    </style>
</head>

<body style="background-color: #f3f4f6; padding: 40px 0;">

    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center">

                <table border="0" cellpadding="0" cellspacing="0" width="100%"
                    style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">

                    <tr>
                        <td align="center" style="background-color: #4f46e5; padding: 30px 20px;">
                            <h1
                                style="color: #ffffff; margin: 0; font-size: 24px; font-weight: 700; letter-spacing: 1px;">
                                NICHIJOU JAPAN ID
                            </h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 40px 30px;">

                            <h2 style="margin-top: 0; color: #1f2937; font-size: 20px;">
                                Halo, {{ $order->customer_name }}! 👋
                            </h2>

                            <p style="color: #4b5563; font-size: 16px; margin-bottom: 24px;">
                                Terima kasih telah berbelanja. <br> Pembayaran kamu untuk Order
                                <strong>#{{ $order->id }}</strong> telah berhasil.
                            </p>

                            <div style="border-bottom: 2px solid #f3f4f6; margin-bottom: 20px; padding-bottom: 10px;">
                                <span
                                    style="font-size: 14px; color: #6b7280; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                                    Akses Produk Digital Anda
                                </span>
                            </div>

                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                @foreach ($order->items as $item)
                                    @php
                                        // Ambil link produk dari relasi product
                                        $product = \App\Models\Product::find($item->product_id);
                                    @endphp

                                    <tr>
                                        <td style="padding-bottom: 20px;">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                                style="background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px;">
                                                <tr>
                                                    <td style="padding: 20px;">
                                                        <div
                                                            style="font-size: 16px; font-weight: 700; color: #111827; margin-bottom: 5px;">
                                                            {{ $item->product_name }}
                                                        </div>
                                                        <div
                                                            style="font-size: 14px; color: #6b7280; margin-bottom: 15px;">
                                                            Digital Download / Access
                                                        </div>

                                                        @if ($product && $product->product_link)
                                                            <table border="0" cellpadding="0" cellspacing="0">
                                                                <tr>
                                                                    <td align="center" style="border-radius: 6px;"
                                                                        bgcolor="#4f46e5">
                                                                        <a href="{{ $product->product_link }}"
                                                                            target="_blank"
                                                                            style="font-size: 14px; font-weight: 600; color: #ffffff; text-decoration: none; padding: 12px 24px; border-radius: 6px; display: inline-block; border: 1px solid #4f46e5;">
                                                                            Akses Produk &rarr;
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        @else
                                                            <div
                                                                style="background-color: #fee2e2; color: #991b1b; padding: 10px; border-radius: 6px; font-size: 13px; display: inline-block;">
                                                                Link belum tersedia. Silakan hubungi admin.
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                            <p style="margin-top: 20px; font-size: 14px; color: #6b7280;">
                                Jika tombol di atas tidak berfungsi, Anda bisa menghubungi kami melalui WhatsApp Admin
                                untuk bantuan manual.
                            </p>

                        </td>
                    </tr>

                    <tr>
                        <td align="center"
                            style="background-color: #f9fafb; padding: 20px; border-top: 1px solid #e5e7eb;">
                            <p style="margin: 0; font-size: 12px; color: #9ca3af;">
                                &copy; {{ date('Y') }} Nichijou Japan ID. All rights reserved.<br>
                                Email ini dibuat secara otomatis, mohon tidak membalas secara langsung.
                            </p>
                        </td>
                    </tr>

                </table>
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td height="40" style="font-size: 0; line-height: 0;">&nbsp;</td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

</body>

</html>
