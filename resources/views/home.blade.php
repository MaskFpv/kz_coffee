@extends('layouts.app')

@section('content')
    <style>
        .main {
            flex: 1;
            display: flex;
            align-items: center;
        }

        .right img {
            width: 100%;
        }

        .title {
            color: #4382b3;
            font-size: 3.2em;
            width: 50%;
            font-weight: bold;
            letter-spacing: 2px;
            margin-bottom: 30px;
        }

        .msg {
            color: #767a7d;
            font-size: 1.1em;
            letter-spacing: 0.7px;
            line-height: 32px;
            margin-bottom: 48px;
        }

        button.cta {
            border: none;
            outline: none;
            background-color: #8e7fa5;
            color: #fff;
            padding: 18px 32px;
            font-weight: bold;
            letter-spacing: 3px;
            text-transform: uppercase;
            border-radius: 30px;
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1),
                0 15px 12px rgba(0, 0, 0, 0.08);
            cursor: pointer;
            transition: opacity 0.9;
        }

        button.cta:hover {
            opacity: 0.9;
        }
    </style>
    <section class="main" style="">

        <section class="left" style="max-width: 45%;
        padding: 40px 64px;">
            <p class="title">KZ Coffee</p>
            <p class="msg">KZ Coffee adalah tempat yang sempurna untuk menikmati kopi berkualitas tinggi dan hidangan
                lezat
                lainnya. Mulai dari berbagai varian kopi dari seluruh dunia hingga makanan ringan dan sarapan sehat, kami
                memiliki semua yang Anda butuhkan untuk memulai hari dengan semangat.</p>
            <button class="cta">Pelajari Lebih Lanjut</button>
        </section>


        <section class="right">
            <img src="cafe.png" alt="Landing Image">
        </section>

    </section>
@endsection
