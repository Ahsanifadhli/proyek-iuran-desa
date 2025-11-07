<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SendEmail;
use App\Jobs\SendMailJob;

class SendEmailController extends Controller
{
    public function index(){
        return view('emails.kirim-email');
    }

    public function store(Request $request){
        $data = $request->all();

        dispatch((new SendMailJob($data)));
        return redirect()->route('kirim-email')->with('success', 'Alhamdulillah. Email berhasil dikirim');
    }

    public function handleContactForm(Request $request)
    {
        // 1. Ambil data mentah dari form kontak
        $senderName = $request->name;
        $senderEmail = $request->email;
        $messageBody = $request->body;

        // 2. Siapkan array $data untuk DIKIRIM KE JOB
        // Ini adalah data yang akan diterima oleh SendMailJob
        $data = [
            // 'email' di sini adalah EMAIL PENERIMA (yaitu email Anda/admin)
            'email' => 'ahsani.fadhli@gmail.com',

            // 'subject' adalah subjek email yang akan Anda terima
            'subject' => 'Ada pesan baru dari web nih' ,

            // 'name' adalah nama pengirim (untuk ditampilkan di template)
            'name' => $senderName,

            'emailpengirim' => $senderEmail,
            'body' => $messageBody
        ];

        // 3. Kirim ke queue (antrian)
        dispatch(new SendMailJob($data));

        // 4. Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim!');
    }
}
