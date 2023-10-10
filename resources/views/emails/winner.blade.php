@extends('layout.email')

@section('content')
    <h1 style="font-size: 24px; margin-bottom: 20px;">Congratulations, You're the Winner!</h1>

    <p>
        We are excited to inform you that you are the winner of the auction for the artwork "{{ $artwork->title }}".
    </p>

    <p>
        Winning Bid Amount: ₱{{ number_format($leadingBid->amount, 2) }}
    </p>

    <p>
        To complete the transaction and claim your artwork, please follow the steps provided below:
    </p>

    <ol>
        <li><strong>Log in to your account.</strong></li>
        <li>Follow the instructions to make the payment and arrange for the artwork's delivery or pickup.</li>
        <li>
            <strong>Click the button below to start a conversation with the artist:</strong>
            <div style="text-align: center; margin-top: 10px;">
                <form method="get" action="{{ url('chatify/' . $artwork->user->id) }}">
                    @csrf
                    <button style="background-color: #007bff; color: #fff; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                        Talk with the Artist
                    </button>
                </form>
            </div>
        </li>
    </ol>

    <p>
        If you have any questions or need assistance, please don't hesitate to contact our support team.
    </p>

    <p>
        Thank you for participating in the auction and for your support of our platform.
    </p>

    <p>
        Best regards,
        <br>
        E-Likha Organization
    </p>
@endsection
