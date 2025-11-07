<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email dari Praktikum</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 600px;
            margin: 20px auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }
        .header {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 30px;
        }
        .footer {
            background-color: #f9f9f9;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 0;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center" style="padding: 20px 0;">

                <table width="90%" border="0" cellspacing="0" cellpadding="0" style="max-width: 600px; border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">

                    <tr>
                        <td align="center" style="background-color: #f4f4f4; padding: 20px;">
                            <h2 style="margin: 0; color: #333;">Pesan Baru Diterima</h2>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 30px;">
                            <h3 style="margin-top: 0; color: #555;">Pesan dari: {{ $data['name'] }}</h3>
                            <h3 style="margin-top: 0; color: #555;">Email Pengirim Pesan: {{ $data['emailpengirim'] }}</h3>

                            <p style="margin-bottom: 20px; color: #666;">Isi Pesan:</p>

                            <div style="background-color: #fdfdfd; border: 1px solid #eee; padding: 15px; border-radius: 5px;">
                                <p style="margin: 0; white-space: pre-wrap;">{!! nl2br(e($data['body'])) !!}</p>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="background-color: #f9f9f9; padding: 20px; font-size: 12px; color: #777;">
                            <p style="margin: 0;">Semoga pesan yang diberikan kepadamu bisa diberikan respons yang baik ya! Terimakasih banyak.</p>
                        </td>
                    </tr>

                </table>
                </td>
        </tr>
    </table>
</body>
</html>
